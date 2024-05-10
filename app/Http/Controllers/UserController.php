<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;

use App\Mail\ForgottenPassword;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use DB;


class UserController extends Controller
{
    //Handle Users

    public function loginclient()
    {
        if( session()->has('nom'))
        {
            return view('customer/my_space');
        }
        else
        {
            return view('customer/customer_login');
        }
    }

    public function my_space()
    {
        if(session()->has('nom'))
        {
            return view('customer/my_space');
        }
        else
        {
            return redirect()->route('connexion');
        }
    }


    public function loginAdmin()//pour l'admin 
    {
        if(session()->has('pseudo'))
        {
            return view('admins/welcome');
        }
        else
        {
            return view('admins/admin');
        }
    }

   


    public function AddUser()
    {
        //Enregistrer un utilisateur de l'administration
        //ici c'est le client qu s'inscrit. vici son script creatcustomer sera pur l'admin
        $name = request('pseudo');
        $full_name = request('full_name');
        $user_email = request('email');
        $user_password = Hash::make(request('pass'));
        $confirm_pass = Hash::make(request('confirm'));
        $type = request('type');
        
        
        //NB: ECRIRE UN CODE JS POUR VERIFIER SI LA CONFIRMATION DU MOT DE PASSE ENTTRE CORRESPOND PAS(fait)
        
        //FAIRE AUSSi UN CODE DE SECUITE POUR NE PAS QUE L'UTILISATEUR S'ENREGISTRE PLUSEUR FOIS AVEC LE MEME MAIL c'est deja fait avec verify_exist
        $verify_exist = Admin::where('email', $user_email)->first();
        if($verify_exist)
        {
            return redirect('users')->with('error', 'Ce mail est déja utilisé');
        }
        else
        {
            //var_dump($user_email);
            $add = new Admin(['full_name' => $full_name, 'pseudo' => $name, 'email' => $user_email,  'password' => $user_password, 'super' => $type]);
            $add->save();

            return redirect('users')->with('success', 'Enregistrement effectué avec succès!');

        
        }
    }

    public function AddAccount(Request $request)
    {
       //ici c'est l'admin qui ajoute

        //ici c'est le client qu s'inscrit. voici son script creatcustomer sera pur l'admin
        $name = $request->fullname;
        $user_email = $request->email;
        $user_password = Hash::make($request->password);
        $confirm_pass = Hash::make($request->confirm_pass);
        $customer = $request->customer;
        $today = date('Y-m-d');

        //dd($customer);

        //dd($name);
        
        //NB: ECRIRE UN CODE JS POUR VERIFIER SI LA CONFIRMATION DU MOT DE PASSE ENTTRE CORRESPOND PAS(fait)
        
        //FAIRE AUSSi UN CODE DE SECUITE POUR NE PAS QUE L'UTILISATEUR S'ENREGISTRE PLUSEUR FOIS AVEC LE MEME MAIL c'est deja fait avec verify_exist
        $verify_exist = User::where('email_user', $user_email)->first();
        if($verify_exist)
        {
            return redirect('users')->with('error', 'Ce mail est déja utilisé');
        }
        else
        {
            //var_dump($user_email);
            $customer = new User(['first_lastname' => $name, 'email_user' => $user_email, 'password' => $user_password, 'id_customer' => $customer, 'added_at' => $today]);
            $customer->save();
          
          return redirect('users')->with('success', 'Enregistrement effectué avec succès!' ); 
            
        
        }
        
    }

    public function displayAllAdmins()
    {
        $get = Admin::all();

        return $get;
    }

    public function displayAllUsers()
    {
        $get = DB::table('users')->join('customers', 'customers.id_customer', '=', 'users.id_customer')
        ->get(['users.first_lastname', 'users.email_user', 'users.added_at', 'users.id', 'customers.name', 'customers.*']);

        return $get;
    }

    public function deleteCustomer()
    {
        $id_user =  request('id_client');
        
        $deleted = DB::table('users')->where('id', '=', $id_user)->delete();

        return redirect('customers')->with('success', 'User Deleted');  
    }

    public function deleteAdminUser()
    {
        $id_user =  request('id');
        
        $deleted = DB::table('admins')->where('id', '=', $id_user)->delete();

        return redirect('users')->with('success', 'User Deleted');  
    }

    public function SelectAdminById($id)
    {
        $get = Admin::where('id', $id)->get();

        return $get;
    }

    public function EditAdminPass(Request $request)
    {
        //dd('ici');
        $user_password = Hash::make($request->pass);
        //dd($user_password);
        
        //on va modifier le mot de passe
        $affected = DB::table('admins')
            ->where('id', $request->id)
            ->update(['password' => $user_password]);
            
     
        return redirect('welcome')->with('success', 'Updating Successfull');

    }

