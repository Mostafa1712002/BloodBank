<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'image', 'content', 'category_id');
    protected $appends = ["is_favorite", "is_favorite_front", "full_image_path"];

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getIsFavoriteAttribute()
    {

        if (auth("api")->user()) {
            $fav = auth("api")->user()->wherehas("posts", function ($q) {
                $q->where("client_post.post_id", $this->id);
            })->first();
            if ($fav) :
                return true;
            endif;
            return false;
        }
    }

    public function getIsFavoriteFrontAttribute()
    {
        if (auth("front")->user()) {
            $fav = auth("front")->user()->wherehas("posts", function ($q) {
                $q->where("client_post.post_id", $this->id);
                $q->where("client_post.client_id", auth("front")->id());
            })->first();
            if ($fav) :
                return true;
            endif;
            return false;
        }
    }

    public function getFullImagePathAttribute()
    {
        return asset($this->image);
    }
}
