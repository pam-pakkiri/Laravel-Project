<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->text('type')->nullable();
            $table->text('featured_image')->nullable();
            $table->text('tool_name')->nullable();
            $table->text('icon_image')->nullable();
            $table->text('custom_tool_link')->nullable();
            $table->boolean('post_status')->default(true);
            $table->boolean('page_status')->default(true);
            $table->boolean('tool_status')->default(true);
            $table->boolean('ads_status')->default(true);
            $table->boolean('popular')->default(false);
            $table->foreignId('category_id')->nullable()->constrained('page_categories')->onDelete('set null');
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
        Schema::dropIfExists('pages');
    }
}
