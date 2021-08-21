<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class CategoryController extends Controller
{

    public function index()
    {
        $records = Category::paginate(20);
        return view("category.index", compact("records"));
    }

    public function create()
    {
        return view("category.create");
    }

    public function store(Request $request)
    {

        // To make a validation before insert data in database
        $messages = [
            "name.required" => "أسم القسم مطلوب",
            "name.max" => " الحد الاقصي من الحروف هو 50 ",
            "name.unique" => "هذا الاسم مأخوذ من قبل",
        ];
        $rules = ["name" => "required|max:50|unique:categories,name"];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            Flash($validator->errors()->first())->error();
            return redirect()->route("category.index");
        endif;

        //  To create a new Category
        category::create($request->all());
        Flash("تم الإضافه بنجاح")->success();
        return redirect()->to(route("category.index"));

    }

    public function edit($id)
    {
        $record = Category::find($id);
        if (!$record) {return abort(404);}
        return view("category.edit", compact("record"));
    }

    public function update(Request $request, $id)
    {
        //  The start of validation
        $record = Category::find($id);
        if (!$record) {return abort(404);}
        $messages = [
            "name.max" => " الحد الاقصي من الحروف هو 50 ",
            "name.unique" => "هدا الاسم مأخوذ من قبل",
        ];
        $rules = ["name" => "nullable|max:50|unique:categories,name," . $record->id];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()):
            Flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;
        //  The End of validation

//  Update Data  after valid form  it
        $record->update($request->all());
        flash("تم التعديل بنجاح")->success();
        return redirect()->to(route("category.index"));

    }

    public function destroy(Request $request, $id)
    {
        //  first confirm for id is exists and then send a response json for ajax for make a delete
        $record = Category::find($id);
        if (!$record) {return abort(404);}
        if ($record) {
            $record->delete();
            return response()->json([
                "status" => 1,
            ]);
        }
    }
}
