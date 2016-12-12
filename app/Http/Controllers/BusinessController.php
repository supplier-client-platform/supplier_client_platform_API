<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Branch;
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
                'supplier.image',
                'supplier.website'
            )
                ->join('supplier_category', 'supplier.supplier_category_id', '=', 'supplier_category.id')
                ->paginate();

            return $result;
        } catch (Exception $e) {
            return response(['data' => ['status' => 'fail', 'message' => 'Query failed. Item not found']], 404);
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
                'supplier_category.name as cat_name',
                'supplier.contact',
                'supplier.supplier_category_id',
                'supplier.website',
                'supplier.email',
                'supplier.address',
                'supplier.base_city',
                'supplier.image'
            )
                ->leftJoin('supplier_category', 'supplier.supplier_category_id', '=', 'supplier_category.id')
                ->where('supplier.id', $id)
                ->get();



            return response()->json(['data' =>  $result], 200);
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
    
            Supplier::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'supplier_category_id' => $request->supplier_category_id,
                    'email' => $request->email,
                    'contact' => $request->contact,
                    'address' => $request->address,
                    'base_city' => $request->base_city,
                    'image' => $request->image
                ]);

            return response(['data' => ['status' => 'success', 'message' => 'Update successful']], 200);
       
    }
    public function branchCreate(Request $request, $id)
    {

        $branch = new Branch;

        $branch->address = $request->address;
        $branch->lat = $request->lat;
        $branch->lng = $request->lng;
        $branch->phone =$request->phone;
        $branch->branchname = $request->name;
        $branch->supplier_id = $id;

        $branch->save();

        return response(['data' => ['status' => 'success', 'message' => ' successful']], 200);

    }

    public function branchUpdate(Request $request, $id)
    {

        $branch = Branch::find($request->id);

        $branch->address = $request->address;
        $branch->lat = $request->lat;
        $branch->lng = $request->lng;
        $branch->phone =$request->phone;
        $branch->branchname = $request->name;

        $branch->save();

        return response(['data' => ['status' => 'success', 'message' => ' update successful']], 200);

    }

    public function branchList(Request $request, $id)
    {
        return Branch::where('supplier_id',$id)->get();
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
