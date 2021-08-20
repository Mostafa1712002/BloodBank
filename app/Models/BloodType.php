<?php
namespace App\Models;

use App\Models\Client;
use App\Models\DonationRequest;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{

    protected $table = 'blood_types';
    protected $fillable = array("id",'name');

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function donationRequest()
    {
        return $this->hasOne(DonationRequest::class);
    }
    public function notificationSettings()
    {
        $this->belongsTo(Notification::class);
    }

}
