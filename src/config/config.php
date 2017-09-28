<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Log Prefix
    |--------------------------------------------------------------------------
    |
    | Prefix that will be added in log message. You may override prefix by
    | declaring protected $key in your exception implementing class or by
    | setting it manually
    |
    */
    'prefix' => env('PROM_GRAYLOG_PREFIX', 'Prometheus'),

    /*
    |--------------------------------------------------------------------------
    | Context Prefix
    |--------------------------------------------------------------------------
    |
    | Prefix that will be used as a key prefix for context array
    |
    */
    'context_prefix' => env('PROM_GRAYLOG_CONTEXT_PREFIX', 'frontend'),

    /*
    |--------------------------------------------------------------------------
    | Graylog Host
    |--------------------------------------------------------------------------
    |
    | Specify the host of graylog we are going to use
    |
    */

    'graylog_host' => env('PROM_GRAYLOG_HOST', '8.8.8.8'),

    /*
    |--------------------------------------------------------------------------
    | Graylog Port
    |--------------------------------------------------------------------------
    |
    | Specify the port of graylog we are going to use
    |
    */
    'graylog_port' => env('PROM_GRAYLOG_PORT', 12197),


    /*
    |--------------------------------------------------------------------------
    | Request Headers
    |--------------------------------------------------------------------------
    |
    | Specify the list of request headers that will be included
    |
    */
    'request_headers' => [
        'Authorization',
        'Accept-Language'
    ],

    'should_log' => [
        'UniExLogger\Exceptions\HttpClientException' => env('UNIEXLOG_HTTPCLIENT_ENABLED', 1),
        'UniExLogger\Exceptions\MaintenanceException' => env('UNIEXLOG_MAINTENANCE_ENABLED', 1),
        'UniExLogger\Exceptions\SiteConfigurationException' => env('UNIEXLOG_HTTPCLIENT_ENABLED', 1),
        'UniExLogger\Exceptions\TokenExpiredException' => env('UNIEXLOG_HTTPCLIENT_ENABLED', 1),
        'UniExLogger\Exceptions\TokenInvalidException' => env('UNIEXLOG_HTTPCLIENT_ENABLED', 1),
        'UniExLogger\Exceptions\CacheUpdateException' => env('UNIEXLOG_HTTPCLIENT_ENABLED', 1),
    ]

];
