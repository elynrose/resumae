<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostingsTable extends Migration
{
    public function up()
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_title');
            $table->string('job_type');
            $table->longText('description');
            $table->longText('requirements')->nullable();
            $table->date('expiry_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
