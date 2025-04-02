<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidebars', function (Blueprint $table) {
            $table->id();
            $table->boolean('post_status')->default(true);
            $table->integer('post_count')->default(6);
            $table->text('post_align')->nullable();
            $table->text('post_background')->nullable();
            $table->boolean('tool_status')->default(true);
            $table->text('tool_align')->nullable();
            $table->text('tool_background')->nullable();
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
        Schema::dropIfExists('sidebars');
    }
}
