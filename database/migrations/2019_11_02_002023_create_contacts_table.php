<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->string('email', 100)->index();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('firstname', 75)->index();
            $table->string('lastname', 75)->nullable();
            $table->string('cell', 30)->nullable();
            $table->string('phonenumber', 30)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 75)->nullable();
            $table->string('state_code', 5)->nullable();
            $table->string('country_code', 5)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('profile_image')->nullable();
            $table->boolean('active')->default(1);
            $table->dateTime('deactivated_at')->nullable();
            $table->text('email_signature')->nullable();
            $table->string('last_ip', 40)->nullable();
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_activity')->nullable();
            $table->dateTime('last_password_change')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->foreign('company_id')
            ->references('id')->on('companies')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
