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
            $table->string('company');
            $table->string('job_title');
            $table->date('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->boolean('to_present')->default(0)->nullable();
            $table->longText('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
