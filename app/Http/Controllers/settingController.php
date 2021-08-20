<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    use ValidatesRequests;

    public function edit()
    {
        $record = Setting::get()->first();
        return view("setting.edit")->with("record", $record);
    }


    public function update(Request $request)
    {

        $rules = [
            "fb_link" => "required",
            "email" => "required|email",
            "tw_link" => "required",
            "insta_link" => "required",
            "intro" => "required",
            "about_app" => "required",
            "notification_settings_text" => "required",
            "intro_app_phone" => "required",
            "intro_who_are_us" => "required",
            "who_are_us" => "required",
            "google_play_link" => "required",
            "app_store_link" => "required",
            "whats_app" => "required",
            "phone_number" => "required",
            "fax" => "required",
        ];
        $messages = [
            "fb_link.required" => "الفيس بوك لينك مطلوب",
            "intro.required" => "القدمه عن التطبيق مطلوبه",
            "tw_link.required" => " تويتر لينك مطلوب",
            "about_app.required" => "  المعلومات عن التطبيق مطلوب",
            "insta_link.required" => " الأنستجرام لينك مطلوب",
            "notification_settings_text.required" => "نص  الأشعارات  مطلوب",
            "intro.required" => "القدمه الرئسيه مطلوبه ",
            "intro_app_phone.required" => "نص  مقدمة الهاتف مطلوب  مطلوب",
            "intro_who_are_us.required" => "نص  مقدمه عن من نحن  مطلوب",
            "google_play_link.required" => "لنيك جوجل بلاي    مطلوب",
            "app_store_link.required" => "لينك  آب استور  مطلوب",
            "whats_app.required" => "  لينك الراتس آب  مطلوب",
            "phone_number.required" => "نص  رقم الهاتف  مطلوب",
            "fax.required" => "نص  الفاكس  مطلوب",
            "email.required" => "  البريد الالكتروني   مطلوب",
            "email.email" => "  البريد الالكتروني   غير صالح",

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back();
        }

        Setting::where("id", $request->id)->update([
            "fb_link" => $request->fb_link,
            "tw_link" => $request->tw_link,
            "insta_link" => $request->insta_link,
            "intro" => $request->intro,
            "about_app" => $request->about_app,
            "notification_settings_text" => $request->notification_settings_text,
            "intro_app_phone" => $request->intro_app_phone,
            "intro_who_are_us" => $request->intro_who_are_us,
            "who_are_us" => $request->who_are_us,
            "google_play_link" => $request->google_play_link,
            "app_store_link" => $request->app_store_link,
            "whats_app" => $request->whats_app,
            "phone_number" => $request->phone_number,
            "fax" => $request->fax,
            "email" => $request->email

        ]);
        Flash("تم التعديل بنجاح")->success();
        return redirect()->back();
    }
}
