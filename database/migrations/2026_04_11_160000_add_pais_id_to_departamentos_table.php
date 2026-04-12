<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('departamentos', 'pais_id')) {
            return;
        }

        Schema::table('departamentos', function (Blueprint $table) {
            $table->foreignId('pais_id')
                ->nullable()
                ->after('nombre')
                ->constrained('pais')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });

        if (Schema::hasColumn('departamentos', 'pais')) {
            $departamentos = DB::table('departamentos')->select('id', 'pais')->get();
            foreach ($departamentos as $row) {
                if (empty($row->pais)) {
                    continue;
                }
                $paisId = DB::table('pais')->where('nombre', $row->pais)->value('id');
                if ($paisId) {
                    DB::table('departamentos')->where('id', $row->id)->update(['pais_id' => $paisId]);
                }
            }

            $firstPaisId = DB::table('pais')->orderBy('id')->value('id');
            if ($firstPaisId !== null) {
                DB::table('departamentos')->whereNull('pais_id')->update(['pais_id' => $firstPaisId]);
            }

            Schema::table('departamentos', function (Blueprint $table) {
                $table->dropColumn('pais');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('departamentos', 'pais_id')) {
            return;
        }

        Schema::table('departamentos', function (Blueprint $table) {
            $table->string('pais')->after('nombre')->nullable();
        });

        $rows = DB::table('departamentos')->select('id', 'pais_id')->get();
        foreach ($rows as $row) {
            $nombre = $row->pais_id
                ? DB::table('pais')->where('id', $row->pais_id)->value('nombre')
                : null;
            DB::table('departamentos')->where('id', $row->id)->update(['pais' => $nombre]);
        }

        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropForeign(['pais_id']);
            $table->dropColumn('pais_id');
        });
    }
};
