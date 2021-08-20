<?php

namespace App\Models;

use App\Models\City;
use App\Models\Post;
use App\Models\BloodType;
use App\Models\Governorate;
use App\Models\Notification;
use App\Models\DonationRequest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomPasswordReset;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'password', 'name', 'd_o_b', 'blood_type_id', 'last_donation_date', 'city_id', 'pin_code', "api_token", "is_active");
    protected $hidden = ["api_token", "password"];
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class);
    }

    public function governorates()
    {
        return $this->belongsToMany(Governorate::class);
    }

    public function bloodTypes()
    {
        return $this->belongsToMany(BloodType::class);
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function donationRequest()
    {
        return $this->hasOne(DonationRequest::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    // Customize  reset password
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordReset($token));
    }
}
