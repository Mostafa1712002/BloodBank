<?php

namespace App\Models;

use App\Models\City;
use App\Models\Client;
use App\Models\BloodType;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'patient_phone', 'city_id', 'client_id', 'hospital_name', 'blood_type_id', 'patient_age', 'bags_num', 'hospital_address', 'latitude', 'longitude','governorate_id',"notes");

    public function bloodType()
    {
        return $this->belongsTo( BloodType::class);
    }

    public function city()
    {
        return $this->belongsTo( City::class);
    }

    public function client()
    {
        return $this->belongsTo( Client::class);
    }

    public function notification()
    {
        return $this->belongsTo( Notification::class);
    }

}
