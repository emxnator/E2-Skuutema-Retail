<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table(name: 'roles', key: 'role_id', timestamps: false)]
#[Fillable(['role_name'])]
class Role extends Model
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
