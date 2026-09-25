<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('team_members')) {
            return;
        }

        Schema::table('team_members', function (Blueprint $table) {
            if (!Schema::hasColumn('team_members', 'slug')) {
                $table->string('slug')->nullable()->unique();
            }
            if (!Schema::hasColumn('team_members', 'tagline')) {
                $table->text('tagline')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'banner')) {
                $table->string('banner', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'company_name')) {
                $table->string('company_name')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'company_logo')) {
                $table->string('company_logo', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'company_website')) {
                $table->string('company_website', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region1_label')) {
                $table->string('region1_label')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region1_phone')) {
                $table->string('region1_phone', 50)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region1_whatsapp')) {
                $table->string('region1_whatsapp', 50)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region1_email')) {
                $table->string('region1_email')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region1_website')) {
                $table->string('region1_website', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region2_label')) {
                $table->string('region2_label')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region2_phone')) {
                $table->string('region2_phone', 50)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region2_whatsapp')) {
                $table->string('region2_whatsapp', 50)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region2_email')) {
                $table->string('region2_email')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'region2_website')) {
                $table->string('region2_website', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'linkedin')) {
                $table->string('linkedin', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'whatsapp')) {
                $table->string('whatsapp', 50)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'instagram')) {
                $table->string('instagram', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'twitter')) {
                $table->string('twitter', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'youtube')) {
                $table->string('youtube', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'facebook')) {
                $table->string('facebook', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'vcf_file')) {
                $table->string('vcf_file', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'qr_code')) {
                $table->string('qr_code', 500)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'years_experience')) {
                $table->integer('years_experience')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'learners_count')) {
                $table->integer('learners_count')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'workshops_count')) {
                $table->integer('workshops_count')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'countries_count')) {
                $table->string('countries_count', 20)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'top_skills')) {
                $table->json('top_skills')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'core_services')) {
                $table->json('core_services')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'why_us_points')) {
                $table->json('why_us_points')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'mission_vision')) {
                $table->json('mission_vision')->nullable();
            }
            if (!Schema::hasColumn('team_members', 'theme_color')) {
                $table->string('theme_color', 10)->nullable();
            }
            if (!Schema::hasColumn('team_members', 'accent_color')) {
                $table->string('accent_color', 10)->nullable();
            }
        });

        $this->backfillExistingMembers();
    }

    public function down(): void
    {
        if (!Schema::hasTable('team_members')) {
            return;
        }

        $columns = [
            'slug',
            'tagline',
            'banner',
            'company_name',
            'company_logo',
            'company_website',
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
            'linkedin',
            'whatsapp',
            'instagram',
            'twitter',
            'youtube',
            'facebook',
            'vcf_file',
            'qr_code',
            'years_experience',
            'learners_count',
            'workshops_count',
            'countries_count',
            'top_skills',
            'core_services',
            'why_us_points',
            'mission_vision',
            'theme_color',
            'accent_color',
        ];

        Schema::table('team_members', function (Blueprint $table) use ($columns) {
            foreach ($columns as $column) {
                if (Schema::hasColumn('team_members', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    private function backfillExistingMembers(): void
    {
        $usedSlugs = DB::table('team_members')
            ->whereNotNull('slug')
            ->pluck('slug')
            ->filter()
            ->mapWithKeys(fn ($slug) => [$slug => true])
            ->all();

        DB::table('team_members')
            ->orderBy('id')
            ->get()
            ->each(function ($member) use (&$usedSlugs) {
                $updates = [];

                if (empty($member->slug)) {
                    $updates['slug'] = $this->uniqueSlug($member->name ?: 'team-member-' . $member->id, $usedSlugs);
                    $usedSlugs[$updates['slug']] = true;
                }

                if (empty($member->tagline) && !empty($member->bio)) {
                    $updates['tagline'] = $member->bio;
                }

                if (empty($member->region1_label)) {
                    $updates['region1_label'] = 'India';
                }

                if (empty($member->region1_phone) && !empty($member->phone)) {
                    $updates['region1_phone'] = $member->phone;
                }

                if (empty($member->region1_whatsapp) && !empty($member->phone)) {
                    $updates['region1_whatsapp'] = $member->phone;
                }

                if (empty($member->region1_email) && !empty($member->email)) {
                    $updates['region1_email'] = $member->email;
                }

                if (empty($member->region1_website) && !empty($member->github_url) && Str::startsWith($member->github_url, ['http://', 'https://'])) {
                    $updates['region1_website'] = $member->github_url;
                }

                if (empty($member->linkedin) && !empty($member->linkedin_url)) {
                    $updates['linkedin'] = $member->linkedin_url;
                }

                if (empty($member->twitter) && !empty($member->twitter_url)) {
                    $updates['twitter'] = $member->twitter_url;
                }

                if (empty($member->years_experience) && !empty($member->experience_years)) {
                    $updates['years_experience'] = $member->experience_years;
                }

                if (empty($member->top_skills) && !empty($member->skills)) {
                    $skills = json_decode($member->skills, true);

                    if (is_array($skills) && count($skills)) {
                        $updates['top_skills'] = json_encode($skills);
                    }
                }

                if (empty($member->theme_color)) {
                    $updates['theme_color'] = '#0f4c81';
                }

                if (empty($member->accent_color)) {
                    $updates['accent_color'] = '#2a72f7';
                }

                if ($updates) {
                    DB::table('team_members')->where('id', $member->id)->update($updates);
                }
            });
    }

    private function uniqueSlug(string $value, array $usedSlugs): string
    {
        $baseSlug = Str::slug($value) ?: 'team-member';
        $slug = $baseSlug;
        $counter = 2;

        while (isset($usedSlugs[$slug])) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
};
