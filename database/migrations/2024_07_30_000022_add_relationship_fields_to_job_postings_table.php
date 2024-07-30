<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJobPostingsTable extends Migration
{
    public function up()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->unsignedBigInteger('job_category_id')->nullable();
            $table->foreign('job_category_id', 'job_category_fk_9985027')->references('id')->on('job_categories');
        });
    }
}
