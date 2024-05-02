<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function LoginForm(Request $request)
    {
        /*if (Auth::guard('admin')->check()) {
            // The user is logged in...
            $request->session()->regenerate();
            return view('admins/welcome');

        }
        else
        {
            //dd('user');
        }*/
        return view('login');
    }

    public function logoutAdmin(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        //dd(session('pseudo'));
        return  redirect()->route('admin');
    }

     public function logoutUser(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        //dd(session('pseudo'));
        return  redirect()->route('login');
    }

    public function AdminLogin(Request $request)
    {
        //dd('ici');
         //Vérifier si c'est un admin qui se connecte
        if (Auth::guard('admin')->attempt(['pseudo' => $request->pseudo, 'password' => $request->pass, ])) 
        {
            // Authentication was successful...
            //dd(Auth::guard('admin')->attempt(['pseudo' => $request->login, 'password' => $request->pass, ]));

            $request->session()->regenerate();//regeneger la session

            return redirect()->intended(route('welcome')); //si l'utilisateur était sur une ancienne page après la connexion ca le renvoi la bas dans le cas contraire sur la page d'accueil welcome

        }
       

        return redirect('admin')->with('error', 'non-existent user password or incorrect login');
    }

    public function UserLogin(Request $request)
    {
        //dd($request->password);
        //Vérifier si c'est un utilisateur qui se connecte
        $user_password = Hash::make($request->password);
        //dd($user_password);
        //dd($request->password);
        if (Auth::guard('web')->attempt(['email_user' => $request->login, 'password' => $request->password, ])) 
        {
            // Authentication was successful...

            $request->session()->regenerate();//regeneger la session

            //dd(Auth::guard('admin')->user());

            return redirect()->intended(route('customer_welcome')); //si l'utilisateur était sur une ancienne page après la connexion ca le renvoi la bas dans le cas contraire sur la page d'accueil welcome

        }
        else
        {
            return back()->with('error', 'non-existent user password or incorrect login');
        }   
       

    }
}
