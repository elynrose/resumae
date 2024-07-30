<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJobSkillsTable extends Migration
{
    public function up()
    {
        Schema::table('job_skills', function (Blueprint $table) {
            $table->unsignedBigInteger('job_posting_id')->nullable();
            $table->foreign('job_posting_id', 'job_posting_fk_9985036')->references('id')->on('job_postings');
        });
    }
}
