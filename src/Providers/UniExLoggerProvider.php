<?php
/**
 * Created by IntelliJ IDEA.
 * User: isda
 * Date: 11/09/2017
 * Time: 3:13 PM
 */

namespace UniExLogger\Providers;

use Illuminate\Support\ServiceProvider;
use UniExLogger\ILogger;
use UniExLogger\Logger;

/**
 * Class PromLogManagerProvider
 * @package UniExLoggerManager\Providers
 */
class UniExLoggerProvider extends ServiceProvider
{


    public function boot ()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('uniexlogger.php'),
        ], 'config');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            ILogger::class,
            Logger::class
        );

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'uniexlogger');

    }
}