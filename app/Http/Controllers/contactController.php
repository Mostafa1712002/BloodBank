<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    // use Flash;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $records = Contact::where(function ($q) use ($request) {
            if ($request->has("email")) {
                $q->where("email", "LIKE", "%" . $request->email . "%");
            }

            if ($request->has("phone")) {
                $q->where("phone", "LIKE", "%" . $request->phone . "%");
            }
            if ($request->has("message")) {
                $q->where("message", "LIKE", "%" . $request->message . "%");
            }
        })->paginate(20);
        return view("contact.index", compact("records"));
    }



    public function destroy($id)
    {
        $record = Contact::find($id);

        if ($record) {
            $record->delete();
            return response()->json([
                "status" => 1,
            ]);
        } else {
            return abort("404");
        }
    }



    public function store(Request $request)
    {

        $rules = [
            "message" => "required",
            "name" => "required|max:50|min:8",
            "subject" => "required|max:50",
            "phone" => "required|min:11|max:17",
            "email" => "required|email"

        ];
        $message = [
            "name.required" => "الاسم مطلوب",
            "message.required" => "نص الرساله مطلوب",
            "subject.required" => "عنوان الرساله مطلوب",
            "phone.required" => "رقم الهاتف مطلوب",
            "email.required" => "البريد الالكتروني مطلوب ",
            "name.max" => "الحد الاقصي من الحروف لاسم هو 50",
            "name.min" => "الحد الادني من الحروف لاسم هو 8",
            "phone.max" => "الحد الاقصي من الحروف لرقم الهاتف هو 17",
            "phone.min" => "الحد الادني من الحروف لرقم الهاتف هو 11",
            "subject.min" => "الحد الاقصي من الحروف لعنوان الرساله هو 50",
            "email.email" => "البريد الالكتروني غير صالح"
        ];

        $validator = validator()->make($request->all(), $rules, $message);
        if ($validator->fails()) :
            $request->flash();
            flash($validator->errors()->first())->error();
            return back();
        endif;

        $contact = Contact::create($request->all());
        flash(" 😍  😍   تم إرسال الرساله بنجاح ,شكرا لتوصلك معنا  😍  😍  ")->success();
        return back();

    }
}
