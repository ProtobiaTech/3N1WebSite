<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flash;
use App\User, App\Blog, App\Category;

class BlogController extends Controller
{
    /**
     * The Content instance
     *
     * @var \App\Content
     */
    public $Blog;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Blog $Blog)
    {
        $this->Blog = $Blog->blogs();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $assign['blogs'] = $this->Blog->paginate(10);
        return view('admin.blog.index', $assign);
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
        $Blog = $this->Blog->findOrFail($id);
        if ($Blog->delete($id)) {
            Flash::success('success');
            return redirect()->back();
        } else {
            Flash::error('error');
            return redirect()->back();
        }
    }
}
