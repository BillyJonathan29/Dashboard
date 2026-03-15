<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            if (!Schema::hasColumn('modules', 'publisher_id')) {
                $table->unsignedBigInteger('publisher_id')->nullable()->after('course_id');
                $table->foreign('publisher_id')->references('id')->on('users')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            if (Schema::hasColumn('modules', 'publisher_id')) {
                $table->dropForeign(['publisher_id']);
                $table->dropColumn('publisher_id');
            }
        });
    }
};
