<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{

    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text("notification_settings_text");
            $table->text("about_app");
            $table->text("intro");
            $table->text("who_are_us");
            $table->text("intro_app_phone");
            $table->string("tw_link");
            $table->string("insta_link");
            $table->string("fb_link");
            $table->string("whats_app");
            $table->string("phone_number");
            $table->string("google_play_link");
            $table->string("app_store_link");
            $table->string("fax");
            $table->timestamps();

        });

    }

    public function down()
    {
        Schema::drop('settings');
    }
}
