<?php
namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{

    protected $fillable = ["name", "guard_name", "created_at", "updated_at"];
    protected $hidden = ["created_at", "updated_at"];

}
