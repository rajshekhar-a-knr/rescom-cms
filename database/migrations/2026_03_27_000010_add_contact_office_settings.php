<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $now = now();
        $defaults = [
            ['key' => 'contact_india_title', 'value' => 'India Office', 'group' => 'content'],
            ['key' => 'contact_india_city', 'value' => 'Bengaluru, Karnataka', 'group' => 'content'],
            ['key' => 'contact_india_address', 'value' => '', 'group' => 'content'],
            ['key' => 'contact_india_directions_url', 'value' => 'https://maps.google.com', 'group' => 'content'],
            ['key' => 'contact_india_image', 'value' => '', 'group' => 'content'],
            ['key' => 'contact_aus_title', 'value' => 'Australia Office', 'group' => 'content'],
            ['key' => 'contact_aus_city', 'value' => 'Sydney, Australia', 'group' => 'content'],
            ['key' => 'contact_aus_address', 'value' => '', 'group' => 'content'],
            ['key' => 'contact_aus_directions_url', 'value' => 'https://maps.google.com', 'group' => 'content'],
            ['key' => 'contact_aus_image', 'value' => '', 'group' => 'content'],
        ];

        foreach ($defaults as $row) {
            $exists = DB::table('settings')->where('key', $row['key'])->exists();
            if (!$exists) {
                DB::table('settings')->insert([
                    'key' => $row['key'],
                    'value' => $row['value'],
                    'group' => $row['group'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', [
            'contact_india_title',
            'contact_india_city',
            'contact_india_address',
            'contact_india_directions_url',
            'contact_india_image',
            'contact_aus_title',
            'contact_aus_city',
            'contact_aus_address',
            'contact_aus_directions_url',
            'contact_aus_image',
        ])->delete();
    }
};
