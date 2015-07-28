<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flash;
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
        $this->Topic = $Topic->topics();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $assign['topics'] = $this->Topic->paginate(10);
        return view('admin.topic.index', $assign);
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
    public function store()
    {
        //
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
        $Topic = $this->Topic->findOrFail($id);
        if ($Topic->delete()) {
            Flash::success('success');
            return redirect()->back();
        } else {
            Flash::error('error');
            return redirect()->back();
        }
    }
}
