<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];


    public static function getProducts($data){

    
            $productBuilder = self::select(
                'product.id',
                'product.name',
                'brand.brandname',
                'product.img_url',
                'product.price',
                'product.status'
            )
                ->join('brand', 'product.brand_id', '=', 'brand.id')
                ->where('product.supplier_id', $data['marketPlaceId']);


            if(isset( $data['query'])){
                $productBuilder->where('product.name', 'like', '%'. $data['query'].'%');
            }
            if(isset( $rq_brand_id)){
                $productBuilder->where('product.brand_id',  $rq_brand_id);
            }
            if(isset($data['status'])){
                $productBuilder->Where('product.status', $data['status']);
            } 
            return $productBuilder->paginate(11);

      
    }
}
