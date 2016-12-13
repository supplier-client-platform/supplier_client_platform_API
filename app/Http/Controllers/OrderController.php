<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_product;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Vinkla\Pusher\Facades\Pusher;

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

            $data = $request->all();
//            try {
                $order = Order::create([
                    'customer_id' => $data['customer_id'],
                    'gross_total' => $data['gross_total'],
                    'discount' => $data['discount'],
                    'net_total' => $data['net_total'],
                    'supplier_id' => $data['supplier_id']
                ]);


                foreach ($data['shopping_list'] as $item) {
                    Order_product::create([
                        'product_id' => $item['productID'],
                        'product_quantity' => $item['productquantity'],
                        'total_price' => $item['totalprice'],
                        'order_id' => $order->id
                    ]);
                }

                Pusher::trigger('order', 'order_web_notifications'.$data['supplier_id'], ['message' => 'New order arrived!']);
                return response(['data' => ['status' => 'success', 'message' => 'Create order successful']], 200);
//            }catch (Exception $e){
//                return response(['data' => ['status' => 'failed', 'message' => 'Create order unsuccessful']], 400);
//            }
    }

    /**
     * Return all product information and details for a given order id
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getOrderProducts($id)
    {
        try {
            return DB::table('order_product')
                ->select(
                    'order_product.product_id',
                    'product.name',
                    'brand.brandname',
                    'product.price',
                    'order_product.product_quantity',
                    'order_product.total_price'
                )
                ->join('product', 'order_product.product_id', '=', 'product.id')
                ->join('brand', 'product.brand_id', '=', 'brand.id')
                ->where('order_product.order_id', $id)
                ->get();

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Order not found']], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            $thisOrder = Order::findOrFail($id);
            $thisOrder->status = $data['status'];
            if ($data['status'] == 'Rejected' || $data['status'] == 'Cancelled') {
                $message_common = "We are sorry, your order was ".$data['status']." because ";
                $thisOrder->message = $data['reason'];
                // Send notification to mobile
                Pusher::trigger('order', 'order_mobile_notifications'.$thisOrder->customer_id, ['data' => ['message' => $message_common.$thisOrder->message], 'customer_id' => $thisOrder->customer_id, 'status' => $data['status']]);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
