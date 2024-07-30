<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSkillsTable extends Migration
{
    public function up()
    {
        Schema::create('job_skills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('skills');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
