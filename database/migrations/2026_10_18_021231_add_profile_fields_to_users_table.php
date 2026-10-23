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
        Schema::table('users', function (Blueprint $table) {
            $table->text('description')->nullable()->after('email');
            $table->string('urlfacebook')->nullable()->after('description');
            $table->string('urlinstagram')->nullable()->after('urlfacebook');
            $table->string('urlyoutube')->nullable()->after('urlinstagram');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['description', 'urlfacebook', 'urlinstagram', 'urlyoutube']);
        });
    }
};
