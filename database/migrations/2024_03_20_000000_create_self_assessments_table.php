<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('self_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->date('assessment_date');
            $table->unsignedTinyInteger('understanding_level')->comment('1: Muito Baixo, 2: Baixo, 3: Médio, 4: Alto, 5: Muito Alto');
            $table->unsignedTinyInteger('confidence_level')->comment('1: Muito Baixa, 2: Baixa, 3: Média, 4: Alta, 5: Muito Alta');
            $table->text('action_plan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('self_assessments');
    }
}; 