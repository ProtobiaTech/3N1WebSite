<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Auth, Flash;
use App\User, App\Category, App\Topic, App\Comment;

class ReplyController extends Controller
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
        $this->Comment->body        =   $request->input('body');
        $this->Comment->user_id     =   Auth::user()->id;
        $this->Comment->type_id     =   Comment::TYPE_TOPIC;
        $this->Comment->entity_id   =   $request->input('topic_id');

        if ($this->Comment->save()) {
            $this->Comment->entity->commentCountAddOne();
            Flash::success('reply success');
            return redirect()->to('/topic/' . $this->Comment->entity_id);
        } else {
            Flash::error('reply error');
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
        //
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
