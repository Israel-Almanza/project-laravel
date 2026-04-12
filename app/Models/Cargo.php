<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cargo
 *
 * @property $id
 * @property $nombre
 * @property $prefijo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cargo extends Model
{
    

    protected $perPage = 20;

    /**
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'prefijo'];



}
