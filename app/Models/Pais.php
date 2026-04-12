<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pais
 *
 * @property $id
 * @property $prefijo
 * @property $nombre
 * @property string $coordenadas
 * @property $zoom
 * @property $created_at
 * @property $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departamento> $departamentos
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Provincia> $provincias
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Municipio> $municipios
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
    protected $fillable = ['prefijo', 'nombre', 'coordenadas', 'zoom'];

    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'pais_id');
    }

    public function provincias()
    {
        return $this->hasMany(Provincia::class, 'pais_id');
    }

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'pais_id');
    }
}
