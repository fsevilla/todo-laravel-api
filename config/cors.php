<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |
     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => true,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Origin', 'Accept', 'Content-Type', 'Authorization', 'X-xsrf-token', 'X-csrf-token'],
    'allowedMethods' => ['POST', 'GET', 'OPTIONS', 'PUT', 'DELETE'],
    'exposedHeaders' => [],
    'maxAge' => 0,
];