<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('authorized_by')->nullable()->constrained('administratives');
            $table->string('ruc')->unique();
            $table->string('name');
            $table->enum('type', ['pública', 'privada', 'organismo internacional', 'tercer sector', 'otras']);
            $table->string('address');
            $table->string('phone');
            $table->string('mobile')->nullable();
            $table->string('email');
            $table->string('city');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
