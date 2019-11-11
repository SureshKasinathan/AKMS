<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->index()->nullable();
            $table->string('email', 100)->unique();
            $table->string('phonenumber', 30)->nullable();
            $table->string('cell', 30)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 75)->nullable();
            $table->string('state_code', 5)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('website', 50)->nullable();
            $table->string('nmlsid', 20)->nullable();
            $table->string('timezone', 30)->nullable();
            $table->string('createdVia', 30)->default('Admin');
            $table->boolean('active')->default(1);
            $table->dateTime('deactivated_at')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
