<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


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

}
