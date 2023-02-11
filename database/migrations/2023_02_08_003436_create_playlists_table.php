<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->string('broadcast_date');
            $table->string('broadcast_on');
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->string('folder');
            $table->integer('ordered')->default(1);
            $table->timestamps();
            $table->foreignId('customer_id')->references('id')->on('customers')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlists');
    }
}
