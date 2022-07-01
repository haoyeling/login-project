<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCarnivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_carnivals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('date')->comment('预约日期');
            $table->string('code', 6)->unique()->comment('邀请码');
            $table->tinyInteger('status')->default(0)->comment('0 待签到，1 已完成');
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
        Schema::dropIfExists('user_carnivals');
    }
}
