<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMySkillsTable extends Migration
{
    public function up()
    {
        Schema::table('my_skills', function (Blueprint $table) {
            $table->unsignedBigInteger('job_category_id')->nullable();
            $table->foreign('job_category_id', 'job_category_fk_9983813')->references('id')->on('job_categories');
            $table->unsignedBigInteger('my_resume_id')->nullable();
            $table->foreign('my_resume_id', 'my_resume_fk_9985046')->references('id')->on('my_resumes');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9983816')->references('id')->on('users');
        });
    }
}
