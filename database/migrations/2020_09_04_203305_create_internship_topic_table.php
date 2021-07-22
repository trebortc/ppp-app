<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internship_topic', function (Blueprint $table) {
            $table->foreignId('internship_id')->constrained()->onDelete('restrict');
            $table->foreignId('topic_id')->constrained()->onDelete('restrict');
            $table->primary(['internship_id', 'topic_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internship_topic');
    }
}
