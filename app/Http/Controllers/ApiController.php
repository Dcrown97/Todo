<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function Contact (Request $request) {
        if($request->isMethod('POST')){
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|string',
                'mobile_network' => 'required|string',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $response = [
                    'status' => 'failure',
                    'message' => 'Validation Error',
                    'errors' => $errors
                ];
                return response()->json($response, 422); // HTTP status code 422 for Unprocessable Entity
            }

            try {
                DB::beginTransaction();
                $input = [
                    'phone_number' => $request->phone_number,
                    'mobile_network' => $request->mobile_network
                ];
                $uniqid = Str::random(9);
                $input['ref_code'] = $uniqid;
                dd($input);
                $createContact = Contact::create($input);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with(
                    'error',
                    'Registration failed'
                );
            }

            // Generate a unique ref_code using UUID
            $ref_code = Str::uuid();


        }
    }
}
