<?php

namespace App\Http\Controllers;

use App\Customer;
use Exception;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    //

    public function create(Request $request){

//            try {
                $data = $request->all();
                $customer = new Customer;
                $customer->name = $data['displayName'];
                //$customer->address = $data['address'];
                $customer->email = $data['email'];
                $customer->contact = $data['telephone'];
                $customer->udid = $data['uid'];

                $customer->save();
                return response()->json(['status' => 'success', 'customer' => $customer], 200);
//            } catch (Exception $e){
//                return response()->json(['status' => 'failed', 'message'=>$e], 400);
//            }
    }
}
