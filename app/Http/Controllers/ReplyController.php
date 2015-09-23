<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth, Flash;
use App\Reply, App\Content;

class ReplyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => ['create', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('body-reply')) {
            $request->merge(['body-reply' => $request->get('body-reply')]);
        } else {
            $name = 'body-reply-comment' . $request->entity_id;
            $request->merge(['body-reply' => $request->get($name)]);
        }

        // @todo form validate
        $this->validate($request, [
            'content_id'    =>  'required|integer',
            'entity_id'     =>  'required|integer',
            'entity_type'   =>  'in:content,comment|string',
            'body-reply'          =>  'required|min:1',
        ]);

        $Reply = new Reply;

        $Reply->user_id = Auth::user()->id;
        $Reply->entity_id = $request->get('entity_id');
        $Reply->body = $request->get('body-reply');
        // type_id
        if ($request->get('entity_type') === 'content') {
            $Reply->type_id = Reply::TYPE_CONTENT;
        } else if ($request->get('entity_type') === 'comment') {
            $Reply->type_id = Reply::TYPE_COMMENT;
        }

        if ($Reply->save()) {
            Flash::success(trans('app.Successful operation'));
            $route = (new Content)->getAppointRoute('show', $request->get('content_id'));
            return redirect()->route($route, ['id' => $request->get('content_id')]);
        } else {
            Flash::error(trans('app.Operation failed'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
