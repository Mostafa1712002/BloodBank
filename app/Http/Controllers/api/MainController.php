<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Post;
use App\Models\Token;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Category;
use App\Models\BloodType;
use App\Traits\ApiTraits;
use App\Models\Governorate;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use Illuminate\Routing\Controller;

class MainController extends Controller
{
    use ApiTraits;


    //  Method to get all posts and search to by => client_id , category_id , by the id of post to

    public function posts(Request $request)
    {

        $posts = Post::paginate(20);

        return $this->responseJson(1, "success", $posts);
    }

    // Method to get all the governorates
    public function governorates()
    {
        $governorates = Governorate::with("cities")->get();
        return $this->responseJson(1, "success", $governorates);
    }

    //  Method to get all cities and can search by the governorate_id to get the cities with it
    public function cities(Request $request)
    {

        $city = City::with("governorate")->where(
            function ($q) use ($request) {
                if ($request->has("governorate_id")) :
                    $q->where("governorate_id", $request->governorate_id);
                endif;
            }
        )->get();
        return $this->responseJson(1, "success", $city);
    }

    //  Method to get all catagories with it posts too.......
    public function categories()
    {
        $cat = Category::with("Posts")->get();
        return $this->responseJson(1, "success", $cat);
    }

    public function donationRequests()
    {
        $donationRequest = DonationRequest::all();
        return $this->responseJson(1, "success", $donationRequest);
    }

    //  get all the blood types
    public function bloodTypes()
    {
        $bloodType = BloodType::all();
        return $this->responseJson(1, "success", $bloodType);
    }


    //  GET DATA And The Same Time is auth

    public function allSettings()
    {
        $settings = Setting::all();

        return $this->responseJson(1, "success", $settings);
    }

    // to get the notification for the specifics client
    public function notifications()
    {

        $notification = Notification::paginate(20);

        return $this->responseJson(1, "success", $notification);
    }


    // to get  The list of favorite for this specifics client
    public function myFavorite(Request $request)
    {
        $list = $request->user()->posts()->latest()->paginate(20);
        return $this->responseJson("1", "success", $list);
    }


    #######################       Methods Posts ###########################


    //  The method to create a donation request
    public function createDonationRequest(Request $request)
    {

        $rules = [
            "client_id" => "required|exists:clients,id",
            "patient_name" => "required|string",
            "patient_age" => "required|integer",
            "blood_type_id" => "required|exists:blood_types,id",
            "bags_num" => "required|integer",
            "hospital_address" => "required|string",
            "hospital_name" => "required",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "governorate_id" => "required|exists:governorates,id",
            "city_id" => "required|exists:cities,id",
            "patient_phone" => "required|numeric|digits_between:11,15",
            "notes" => "required|string",

        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        $donationRequest = $request->user()->donationRequest()->create($request->all());

        $clientIds = $donationRequest->city->governorate->clients()->whereHas("bloodTypes", function ($q) use ($donationRequest) {
            $q->where("blood_types.id", $donationRequest->blood_type_id);
        })->pluck("clients.id")->toArray();

        // check if there are client id first
        if (count($clientIds)) :
            // register the notification and created it with the request id
            $notification = $donationRequest->notification()->create([
                "title" => " لديك اشعار من متبرع لديك ",
                "donation_request_id" => $donationRequest->id,
                "content" => $donationRequest->bloodType->name . " احتاج متبرع من فصلية دم",

            ]);
            $notification->clients()->attach($clientIds);
        endif;
        // To get the tokens of the clients
        $tokens = Token::whereIn("client_id", $clientIds)->where("token", "!=", null)->pluck("tokens.token")->toArray();
        // check if there are any token first
        if (count($tokens)) :
            $title = $notification->title;
            $content = $notification->content;
            $data = [
                "donation_request_id" => $notification->donation_request_id,
            ];
            //  use the notifyByFirebase function
            $this->notifyByFirebase($title, $content, $tokens, $data);
        endif;
        return $this->responseJson("1", "تم الامر", $donationRequest);
    }



    // Method for the notification settings
    public function NotificationSettings(Request $request)
    {
        $rules = [
            "governorate.*" => "exists:governorates,id",
            "blood_type.*" => "exists:blood_types,id",
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        if ($request->has("governorates")) {
            $request->user()->governorates()->sync($request->governorate);
        }
        if ($request->has("blood_types")) {
            $request->user()->bloodTypes()->sync($request->blood_type);
        }

        $data = [
            "governorates" => $request->user()->governorates()->pluck("governorates.id")->toArray(),
            "blood_types" => $request->user()->bloodTypes()->pluck("blood_types.id")->toArray()
        ];

        return $this->responseJson("1", "تمت الاعدادت بنجاح", $data);
    }




    // to make a toggle favorite between the post , I will choice it
    public function postFavorite(Request $request)
    {
        $rules = [
            "post_id" => 'required|exists:posts,id',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        endif;
        $favorite = $request->user()->posts()->toggle($request->post_id);
        return $this->responseJson("1", "تمت العمليه بنجاح", $favorite);
    }

    //  To make a new contact request and register it in database .
    public function createContact(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            "name" => "required",
            "phone" => "max:15|required",
            "email" => "email|required|email",
            "message" => "required",
            "subject" => "required",
        ]);

        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        $contact = Contact::create($request->all());
        return $this->responseJson("1", "تم العمليه بنجاح", $contact);
    }
    // Method to update the data of client { User }

    public function updateProfile(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => "nullable|string",
            "email" => "nullable|unique:clients,id," . $request->user()->id, // make it nullable if you he want to change it will be change if not isn't change
            "last_donation_date" => "nullable|date",
            "blood_type_id" => "nullable|max:12|exists:blood_types,id",
            "d_o_b" => "nullable|before:2015-1-1|date",
            "governorate_id" => ["nullable", "exists:governorates,id", "integer"],
            "city_id" => ["nullable", "exists:cities,id", "integer"],
            "phone" => "nullable|unique:clients,phone," . $request->user()->id,
            "password" => "required|confirmed",
        ]);

        if ($validator->fails()) :
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        endif;

        $user = $request->user();
        $user->update($request->all());
        return $this->responseJson("1", "تم تعديل البيانات بنجاح", $user);
    }
}
