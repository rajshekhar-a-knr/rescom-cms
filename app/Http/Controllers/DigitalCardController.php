<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DigitalCardController extends Controller
{
    public function show(string $slug)
    {
        $member = $this->activeMember($slug);

        return view('digital-card.show', compact('member'));
    }

    public function downloadVcf(string $slug)
    {
        $member = $this->activeMember($slug);

        if ($member->vcf_file && Storage::disk('public')->exists($member->vcf_file)) {
            return Storage::disk('public')->download($member->vcf_file, Str::slug($member->name) . '.vcf');
        }

        return response($member->generateVcf(), 200, [
            'Content-Type'        => 'text/vcard; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . Str::slug($member->name) . '.vcf"',
        ]);
    }

    public function downloadPdf(string $slug)
    {
        $member = $this->activeMember($slug);

        $siteLogo    = (string) setting('site_logo', '');
        $companyName = (string) setting('site_name', 'Rescom');

        $pdf = Pdf::loadView('digital-card.pdf', [
            'member'          => $member,

            // ── Company identity ──────────────────────────────────────────
            'companyName'     => $companyName,
            'companyTagline'  => (string) setting('site_tagline', ''),
            'companyLogo'     => $this->imageDataUri($siteLogo) ?: $siteLogo,

            // ── India / primary office ────────────────────────────────────
            // Address text stored in the CMS setting OR per-member field
            'companyAddress'    => $member->region1_address
                                    ?: (string) setting('contact_address', ''),
            'companyWebsite'    => $member->region1_website
                                    ?: (string) setting('contact_website', url('/')),
            'companyEmail'      => $member->region1_office_email
                                    ?: $member->region1_email
                                    ?: (string) setting('contact_email', ''),

            // ── Corporate / secondary office ─────────────────────────────
            'companyAddressAlt' => $member->region2_address
                                    ?: (string) setting('contact_aus_address', ''),
            'companyWebsiteAlt' => $member->region2_website
                                    ?: (string) setting('contact_aus_website', ''),
            'companyEmailAlt'   => $member->region2_office_email
                                    ?: $member->region2_email
                                    ?: (string) setting('contact_aus_email', ''),

            // ── QR code (embedded as data URI so dompdf never hits the net) ──
            'qrImageDataUri'  => $this->qrPngDataUri($member),
        ])
            ->setOption('isRemoteEnabled', true)
            ->setPaper([0, 0, 241.89, 153.07]);   // 85 × 54 mm in points

        return $pdf->download(Str::slug($member->name) . '-digital-card.pdf');
    }

    public function qrCode(Request $request, string $slug)
    {
        $member = $this->activeMember($slug);

        if (Str::endsWith($request->path(), '.png')) {
            $pngPath = $this->pngQrPath($member);

            if ($pngPath) {
                foreach ($this->storageDisks() as $disk) {
                    try {
                        if ($disk->exists($pngPath)) {
                            return response($disk->get($pngPath), 200, [
                                'Content-Type'  => 'image/png',
                                'Cache-Control' => 'public, max-age=86400',
                            ]);
                        }
                    } catch (\Throwable $exception) {
                        report($exception);
                    }
                }
            }

            try {
                $png = $this->makeQrPng($member);

                return response((string) $png, 200, [
                    'Content-Type'  => 'image/png',
                    'Cache-Control' => 'public, max-age=86400',
                ]);
            } catch (\Throwable $exception) {
                report($exception);
            }
        }

        $svg = $this->storedQrSvg($member);

        return response($svg, 200, [
            'Content-Type'  => 'image/svg+xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    // ─────────────────────────────────────────────────────────────────
    // Private helpers
    // ─────────────────────────────────────────────────────────────────

    private function activeMember(string $slug): TeamMember
    {
        return TeamMember::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    private function storedQrSvg(TeamMember $member): string
    {
        if ($member->qr_code) {
            foreach ($this->storageDisks() as $disk) {
                try {
                    if ($disk->exists($member->qr_code)) {
                        return $disk->get($member->qr_code);
                    }
                } catch (\Throwable $exception) {
                    report($exception);
                }
            }
        }

        return $this->makeQrSvg($member);
    }

    private function pngQrPath(TeamMember $member): ?string
    {
        if (! $member->qr_code) {
            return null;
        }

        return Str::endsWith($member->qr_code, '.png')
            ? $member->qr_code
            : preg_replace('/\.svg$/i', '.png', $member->qr_code);
    }

    private function qrPngDataUri(TeamMember $member): string
    {
        return 'data:image/png;base64,' . base64_encode($this->makeQrPng($member));
    }

    private function storageDisk()
    {
        try {
            return Storage::disk(config('filesystems.default', 'public'));
        } catch (\Throwable $exception) {
            report($exception);
            return Storage::disk('public');
        }
    }

    private function storageDisks(): array
    {
        $disks = [];

        try {
            $defaultDisk = Storage::disk(config('filesystems.default', 'public'));
            $disks[] = $defaultDisk;
        } catch (\Throwable $exception) {
            report($exception);
        }

        if (config('filesystems.default', 'public') !== 'public') {
            try {
                $publicDisk = Storage::disk('public');
                $disks[] = $publicDisk;
            } catch (\Throwable $exception) {
                report($exception);
            }
        }

        if (empty($disks)) {
            $disks[] = Storage::disk('public');
        }

        return $disks;
    }

    private function makeQrSvg(TeamMember $member): string
    {
        return (string) QrCode::format('svg')
            ->size(420)
            ->margin(1)
            ->errorCorrection('H')
            ->generate($member->cardUrl());
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

    private function imageDataUri(?string $source): ?string
    {
        $source = trim((string) $source);

        if ($source === '' || Str::startsWith($source, 'data:')) {
            return $source ?: null;
        }

        $contents  = null;
        $extension = strtolower(
            pathinfo(parse_url($source, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION)
        );

        try {
            if (Str::startsWith($source, ['http://', 'https://'])) {
                $context  = stream_context_create([
                    'http' => ['timeout' => 5],
                    'ssl'  => ['verify_peer' => false, 'verify_peer_name' => false],
                ]);
                $contents = @file_get_contents($source, false, $context);
            } else {
                $path = Str::startsWith($source, ['/'])
                    ? public_path(ltrim($source, '/'))
                    : public_path($source);

                if (is_file($path)) {
                    $contents = file_get_contents($path);
                }
            }
        } catch (\Throwable $exception) {
            report($exception);
        }

        if (! $contents) {
            return null;
        }

        $mime = match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'svg'         => 'image/svg+xml',
            'webp'        => 'image/webp',
            default       => 'image/png',
        };

        return 'data:' . $mime . ';base64,' . base64_encode($contents);
    }
}