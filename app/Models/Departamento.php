<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Departamento
 *
 * @property $id
 * @property $nombre
 * @property $pais_id
 * @property $coordena
 * @property $zoom
 * @property $created_at
 * @property $updated_at
 * @property-read \App\Models\Pais|null $pais
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Provincia> $provincias
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Departamento extends Model
{
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'pais_id', 'coordena', 'zoom'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function provincias()
    {
        return $this->hasMany(Provincia::class, 'departamento_id');
    }
}
