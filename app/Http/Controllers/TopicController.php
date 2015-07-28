<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
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
        $this->Topic = $Topic->topics();
    }

    /**
     * Index Page
     *
     * @return Response
     */
    public function index()
    {
        $assign['topics'] = Topic::getTopic(15);
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
        // view_count +1
        $assign['topic']->timestamps = false;
        $assign['topic']->view_count = $assign['topic']->view_count + 1;
        $assign['topic']->save();

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
        $assign['topic'] = $this->Topic->findOrFail($id);
        $assign['nodeCategorys'] = with(new Category)->getTopic4TopCategorys();
        return view('topics.edit', $assign);
    }

    /**
     * Update a Topic
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $Topic = $this->Topic->find($id);
        $Topic->title       =   $request->input('title');
        $Topic->category_id =   $request->input('node_id');
        $Topic->body        =   $request->input('body');

        if ($Topic->save()) {
            Flash::success('success');
            return redirect()->route('topic.show', ['id' => $id]);
        } else {
            Flash::error('error');
            return redirect()->back();
        }

    }

    /**
     * Delete a Topic
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $Topic = $this->Topic->find($id);
        if ($Topic->delete()) {
            Flash::success('success');
            return redirect()->route('topic.index');
        } else {
            Flash::error('error');
            return redirect()->back();
        }
    }

}
