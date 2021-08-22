<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class GovernorateController extends Controller
{

    public function index()
    {
        $records = Governorate::paginate(20);
        return view("governorate.index", compact("records"));
    }

    public function create()
    {
        return view("governorate.create");
    }


    public function store(Request $request)
    {
        /* Validation  */

        $validator = Validator::make($request->all(), ["name" => "required|max:50|unique:governorates,name"], $this->getMessage());
        $request->flash();
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;
        /*   / Validation  */


        Governorate::create($request->all());
        flash("تم الأنشاء")->success();
        return redirect()->to(route("governorate.index"));
    }

    public function edit($id)
    {
        $record = Governorate::find($id);
        if (!$record) {
            return abort("404");
        }
        return view("governorate.edit", compact("record"));
    }


    public function update(Request $request, $id)
    {
        /* Validation */
        $record = Governorate::find($id);
        if (!$record) {
            return abort("404");
        }
        $validator = Validator::make($request->all(), ["name" => "required|max:50|unique:governorates,name," . $record->id], $this->getMessage());
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back();
        }

        /* / validation  */
        $record->update($request->all());
        flash("تم التعديل بنحاح")->success();
        return redirect()->to(route("governorate.index"));
    }


    public function destroy($id)
    {
        $record = Governorate::find($id);
        if (!$record) {
            return abort("404");
        }
        if ($record) {
            $record->delete();
            return response()->json([
                "status" => 1,
            ]);
        } else {
            return abort("404");
        }
    }



    public function getMessage()
    {
        $msg = [
            "name.required" => "أسم المحافظه مطلوب",
            "name.max" => " الحد الاقصي من الحروف هو 50 ",
            "name.unique" => "هدا الاسم مأخوذ من قبل"
        ];
        return $msg;
    }
}
