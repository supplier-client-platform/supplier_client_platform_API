<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $table = 'order';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public static function getOrders($data)
    {
        $orderBuilder = self::select(
            'order.id',
            'order.created_at',
            'order.updated_at',
            'order.status',
            'order.gross_total',
            'order.net_total',
            'order.discount',
            'order.customer_id',
            'customer.name',
            'customer.email',
            'customer.contact'
        )
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->where('order.supplier_id', $data['marketPlaceId']);

        if (isset($data['contact_number'])) {
            $orderBuilder->where('customer.contact', 'like', '%' . $data['contact_number'] . '%');
        }

        if (isset($data['status'])) {
            $orderBuilder->where('order.status', $data['status']);
        }

        if (isset($data['orderId'])) {
            $orderBuilder->where('order.id', $data['orderId']);
        }

        if (isset($data['customer_name'])) {
            $orderBuilder->where('customer.name', 'like', '%' . $data['customer_name'] . '%');
        }

        if (isset($data['startDate']) && isset($data['endDate']) && !isset($data['type'])) {
            $orderBuilder->whereBetween('order.created_at', [$data['startDate'], $data['endDate']]);
        }

        if (isset($data['startDate']) && isset($data['endDate']) && isset($data['type'])) {
            $orderBuilder->whereBetween('order.updated_at', [$data['startDate'], $data['endDate']]);
        }



        if (isset($data['status'])) {
            if($data['status'] == 'Pending' || $data['status'] == 'Accepted'){
                return $orderBuilder->paginate(10000);
            }
        }
        return $orderBuilder->paginate(25);
    }

    public function products()
    {
        return $this->hasMany(Order_product::class);
    }
}
