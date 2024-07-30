<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyResumesTable extends Migration
{
    public function up()
    {
        Schema::create('my_resumes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('resume');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
