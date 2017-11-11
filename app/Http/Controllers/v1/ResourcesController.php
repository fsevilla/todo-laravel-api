<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\CustomController;
use App\Providers\ResponseProvider as Response;
use Illuminate\Http\Request;
use App\Models\v1\Resource;

class ResourcesController extends CustomController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Resource $resource, Request $request)
    {
        parent::__construct($request);
    }

    public function index(Resource $resource, Request $request)
    {
        if($request->input('permissions')=='true'){
            $resource = $resource->withPermissions();
        }
        
        return $this->getItems($resource);
    }

    public function show($id)
    {
        $resource = Resource::find($id);
        if($resource){
            return Response::json($resource);
        } else {
            return Response::error(404, 'item not found');
        }
    }

    public function create(Request $request)
    {
        
    }

    public function update($id, Request $request)
    {
        
    }

    public function delete($id)
    {
        
    }
}
