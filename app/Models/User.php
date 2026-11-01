<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[Table(name: 'users', key: 'user_id')]
#[Fillable(['username', 'email', 'password_hash', 'role_id', 'is_approved', 'branch_id'])]
#[Hidden(['password_hash', 'remember_token'])]
class User extends Authenticatable
{
    public const UPDATED_AT = null;

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
            'password_hash' => 'hashed',
        ];
    }

    public function getAuthPasswordName(): string
    {
        return 'password_hash';
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function handledComplaints(): HasMany
    {
        return $this->hasMany(CustomerComplaint::class, 'handled_by_user_id');
    }
}
