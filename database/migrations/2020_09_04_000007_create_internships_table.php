<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('restrict');
            $table->foreignId('authorized_by')->nullable()->constrained('administratives')->onDelete('restrict');
            $table->foreignId('teacher_id')->nullable()->constrained()->onDelete('restrict');
            $table->foreignId('representative_id')->constrained()->onDelete('restrict');
            $table->date('start_date');
            $table->date('finish_date')->nullable();
            $table->enum('type', ['laboral', 'servicio a la comunidad']);
            $table->string('wide_field');
            $table->string('specific_field');
            $table->string('area');
            $table->text('student_activities');
            $table->string('institutional_agreement_code')->nullable();
            $table->string('institutional_agreement_name')->nullable();
            $table->string('research_project_code')->nullable();
            $table->string('research_project_name')->nullable();
            $table->string('social_project_code')->nullable();
            $table->string('social_project_name')->nullable();
            $table->enum('status', ['pending', 'rejected', 'in_progress', 'representative_pending', 'tutor_pending', 'commission_pending', 'approved', 'registered']);
            $table->integer('hours_worked')->nullable();
            $table->text('student_observations')->nullable();
            $table->integer('evaluation_punctuality')->nullable();
            $table->integer('evaluation_performance')->nullable();
            $table->integer('evaluation_motivation')->nullable();
            $table->integer('evaluation_knowledge')->nullable();
            $table->text('evaluation_observations')->nullable();
            $table->text('tutor_observations')->nullable();
            $table->boolean('tutor_recommends')->nullable();
            $table->text('tutor_recommends_observations')->nullable()->nullable();
            $table->boolean('tutor_knowledge_contribution')->nullable();
            $table->text('tutor_knowledge_contribution_observations')->nullable();
            $table->boolean('tutor_recommends_approval')->nullable();
            $table->text('tutor_recommends_approval_observations')->nullable();
            $table->boolean('commission_approves')->nullable();
            $table->text('commission_observations')->nullable();
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
        Schema::dropIfExists('internships');
    }
}
