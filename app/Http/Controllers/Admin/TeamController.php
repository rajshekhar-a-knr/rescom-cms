<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamDepartment;
use App\Models\TeamMember;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::with('department')->orderBy('sort_order')->paginate(20);

        return view('admin.pages.team.index', compact('members'));
    }

    public function create()
    {
        $departments = TeamDepartment::orderBy('sort_order')->get();

        return view('admin.pages.team.form', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedTeamMemberData($request);
        $data = $this->handleFileUploads($request, $data);

        $member = TeamMember::create($data);
        $this->saveCardQr($member);

        return redirect()->route('admin.team.index')->with('success', 'Team member added!');
    }

    public function edit(TeamMember $team)
    {
        $departments = TeamDepartment::orderBy('sort_order')->get();

        return view('admin.pages.team.form', ['member' => $team, 'departments' => $departments]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $this->validatedTeamMemberData($request, $team);
        $data = $this->handleFileUploads($request, $data);

        $team->update($data);
        $this->saveCardQr($team->fresh());

        return redirect()->route('admin.team.index')->with('success', 'Team member updated!');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Member deleted!');
    }

    public function toggle($id)
    {
        $member = TeamMember::findOrFail($id);
        $member->update(['is_active' => !$member->is_active]);

        return response()->json(['success' => true]);
    }

    private function validatedTeamMemberData(Request $request, ?TeamMember $member = null): array
    {
        $memberId = $member?->id;
        $phoneRule = ['nullable', 'string', 'max:50', 'regex:/^(?=(?:\\D*\\d){10,15}\\D*$)[0-9\\s\\+\\-\\(\\)]+$/'];

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['nullable', 'alpha_dash', 'max:120', Rule::unique('team_members', 'slug')->ignore($memberId)],
            'designation' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:team_departments,id',
            'experience_years' => 'nullable|integer|min:0|max:60',
            'bio' => 'nullable|string|max:2000',
            'tagline' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => $phoneRule,
            'linkedin_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'github_url' => 'nullable|url|max:500',
            'skills_raw' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:5120',
            'banner' => 'nullable|image|max:5120',
            'company_name' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|max:3072',
            'company_website' => 'nullable|url|max:500',
            'region1_label' => 'nullable|string|max:60',
            'region1_phone' => $phoneRule,
            'region1_whatsapp' => $phoneRule,
            'region1_email' => 'nullable|email|max:255',
            'region1_website' => 'nullable|url|max:500',
            'region2_label' => 'nullable|string|max:60',
            'region2_phone' => $phoneRule,
            'region2_whatsapp' => $phoneRule,
            'region2_email' => 'nullable|email|max:255',
            'region2_website' => 'nullable|url|max:500',
            'linkedin' => 'nullable|url|max:500',
            'whatsapp' => $phoneRule,
            'instagram' => 'nullable|url|max:500',
            'twitter' => 'nullable|url|max:500',
            'youtube' => 'nullable|url|max:500',
            'facebook' => 'nullable|url|max:500',
            'years_experience' => 'nullable|integer|min:0|max:100',
            'learners_count' => 'nullable|integer|min:0',
            'workshops_count' => 'nullable|integer|min:0',
            'countries_count' => 'nullable|string|max:20',
            'top_skills_raw' => 'nullable|string|max:2000',
            'core_services_raw' => 'nullable|string|max:12000',
            'why_us_points_raw' => 'nullable|string|max:12000',
            'mission_text' => 'nullable|string|max:2000',
            'vision_text' => 'nullable|string|max:2000',
            'theme_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'accent_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['name'], $memberId);
        $data['skills'] = $this->linesToArray($request->input('skills_raw'));
        $data['top_skills'] = $this->linesToArray($request->input('top_skills_raw')) ?: null;
        $data['core_services'] = $this->jsonArrayField($request, 'core_services_raw', 'Core services');
        $data['why_us_points'] = $this->jsonArrayField($request, 'why_us_points_raw', 'Why us points');
        $data['mission_vision'] = $this->missionVisionField($request);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        unset(
            $data['skills_raw'],
            $data['top_skills_raw'],
            $data['core_services_raw'],
            $data['why_us_points_raw'],
            $data['mission_text'],
            $data['vision_text']
        );

        return $data;
    }

    private function handleFileUploads(Request $request, array $data): array
    {
        foreach (['photo', 'banner', 'company_logo'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = upload_to_storage($request->file($field), 'team');
            }
        }

        return $data;
    }

    private function uniqueSlug(?string $requestedSlug, string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($requestedSlug ?: $name) ?: 'team-member';
        $slug = $baseSlug;
        $counter = 2;

        while (
            TeamMember::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function linesToArray(?string $value): array
    {
        $lines = preg_split("/\r\n|\r|\n/", trim((string) $value));

        return array_values(array_filter(array_map('trim', $lines ?: [])));
    }

    private function jsonArrayField(Request $request, string $field, string $label): ?array
    {
        $rawValue = trim((string) $request->input($field));

        if ($rawValue === '') {
            return null;
        }

        $decoded = json_decode($rawValue, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            throw ValidationException::withMessages([
                $field => $label . ' must be valid JSON.',
            ]);
        }

        return $decoded;
    }

    private function missionVisionField(Request $request): ?array
    {
        $mission = trim((string) $request->input('mission_text'));
        $vision = trim((string) $request->input('vision_text'));

        if ($mission === '' && $vision === '') {
            return null;
        }

        return [
            'mission' => $mission,
            'vision' => $vision,
        ];
    }

    private function saveCardQr(TeamMember $member): void
    {
        if (!$member->slug) {
            return;
        }

        try {
            $svg = (string) QrCode::format('svg')
                ->size(420)
                ->margin(1)
                ->errorCorrection('H')
                ->generate($member->cardUrl());

            $path = 'cards/qr/' . $member->slug . '.svg';
            $this->putQrAsset($path, $svg);
            $member->forceFill(['qr_code' => $path])->saveQuietly();

            if (function_exists('imagecreatetruecolor')) {
                $png = $this->makeQrPng($member);
                $pngPath = 'cards/qr/' . $member->slug . '.png';
                $this->putQrAsset($pngPath, $png);
            }
        } catch (\Throwable $exception) {
            report($exception);
        }
    }

    private function putQrAsset(string $path, string $contents): bool
    {
        try {
            return Storage::disk(config('filesystems.default', 'public'))->put($path, $contents);
        } catch (\Throwable $exception) {
            report($exception);
        }

        try {
            return Storage::disk('public')->put($path, $contents);
        } catch (\Throwable $exception) {
            report($exception);
        }

        return false;
    }

    private function makeQrPng(TeamMember $member, int $size = 420, int $margin = 1): string
    {
        if (! function_exists('imagecreatetruecolor')) {
            throw new \RuntimeException('The GD extension is required to generate PNG QR codes.');
        }

        $qrCode     = Encoder::encode($member->cardUrl(), ErrorCorrectionLevel::H(), Encoder::DEFAULT_BYTE_MODE_ECODING);
        $matrix     = $qrCode->getMatrix();
        $matrixSize = $matrix->getWidth();
        $total      = $matrixSize + ($margin * 2);
        $scale      = max(1, intdiv($size, $total));
        $imgSize    = $total * $scale;

        $image = imagecreatetruecolor($imgSize, $imgSize);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        imagefill($image, 0, 0, $white);

        for ($y = 0; $y < $matrixSize; $y++) {
            for ($x = 0; $x < $matrixSize; $x++) {
                if ($matrix->get($x, $y) !== 1) {
                    continue;
                }

                $left = ($x + $margin) * $scale;
                $top  = ($y + $margin) * $scale;
                imagefilledrectangle($image, $left, $top, $left + $scale - 1, $top + $scale - 1, $black);
            }
        }

        ob_start();
        imagepng($image);
        imagedestroy($image);

        return (string) ob_get_clean();
    }
}
