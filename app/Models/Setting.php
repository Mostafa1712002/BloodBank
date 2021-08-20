<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    public $table = "settings";
    public $timestamps = true;
    protected $fillable = [
        'notification_settings_text', 'about_app', 'tw_link', 'fb_link',
        'insta_link', "intro", "intro_who_are_us", "who_are_us", "google_play_link", "app_store_link",
        "whats_app", "phone_number", "intro_app_phone", "fax"
    ];
}
