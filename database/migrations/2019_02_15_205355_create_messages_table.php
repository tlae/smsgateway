<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('msisdn');
            $table->text('body');
            $table->string('smsc');
            $table->boolean('corruption_related')->nullable();
            $table->unsignedInteger('chat_id')->nullable();
            $table->unsignedInteger('unread_count')->default(0);
            $table->timestamps();

            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
