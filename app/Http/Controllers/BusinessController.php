<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

use App\Http\Requests;
use Exception;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $result = DB::table('supplier')
                ->select(
                    'supplier.id',
                    'supplier.name',
                    'supplier_category.name',
                    'supplier.contact',
                    'supplier.email',
                    'supplier.address',
                    'supplier.base_city',
                    'supplier.image'
                )
                ->join('supplier_category', 'supplier.supplier_category_id', '=', 'supplier_category.id')
                ->where('supplier.user_id', $id)
                ->paginate();

            return $result;
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Query failed. Item not found']], 404);
        }
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
            Supplier::where('id', $id)
                ->update([
                    'name' => $request->businessName,
                    'supplier_category_id' => $request->supplierCategory,
                    'email' => $request->businessEmail,
                    'contact' => $request->businessContact,
                    'address' => $request->business_address,
                    'base_city' => $request->baseCity,
                    'image' => $request->imageUrl
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
        //
    }
}
