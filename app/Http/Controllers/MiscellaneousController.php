<?php

namespace App\Http\Controllers;

use App\Citylist;
use App\Category;
use Illuminate\Http\Request;
use Exception;

use App\Http\Requests;

class MiscellaneousController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Miscellaneous Controller
    |--------------------------------------------------------------------------
    | As the name suggests, this controller handles miscellaneous tasks that
    | do not fall under any of the standard controllers.
    |
    */

    /**
     * Returns the  complete city list
     *
     * @return mixed
     */
    public function getCityList() {
        try{
            return Citylist::all();
        } catch(Exception $e){
            return response('Retireval failed.', 500);
        }
    }
    
    //product categories
    public function getCategoryList() {
        try{
            return Category::all();
        } catch(Exception $e){
            return response('Retireval failed.', 500);
        }
    }
}
