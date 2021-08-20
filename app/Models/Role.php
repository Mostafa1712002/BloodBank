<?php
namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    protected $fillable = ["name", "guard_name", "display_name", "description","created_at", "updated_at"];
    protected $hidden = ["created_at", "updated_at"];

}
