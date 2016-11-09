<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_product;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Brand;

class ReportController extends Controller
{
    public function sales(Request $request, $id) {

        $data = $request->all();
        $supplierId = $id;

        try {
            return DB::table('order')
                ->select(
                    'order.id',
                    'order.created_at',
                    'customer.name',
                    'order.net_total'
                )
                ->join('customer', 'order.customer_id', '=', 'customer.id')
                ->whereBetween('order.created_at', [$data['startDate'], $data['endDate']])
                ->whereIn('order.supplier_id',[$supplierId,0])
                ->get();

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Sales details not found']], 404);
        }
    }


    public function brands(Request $request, $id) {

        $data = $request->all();
        $supplierId = $id;
        try {
            return Brand::select(DB::raw('brand.id, brand.brandname, count(product.id) as product_count'))
                ->join('product', 'product.brand_id', '=', 'brand.id')
                ->whereIn('brand.supplier_id',[$supplierId,0])
                ->groupBy('brand.id')
                ->get();

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Brand details not found']], 404);
        }
    }


    public function products(Request $request, $id) {

        $data = $request->all();
        $supplierId = $id;

        try {
            return DB::select(DB::raw("SELECT order_product.product_id, product.name, SUM(order_product.product_quantity) as product_count FROM `order_product`, `product` WHERE order_product.order_id IN (SELECT order.id FROM `order` WHERE order.created_at <= '".$data['endDate']."' AND order.created_at >= '".$data['startDate']."' AND order.supplier_id = ".$supplierId.") AND order_product.product_id = product.id GROUP BY order_product.product_id"));

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Product details not found']], 404);
        }
    }

    public function orders(Request $request,$id) {

        $data = $request->all();
        $supplierId = $id;
        try {
            return DB::table('order')
                ->select(
                    'order.id',
                    'order.created_at',
                    'customer.name',
                    'order.net_total',
                    'order.message'
                )
                ->join('customer', 'order.customer_id', '=', 'customer.id')
                ->where('order.status', '=', $data['status'] )
                ->whereIn('order.supplier_id',[$supplierId,0])
                ->whereBetween('order.created_at', [$data['startDate'], $data['endDate']])
                ->get();

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Orders details not found']], 404);
        }
    }
}
