<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ErrorController extends Controller
{

    public function frontError403()
    {
        return view("message.front.403");
    }
    public function frontError404()
    {
        return view("message.front.404");
    }


    public function backError403()
    {
        return view("message.back.403");
    }
    public function backError404()
    {
        return view("message.back.404");
    }

}
