<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoggingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logging_statuses', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('user_id')->unsigned()->index()->default(0);//登陆的用户名
            $table->integer('logged_on')->unsigned()->default(0);//在机器时间的什么时候登陆
            $table->string('ip', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logging_statuses');
    }
}
