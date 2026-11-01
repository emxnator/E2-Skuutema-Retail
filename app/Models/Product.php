<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table(name: 'products', key: 'product_id', timestamps: false)]
#[Fillable(['sku', 'name', 'description', 'image_url', 'price', 'category'])]
class Product extends Model
{
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function inventory(): HasMany
    {
        return $this->hasMany(BranchInventory::class, 'product_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'product_id');
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(CustomerComplaint::class, 'product_id');
    }
}
