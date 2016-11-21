<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\ViewReportSale;
use Psy\Util\Json;

/**
 * Class representing the ReportController
 * @package App\Http\Controllers
 */
class ReportController extends Controller
{
    /**
     * This function is used to generate the orders report according various types.
     *
     * @param Request $request
     * @param $id
     * @return Json response.
     */
    public function orders(Request $request, $id)
    {
        $data = $request->all();
        $data['marketPlaceId'] = $id;
        $data['type'] = 'Report';

        try {
            return Order::getOrders($data);
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => ' Details not found']], 404);
        }
    }

    /**
     * This function used to generate brand sales within a specific date periods.
     *
     * @param Request $request
     * @param $id
     * @return  Json response.
     */
    public function brands(Request $request, $id)
    {
        $data = $request->all();
        $supplierId = $id;

        try {
            $brand_sales = ViewReportSale::select(DB::raw('brand_id, brand_name, sum(product_quantity) as quantity, sum(product_price) as total'))
                ->whereIn('order_status', ['Completed', 'Accepted'])
                ->where('supplier_id', $supplierId)
                ->whereBetween('order_date', [$data['startDate'], $data['endDate']])
                ->groupBy('brand_id', 'brand_name')
                ->get();

            return response(['data' => ['brand_sales' => $brand_sales]], 200);

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Brand details not found']], 404);
        }
    }


    /**
     * This function is used to generate product sales within a specific date periods.
     *
     * @param Request $request
     * @param $id
     * @return Json response.
     */
    public function products(Request $request, $id)
    {
        $data = $request->all();
        $supplierId = $id;

        try {
            $product_sales = ViewReportSale::select(DB::raw('product_id, product_name, brand_name, sum(product_quantity) as quantity, sum(product_price) as total'))
                ->whereIn('order_status', ['Completed', 'Accepted'])
                ->where('supplier_id', $supplierId)
                ->whereBetween('order_date', [$data['startDate'], $data['endDate']])
                ->groupBy('product_id', 'product_name', 'brand_name')
                ->get();

            return response(['data' => ['product_sales' => $product_sales]], 200);

        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Product details not found']], 404);
        }
    }
}
