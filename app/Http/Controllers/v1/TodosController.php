<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\CustomController;
use App\Providers\ResponseProvider as Response;
use Illuminate\Http\Request;
use App\Models\v1\Todo;
use App\Models\v1\User;
use Auth;

class TodosController extends CustomController
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

    public function index(Todo $todo, Request $request)
    {
        $todos = $todo->withStatus()->inOrder()->owned();
        return $this->getItems($todos);
    }

    public function listAll(Todo $todo, Request $request)
    {
        $todos = $todo->withStatus()->inOrder();
        return $this->getItems($todos);
    }

    public function show($id)
    {
        $todo = Todo::allowed()->find($id);
        if($todo ){
            return $todo;
        } else {
            return Response::error(404, 'Todo not found');
        }
    }

    public function create(Request $request)
    {
        try{
            $user_id = Auth::user()->id;

            $data = [];
            $data['name'] = $request->input('name');
            $data['description'] = $request->input('description');
            $data['status_id'] = $request->input('status');
            $data['user_id'] = $user_id;

            $todo = Todo::create($data);
            
            return Response::json($todo);

        } catch (\PDOException $e) {
            $message = $e->getMessage();
            if (strpos($message,'cannot be null')){
                return Response::error(400, 'missing fields');
            } else {
                return Response::error(400, $message);
            }
        } catch (\Exception $e) {
            return Response::error(400, $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try{
            $todo = Todo::allowed()->find($id);
            $todo->name = $request->input('name');
            $todo->description = $request->input('description'); 
            $todo->status_id = $request->input('status');
            $todo->save();
            return Response::json($todo);

        } catch (\PDOException $e) {
            return Response::error(400, $e->getMessage());
        } catch (\Exception $e) {
            return Response::error(404, 'Todo not found');
        }
    }

    public function delete($id)
    {
        try{
            $todo = Todo::owned()->find($id);
            if($todo){
                $todo->delete();
                return Response::data($todo);
            } else {
                return Response::error(404, 'Todo not found');
            }
        } catch (\Exception $e) {
            return Response::error(404, 'Todo not found');
        }
    }
}
