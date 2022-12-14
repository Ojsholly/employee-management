<?php

namespace App\Models;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, HasUUID, SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'email', 'website',
    ];

    protected $with = [
        'user',
    ];

    protected $withCount = ['employees'];

    protected static function booted()
    {
        static::softDeleted(function (Company $company) {
            $company->user?->delete();
            $company->employees()->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }

    public function getUsernameAttribute()
    {
        return $this->user?->username ?? fake()->userName;
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'company_id', 'uuid');
    }
}
