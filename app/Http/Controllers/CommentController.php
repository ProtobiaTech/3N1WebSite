<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Flash, Purifier;
use App\User, App\Category, App\Content, App\Topic, App\Comment;

class CommentController extends Controller
{
    /**
     * The Comment instance
     *
     * @var \App\Comment
     */
    public $Comment;

    /**
     *
     */
    public function __construct(Comment $Comment)
    {
        $this->middleware('auth', ['only' => ['create', 'store']]);
        $this->Comment = $Comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return redirect()->route('topic.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'body'  =>  Purifier::clean($request->input('body'), 'ugc'),
        ]);
        // validate
        $this->validate($request, [
            'entity_id' =>  ['required', 'integer'],
            'body'      =>  ['required', 'min:25'],
        ]);

        $Entity = Content::findOrFail($request->id);

        $this->Comment->body        =   $request->input('body');
        $this->Comment->user_id     =   Auth::user()->id;
        $this->Comment->type_id     =   $Entity->type_id;
        $this->Comment->entity_id   =   $request->input('entity_id');

        if ($this->Comment->save()) {
            event(new \App\Events\ContentWasCommented($this->Comment));
            Flash::success(trans('app.Successful operation'));
            return redirect()->back();
        } else {
            Flash::error(trans('app.Operation failed'));
            $request->flash();
            return redirect()->back()->withErrors($this->Comment->validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $Comment = Comment::findOrFail($id);
        $Content = $Comment->entity;
        $route = route($Content->getAppointRoute('show'), $Content->id) . '#section-comment-' . $Comment->id;

        return redirect()->to($route);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
