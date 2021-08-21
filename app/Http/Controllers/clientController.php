<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class clientController extends Controller
{
    // use Flash;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Client::where(function ($q) use ($request) {
            if ($request->has("is_active") && $request->is_active != "2") {
                $q->where("is_active", "=", $request->is_active);
            }

            if ($request->has("name")) {
                $q->where("name", "LIKE", "%" . $request->name . "%");
            }

            if ($request->has("email")) {
                $q->where("email", "LIKE", "%" . $request->email . "%");
            }

            if ($request->has("phone")) {
                $q->where("phone", "LIKE", "%" . $request->phone . "%");
            }

            if ($request->has("d_o_b") && $request->d_o_b != date('Y-m-d', 00 - 00 - 00)) {
                $q->where("d_o_b", $request->d_o_b);
            }

            if ($request->has("last_donation_date") && $request->last_donation_date != date('Y-m-d', 00 - 00 - 00)) {

                $q->where("last_donation_date", $request->last_donation_date);
            }

            if ($request->has("city")) {
                $q->whereHas("city", function ($query) use ($request) {
                    $query->where("name", "like", "%" . $request->city . "%");

                });
            }
            if ($request->has("blood_type")) {
                $q->whereHas("bloodType", function ($query) use ($request) {
                    $query->where("name", "like", "%" . $request->blood_type . "%");
                });
            }
        })->paginate(20);
        return view("client.index", compact("records"));
    }


    public function show($id)
    {

      
    }

    // Delete && destroy client
    public function destroy($id)
    {
        $record = Client::find($id);
        if(!$record){ return abort(404); }
        if ($record) {
            $record->delete();
            return response()->json([
                "status" => 1,
            ]);
        }
    }

/**
 * Active  the client ;
 * @param int $id
 * @return redirect()->back()
 */
    public function active($id)
    {
        $record = Client::find($id);
        if(!$record){ return abort(404); }

        $record->update(["is_active" => 1]);
        return redirect()->back();
    }

/**
 * De Active the client ;
 * @param int $id
 * @return redirect()->back()
 */

    public function deActive($id)
    {

        $record = Client::find($id);
        if(!$record){ return abort(404); }
        $record->update(["is_active" => 0]);
        return redirect()->back();

    }
}
