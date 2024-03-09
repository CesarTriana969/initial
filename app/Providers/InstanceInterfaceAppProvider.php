<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InstanceInterfaceAppProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // --BEGIN ACTION BINDINGS--
        $this->app->bind(\App\Actions\Panel\Client\Interfaces\ClientInterface::class, \App\Actions\Panel\Client\ClientAction::class);

        $this->app->bind(\App\Actions\Panel\ContactUs\Interfaces\ContactUsInterface::class, \App\Actions\Panel\ContactUs\ContactUsAction::class);
            
        $this->app->bind(\App\Actions\Panel\Blog\Interfaces\BlogInterface::class, \App\Actions\Panel\Blog\BlogAction::class);

        $this->app->bind(\App\Actions\Panel\Blog\Schedule\Interfaces\ScheduleInterface::class, \App\Actions\Panel\Blog\Schedule\ScheduleAction::class);

        $this->app->bind(\App\Actions\Panel\Blog\Author\Interfaces\AuthorInterface::class, \App\Actions\Panel\Blog\Author\AuthorAction::class);

        $this->app->bind(\App\Actions\Panel\Blog\Category\Interfaces\CategoryInterface::class, \App\Actions\Panel\Blog\Category\CategoryAction::class);

        $this->app->bind(\App\Actions\Panel\Blog\Tag\Interfaces\TagInterface::class, \App\Actions\Panel\Blog\Tag\TagAction::class);

        $this->app->bind(\App\Actions\Panel\SiteServices\Interfaces\SiteServicesInterface::class, \App\Actions\Panel\SiteServices\SiteServicesAction::class);

        $this->app->bind(\App\Actions\Panel\User\interfaces\UserInterface::class, \App\Actions\Panel\User\UserAction::class);

        $this->app->bind(\App\Actions\Panel\Role\Interfaces\RoleInterface::class, \App\Actions\Panel\Role\RoleAction::class);

        $this->app->bind(\App\Actions\Panel\SiteServices\ServiceArea\Interfaces\ServiceAreaInterface::class, \App\Actions\Panel\SiteServices\ServiceArea\ServiceAreaAction::class);
// --END ACTION BINDINGS--
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
