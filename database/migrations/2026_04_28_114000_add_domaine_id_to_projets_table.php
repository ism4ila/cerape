<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projets', function (Blueprint $table): void {
            $table->foreignId('domaine_id')->nullable()->after('slug')->constrained('domaines')->cascadeOnDelete();
        });

        $domaines = DB::table('domaines')->pluck('id', 'nom');
        $projets = DB::table('projets')->select('id', 'domaine')->get();

        foreach ($projets as $projet) {
            $domaineId = $domaines[$projet->domaine] ?? null;

            if ($domaineId !== null) {
                DB::table('projets')
                    ->where('id', $projet->id)
                    ->update(['domaine_id' => $domaineId]);
            }
        }

        Schema::table('projets', function (Blueprint $table): void {
            $table->dropColumn('domaine');
        });
    }

    public function down(): void
    {
        Schema::table('projets', function (Blueprint $table): void {
            $table->string('domaine')->nullable()->after('slug');
        });

        $domaines = DB::table('domaines')->pluck('nom', 'id');
        $projets = DB::table('projets')->select('id', 'domaine_id')->get();

        foreach ($projets as $projet) {
            $domaine = $domaines[$projet->domaine_id] ?? null;

            if ($domaine !== null) {
                DB::table('projets')
                    ->where('id', $projet->id)
                    ->update(['domaine' => $domaine]);
            }
        }

        Schema::table('projets', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('domaine_id');
        });
    }
};
