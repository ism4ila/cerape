<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Projet;
use App\Models\SiteConfig;
use App\Policies\ArticlePolicy;
use App\Policies\ProjetPolicy;
use Throwable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Article::class, ArticlePolicy::class);
        Gate::policy(Projet::class, ProjetPolicy::class);

        $defaults = [
            'site_name' => config('app.name', 'CERAPE'),
            'site_tagline' => 'Education is Life',
            'site_description' => "Cercle des Associations Prospères pour l'Éducation.",
            'contact_email' => 'cerapecmr@gmail.com',
            'contact_phone' => '(+237) 690-99-07-53',
            'contact_address' => "Mandjou, Région de l'Est, Cameroun",
            'theme_primary_color' => '#0d47a1',
            'facebook_url' => null,
            'twitter_url' => null,
            'instagram_url' => null,
            'whatsapp_url' => null,
            'whatsapp_number' => null,
            'logo' => null,
            'favicon' => null,
        ];

        try {
            $storedSettings = Cache::remember('site_settings', now()->addHour(), function (): array {
                return SiteConfig::query()->pluck('value', 'key')->toArray();
            });
        } catch (Throwable) {
            $storedSettings = [];
        }

        $siteSettings = array_merge($defaults, $storedSettings);
        View::share('siteSettings', $siteSettings);

        View::composer(['layouts.public', 'layouts.admin'], function ($view) use ($siteSettings): void {
            $view->with('siteSettings', $siteSettings);
        });
    }
}
