<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property array<int, string> $administrador
 * @property array<int, string> $representante
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Role extends Model
{
    protected $table = 'roles';

    protected $perPage = 20;

    /**
     * @var array<int, string>
     */
    protected $fillable = ['administrador', 'representante'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'administrador' => 'array',
        'representante' => 'array',
    ];
}
