<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pais
 *
 * @property $id
 * @property $prefijo
 * @property $nombre
 * @property $coordena
 * @property $zoom
 * @property $created_at
 * @property $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departamento> $departamentos
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pais extends Model
{
    protected $table = 'pais';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['prefijo', 'nombre', 'coordena', 'zoom'];

    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'pais_id');
    }
}
