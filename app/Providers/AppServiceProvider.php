<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Javoscript\MacroableModels\Facades\MacroableModels;
use Spatie\UptimeMonitor\Models\Monitor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		MacroableModels::addMacro( Monitor::class, 'getShortUrl', function() {
			$parts = parse_url( $this->url );

			if( $parts ) {
				return str_replace('.', '.<wbr>', $parts['host']);
			}

			return null;
		} );

		MacroableModels::addMacro( Monitor::class, 'getFullUrl', function() {
			return str_replace('.', '.<wbr>', $this->url);
		} );

		MacroableModels::addMacro( Monitor::class, 'getUptimeStatusId', function() {
			return str_replace( ' ', '-', $this->uptime_status );
		} );
    }
}
