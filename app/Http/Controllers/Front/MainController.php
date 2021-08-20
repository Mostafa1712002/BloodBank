<?php

namespace App\Http\Controllers\front;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Post;
use App\Models\Client;
use App\Traits\ApiTraits;
use App\Models\BloodType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


//  The controller for the pages show if the user isn't auth
class MainController extends Controller
{

    use ApiTraits;
    use  ValidatesRequests;


    //  Show the index page
    public function index()
    {
        $myTime = Carbon::now();
        $date = $myTime->toDateTimeString();
        $posts = Post::where("created_at", "<", $date)->take(9)->get();
        $bloodTypes = BloodType::all();
        $cities = City::all();

        $donationRequests = DonationRequest::orderBy("created_at", "DESC")->take(4)->get();
        return view("front.index", compact("posts", "bloodTypes", "cities", 'donationRequests'));
    }


    //Edit profile && update

    public function edit($id)
    {
        return view("front.profile");
    }

    public function update(Request $request, $id)
    {

        $request->flash();
        if ($request->password != null) {
            $msg = [
                "password.min" => "الحد الادني من الحروف هو 8",
                "password.confirmed" => "كلمتي المرور غير مطابقتين"
            ];
            $this->validate($request, ["password" => "nullable|confirmed|min:8"], $msg);
            Client::where("id", $id)->update(["password" =>  bcrypt($request->password)]);
        }

        $request->merge(["api_token" => Str::random(60)]);
        $client = Client::where("id", $id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "d_o_b" => $request->d_o_b,
            "blood_type_id" => $request->blood_type_id,
            "last_donation_date" => $request->last_donation_date,
            "city_id" => $request->city_id,
            "api_token" => $request->api_token
        ]);

        if ($client) {
            flash("تم تعديل بيانات حسابك بنجاح")->success();
            return back();
        } else {
            flash("حدث خطأ غير منوقع حاول مره آخري بعد بضع دقائق")->error();
            return back();
        }
    }

    //  More Details about the articles
    public function articleDetails()
    {
        $posts = Post::paginate(24);
        return view("front.article-details", compact("posts"));
    }



    // Toggle favourite method
    public function postFavorite(Request $request)
    {
        $favorite = $request->user()->posts()->toggle($request->post_id);
        return $this->responseJson("1", "success", $favorite);
    }

    // Inside Post
    public function insidePost($id)
    {
        $postChoice = Post::where("id", $id)->first();
        $posts = Post::orderBy("created_at", "DESC")->take("9")->get();
        return view("front.inside-article", compact("postChoice", "posts"));
    }


    /**
     * The Method to handle if login if the user is not auth to login both to guard front and web
     */

    public function handleLogin()
    {

        $valid = 1;
        return view("front.create-account", compact("valid"));
    }


    public function contactUs()
    {
        return view("front.contact-us");
    }

    public function whoAreUs()
    {
        return view("front.who-are-us");
    }
    public function aboutBloodBank()
    {
        return view("front.about-blood-bank");
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
