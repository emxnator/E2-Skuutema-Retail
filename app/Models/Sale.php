<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(name: 'sales', key: 'sale_id', timestamps: false)]
#[Fillable(['branch_id', 'product_id', 'quantity_sold', 'total_revenue', 'sale_date'])]
class Sale extends Model
{
    protected function casts(): array
    {
        return [
            'total_revenue' => 'decimal:2',
            'sale_date' => 'datetime',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
