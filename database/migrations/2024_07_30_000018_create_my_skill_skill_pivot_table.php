<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMySkillSkillPivotTable extends Migration
{
    public function up()
    {
        Schema::create('my_skill_skill', function (Blueprint $table) {
            $table->unsignedBigInteger('my_skill_id');
            $table->foreign('my_skill_id', 'my_skill_id_fk_9983814')->references('id')->on('my_skills')->onDelete('cascade');
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id', 'skill_id_fk_9983814')->references('id')->on('skills')->onDelete('cascade');
        });
    }
}
