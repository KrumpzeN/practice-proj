<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Serializer::class, function ($app) {
            return new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        });
        
        
        $this->app->bind('Symfony\Component\Serializer\SerializerInterface', Serializer::class);
    }

    public function boot()
    {
        $now = Carbon::now();
        $newYear = Carbon::createFromDate($now->year + 1, 1, 1);
        $daysUntilNewYear = $now->diffInDays($newYear);
        
        Blade::directive('newYearsSale', function ($daysBeforeNewYear) use ($daysUntilNewYear) {
            return "<?php
                \$daysUntilSale = $daysUntilNewYear - intval($daysBeforeNewYear);
                echo 'New Year\'s sale starts in ' . intval(\$daysUntilSale) . ' days.';
            ?>";
        });
    }
}
