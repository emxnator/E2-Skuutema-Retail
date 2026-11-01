<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table(name: 'branches', key: 'branch_id', timestamps: false)]
#[Fillable(['branch_name', 'location', 'address'])]
class Branch extends Model
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    public function inventory(): HasMany
    {
        return $this->hasMany(BranchInventory::class, 'branch_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'branch_id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'branch_id');
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(CustomerComplaint::class, 'branch_id');
    }
}
