<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Provincia
 *
 * @property int $id
 * @property string $prefijo
 * @property int $pais_id
 * @property int $departamento_id
 * @property string $coordena
 * @property string $zoom
 * @property $created_at
 * @property $updated_at
 * @property-read \App\Models\Departamento|null $departamento
 * @property-read \App\Models\Pais|null $pais
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Provincia extends Model
{
    protected $perPage = 20;

    /**
     * @var array<int, string>
     */
    protected $fillable = ['prefijo', 'pais_id', 'departamento_id', 'coordena', 'zoom'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }
}
