<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Models\Contact;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    use ApiTraits;
    // The Method Register Post request
    public function register(Request $request)
    {

        $validator = validator()->make($request->all(), [
            "name" => "required|max:80",
            "last_donation_date" => "required|date",
            "email" => "required|email|unique:clients,email",
            "phone" => "required|max:17|unique:clients,phone",
            "d_o_b" => "required|date",
            "pin_code" => "nullable|max:10",
            "city_id" => "required|max:30|exists:cities,id",
            "governorate_id" => ["required", "exists:governorates,id", "integer"],
            "blood_type_id" => "required|max:12|exists:blood_types,id",
            "password" => "required|confirmed",
        ]);

        if ($validator->fails()) {
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();
        return $this->responseJson(1, "تم التسجيل بنجاح", ["api_token" => $client->api_token, "data" => $client]);
    }

    // The Method to login
    public function login(Request $request)
    {

        $validator = validator()->make($request->all(), [ // Note here we use validator()->make(,[]) not $this->validate() in API
            "phone" => "required|max:15",
            "password" => "required",
        ]);
        if ($validator->fails()) {
            return $this->responseJson(0, "لا يوجد حساب مطابق");
        }
        $client = Client::where("phone", $request->phone)->first();
        auth("api")->validate($request->all()); // take the password hashing and make matching between it and the the password and phone you enter .
        return $this->responseJson(1, "تم التسجيل بنجاح", [
            "api_token" => $client->api_token,
            "data" => $client,

        ]);
    }


    // The Method to reset the password
    public function resetPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "phone" => "required",
        ]);

        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), [
                "errors" => $validator->errors(),
                "fails" => Mail::failures(),
            ]);
        }
        $pin_code = rand(11111, 99999);
        Client::where("phone", $request->phone)->update(["pin_code" => $pin_code]);
        $client = Client::where("pin_code", $pin_code)->first();
        // Mail::to($client->email)->send(new bloodBank_resetPassword($client));
        // Nexmo::message()->send([
        //     "to" => "201022348224",
        //     "from" => "+20148976476",
        //     "text" => "your pin_code is " . $pin_code]
        // );
        return $this->responseJson("1", "تم ارسال رمز التحقق", [
            "pin_code" => $pin_code,
        ]);
    }

    //  The Method to make a new password after know the pin code
    public function newPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [ // Note here we use validator()->make(,[]) not $this->validate() in API
            "pin_code" => "required",
            "password" => "required|confirmed",
        ]);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), ["errors" => $validator->errors()]);
        }

        $user = Client::where("pin_code", $request->pin_code)->where("pin_code", "!=", 0)->first();
        // return print_r($user);
        if ($user) :
            // Client::where("pin_code",$request->pin_code)->update(["password" => $request->password]);
            $user->password = $request->password;
            $user->pin_code = null;
            if ($user->save()) :
                return $this->responseJson("1", "تم تحديت كلمه المرور ");

            else :
                return $this->responseJson("0", "حدث خطأ حاول مره أخري !!");
            endif;
        else :
            return $this->responseJson("0", "هذا الكود غير صحيح ");

        endif;
    }


    // The method  of the mobile to register token for FCM
    public function registerToken(Request $request)
    {
        $rules = [
            "platform" => ["required", "in:android,ios"],
            "client_id" => ["required", "exists:clients,id"],
            "token" => ["required"],
        ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        Token::where("token", $request->token)->delete();

        $token = $request->user()->tokens()->create($request->all());
        return $this->responseJson("1", "تم", $token);
    }


    // The method  of the mobile to remove token for FCM if the client make a sign out from his account in any device

    public function removeToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "token" => "required",
        ]);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        Token::where("token", $request->token)->delete();
        return $this->responseJson("0", "تم");
    }
}
