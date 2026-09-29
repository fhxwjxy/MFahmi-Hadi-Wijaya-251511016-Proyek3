<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->after('title')
                ->constrained()
                ->restrictOnDelete();

            $table->string('code')
                ->after('title')
                ->unique();

            $table->dropColumn('category'); // ganti field string lama dengan relasi
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'code']);
            $table->string('category')->nullable();
        });
    }
};