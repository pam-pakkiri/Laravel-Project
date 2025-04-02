<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class V104To105 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->boolean('back_to_top')->after('page_load')->default(true);
            $table->boolean('lazy_loading')->after('page_load')->default(true);
            $table->string('blog_page_count')->after('blog_page_status')->default(6);
            $table->string('related_tools_background')->after('related_tools_count')->default('bg-teal');
        });

        Schema::table('api_keys', function (Blueprint $table) {
            $table->longText('moz_access_id')->after('facebook_cookies')->nullable();
            $table->longText('moz_secret_key')->after('facebook_cookies')->nullable();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->integer('position')->after('popular')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
