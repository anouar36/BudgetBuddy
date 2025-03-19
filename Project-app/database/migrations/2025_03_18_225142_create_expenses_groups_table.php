<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('depenses_id');
            $table->unsignedBigInteger('user_id');
            $table->float('amount');
            $table->string('paid_by');
            $table->string('split_method');
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('depenses_id')->references('id')->on('depenses');
            $table->foreign('user_id')->references('id')->on('users');
        });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses_groups');
    }
}
