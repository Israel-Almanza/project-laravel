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
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pais extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['prefijo', 'nombre', 'coordena', 'zoom'];



}
