<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DonationRequestController extends Controller
{

    public function index(Request $request)
    {
        $records = DonationRequest::where(function ($q) use ($request) {

            // Search in database
            if ($request->has("patient_name")) {

                $q->where("patient_name", "LIKE", "%" . $request->patient_name . "%");
            }

            if ($request->has("patient_phone")) {
                $q->where("patient_phone", "LIKE", "%" . $request->patient_phone . "%");
            }

            if ($request->has("patient_age")) {
                $q->where("patient_age", "LIKE", "%" . $request->patient_age . "%");
            }
            if ($request->has("hospital_name")) {
                $q->where("hospital_name", "LIKE", "%" . $request->hospital_name . "%");
            }
            if ($request->has("hospital_address")) {
                $q->where("hospital_address", "LIKE", "%" . $request->hospital_address . "%");
            }

            if ($request->has("city")) {
                $q->whereHas("city", function ($query) use ($request) {
                    $query->where("name", "like", "%" . $request->city . "%");

                });
            }
            if ($request->has("client")) {
                $q->whereHas("client", function ($query) use ($request) {
                    $query->where("name", "like", "%" . $request->client . "%");

                });
            }

            if ($request->has("governorate")) {
                $q->whereHas("city", function ($query) use ($request) {
                    $query->whereHas("governorate", function ($query) use ($request) {
                        $query->where("name", "like", "%" . $request->governorate . "%");

                    });

                });
            }

        })->paginate(20);

        return view("donationRequest.index", compact("records"));
    }


    public function show(Request $request, $id)
    {

        $records = DonationRequest::where(function ($q) use ($request) {

            // Search in database
            if ($request->has("patient_name")) {

                $q->where("patient_name", "LIKE", "%" . $request->patient_name . "%");
            }

            if ($request->has("patient_phone")) {
                $q->where("patient_phone", "LIKE", "%" . $request->patient_phone . "%");
            }

            if ($request->has("patient_age")) {
                $q->where("patient_age", "LIKE", "%" . $request->patient_age . "%");
            }
            if ($request->has("hospital_name")) {
                $q->where("hospital_name", "LIKE", "%" . $request->hospital_name . "%");
            }
            if ($request->has("hospital_address")) {
                $q->where("hospital_address", "LIKE", "%" . $request->hospital_address . "%");
            }

        })->paginate(20);
        return view("donationRequest.show", compact("records"));

    }

    public function destroy($id)
    {
        $record = DonationRequest::find($id);
        if (!$record) {return view("message.404");}
        if ($record) {
            $record->delete();
            return response()->json([
                "status" => 1,
            ]);
        }
    }
}
