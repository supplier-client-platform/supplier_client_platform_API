<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        try {
            return Order::getOrders($data);
        } catch (Exception $e) {
//            return response($e.'');
            return response(['data' => ['status' => 'fail', 'message' => 'Query failed.']], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            $thisOrder = Order::findOrFail($id);
            $thisOrder->status = $data['status'];
            if ($data['status'] == 'Rejected' || $data['status'] == 'Cancelled') {
                $thisOrder->message = $data['reason'];
                // Send notification to mobile
                // TODO : talk with Nipuna regarding this
            }
            $thisOrder->save();

            return response(['data' => ['status' => 'success', 'message' => 'Update successful']], 200);
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Update failed. Check parameters sent.']], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
