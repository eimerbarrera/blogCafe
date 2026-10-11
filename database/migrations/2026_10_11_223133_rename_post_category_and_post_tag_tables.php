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
        Schema::rename('post_category', 'post_categories');
        Schema::rename('post_tag', 'post_tags');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('post_categories', 'post_category');
        Schema::rename('post_tags', 'post_tag');
    }
};
