<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\CustomController;
use App\Providers\ResponseProvider as Response;
use Illuminate\Http\Request;
use App\Models\v1\Status;
use App\Models\v1\User;

class StatusController extends CustomController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $user;
    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        parent::__construct($request);
    }

    public function index(Status $status, Request $request)
    {
        return $this->getItems($status->inOrder());
    }

    public function show($id)
    {
        $status = Status::find($id);
        if($status){
            return Response::json($status);
        } else {
            return Response::error(404, 'Status not found');
        }
    }
}
