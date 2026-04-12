<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('provincias') && ! Schema::hasColumn('provincias', 'nombre')) {
            Schema::table('provincias', function (Blueprint $table) {
                $table->string('nombre')->default('')->after('prefijo');
            });
        }

        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql' || $driver === 'mariadb') {
            foreach (['pais', 'departamentos', 'provincias', 'municipios'] as $table) {
                if (! Schema::hasTable($table)) {
                    continue;
                }
                if (Schema::hasColumn($table, 'coordena') && ! Schema::hasColumn($table, 'coordenadas')) {
                    DB::statement("ALTER TABLE `{$table}` CHANGE `coordena` `coordenadas` VARCHAR(255) NOT NULL");
                }
            }
        } else {
            foreach (['pais', 'departamentos', 'provincias', 'municipios'] as $table) {
                if (! Schema::hasTable($table)) {
                    continue;
                }
                if (Schema::hasColumn($table, 'coordena') && ! Schema::hasColumn($table, 'coordenadas')) {
                    Schema::table($table, function (Blueprint $blueprint) {
                        $blueprint->renameColumn('coordena', 'coordenadas');
                    });
                }
            }
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql' || $driver === 'mariadb') {
            foreach (['pais', 'departamentos', 'provincias', 'municipios'] as $table) {
                if (! Schema::hasTable($table)) {
                    continue;
                }
                if (Schema::hasColumn($table, 'coordenadas') && ! Schema::hasColumn($table, 'coordena')) {
                    DB::statement("ALTER TABLE `{$table}` CHANGE `coordenadas` `coordena` VARCHAR(255) NOT NULL");
                }
            }
        } else {
            foreach (['pais', 'departamentos', 'provincias', 'municipios'] as $table) {
                if (! Schema::hasTable($table)) {
                    continue;
                }
                if (Schema::hasColumn($table, 'coordenadas') && ! Schema::hasColumn($table, 'coordena')) {
                    Schema::table($table, function (Blueprint $blueprint) {
                        $blueprint->renameColumn('coordenadas', 'coordena');
                    });
                }
            }
        }

        if (Schema::hasTable('provincias') && Schema::hasColumn('provincias', 'nombre')) {
            Schema::table('provincias', function (Blueprint $table) {
                $table->dropColumn('nombre');
            });
        }
    }
};
