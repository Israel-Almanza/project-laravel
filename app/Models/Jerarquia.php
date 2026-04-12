<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Jerarquia
 *
 * @property $id
 * @property $prefijo
 * @property $organizacion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Jerarquia extends Model
{
    protected $table = 'jerarquias';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['prefijo', 'organizacion'];



}
