<?php

namespace App\Http\Controllers;

use App\Mail\RegisterUser;
use App\Models\Todos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    //
    public function index()
    {

        return view('index');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'phone_number' => 'required|string|size:11',
                'email' => 'unique:users|required|min:3|max:128'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                // dd($errors);
                return back()->with(['error' => 'Phone number must be 11 digit and email address must be valid']);
            }

            try {
                DB::beginTransaction();
                $input = [
                    'first_name' => $request->first_name,
                    'phone_number' => $request->phone_number,
                    'email' => $request->email
                ];
                $createUser = User::create($input);
                DB::commit();
                // Send Email
                try {
                    $get_user = User::where('email', $request->email)->first();
                    Mail::to($get_user->email)->send(new RegisterUser($createUser));
                    return back()->with(['success' => 'Email sent successfully']);
                } catch (\Exception $e) {
                    Log::info('Error sending email: ' . $e->getMessage());
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error',
                    'Registration failed'
                );
            }
        }

        return view('auth.register');
    }

}
