<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ClientGovernorate extends Model
{

    protected $table = 'client_governorate';
    protected $fillable = array('client_id', 'governorate_id',"created_at","updated_at");

}
