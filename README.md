# CERAPE Laravel

Application Laravel 12 pour le site vitrine CERAPE et son back-office d'administration.

## Stack technique

- PHP 8.2
- Laravel 12
- MySQL
- Laravel Breeze (authentification)
- Vite (assets front)

## Prerequis

- PHP 8.2+
- Composer
- Node.js 20+ et npm
- MySQL 8+

## Installation

1. Cloner le projet.
2. Installer les dependances PHP.
3. Installer les dependances front.
4. Configurer les variables d'environnement.
5. Generer la cle d'application.
6. Executer les migrations et les seeders.
7. Lancer les services locaux.

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

## Configuration de base

Verifier dans `.env` :

```env
APP_ENV=local
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cerape_laravel
DB_USERNAME=root
DB_PASSWORD=
QUEUE_CONNECTION=database
SESSION_SECURE_COOKIE=false
```

## Queues (jobs)

Le projet utilise des jobs pour certaines taches asynchrones (ex: email de contact).

```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

## Commandes utiles

```bash
php artisan migrate
php artisan migrate:fresh --seed
php artisan test
php artisan cache:clear
php artisan route:list
php artisan queue:work
npm run dev
npm run build
```

## Comptes de test

Seeder principal :

- Email: `admin@cerape.org`
- Mot de passe: `password`
- Role: `superadmin`

## Structure des roles

- `superadmin` : acces total, y compris suppression sur le CRUD admin.
- `admin` : acces de gestion complet sauf suppression.
- `editeur` : creation et modification uniquement.
- `member` : espace membre standard, pas d'acces admin.

## Lancer les tests

```bash
php artisan test
```

## Securite et contenu HTML

Le contenu riche des articles est purifie avant affichage via `mews/purifier`.

Installation si necessaire :

```bash
composer require mews/purifier
php artisan vendor:publish --provider="Mews\Purifier\PurifierServiceProvider"
```

## Deploiement (resume)

1. Mettre `APP_ENV=production` et `APP_DEBUG=false`.
2. Configurer `APP_URL` en HTTPS.
3. Activer `SESSION_SECURE_COOKIE=true`.
4. Construire les assets avec `npm run build`.
5. Executer `php artisan migrate --force`.
6. Lancer un worker queue permanent.
