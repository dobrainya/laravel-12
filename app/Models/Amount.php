<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'amount';

    public function type(): HasOne
    {
        return $this->hasOne(Reference::class, 'id', 'type_id');
    }
}
