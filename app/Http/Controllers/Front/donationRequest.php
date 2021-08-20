<?php

namespace App\Http\Controllers\Front;

use App\Models\City;
use App\Models\DonationRequest as ModelDonationRequest;
use App\Models\Token;
use App\Models\BloodType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DonationRequest extends Controller
{

    // Show all donation request
    public function index(Request $request)
    {

        $donationRequests = ModelDonationRequest::where(function ($q) use ($request) {
            if ($request->has("bloodType")) :
                $q->where("blood_type_id", $request->bloodType);
            endif;
            if ($request->has("city")) :
                $q->where("city_id", $request->city);
            endif;
        })->orderBy("created_at", "DESC")->paginate(20);



        $bloodTypes = BloodType::all();
        $cities = City::all();
        return view("front.donation-requests", compact("donationRequests", "bloodTypes", "cities"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("front.create-donation-request");
    }

    // To store the donation requests
    public function store(Request $request)
    {

        $validator = validator()->make($request->all(), $this->getRules(), $this->getMessage());

        if ($validator->fails()) :
            flash($validator->errors()->first())->error();
            return back();
        endif;

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

        flash(" 🥳🥳🥳🥳🥳 تم إرسال طلب التبرع بنجاح 🥳🥳🥳🥳🥳")->success();


        return back();
    }

    // Show donations requests details
    public function show($id)
    {

        $donationRequest = ModelDonationRequest::where("id", $id)->first();
        return view("front.inside-donation-request", compact("donationRequest"));
    }






    public function getRules()
    {


        $rules = [
            "patient_name" => "required|max:50|min:8",
            "patient_age" => "required|alpha_num|between:0,100",
            "patient_phone" => "required|max:17|min:11",
            "bags_num" => "required",
            "blood_type_id" => "required|exists:blood_types,id",
            "governorate_id" => "required|exists:governorates,id",
            "city_id" => "required|exists:cities,id",
            "hospital_name" => "required|max:100|min:10",
            "hospital_address" => "required",
            "notes" => "nullable"

        ];

        return $rules;
    }


    public function getMessage()
    {

        $messages = [
            "patient_name.required" =>  "اسم المريض مطلوب",
            "patient_name.max" => "الحد الاقصي من الحروف الاسم هو 50",
            "patient_name.min" => "الحد الادني من الحروف الاسم هو 8",
            'patient_age.required' => " عمر المريض مطلوب",
            "patient_age.alpha_num" => "عمر المريض يجب ان يكون أرقام",
            "patient_age.between" => "عمر المريض لا يتعدي ال100 عام",
            "bags_num.required" => "عدد الأكياس مطلوب",
            "blood_type_id.required" => "فصلية الدم مطلوبه",
            "blood_type_id.exists" => "فصيلة هذه غير موجوده",
            "governorate_id.required" => "اسم المحافظه مطلوب",
            "governorate_id.exists" => " المحافظه هذه  غير موجوده",
            "city_id.required" => "اسم المدينه مطلوب",
            "city_id.exists" => "اسم المدينه غير موجود",
            "hospital_name.max" => "لحد الاقصي من الحروف الاسم هو 100",
            "hospital_name.min" => "الحد الادني من الحروف الاسم هو 10",
            "hospital_name.required" => "اسم المشفي مطلوب",
            "hospital_address.required" => "عنوان المشفي مطلوب",

        ];
        return $messages;
    }
}
