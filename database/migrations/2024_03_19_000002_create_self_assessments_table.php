<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('self_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->date('assessment_date');
            $table->integer('understanding_level')->comment('1-5: Nível de compreensão do conteúdo');
            $table->integer('study_effectiveness')->comment('1-5: Efetividade dos métodos de estudo');
            $table->integer('confidence_level')->comment('1-5: Nível de confiança para avaliações');
            $table->text('strengths')->nullable()->comment('Pontos fortes identificados');
            $table->text('areas_to_improve')->nullable()->comment('Áreas que precisam de melhoria');
            $table->text('action_plan')->nullable()->comment('Plano de ação para melhorar');
            $table->text('notes')->nullable()->comment('Observações adicionais');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('self_assessments');
    }
}; 