    public function EditAdminUser(Request $request)
    {
        //Enregistrer un utilisateur de l'administration
       
        $name = $request->pseudo;
        $full_name = $request->full_name;
        $user_email = $request->email;
        //$confirm_pass = Hash::make($request->confirm);
        $type = $request->type;

        //modifier les éléments de la table
        $update = DB::table('admins')
                ->where('id', $request->id)
                ->update(['full_name' => $full_name, 'email' => $user_email, 'pseudo' => $name, 'super' => $type]);


        return redirect('users')->with('success', 'Updating Successfull');
    }

    public function EditAdminForm(Request $request) 
    {
          
       return view('admins/edit_admin_form', [
            'id' => $request->id,
            ]);
        
    }

    public function EditCustomerForm(Request $request)
    {
        return view('admins/edit_customer_user_form', [
            'id' => $request->id_client,
            ]);
    }

    public function EditUserPass(Request $request)
    {
        $user_password = Hash::make($request->pass);
        //$confirm_pass = Hash::make($request->confirm_pass);
        //dd($user_password);
        //on va modifier le mot de passe
        $affected = DB::table('users')
            ->where('id', $request->id)
            ->update(['password' => $user_password]);
        //dd($affected);

        return redirect('customers')->with('success', 'Updating Successfull');
    }

    public function EditUserAccount(Request $request)
    {
        $name = $request->fullname;
        $user_email = $request->email;
        
        $customer = $request->customer;
        $today = date('Y-m-d');

        //dd($request->id);
        //dd($name."/".$full_name."/".$user_email."/".$type);

        //modifier les éléments de la table
        $update = DB::table('users')
                ->where('id', $request->id)
                ->update(['first_lastname' => $name, 'email_user' => $user_email, 'id_customer' => $customer]);

        //dd($update);

        return redirect('customers')->with('success', 'Updating Successfull');
    }

    public function SelectAccountCustomerById($id)
    {
       $get = DB::table('users')->join('customers', 'customers.id_customer', '=', 'users.id_customer')
       ->where('id', $id)
        ->get(['users.first_lastname', 'users.email_user', 'users.added_at', 'users.id', 'customers.name', 'users.id_customer']);
         //= User::where('id', $id);

        return $get;
    }

    public function Userprofile(Request $request)
    {
         return view('admins/admin_profile', [
            'id' => $request->id_admin,
            ]);
    }

    public function UserCustomerprofile(Request $request)
    {
         return view('customers/user_profile', [
            'id' => $request->id_user,
            ]);
    }

    public function EditMyPass(Request $request)
    {
        $user_password = Hash::make($request->pass);
        //$confirm_pass = Hash::make($request->confirm_pass);
        //dd($user_password);
        //on va modifier le mot de passe
        $affected = DB::table('users')
            ->where('id', $request->id)
            ->update(['password' => $user_password]);
        //dd($affected);

        return redirect('customer_welcome')->with('edit_success', 'Updating Successfull');
    }

    public function ResetMyPass(Request $request)
    {
        //dd('ici');
        $user_password = Hash::make($request->pass);
        //$confirm_pass = Hash::make($request->confirm_pass);
        //dd($user_password);
        //on va modifier le mot de passe
        $affected = DB::table('users')
            ->where('id', $request->id)
            ->update(['password' => $user_password]);
        //dd($affected);

        return redirect()->route('login');
    }


    public function EditMyAccount(Request $request)
    {
        $name = $request->fullname;
        $user_email = $request->email;
        
        $customer = $request->customer;
        $today = date('Y-m-d');

        //dd($request->id);
        //dd($name."/".$full_name."/".$user_email."/".$type);

        //modifier les éléments de la table
        $update = DB::table('users')
                ->where('id', $request->id)
                ->update(['first_lastname' => $name, 'email_user' => $user_email, 'id_customer' => $customer]);

        //dd($update);

        return redirect('customer_welcome')->with('edit_success', 'Updating Successfull');
    }

    public function GetEmailForget(Request $request)
    {

        //dd('ici');
        $email = $request->email;

        $le_client = User::where('email_user', $email)->first();

        if($le_client != null)
        {
            //dd('ici');
            $url = config('app.url')."/reset_pass_form/".$le_client->id;

            //echo $url; 
            
            $data = ['id_client' => $le_client->id,  'url' => $url];
      
            Mail::to($email)->send(new ForgottenPassword($data));

            return redirect('email_forget_form')->with('success', 'Un mail a été envoyé à '. $email. 'consultez votre boîte mail');
           /* return view('reset_pass_form', [
                'id' => $le_client->id,
                ] );*/
        }
        return redirect('email_forget_form')->with('error', 'L\'adresse mail renseignée n\'existe pas');
    }

    public function ResetPassCustomerForm($id)
    {
        return view('reset_pass_form', [
            'id' => $id,
            ] );
    }

    public function RessetPassword(Request $request)
    {

    }

   
}
