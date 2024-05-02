<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;

use DB;

class CustomerController extends Controller
{
    //Handel Customers

    public function displayAllCustomers()
    {
        $query = Customer::all();

        return $query;
    }

    public function AddCompany(Request $request)
    {

        $query = new Customer(['name' => $request->name_company,]);
        $query->save();

        return redirect('customers')->with('success', 'Saved');
    }

    public function DeleteCompany(Request $request)
    {
        $id =  $request->id;
        
        $deleted = DB::table('customers')->where('id_customer', '=', $id)->delete();

        return redirect('companies')->with('success', 'Company Deleted');  
    }

    public function EditForm(Request $request)
    {
        return view('admins/company_edit', [
            'id' => $request->id,
            ]);

        //dd($request->id);
    }

    public function seclectById($id)
    {
        $get = Customer::where('id_customer', $id)->get();

        //dd($get);

        return $get;
    }

    public function EditCompany(Request $request)
    {
        //modifier les éléments de la table
        $update = DB::table('customers')
                ->where('id_customer', $request->id)
                ->update(['name' => $request->name_company,]);
       

        return redirect('companies')->with('success', 'Company Updated');
    }
}
