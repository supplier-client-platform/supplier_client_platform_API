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
                
                //order summary should filter from updated date. NOT created Date.
                ->whereBetween('order.created_at', [$data['startDate'], $data['endDate']])
                
                // Why have you used Where In supplier id [suuplierid,0]? WHY 0?
                ->whereIn('order.supplier_id',[$supplierId,0])
                ->get();
            
            
            // If this is the service for all orders, What about getting only completed orders? or Rejected or Cancelled Orders? user a Query builder for that using this same service
            
            // Where is the correct json response return?

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Sales details not found']], 404);
        }
    }


    public function brands(Request $request, $id) {

        // whats the purpose of this report? returning the count of products for each brand why would anyone want such a report?
        
        // better reports would be number of brand sales for a given period of time  for all brands
        // or monthly brand sales for a single brand
        
        $data = $request->all();
        $supplierId = $id;
        try {
            return Brand::select(DB::raw('brand.id, brand.brandname, count(product.id) as product_count'))
                ->join('product', 'product.brand_id', '=', 'brand.id')
                
                // Whats with supplierID ZERO? I used supplier ID zero for some other purpose in the view. 
                // Don't copy my codes you twat! -- Nilesh
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
            
            
            //DO NOT USE THIS!!

            //EVER HEARD OF SQL INJECTOINS? 
            
            //USE A BLOODY VIEW!!!!!!
            return DB::select(DB::raw("SELECT order_product.product_id, product.name, SUM(order_product.product_quantity) as product_count FROM `order_product`, `product` WHERE order_product.order_id IN (SELECT order.id FROM `order` WHERE order.created_at <= '".$data['endDate']."' AND order.created_at >= '".$data['startDate']."' AND order.supplier_id = ".$supplierId.") AND order_product.product_id = product.id GROUP BY order_product.product_id"));
            
            
            //return a JSON response. why return a JSON? success status eka hariyata denne nathnam thoge achchida? Google what PSR means and write services/codes accordingly

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Product details not found']], 404);
        }
    }

    public function orders(Request $request,$id) {

        // DNRY
        // LEARN WHAT IT MEANS
        // IT MEANS DO NOT REPEAT YOURSELF
        // Wise words to live by
        
        
        // This function is the same as the function sales() with tbe only exception of  
        // ->where('order.status', '=', $data['status'] )
        // use a query builder and handle it all in the sales() function without violating the DNRY rule
        // seriously you are embarassing zone and ur GPA
        // If you are wondering how to use a dynamic  query builder,  go view the model Product.php
        
        
        
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
