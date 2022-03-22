<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'name',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }
}
