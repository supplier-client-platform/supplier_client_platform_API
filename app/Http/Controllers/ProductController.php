<?php

namespace App\Http\Controllers;

use App\Product;
use App\Template;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        

        $data = $request->all();
        try{
            return Product::getProducts($data);
        } catch(Exception $e) {
            return response('Product not found', 404);
        }
    }

    public function create(Request $request)
    {
        $data = $request->all();

        if (Product::where('brand_id', $data['brand_id'])->where('supplier_id',$data['supplier_id'])->where('name', $data['name'])->count() > 0) {
            return response(['data' => ['status' => 'failed', 'message' => 'Product already exists for this Supplier']], 409);
        }
        else {
            Product::create([
                'name' => $data['name'],
                'brand_id' => $data['brand_id'],
                'price' => $data['price'],
                'status' => $data['status'],
                'custom_attr' => serialize($data['custom_attr']),
                'supplier_id' => $data['supplier_id'],
                'img_url' =>  $data['img_url'],
                'description' => 'undefined',
                'quantity' => 0,
                'category_id' => $data['category_id']
            ]);

            //if the template is new
            if($data['template_id'] =='0'){
                $template = new Template;
                $template->name = $data['template_name'];
                $template->supplier_id = $data['supplier_id'];
                $template->custom_attr = serialize($data['custom_attr']);
                $template->save();
            }

            return response(['data' => ['status' => 'success', 'message' => 'Product created']], 200);
//            return response('Success', 200);    // XXX: Better option is to return the model itself.
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
        try{
            $collection = DB::table('product')
                ->select(
                'product.id',
                'product.name',
                'brand.brandname',
                'product.img_url',
                'product.price',
                'product.status',
                'product.custom_attr',
                'product.supplier_id',
                'product.category_id',
                'product.brand_id'
            )
                ->join('brand', 'product.brand_id', '=', 'brand.id')
                ->where('product.id', $id)
                ->get();

            //$collection->custom_attr = unserialize($collection->custom_attr);

            foreach ($collection as $item) {
                $item->custom_attr = unserialize($item->custom_attr);
            }

            return [
                'data' => $collection
            ];


        } catch(Exception $e) {
            return response('Product not found', 404);
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
        $data = $request->all();

        try{
            Product::where('id', $id)
                ->update([
                    'name' => $data['name'],
                    'brand_id' => $data['brand_id'],
                    'price' => $data['price'],
                    'status' => $data['status'],
                    'custom_attr' => serialize($data['custom_attr']),
                    'supplier_id' => $data['supplier_id'],
                    'img_url' => $data['img_url'],
                    'description' => 'undefined',
                    'quantity' => 0,
                    'category_id' => $data['category_id'],  
                ]);

            return response('Success', 200);    // XXX: Better option is to return the model itself.

        } catch(Exception $e) {
            return response('Product not found', 404);
        }
    }
}