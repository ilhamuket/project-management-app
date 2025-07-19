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
        Schema::table('projects', function (Blueprint $table) {
            // Add indexes for better query performance
            $table->index('status');
            $table->index('tanggal_mulai');
            $table->index('tanggal_selesai');
            $table->index('created_at');
            $table->index('updated_at');
            $table->index('nilai_kontrak');
            
            // Composite indexes for dashboard queries
            $table->index(['status', 'created_at']);
            $table->index(['status', 'tanggal_mulai']);
            $table->index(['status', 'tanggal_selesai']);
            $table->index(['status', 'nilai_kontrak']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['tanggal_mulai']);
            $table->dropIndex(['tanggal_selesai']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['updated_at']);
            $table->dropIndex(['nilai_kontrak']);
            $table->dropIndex(['status', 'created_at']);
            $table->dropIndex(['status', 'tanggal_mulai']);
            $table->dropIndex(['status', 'tanggal_selesai']);
            $table->dropIndex(['status', 'nilai_kontrak']);
        });
    }
};