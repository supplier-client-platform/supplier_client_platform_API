<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\ViewDashboardOrder;
use Exception;
use App\Order;
use App\Product;
use App\Brand;
use App\Order_product;

class DashboardController extends Controller
{
    //

    public function orders($id){

        $months = $this->getMonths(6);

        $supplierId = $id;
        try{
            $completed =  ViewDashboardOrder::select(DB::raw('sum(orders) as orders,month_name,month'))
                ->whereIn('status',['Completed','Accepted'])
                ->whereIn('month', $months )
                ->whereIn('supplier_id',[$supplierId,0])
                ->groupBy('month_name','month')
                ->get();

            $completed = $this->sortItems($completed,$months);

            $rejected =  ViewDashboardOrder::select(DB::raw('sum(orders) as orders,month_name,month'))
                ->whereIn('status',['Rejected','Cancelled'])
                ->whereIn('month',  $months)
                ->whereIn('supplier_id',[$supplierId,0])
                ->groupBy('month_name','month')
                ->get();

            $rejected = $this->sortItems($rejected ,$months);
            return response(['data' => ['completed' =>  $completed , 'rejected' => $rejected ]], 200);

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Query failed. Item not found']], 404);
        }


    }

    public function sales($id){

        $months = $this->getMonths(6);

        $supplierId = $id;



        try{
            $sales =  ViewDashboardOrder::select(DB::raw('sum(gross_total) as gross_total, sum(net_total) as net_total, sum(discount) as discount, month_name,month'))
                ->whereIn('status',['Completed','Accepted'])
                ->whereIn('month', $months )
                ->whereIn('supplier_id',[$supplierId,0])
                ->groupBy('month_name','month')
                ->get();

            $sales = $this->sortItems($sales,$months);

            return response(['data' => ['sales' =>  $sales]], 200);

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Query failed. Item not found']], 404);
        }

    }


    public function statsWidget($id){

        $supplierId = $id;

        //orders this year
        $months = $this->getMonths(12);

        $orders =  ViewDashboardOrder::whereIn('status',['Completed','Accepted'])
            ->whereIn('month', $months )
            ->whereIn('supplier_id',[$supplierId,0])
            ->sum('orders');

        //items sold today

        $sold = Order::with(['products'=>function($product){
            return $product;
        }])
            ->where('supplier_id',$supplierId)
            ->where('updated_at','LIKE',date('Y-m-d').'%')
            ->get()
            ->sum(function($orders){
                $sum = 0;
                foreach($orders->products as $product){
                    $sum += $product->product_quantity;
                }
                return  $sum;

            });

        //profit today
        $profit = Order::where('supplier_id',$supplierId)
            ->where('updated_at','LIKE',date('Y-m-d').'%')
            ->whereIn('status',['Completed','Accepted'])
            ->sum('gross_total');


        //total customers
        $customers = Order::where('supplier_id',$supplierId)
            ->count(DB::raw('DISTINCT customer_id'));


        return response(['data' => ['orders' =>  $orders, 'profit'=> $profit, 'sold'=> $sold, 'customers'=>$customers]], 200);


    }

    public function sidebar($id){
        //product count
        $product = Product::where('supplier_id',$id)->count();
        //brand count
        $brand = Brand::where('supplier_id',$id)->count();
        //pending count
        $pending = Order::where('supplier_id',$id)->where('status','Pending')->count();
        //accepted count
        $accepted =  Order::where('supplier_id',$id)->where('status','Accepted')->count();

        return response(['data'=>['product'=>$product, 'brand'=>  ($brand-1), 'pending'=>$pending,'accepted'=>$accepted]],200);
    }

    private function getMonths($duration){

        $months = array();    
        $month = date('m');

        for($i = 0; $i < $duration; $i++){
            if($month == 0){
                $month = 12;
            }
            array_push($months,$month);
            $month --;
        }
        return $months;
    }

    private function sortItems($arr,$index){

        $sorted = array();
        foreach( $index as $i ){

            foreach($arr as $item){

                if($item->month == $i){
                    array_push($sorted,$item);
                }
            }
        }

        return $sorted;

    }
}
