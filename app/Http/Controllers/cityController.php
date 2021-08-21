<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class CityController extends Controller
{

    public function index()
    {
        $records = City::paginate(20);
        return view("city.index", compact("records"));
    }

    public function create()
    {
        $records = Governorate::pluck("name", "id");
        return view("city.create", compact("records"));
    }

    public function store(Request $request)
    {
        /*  Validation */

        $rules = ["name" => "required|max:50|unique:cities,name", "governorate_id" => "required|exists:governorates,id"];
        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;

        /* / Validation */
        //  Create new city and back with message flash
        city::create($request->all());
        Flash("تم الأنشاء بنجاح")->success();
        return redirect()->to(route("city.index"));
    }

    public function edit($id)
    {

        $record = City::find($id);
        if (!$record) {
            return abort(404);
        }
        $governorates = Governorate::pluck("name", "id");
        return view("city.edit")->with(["record" => $record, "governorates" => $governorates]);
    }

    public function update(Request $request, $id)
    {
        //  The start of validation
        $record = City::find($id);
        if (!$record) {
            return abort(404);
        }


        $rules = [
            "name" => "required|nullable|max:50|unique:cities,name," . $record->id,
            "governorate_id" => "required|nullable",
        ];
        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;
        //  The End of validation
        // Update city
        $record->update($request->all());
        flash("تم التعديل بنجاح")->success();
        return redirect()->to(route("city.index"));
    }

    public function destroy($id)
    {
        $record = City::find($id);
        if ($record) {
            $record->delete();
            return response()->json([
                "status" => 1,
            ]);
        } else {
            return abort(404);
        }
    }

    public function getMessage()
    {
        $msg = [
            "name.required" => "أسم المدينه مطلوب",
            "name.max" => " الحد الاقصي من الحروف هو 50 ",
            "name.unique" => "هدا الاسم مأخوذ من قبل",
            "governorate_id.required" => "أختيار المحافظه مطلوب",
            "governorate_id.exists" => "يجب ان تكون المحافظه ضمن المحافظات الموجوده",
        ];
        return $msg;
    }
}
