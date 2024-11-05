<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('linux_commands', function (Blueprint $table) {
            $table->id();
            $table->string('command');
            $table->text('description');
            $table->string('category');
            $table->json('examples');
            $table->json('flags');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('linux_commands');
    }
};
