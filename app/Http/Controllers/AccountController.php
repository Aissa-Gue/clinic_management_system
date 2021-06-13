<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Redirect;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAccount(){
        return view('account.account');
    }
    public function updateAccount(){
        return view('account.account');
    }

    public function update(Request $req, $id){

        $validator = Validator::make(
            array(
                'first_name' => $req->first_name,
                'last_name' =>  $req->last_name,
                'email' =>  $req->email,
                'phone' =>  $req->phone,
                'password' => $req->password,
            ),
            array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'phone' => 'required|numeric|digits:10|unique:users,phone,'.$id,
                'password' => 'min:5|required',
                'password_confirmation' => 'min:5|same:password',
            )
        );

        $user = User::where('id', $id)->firstOrFail();

        if ($validator->fails() or !hash::check($req->old_password,$user->password)){
            $messages = $validator->messages();

            if(hash::check($req->old_password,$user->password)){
                $old_pwd_err="";
            }else{
                $old_pwd_err = "incorrect password";
            }

            return view('account.account')->with('messages', $messages)
                ->with('old_pwd_err', $old_pwd_err);

        }else{
            $user->update(
                ['first_name' => $req->first_name,
                    'last_name' => $req->last_name,
                    'email' => $req->email,
                    'phone' => $req->phone,
                    'password' => Hash::make($req->password)]
            );
            return redirect('/');
        }
    }
}
