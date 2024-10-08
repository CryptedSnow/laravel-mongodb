<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\{Model,SoftDeletes};

class TipoNenModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = "tipos_nens";
    protected $primary_key = '_id';
    protected $fillable = [
        'descricao',
    ];

    public function tipo_nen()
    {
        return $this->hasMany(HunterModel::class, 'tipo_nen_id');
    }
}
