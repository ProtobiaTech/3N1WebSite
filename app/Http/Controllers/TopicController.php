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
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => ['edit', 'update', 'destroy']]);

        $this->Topic = $Topic;
        $this->Topics = $Topic->topics();
    }

    /**
     * Index Page
     *
     * @return Response
     */
    public function index()
    {
        $assign['topics'] = (new Topic)->getTopic(15);
        $assign['categorys'] = (new Category)->getTopic4TopCategorys();
        return view('topic/index', $assign);
    }

    /**
     * Create Topic page
     *
     * @return Response
     */
    public function create()
    {
        $assign['nodeCategorys'] = with(new Category)->getTopic4TopCategorys();
        return view('topic/create', $assign);
    }

    /**
     * Store new Topic
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         =>  'required|max:255|min:4|unique:' . $this->Topic->getTable(),
            'body'          =>  'required|min:25',
            'category_id'   =>  'required|integer',
        ]);
        $this->Topic->title     =   Input::get('title');
        $this->Topic->body      =   Input::get('body');
        $this->Topic->type_id   =   Topic::TYPE_TOPIC;
        $this->Topic->user_id   =   Auth::user()->id;
        $this->Topic->category_id   =   Input::get('category_id');
        $this->Topic->last_comment_user_id  =    Auth::user()->id;

        if ($this->Topic->save()) {
            Flash::success(trans('app.Successful operation'));
            return Redirect::to('/topic/' . $this->Topic->id);
        } else {
            Flash::error(trans('app.Operation failed'));
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
        // event view_count +1
        event(new \App\Events\ContentWasShow($assign['topic']));

        return view('topic/show', $assign);
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
        if (!is_null(old('title'))) $assign['topic']->title = old('title');
        if (!is_null(old('body'))) $assign['topic']->body = old('body');
        if (!is_null(old('category_id'))) $assign['topic']->category_id = old('category_id');

        $assign['nodeCategorys'] = with(new Category)->getTopic4TopCategorys();
        return view('topic.edit', $assign);
    }

    /**
     * Update a Topic
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title'         =>  'required|max:255|min:4',
            'body'          =>  'required|min:25',
            'node_id'       =>  'required|integer',
        ]);

        $Topic = $this->Topic->findOrFail($id);
        $Topic->title       =   $request->input('title');
        $Topic->category_id =   $request->input('node_id');
        $Topic->body        =   $request->input('body');

        if ($Topic->save()) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('topic.show', ['id' => $id]);
        } else {
            Flash::error(trans('app.Operation failed'));
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
        $Topic = $this->Topic->findOrFail($id);
        if ($Topic->delete()) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('topic.index');
        } else {
            Flash::error(trans('app.Operation failed'));
            return redirect()->back();
        }
    }

}
