<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    protected $fillable = [
        'department_id',
        'slug',
        'name',
        'designation',
        'bio',
        'tagline',
        'photo',
        'banner',
        'company_name',
        'company_logo',
        'company_website',
        'email',
        'phone',
        'region1_label',
        'region1_phone',
        'region1_whatsapp',
        'region1_email',
        'region1_website',
        'region2_label',
        'region2_phone',
        'region2_whatsapp',
        'region2_email',
        'region2_website',
        'linkedin_url',
        'twitter_url',
        'github_url',
        'linkedin',
        'whatsapp',
        'instagram',
        'twitter',
        'youtube',
        'facebook',
        'vcf_file',
        'qr_code',
        'skills',
        'top_skills',
        'core_services',
        'why_us_points',
        'mission_vision',
        'experience_years',
        'years_experience',
        'learners_count',
        'workshops_count',
        'countries_count',
        'theme_color',
        'accent_color',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'skills' => 'array',
        'top_skills' => 'array',
        'core_services' => 'array',
        'why_us_points' => 'array',
        'mission_vision' => 'array',
    ];

    public function department()
    {
        return $this->belongsTo(TeamDepartment::class, 'department_id');
    }

    public function photoUrl(): string
    {
        return $this->cardMediaUrl($this->photo) ?: $this->placeholderAvatar();
    }

    public function bannerUrl(): ?string
    {
        return $this->cardMediaUrl($this->banner);
    }

    public function companyLogoUrl(): ?string
    {
        return $this->cardMediaUrl($this->company_logo);
    }

    public function vcfUrl(): ?string
    {
        return $this->cardMediaUrl($this->vcf_file);
    }

    public function qrUrl(): ?string
    {
        if (!$this->slug) {
            return null;
        }

        return route('digital-card.qr', $this->slug);
    }

    public function cardUrl(): string
    {
        return route('digital-card.show', $this->slug);
    }

    public function generateVcf(): string
    {
        $lines = [
            'BEGIN:VCARD',
            'VERSION:3.0',
            'FN:' . $this->escapeVcfValue($this->name),
            'N:' . $this->escapeVcfValue($this->name) . ';;;;',
        ];

        if ($this->designation) {
            $lines[] = 'TITLE:' . $this->escapeVcfValue($this->designation);
        }

        if ($this->company_name) {
            $lines[] = 'ORG:' . $this->escapeVcfValue($this->company_name);
        }

        if ($this->region1_phone) {
            $lines[] = 'TEL;TYPE=CELL:' . $this->escapeVcfValue($this->region1_phone);
        }

        if ($this->region2_phone) {
            $lines[] = 'TEL;TYPE=WORK:' . $this->escapeVcfValue($this->region2_phone);
        }

        if ($this->region1_email) {
            $lines[] = 'EMAIL;TYPE=WORK:' . $this->escapeVcfValue($this->region1_email);
        }

        if ($this->region2_email) {
            $lines[] = 'EMAIL;TYPE=HOME:' . $this->escapeVcfValue($this->region2_email);
        }

        if ($this->region1_website) {
            $lines[] = 'URL:' . $this->escapeVcfValue($this->region1_website);
        }

        if ($this->linkedin) {
            $lines[] = 'URL;TYPE=LinkedIn:' . $this->escapeVcfValue($this->linkedin);
        }

        if ($this->photo) {
            $lines[] = 'PHOTO;VALUE=URL:' . $this->escapeVcfValue($this->photoUrl());
        }

        $lines[] = 'END:VCARD';

        return implode("\r\n", $lines) . "\r\n";
    }

    public function getTaglineAttribute($value): ?string
    {
        return $value ?: $this->bio;
    }

    public function getRegion1LabelAttribute($value): string
    {
        return $value ?: 'India';
    }

    public function getRegion1PhoneAttribute($value): ?string
    {
        return $value ?: $this->phone;
    }

    public function getRegion1WhatsappAttribute($value): ?string
    {
        return $value ?: $this->whatsapp ?: $this->phone;
    }

    public function getRegion1EmailAttribute($value): ?string
    {
        return $value ?: $this->email;
    }

    public function getRegion1WebsiteAttribute($value): ?string
    {
        return $value ?: $this->company_website ?: $this->github_url;
    }

    public function getLinkedinAttribute($value): ?string
    {
        return $value ?: $this->linkedin_url;
    }

    public function getTwitterAttribute($value): ?string
    {
        return $value ?: $this->twitter_url;
    }

    public function getYearsExperienceAttribute($value): ?int
    {
        return $value !== null ? (int) $value : ($this->experience_years ? (int) $this->experience_years : null);
    }

    public function getTopSkillsAttribute($value): ?array
    {
        $skills = $this->decodeJsonAttribute($value);

        return $skills ?: ($this->skills ?: null);
    }

    public function getThemeColorAttribute($value): string
    {
        return $value ?: '#0f4c81';
    }

    public function getAccentColorAttribute($value): string
    {
        return $value ?: '#2a72f7';
    }

    private function cardMediaUrl(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://', 'data:'])) {
            return $value;
        }

        if (function_exists('media_url')) {
            return media_url($value);
        }

        return Storage::url($value);
    }

    private function placeholderAvatar(): string
    {
        $initial = Str::upper(Str::substr(trim($this->name ?: 'K'), 0, 1));
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" viewBox="0 0 320 320">'
            . '<rect width="320" height="320" rx="160" fill="#0f4c81"/>'
            . '<text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-size="132" fill="#ffffff" font-weight="700">'
            . e($initial)
            . '</text></svg>';

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    private function decodeJsonAttribute($value): ?array
    {
        if (is_array($value)) {
            return $value;
        }

        if (!$value) {
            return null;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : null;
    }

    private function escapeVcfValue(?string $value): string
    {
        return str_replace(
            ["\\", "\r", "\n", ';', ','],
            ["\\\\", '', '\\n', '\\;', '\\,'],
            (string) $value
        );
    }
}
