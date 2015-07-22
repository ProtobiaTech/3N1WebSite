<?php

namespace App\Http\Controllers;

use Auth, Input, Redirect, Flash;
use App\User, App\Topic, App\Category;

class TopicController extends Controller
{
    /**
     * The Content instance
     *
     * @var \App\Content
     */
    public $Topic;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Topic $Topic)
    {
        $this->middleware('auth', ['only' => ['create', 'store']]);
        $this->Topic = $Topic;
    }

    /**
     * Index Page
     *
     * @return Response
     */
    public function index()
    {
        $assign['topics'] = $this->Topic->getTopic(15);
        // categorys
        $assign['nodeCategorys'] = Category::where('parent_id', '=', '0')->get();
        return view('topics/index', $assign);
    }

    /**
     * Create Topic page
     *
     * @return Response
     */
    public function create()
    {
        $assign['nodeCategorys'] = with(new Category)->getTopic4TopCategorys();
        return view('topics/create', $assign);
    }

    /**
     * Store new Topic
     *
     * @return Response
     */
    public function store()
    {
        $this->Topic->title     =   Input::get('title');
        $this->Topic->body      =   Input::get('body');
        $this->Topic->type_id   =   Topic::TYPE_TOPIC;
        $this->Topic->user_id   =   Auth::user()->id;
        $this->Topic->category_id   =   Input::get('node_id');
        $this->Topic->last_comment_user_id  =    Auth::user()->id;

        if ($this->Topic->save()) {
            Flash::success('created new topic');
            return Redirect::to('/topic/' . $this->Topic->id);
        } else {
            return Redirect::back();
        }
    }

    /**
     * Show a Topic
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $assign['topic'] = $this->Topic->findOrFail($id);
        return view('topics/show', $assign);
    }

    /**
     * Edit a Topic
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update a Topic
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Delete a Topic
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
