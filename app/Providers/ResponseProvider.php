<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;

class ResponseProvider extends ServiceProvider
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

    static private function parse($data, $code = 200, $type = 'text/javascript')
    {
        return (new Response($data, $code))->header('Content-type', $type);
    }

    static function data($data)
    {
        return ResponseProvider::parse($data);
    }

    static function json($data)
    {
        return ResponseProvider::parse(json_encode($data));
    }

    static function jsonArray($data)
    {
        return ResponseProvider::parse(json_encode(array_values($data)));
    }

    static function error($code, $error)
    {
        $message = [
            'error'=> $error
        ];
        return ResponseProvider::parse($message, $code);
    }
    
}
