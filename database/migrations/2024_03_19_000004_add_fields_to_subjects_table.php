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
        // Primeiro, adicionamos os novos campos
        Schema::table('subjects', function (Blueprint $table) {
            $table->integer('workload')->nullable()->after('teacher');
            $table->string('semester')->nullable()->after('workload');
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active')->after('semester');
        });

        // Depois, renomeamos a coluna
        Schema::table('subjects', function (Blueprint $table) {
            $table->renameColumn('teacher', 'professor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Primeiro, renomeamos a coluna de volta
        Schema::table('subjects', function (Blueprint $table) {
            $table->renameColumn('professor', 'teacher');
        });

        // Depois, removemos os campos adicionados
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn(['workload', 'semester', 'status']);
        });
    }
};
