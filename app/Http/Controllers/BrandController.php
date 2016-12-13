<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Exception;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $supplier = $request->input('supplier_id');

        try{
            return DB::table('brand')
                ->select(
               DB::raw('brand.id , brand.brandname, (select count(*) from product p where p.brand_id = brand.id) as count')
            )
                ->where('supplier_id', $supplier)
                ->where('status','Active')
                ->get();

        }catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Items Not found.']], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            Brand::create([
                'brandname' => $request->brandName,
                'supplier_id' => $request->businessID
            ]);

            return response(['data' => ['status' => 'success', 'message' => 'Creation successful']], 200);
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Creation failed. Check parameters sent.']], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
            Brand::where('id', $id)
                ->update([
                    'brandname' => $request->brandName,
                    'supplier_id' => $request->businessID
                ]);
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
        try {
            Brand::where('id', $id)
                ->update([
                    'status' => 'Deprecated'
                ]);
            return response(['data' => ['status' => 'success', 'message' => 'Delete successful']], 200);
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Delete failed. Item Not found.']], 404);
        }
    }
}
