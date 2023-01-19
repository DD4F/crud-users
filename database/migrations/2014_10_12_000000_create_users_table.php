<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('identificacion')->unique();
            $table->string('email')->unique();
            $table->string('direccion');
            $table->string('celular');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('categoria_id')->unsigned()->default(2);
            $table->bigInteger('countrie_id')->unsigned()->default(28);
            $table->rememberToken();
            $table->timestamps();

            // LLaves foraneas
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('countrie_id')->references('id')->on('countries');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
