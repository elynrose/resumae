<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRequestResumesTable extends Migration
{
    public function up()
    {
        Schema::table('request_resumes', function (Blueprint $table) {
            $table->unsignedBigInteger('resume_id')->nullable();
            $table->foreign('resume_id', 'resume_fk_9983805')->references('id')->on('my_resumes');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9983807')->references('id')->on('users');
        });
    }
}
