<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\{Model,SoftDeletes};

class TipoHunterModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = "tipos_hunters";
    protected $primary_key = '_id';
    protected $fillable = [
        'descricao',
    ];

    public function tipo_hunter()
    {
        return $this->hasMany(HunterModel::class, 'tipo_hunter_id');
    }
}
