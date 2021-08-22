<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    // Get all user expected admin
    public function index()
    {

        $users = User::where("is_admin", 0)->paginate(20);
        return view("user.index", compact("users"));
    }

    public function create()
    {

        $listRoles = Role::pluck("display_name", "id");

        return view("user.create", compact("listRoles"));
    }

    public function store(Request $request)
    {

        /*  Validtion  */

        $rules = [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:8",

        ];

        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;

        /*  / Validtion  */

        // Create new user
        $user = User::create($request->all());
        $user->assignRole($request->listRoles);
        Flash("تم إنشاء المستخدم بنجاح")->success();
        return redirect()->route("user.index");
    }

    public function edit($id)
    {
        $record = User::with(["roles" => function ($q) {
            $q->select("id");
        }])->find($id);
        $listRoles = Role::pluck("display_name", "id");
        if (!$record) {
            return view("message.403");
        }
        return view("user.edit", compact("record", "listRoles"));
    }

    public function update(Request $request, $id)
    {

        $record = User::find($id);
        /* Validation */
        if (!$record) {
            return abort("404");
        }
        $rules = [
            "name" => "required",
            "email" => "required|email|unique:users,email," . $record->id,
            "password" => "confirmed|nullable",

        ];

        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) {
            Flash($validator->errors()->first())->error();
            return redirect()->back();
        }
        /* /Validation */

        // Update Data
        $record->syncRoles($request->listRoles);
        $record->update(["name" => $request->name, "email" => $request->email]);

        // Condition to show if password is null of not
        if (isset($request->password)) :
            $record->update(["password" => $request->password]);
        endif;
        // Message confirm to update
        flash("تم التعديل بنجاح")->success();
        return redirect()->route("user.index");
    }

    // Delete user
    public function destroy($id)
    {
        $record = User::find($id);
        if (!$record) {
            return abort("404");
        }
        if ($record) {
            $record->delete();
            return response()->json([
                "status" => 1,
            ]);
        }
    }

    //   To Edit Password User
    public function change($id)
    {
        $record = User::find($id);
        if (!$record) {
            return abort("404");
        }
        return view("user.editPassword", compact("record"));
    }

    // Update the password of User
    public function saveChange(Request $request, $id)
    {

        $record = User::find($id);
        if (!$record) {
            return abort("404");
        }
        $rules = ["password" => "required|confirmed|min:8"];

        $validator = Validator::make($request->all(), $rules, $this->getMessage());


        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back();
        }



        $record->update(["password" => $request->password]);
        flash("تم التعديل بنجاح")->success();
        return redirect()->back();
    }

    //  Message Validation  Method
    public function getMessage()
    {
        $msg = [
            "name.required" => "اسم المستخدم مطلوب",
            "password.min" => "الحد الأدني من الحروف هو  8 ",
            "email.required" => "البريد الألكتروني للمستخدم مطلوب",
            "password.min" => "الحد الادني من الحروف 8 ",
            "email.unique" => "البريد الألكتروني للمستخدم مستخدم من قبل",
            "password.required" => " كلمة المرور مطلوبه",
            "password.confirmed" => "لا  تتطابق كملتي المرور ",
            "email.email" => "صيغة البريد الالكتروني غير صالحه",
        ];

        return $msg;
    }
}
