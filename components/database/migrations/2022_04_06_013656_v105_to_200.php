<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class V105To200 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('installs', function (Blueprint $table) {
            $table->renameColumn('admin', 'account');
        });

        Schema::table('generals', function (Blueprint $table) {
            $table->string('default_theme_mode')->after('theme_mode')->default('theme-light');
            $table->boolean('captcha_status')->after('social_status')->default(false);
            $table->boolean('google_login_status')->after('social_status')->default(false);
            $table->boolean('facebook_login_status')->after('social_status')->default(false);
            $table->boolean('icon_before_tool_name_status')->after('social_status')->default(true);
            $table->boolean('featured_images_in_sidebar_status')->after('social_status')->default(true);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->string('target')->after('slug')->default('_self');
        });

        Schema::table('page_translations', function (Blueprint $table) {
            $table->boolean('sitename_status')->after('page_title')->default(true);
            $table->boolean('robots_meta')->after('page_title')->default(true);
        });

        Schema::table('advanceds', function (Blueprint $table) {
            $table->longText('insert_body')->after('header_status')->nullable();
            $table->boolean('body_status')->after('header_status')->default(false);
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->string('target')->after('url')->default('_self');
        });

        Schema::table('sidebars', function (Blueprint $table) {
            $table->integer('tool_count')->after('tool_status')->default(6);
            $table->boolean('post_sticky')->after('post_count')->default(false);
            $table->boolean('tool_sticky')->after('tool_count')->default(false);
        });

        Schema::table('advertisements', function (Blueprint $table) {
            $table->boolean('sidebar_top_sticky')->after('sidebar_top_status')->default(false);
            $table->boolean('sidebar_middle_sticky')->after('sidebar_middle_status')->default(false);
            $table->boolean('sidebar_bottom_sticky')->after('sidebar_bottom_status')->default(false);
        });

        Schema::table('api_keys', function (Blueprint $table) {
            $table->longText('indexnow_api_key')->after('facebook_cookies')->nullable();
            $table->longText('google_api_key')->after('facebook_cookies')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->after('password')->nullable();
            $table->string('facebook_id')->after('password')->nullable();
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
