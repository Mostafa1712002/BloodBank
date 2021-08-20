<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\registerClient;
use App\Models\Post;
use App\Models\Client;
use App\Traits\ApiTraits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthController extends Controller
{
    use  ValidatesRequests;
    use ApiTraits;

    // ############# Login and Register Methods ################
    // Create Account
    public function createAccount()
    {
        return view("front.create-account");
    }

    // Register new client
    public function registerSave(Request $request)
    {
        $request->flash();
        $this->validate($request, $this->rules(), $this->messages());
        $request->merge(["api_token" => Str::random(60)]);
        $client = Client::create($request->all());
        if ($client) {
            flash("يمكنك الان تسجيل الدخول")->success();
            return view("front.signin-account");
        } else {
            flash("حدث خطأ غير منوقع حاول مره آخري بعد بضع دقائق")->error();
            return redirect()->back();
        }
    }

    // Show form Sign in
    public function signInAccount()
    {
        return view("front.signin-account");
    }


    //  check for sign in
    public function signInCheck(Request $request)
    {
        if (Auth::guard('front')->attempt(['phone' => $request->phone, 'password' => $request->password], true)) {
            return redirect()->route("front.index");
        } else {
            $request->flash();
            flash("هناك خطأ في بياناتك راجع بياناتك ثم حاول مره آخري ")->error();
            return redirect()->back();
        }
    }

    //  logout from the website
    public function logOut()
    {
        Auth::guard('front')->logout();
        return redirect()->route("front.index");
    }
    //  Validation Messages and rules
    public function messages()
    {
        return  [
            "name.required" => "الاسم مطلوب",
            "name.min" => "الحد الأدني من حروف الاسم هو 10",
            "name.max" => "الحد الأقصي من الحروف الاسم هو 255",
            "email.unique" => "هذا البريد الالكتروني مأخوذ من قبل",
            "email.email" => "هذا البريد الالكتروني غير صالح",
            "email.required" => "البريد الالكتروني مطلوب",

            "phone.max" => "الحد الأقصي من الارقام الاسم هو 17",
            "phone.min" => "الحد الأدني من الارقام الاسم هو 11",
            "phone.required" => "رقم الهاتف مطلوب",
            "phone.unique" => "رقم الهاتف مأخوذ من قبل",

            "password.required" => "كلمة المرور مطلوبه",
            "password.min" => "الحد الادني من الحروف هو 8",
            "password.confirmed" => "كلمتي المرور غير مطباقين",

            "last_donation_date.required" => "آخر تاريخ لتبرع مطلوب",
            "d_o_b.required" => " تاريخ الميلاد مطلوب",
            "city_id.required" => " اسم  المدينه مطلوب",
            "governorate_id.required" => " اسم  المحافظه مطلوب",
            "blood_type_id.required" => " اسم  فصيلة الدم مطلوب",
        ];
    }

    public function rules()
    {
        return [
            'name' => "required|max:255|min:10",
            "phone" => "required|min:11|max:15,unique:phones,name",
            "blood_type_id" => "required",
            "last_donation_date" => "required",
            "email" => "required|email|unique:clients,email",
            "phone" => "required|max:17|unique:clients,phone|min:11",
            "d_o_b" => "required",
            "city_id" => "required",
            "governorate_id" => ["required", "exists:governorates,id", "integer"],
            "blood_type_id" => "required|max:12|exists:blood_types,id",
            "password" => "required|confirmed|min:8",
        ];
    }



}
