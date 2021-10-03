<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BloodTypeResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ContactResource;
use App\Http\Resources\DonationRequestResource;
use App\Http\Resources\GovernorateResource;
use App\Http\Resources\PostResource;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MainController extends Controller
{
    use ApiTraits;

    public function posts()
    {
        $posts = Post::paginate(20);
        return $this->responseJson(1, "success", PostResource::collection($posts));
    }

    public function governorates()
    {
        $governorates = Governorate::with("cities")->get();
        return $this->responseJson(1, "success", GovernorateResource::collection($governorates));
    }

    public function cities(Request $request)
    {

        $city = City::with("governorate")->where(
            function ($q) use ($request) {
                if ($request->has("governorate_id")):
                    $q->where("governorate_id", $request->governorate_id);
                endif;
            }
        )->get();

        return $this->responseJson(1, "success", CityResource::collection($city));
    }

    public function categories()
    {
        $cats = Category::all();
        return $this->responseJson(1, "success", CategoryResource::collection($cats));
    }

    public function donationRequests()
    {
        $donationRequest = DonationRequest::paginate();
        return $this->responseJson(1, "success", DonationRequestResource::collection($donationRequest));
    }

    public function bloodTypes()
    {
        $bloodType = BloodType::all();
        return $this->responseJson(1, "success", BloodTypeResource::collection($bloodType));
    }

    public function notifications(Request $request)
    {

        $id = $request->user()->donationRequest->id;
        $notification = Notification::where("donation_request_id", $id)->get();
        return $this->responseJson(1, "success", $notification);
    }

    public function myFavorite(Request $request)
    {
        $list = $request->user()->posts()->latest()->paginate(20);
        return $this->responseJson("1", "success", PostResource::collection($list));

    }

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
            "patient_phone" => "required|numeric|digits_between:11,15",
            "notes" => "required|string",
            "city_id" => "required|exists:cities,id",

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
        if (count($clientIds)):
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
        if (count($tokens)):
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
            "blood_types" => $request->user()->bloodTypes()->pluck("blood_types.id")->toArray(),
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
        if ($validator->fails()):
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        endif;
        $favorite = $request->user()->posts()->toggle($request->post_id);
        return $this->responseJson("1", "تمت العمليه بنجاح", $favorite);
    }

    //  To make a new contact request and register it in database .
    public function createContact(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            "title" => "required",
            "phone" => "max:15|required",
            "email" => "email|required|email",
            "message" => "required",
            "subject" => "required",
        ]);

        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        $contact = Contact::create($request->all());
        return $this->responseJson("1", "تم العمليه بنجاح", new ContactResource($contact));
    }

    public function updateProfile(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => "nullable|string",
            "email" => "nullable|unique:clients,id," . $request->user()->id,
            "last_donation_date" => "nullable|date",
            "blood_type_id" => "nullable|max:12|exists:blood_types,id",
            "d_o_b" => "nullable|before:2015-1-1|date",
            "governorate_id" => ["nullable", "exists:governorates,id", "integer"],
            "city_id" => ["nullable", "exists:cities,id", "integer"],
            "phone" => "nullable|unique:clients,phone," . $request->user()->id,
            "password" => "nullable|confirmed|min:8",
        ]);
        if ($validator->fails()):
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        endif;

        $request->user()->update($request->all());
        $request->user()->refresh();

        return $this->responseJson("1", "تم تعديل البيانات بنجاح", new ClientResource($request->user()));
    }

    public function allSettings()
    {
        $settings = Setting::all();

        return $this->responseJson(1, "success", $settings);
    }

}
