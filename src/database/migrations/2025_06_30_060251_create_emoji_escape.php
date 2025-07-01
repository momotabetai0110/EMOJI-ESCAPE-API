<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emoji_escape', function (Blueprint $table) {
            $table->id('id');
            $table->string('client_id')->nullable(false);
            $table->integer('clear_score')->nullable(false);
            $table->time('clear_time')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emoji_escape');
    }
};
