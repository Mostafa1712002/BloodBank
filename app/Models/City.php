<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Governorate;
use App\Models\DonationRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array("id",'name', 'governorate_id');

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function donationRequest()
    {
        return $this->hasMany(DonationRequest::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

}
