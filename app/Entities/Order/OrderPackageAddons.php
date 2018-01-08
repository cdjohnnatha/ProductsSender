<?php

namespace App\Entities\Order;

use App\Entities\Company\Warehouse\CompanyWarehouseAddon;
use App\Entities\Entity;
use Illuminate\Database\Eloquent\Model;

class OrderPackageAddons extends Entity
{
    protected $fillable = [
        'price',
        'order_id',
        'company_warehouse_addon_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function companyWarehouseAddon()
    {
        return $this->belongsTo(CompanyWarehouseAddon::class);
    }
}
