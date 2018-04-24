<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\CustomController;
use App\Providers\ResponseProvider as Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\v1\User;

class UsersController extends CustomController
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

    public function index(User $user, Request $request)
    {
        if($request->input('includeType')=='true'){
            $user = $user->withUserType();
        }
        
        return $this->getItems($user);
    }

    public function show($id)
    {
        $User = new User();
        $user = $User->withUserType()->find($id);
        if($user){
            return $user;
        } else {
            return Response::error(404, 'user not found');
        }
    }

    public function create(Request $request)
    {
        try{
            $user_data = [];
            $user_data['email'] = $request->input('email');
            $user_data['username'] = $request->input('email');
            $user_data['name'] = $request->input('name');
            $user_data['password'] = Hash::make($request->input('password'));
            $user_data['user_type_id'] = $request->input('type') ? $request->input('type') : 4;
            $user = User::create($user_data);
            
            return Response::json($user);

        } catch (\PDOException $e) {
            $message = $e->getMessage();
            if(strpos($message,'email_unique')){
                return Response::error(400, 'email is taken');
            } else if (strpos($message,'username_unique')){
                return Response::error(400, 'username is taken');
            } else {
                return Response::error(400, $message);
            }
        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 400);
        }
    }

    public function update($id, Request $request)
    {
        try{
            $user = User::find($id);

            $user->email = $this->valueOrDefault($request->input('email'), $user->email);
            $user->username = $this->valueOrDefault($request->input('email'), $user->email);
            $user->name = $this->valueOrDefault($request->input('name'), $user->name);
            
            $user->save();
            
            return Response::json($user);

        } catch (\PDOException $e) {
            $message = $e->getMessage();
            if(strpos($message,'unique_email')){
                return Response::error(400, 'email is taken');
            } else if (strpos($message,'unique_username')){
                return Response::error(400, 'username is taken');
            } else {
                return Response::error(400, $message);
            }
        } catch (\Exception $e) {
            // DB::rollback();
            return Response::json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete($id)
    {
        try{
            $user = User::find($id);
            if($user){
                $user->delete();
                return Response::data('true');
            } else {
                return Response::error(404, 'user not found');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function signup(Request $request)
    {
        // Simulate a registered code for the event
        $validCode = 'angular5';

        if($request->input('code') !== $validCode) {
            return Response::json(['error' => 'invalid invitation code'], 400);
        }

        try{
            if($request->input('password') === null) {
                abort(400, 'password cannot be null');
            }

            $user_data = [];
            $user_data['email'] = $request->input('email');
            $user_data['username'] = $request->input('email');
            $user_data['name'] = $request->input('name');
            $user_data['password'] = Hash::make($request->input('password'));
            $user_data['user_type_id'] = 4;
            $user_data['status'] = 2;
            $user = User::create($user_data);
            
            return $user;

        } catch (\PDOException $e) {
            $message = $e->getMessage();
            if(strpos($message,'email_unique')){
                return Response::error(400, 'email is taken');
            } else if (strpos($message,'username_unique')){
                return Response::error(400, 'username is taken');
            } else if (strpos($message,'cannot be nulls')){
                return Response::error(400, 'missing fields');
            } else {
                return Response::error(400, $message);
            }
        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 400);
        }
    }
}
