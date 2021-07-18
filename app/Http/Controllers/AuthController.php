<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use DB;


class AuthController extends Controller
{
    //
    /**
     * Display login page
     * 
     * @return page login
     */
    public function loginPage() {
        if(Session::get('user') !== null){
            Redirect::to('/home')->send();
        }
        return view('login');
    }


    /**
     * Login with credential
     * 
     * @param Illuminate\Http\Request $request
     * @return page home
     */
    public function login(Request $request) {
        $Users = Users::where('email', '=', $request->email)->first();
        if(!isset($Users)){
            Session::flash('error', "Email Failed!");
            return redirect('/');
        }

        if(!Hash::check($request->password, $Users->password)){
            Session::flash('error', "Password Failed!");
            return redirect('/');
        }

        if($Users) {
            Session::put('user', json_decode($Users->toJson(), false));
            // Session::put('user', true);
            return redirect('/home');
        } else {
            $this->logout();
        } 

    }

    public function logout() {
        Session::flush();
        Session::save();
        Session::regenerate(true);
        return redirect('/');
    }



    /**
     * function untuk kirim email saat forgot password
     *
    */
    public function sendEmail(Request $request){
        // $request->validate([
        //     'email' => 'required|email'
        // ]);

        $Users = Users::where('email', '=', $request->email)->first();

        if(!isset($Users)){
            Session::flash('error', "Email Failed!");
            return redirect('/forgot-password');
        }

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $Users->email],
            [
                'email' => $Users->email,
                'token' => Str::random(60)
             ]
        );

        \Mail::to($Users->email)->send(new \App\Mail\SendMail($passwordReset->email,$passwordReset->token));
        
        Session::flash('success', "Success Send Email");
        return redirect('/forgot-password');
    }
    /**
     * function untuk kirim email saat forgot password
     *
    */
    public function find($token){
        $passwordReset = PasswordReset::where('token', $token)
                         ->first();

        if (empty($passwordReset)){
            Session::flash('error', "Token Sudah Tidak Bisa Dipakai");
            return redirect("login");
        }

        $response = Users::where('email',$passwordReset->email)->first()->toJson();

        return view('Auth.reset-password')
                ->with('detail', json_decode($response, false));

    }


    public function updatePassword(Request $request) {

        try {

            DB::beginTransaction();

            $response = Users::where('email',$request->email)->first();
            $response->update([
                'password' => Hash::make($request->password),
            ]);

            $resp        = PasswordReset::where('email',$request->email)->delete();

            DB::commit();
            Session::flash('success', "Update Berhasil!");
            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('error', "Update Gagal!");
            return redirect('/');
        }
    }


}
