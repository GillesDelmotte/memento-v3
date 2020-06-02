<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('job_id')->nullable();
            $table->char('gsm')->nullable();
            $table->string('address')->nullable();
            $table->string('postalCode')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('token')->nullable();
            $table->string('profilPic')->nullable();
            $table->string('theme')->default('black');
            $table->text('description')->nullable();
            $table->boolean('schedule')->default(false);
            $table->boolean('geolocation')->default(false);
            $table->boolean('create')->default(false);
            $table->boolean('notification')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
