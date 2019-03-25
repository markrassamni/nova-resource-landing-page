<?php

namespace MarkRassamni\NovaResourceLandingPage\Providers;

use Illuminate\Support\ServiceProvider;

class NovaResourceLandingPageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishAssets();
    }

    /**
     * @return $this
     */
    protected function publishAssets()
    {
        $this->publishes([
            __DIR__.'/../../resources/views/resources' => resource_path('views/vendor/nova/resources'),
        ], 'nova-views');

        return $this;
    }
}
