<?php

namespace App\Models;

use App\Mail\Company\AccountCreationNoticeMail;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class Company extends Model
{
    use HasFactory, HasUUID, SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'email', 'website',
    ];

    protected $with = [
        'user',
    ];

    protected static function booted()
    {
        static::created(function (Company $company) {
            Mail::to($company->email)->send(new AccountCreationNoticeMail($company));
        });

        static::deleted(function (Company $company) {
            $company->user->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }

    public function getUsernameAttribute()
    {
        return $this->user->username;
    }
}
