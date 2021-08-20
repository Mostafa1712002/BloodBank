<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{

    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('notification_settings_text');
            $table->text("intro");
            $table->string("google_play_link");
            $table->string("app_store_link");
            $table->text("who_are_us");
            $table->string("intro_who_are_us");
            $table->string("email");
            $table->string("fax");
            $table->string("whats_app");
            $table->text('about_app');
            $table->string('tw_link');
            $table->string('fb_link');
            $table->string('insta_link');
        });
    }

    public function down()
    {
        Schema::drop('settings');
    }
}
