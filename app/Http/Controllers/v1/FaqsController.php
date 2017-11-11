<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\CustomController;
use App\Providers\ResponseProvider as Response;
use Illuminate\Http\Request;
use App\Models\v1\Faq;
use App\Models\v1\User;

class FaqsController extends CustomController
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

    public function index(Faq $faq, Request $request)
    {
        return $this->getItems($faq->inOrder());
    }

    public function show($id)
    {
        $faq = Faq::find($id);
        if($faq){
            return Response::json($faq);
        } else {
            return Response::error(404, 'faq not found');
        }
    }

    public function create(Request $request)
    {
        try{
            $data = [];
            $data['faq'] = $request->input('faq');
            $data['answer'] = $request->input('answer');
            $data['position'] = Faq::count() + 1;

            $faq = Faq::create($data);
            
            return Response::json($faq);

        } catch (\PDOException $e) {
            return Response::error(400, $e->getMessage());
        } catch (\Exception $e) {
            return Response::error(400, $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try{
            $faq = Faq::find($id);
            $faq->faq = $request->input('faq');
            $faq->answer = $request->input('answer'); 
            $faq->save();
            return Response::json($faq);

        } catch (\PDOException $e) {
            return Response::error(400, $e->getMessage());
        } catch (\Exception $e) {
            return Response::error(404, 'faq not found');
        }
    }

    public function delete($id)
    {
        try{
            $faq = Faq::find($id);
            if($faq){

                $faqs = Faq::where('position', '>', $faq->position)->decrement('position');

                $faq->delete();

                return Response::data($faq);
            } else {
                return Response::error(404, 'faq not found');
            }
        } catch (\Exception $e) {
            return Response::error(404, 'faq not found');
        }
    }

    public function reorganize($id, Request $request)
    {
        try{
            $faq = Faq::find($id);
            $previous = $faq->position;
            $new = $request->input('position');

            if($new > Faq::count()) {
                return Response::error(400, 'invalid position');
            }

            if($new < $previous) {
                $faqs = Faq::where([
                        ['position', '>=', $new],
                        ['position', '<', $previous],
                    ])->increment('position');
            } else {
                $faqs = Faq::where([
                        ['position', '<=', $new],
                        ['position', '>', $previous],
                    ])->decrement('position');
            }

            $faq->position = $new;
            $faq->save();
            return Response::json($faq);

        } catch (\PDOException $e) {
            return Response::error(400, $e->getMessage());
        } catch (\Exception $e) {
            return Response::error(404, 'faq not found');
        }
    }  
}
