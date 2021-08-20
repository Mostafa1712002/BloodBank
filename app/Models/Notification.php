<?php

namespace App\Models;

use App\Models\BloodType;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'donation_request_id');

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function donationRequest()
    {
        return $this->hasOne(DonationRequest::class);
    }
    public function bloodTypes()
    {
        return $this->hasMany(BloodType::class);
    }
    public function governorates()
    {
        return $this->hasMany(Governorate::class);
    }

}
