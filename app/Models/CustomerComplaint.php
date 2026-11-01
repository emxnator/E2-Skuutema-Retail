<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(name: 'customer_complaints', key: 'complaint_id')]
#[Fillable([
    'customer_name',
    'customer_contact',
    'product_id',
    'branch_id',
    'handled_by_user_id',
    'complaint_description',
    'status',
])]
class CustomerComplaint extends Model
{
    public const UPDATED_AT = null;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function handledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by_user_id');
    }
}
