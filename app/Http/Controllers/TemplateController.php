<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

use App\Http\Requests;
use Exception;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
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
            $template = DB::table('template')
                ->select(
                'supplier_id',
                'name',
                'custom_attr'   // TODO: Check how to deserialize and paginate
            )
                ->where('supplier_id',$supplier)
                ->get();

            foreach ($template as $temp) {
                $temp->custom_attr = unserialize($temp->custom_attr);
            }
            return [
                'data' => $template
            ];

        } catch(Exception $e) {
            return response('Template retrieval failed', 500);
        }
    }

    /**
     * Create a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            Template::create([
                'name' => $request->input('name'),
                'supplier_id' => $request->input('supplier_id'),
                'custom_attr' => serialize($request->input('custom_attr'))
            ]);
            return response('Template created successfully', 200);
        } catch (Exception $e) {
            return response('Error creating new template', 400);
        }
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
        //
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
