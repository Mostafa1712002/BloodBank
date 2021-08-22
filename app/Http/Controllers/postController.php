<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Traits\helperTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use helperTrait;

    public function index()
    {
        $records = Post::paginate(20);
        return view("post.index", compact("records"));
    }


    public function create()
    {
        $records = Category::pluck("name", "id");
        return view("post.create", compact("records"));
    }

    public function store(Request $request)
    {

        /* Validation  */
        $rules =   [
            "title" => "required|string|max:50",
            "content" => "required|string",
            "category_id" => "required|exists:categories,id",
            "image" => "required|mimes:jpg,bmp,png,jpeg",
        ];

        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return redirect()->back()->withInput(["title", "content", "image", "category_id"]);
        endif;
        /* /Validation  */

        $post = Post::create($request->all());

        $img = $this->uploadImages($request->file("image"), "images/posts");
        Post::where("id", $post->id)->update(["image" => "/images/posts/" . $img]);

        flash("تم الأنشاء بنجاح")->success();
        return redirect()->to(route("post.index"));
    }

    public function show($id)
    {

        $post = Post::where("id",$id)->first();

        return view("post.show",compact("post"));
    }

    public function edit($id)
    {
        $record = Post::find($id);
        if (!$record) {
            return abort("404");
        }
        $categories = Category::pluck("name", "id");
        return view("post.edit")->with(["record" => $record, "categories" => $categories]);
    }


    public function update(Request $request, $id)
    {

        $record = Post::find($id);
        $rules =   [
            "title" => "required|string|max:50",
            "content" => "required|string",
            "category_id" => "required|exists:categories,id",
            "image" => "mimes:jpg,bmp,png,jpeg|nullable",
        ];


        if (!$record) {
            return abort("404");
        }
        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;
        $record->update([
            "title" => $request->input("title"),
            "content" => $request->input("content"),
            "category_id" => $request->input("category_id"),
        ]);



        //  if user update new image
        if ($request->file("image") != null) {

            $img = $this->uploadImages($request->file("image"), "images/posts");
            Post::where("id", $record->id)->update(["image" => "/images/posts/" . $img]);
        }

        flash("تم التعديل بنجاح")->success();
        return redirect()->to(route("post.index"));
    }



    public function destroy($id)
    {
        $record = Post::find($id);
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



    public function getMessage()
    {
        $messages = [
            "title.required" => "العنوان مطلوب",
            "content.required" => "محتوي المقال مطلوب",
            "category_id.required" => "اسم القسم مطلوب",
            "image.required" => "الصوره مطلوبه",
            "image.mimes" => "هذه الصوره غيره موافقه للمعاير"
        ];

        return $messages;
    }
}
