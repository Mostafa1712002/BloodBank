<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{

    public function index()
    {
        $records = role::paginate(20);
        return view("role.index", compact("records"));
    }

    public function create()
    {

        $permissions = Permission::orderBy("group")->get();
        return view("role.create", compact("permissions"));
    }

    public function store(Request $request)
    {

        // Make Validation on the data coming from the request
        $rules = ["name" => "required|unique:roles,name", "display_name" => "required|unique:roles,display_name"];
        $message = [
            "name.required" => "اسم رتبه مطلوب",
            "name.unique" => " رتبه موجوده من قبل",
            "display_name.unique" => " الاسم المعروض موجود من قبل",
            "display_name.required" => "الاسم المعروض مطلوب",
        ];
        $validator = validator()->make($request->all(), $rules, $message);
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;

        // Create New Roles and connect it with the permission
        $role = Role::create($request->all());
        $role->permissions()->attach($request->permissions);

        Flash("تم إنشاء رتبه بنجاح")->success();
        return redirect()->to(route("role.index"));
    }

    public function edit($id)
    {
        //  Return the record of data with permission relation
        $record = Role::with(["permissions" => function ($q) {
            $q->select("id");
        }])->find($id);
        $permissions = Permission::orderBy("group")->get();

        if (!$record) {
            return abort("404");
        }

        return view("role.edit", compact("record", "permissions"));
    }

    public function update(Request $request, $id)
    {
        //  Validation to sure it valid id and then validation of the rules
        $role = Role::find($id);
        if (!$role) : return abort("404");
        endif;
        $rules = ["name" => "nullable|unique:roles,name," . $role->id, "display_name" => "nullable"];
        $message = ["name.unique" => " رتبه موجوده من قبل"];
        $validator = validator()->make($request->all(), $rules, $message);
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;

        // if the query pass from the validation it will be update and sync the permission for rules
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        flash("تم تعديل الرتبه بنجاح")->success();
        return redirect()->to(route("role.index"));
    }
    // Delete Role by ajax
    public function destroy($id)
    {
        $record = Role::find($id);
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
}
