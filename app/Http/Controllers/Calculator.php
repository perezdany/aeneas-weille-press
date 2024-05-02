<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Customer;
use App\Models\Review;

use DB;

class Calculator extends Controller
{
    //Performs all calcul

    public function CountUserAccount()
    {
        $get = User::all()->count();

        return $get;
    }

    public function CountCompanies()
    {
        $get = Customer::all()->count();

        return $get;
    }

    public function CountPressReveiew()
    {
        $get = Review::all()->count();

        return $get;
    }

    public function CountUserByCompanies($id)
    {
        $number = DB::table('users')->where('id_customer', $id)->count();

        return $number;
    }
}
