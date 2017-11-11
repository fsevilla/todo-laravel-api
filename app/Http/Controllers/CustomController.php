<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    protected $debug = false;

    protected $pagination_enabled = false;

    protected $pagination = [
        'current_page' => 1,
        'per_page' => 1
    ];

    public function __construct(Request $request)
    {
        if($request->input('paginate') == 'true'){
            $this->pagination_enabled = true;
        }

        if(env("APP_ENV")=="local"){
            \DB::listen(function($query) {
                if($this->debug == true){
                    echo $query->sql;
                    echo "<hr />";
                }
            });
        }
    }

    protected function getItems($model)
    {
        if($this->pagination_enabled){
            return $model->paginate($this->pagination['per_page']);
        } else {
            return $model->get();
        }
    }

    protected function valueOrDefault($value, $default)
    {
        return $value ? $value : $default;
    }
}
