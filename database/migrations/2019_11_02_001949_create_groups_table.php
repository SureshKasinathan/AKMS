<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique();
            $table->unsignedBigInteger('company_id');
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->dateTime('deactivated_at')->nullable();
            $table->timestamps();
        });

        Schema::table('groups', function (Blueprint $table) {
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
        Schema::dropIfExists('groups');
    }
}
