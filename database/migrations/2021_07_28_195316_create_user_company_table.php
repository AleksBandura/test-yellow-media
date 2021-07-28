<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCompanyTable extends Migration
{
    public function up()
    {
        Schema::create('user_company', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('company_id');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_company');
    }
}
