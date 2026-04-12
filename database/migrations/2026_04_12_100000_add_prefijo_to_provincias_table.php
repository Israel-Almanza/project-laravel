<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('provincias', 'prefijo')) {
            return;
        }

        Schema::table('provincias', function (Blueprint $table) {
            $table->string('prefijo')->default('')->after('id');
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('provincias', 'prefijo')) {
            Schema::table('provincias', function (Blueprint $table) {
                $table->dropColumn('prefijo');
            });
        }
    }
};
