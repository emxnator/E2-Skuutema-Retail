<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(name: 'branch_inventory', key: 'inventory_id')]
#[Fillable(['branch_id', 'product_id', 'stock_quantity'])]
class BranchInventory extends Model
{
    public const CREATED_AT = null;

    public const UPDATED_AT = 'last_updated';

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
