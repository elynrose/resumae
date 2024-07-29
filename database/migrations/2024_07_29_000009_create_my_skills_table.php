<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMySkillsTable extends Migration
{
    public function up()
    {
        Schema::create('my_skills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_title');
            $table->string('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
