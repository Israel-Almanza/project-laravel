<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipio
 *
 * @property int $id
 * @property string $prefijo
 * @property string $nombre
 * @property int $pais_id
 * @property int $departamento_id
 * @property int $provincia_id
 * @property string $coordenadas
 * @property string $zoom
 * @property $created_at
 * @property $updated_at
 * @property-read \App\Models\Departamento|null $departamento
 * @property-read \App\Models\Pais|null $pais
 * @property-read \App\Models\Provincia|null $provincia
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Municipio extends Model
{
    protected $perPage = 20;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'prefijo',
        'nombre',
        'pais_id',
        'departamento_id',
        'provincia_id',
        'coordenadas',
        'zoom',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }
}
