<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->string('college_name')->nullable()->after('bio');
            $table->string('college_guide')->nullable()->after('college_name');
            $table->string('knr_guide')->nullable()->after('college_guide');
        });
    }

    public function down()
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->dropColumn(['college_name', 'college_guide', 'knr_guide']);
        });
    }
};
