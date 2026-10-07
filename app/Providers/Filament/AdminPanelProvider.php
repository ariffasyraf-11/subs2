<?php

namespace AppProvidersFilament;

use FilamentHttpMiddlewareAuthenticate;
use FilamentHttpMiddlewareAuthenticateSession;
use FilamentHttpMiddlewareDisableBladeIconComponents;
use FilamentHttpMiddlewareDispatchServingFilamentEvent;
use FilamentPanel;
use FilamentPanelProvider;
use FilamentSupportColorsColor;
use IlluminateCookieMiddlewareAddQueuedCookiesToResponse;
use IlluminateCookieMiddlewareEncryptCookies;
use IlluminateFoundationHttpMiddlewareVerifyCsrfToken;
use IlluminateRoutingMiddlewareSubstituteBindings;
use IlluminateSessionMiddlewareStartSession;
use IlluminateViewMiddlewareShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors(['primary' => Color::Blue])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([Authenticate::class]);
    }
}