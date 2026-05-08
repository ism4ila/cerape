<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table): void {
            $table->index(['statut', 'date_publication'], 'articles_statut_date_publication_index');
        });

        Schema::table('projets', function (Blueprint $table): void {
            $table->index(['visible_public', 'created_at'], 'projets_visible_public_created_at_index');
        });

        Schema::table('events', function (Blueprint $table): void {
            $table->index('date_heure', 'events_date_heure_index');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table): void {
            $table->dropIndex('articles_statut_date_publication_index');
        });

        Schema::table('projets', function (Blueprint $table): void {
            $table->dropIndex('projets_visible_public_created_at_index');
        });

        Schema::table('events', function (Blueprint $table): void {
            $table->dropIndex('events_date_heure_index');
        });
    }
};
