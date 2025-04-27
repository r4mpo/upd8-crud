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
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cpf', 11)->unique();
            $table->string('nome', 100);
            $table->date('data_nascimento');
            $table->enum('sexo', ['M', 'F']);
            $table->string('telefone', 20)->nullable();
            $table->string('email')->unique();
            $table->string('endereco', 60);
            $table->string('estado', 2);
            $table->unsignedBigInteger('cidade_id');
            $table->foreign('cidade_id')->references('id')->on('cidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representantes');
    }
};
