<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateMsisdnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msisdn', function (Blueprint $table) {
            $table->string('msisdn')->unique();
            $table->unsignedInteger('last_message_id')->nullable();
            $table->boolean('last_message_replied')->default(0);
            $table->unsignedInteger('messages_count')->default(0);
            $table->unsignedInteger('messages_unread_count')->default(0);
            $table->unsignedInteger('chats_count')->default(0);
            $table->unsignedInteger('misuses_count')->default(0);
            $table->unsignedInteger('corruption_related_count')->default(0);
            $table->unsignedInteger('open_chat_id')->nullable();
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
        Schema::dropIfExists('msisdn');
    }
}
