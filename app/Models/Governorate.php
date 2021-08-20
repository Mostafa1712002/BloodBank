<?php


namespace App\Models;

use App\Models\City;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Governorate extends Model
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function notificationSettings(){
        $this->belongsTo(Notification::class);
    }

}
