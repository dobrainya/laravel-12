<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reference extends Model
{
    use SoftDeletes;

    protected $table = 'reference';

    protected $fillable = [
        'name',
        'code',
    ];

    public function amounts() : HasMany
    {
        return $this->hasMany(Amount::class, 'type_id', 'id');
    }
}
