<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    protected $debug = true;

    protected $pagination_enabled = false;

    protected $pagination = [
        'current_page' => 1,
        'per_page' => 1
    ];

    public function __construct(Request $request)
    {
        if($request->input('paginate') == 'true'){
            $this->pagination_enabled = true;
            $this->pagination['per_page'] = $request->input('per_page') ? $request->input('per_page') : $this->pagination['per_page'];
        }

        if(env("APP_ENV")=="local"){
            if($request->input('debug') !== null) {
                $this->debug = $request->input('debug') === 'true' ? true : false;
            }
            \DB::listen(function($query) {
                if($this->debug === true){
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
