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
        
        
        
        $orders = ViewDashboardOrder::where();
        return ViewDashboardOrder::all();
    }
    
    
    private function getMonths(){
        
     $month = date('m');
     
    
        
    }
}
