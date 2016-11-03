<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\ViewDashboardOrder;

class DashboardController extends Controller
{
    //
    
    public function orders(){
        return ViewDashboardOrder::all();
    }
}
