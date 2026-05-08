<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Domaines d'intervention
        Schema::create('domaines', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('icone')->nullable();
            $table->timestamps();
        });

        // Articles (Blog / Actualités)
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->longText('contenu');
            $table->string('auteur');
            $table->string('categorie');
            $table->string('image_url')->nullable();
            $table->json('tags')->nullable();
            $table->enum('statut', ['brouillon', 'publie', 'archive'])->default('brouillon');
            $table->dateTime('date_publication')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        // Projets / Réalisations
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->string('domaine'); // Could be a foreign key to domaines.id
            $table->text('description');
            $table->string('lieu');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->integer('beneficiaires')->default(0);
            $table->json('images')->nullable();
            $table->json('documents')->nullable(); // [{nom, url}]
            $table->enum('statut', ['en_cours', 'termine', 'planifie'])->default('planifie');
            $table->json('partenaires')->nullable();
            $table->boolean('visible_public')->default(true);
            $table->timestamps();
        });

        // Événements (Agenda)
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->enum('type', ['formation', 'sensibilisation', 'ag', 'commemoration', 'autre']);
            $table->text('description');
            $table->dateTime('date_heure');
            $table->string('lieu');
            $table->integer('capacite_max')->default(0);
            $table->boolean('inscriptions_ouvertes')->default(true);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // Inscriptions aux événements
        Schema::create('event_inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('nom');
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->timestamps();
        });

        // Contacts (Messages)
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email');
            $table->string('sujet');
            $table->text('message');
            $table->boolean('lu')->default(false);
            $table->boolean('repondu')->default(false);
            $table->timestamps();
        });

        // Dons
        Schema::create('dons', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 15, 2);
            $table->string('devise')->default('FCFA');
            $table->string('donateur');
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('cause');
            $table->string('moyen'); // mtn, orange, cinetpay, virement, paypal
            $table->enum('statut', ['en_attente', 'confirme', 'echec'])->default('en_attente');
            $table->dateTime('date_don');
            $table->timestamps();
        });

        // Statistiques (Compteurs Home Page)
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->integer('count')->default(0);
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        // Partenaires
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('logo_url');
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });

        // FAQ
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('reponse');
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });

        // Galerie
        Schema::create('galeries', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->string('legende')->nullable();
            $table->timestamps();
        });

        // Abonnés Newsletter
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamps();
        });

        // Configuration du site
        Schema::create('site_configs', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_configs');
        Schema::dropIfExists('subscribers');
        Schema::dropIfExists('galeries');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('partenaires');
        Schema::dropIfExists('stats');
        Schema::dropIfExists('dons');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('event_inscriptions');
        Schema::dropIfExists('events');
        Schema::dropIfExists('projets');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('domaines');
    }
};
