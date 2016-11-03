<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_product;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

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
     * Create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $data = $request->all();

            $order = Order::create([
                'customer_id' => $data['customer_id'],
                'gross_total' => $data['gross_total'],
                'discount' => $data['discount'],
                'net_total' => $data['net_total'],
                'supplier_id' => $data['supplier_id']
            ]);

            foreach($data['shopping_list'] as $item) {
                Order_product::create([
                    'product_id' => $item['product_ID'],
                    'product_quantity' => $item['product_quantity'],
                    'total_price' => $item['total_price'],
                    'order_id' => $order->id
                ]);
            }

            return response(['data' => ['status' => 'success', 'message' => 'Create order successful']], 200);
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Create order failed. Check parameters sent']], 400);
        }
    }

    /**
     * Return all product information and details for a given order id
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getOrderProducts($id) {
        try {
            return DB::table('order_product')
                ->select(
                'order_product.product_id',
                'product.name',
                'order_product.product_quantity',
                'order_product.total_price'
            )
                ->join('product', 'order_product.product_id', '=', 'product.id')
                ->where('order_product.order_id', $id)
                ->paginate();

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Order not found']], 404);
        }
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
