<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth, Flash, Input;

use App\Blog, App\Category;

class BlogController extends Controller
{
    /**
     * The Content instance
     *
     * @var \App\Content
     */
    public $Blog;

    /**
     * The Content query builder
     *
     * @var Illuminate\Database\Query\Builder
     */
    public $Blogs;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Blog $Blog)
    {
        $this->Blog = $Blog;
        $this->Blogs = $Blog->blogs();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Input::has('category_id')) {
            $assign['blogs'] = $this->Blog->blogs()->where('category_id', '=', Input::get('category_id'))->paginate(6);
        } else {
            $assign['blogs'] = $this->Blog->blogs()->paginate(6);
        }
        return view('blog.index', $assign);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $assign['categorys'] = (new Category)->getBlog4TopCategorys();
        return view('blog.create', $assign);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->Blog->title          =   $request->input('title');
        $this->Blog->category_id    =   $request->input('category_id');
        $this->Blog->body           =   $request->input('body');
        $this->Blog->type_id        =   Category::TYPE_BLOG;
        $this->Blog->user_id        =   Auth::user()->id;

        if ($this->Blog->save()) {
            Flash::success('success');
            return redirect()->route('blog.index');
        } else {
            Flash::error('error');
            return redirect()->back();
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
        $assign['blog'] = $this->Blog->findOrFail($id);
        // view_count +1
        $assign['blog']->timestamps = false;
        $assign['blog']->view_count = $assign['blog']->view_count + 1;
        $assign['blog']->save();

        return view('blog.show', $assign);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $assign['blog'] = $this->Blog->findOrFail($id);
        $assign['categorys'] = (new Category)->getBlog4TopCategorys();
        return view('blog.edit', $assign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, $request)
    {
        $Blog = $this->Blog->findOrFail($id);
        $Blog->title        =   $request->input('title');
        $Blog->category_id  =   $request->input('category_id');
        $Blog->body         =   $request->input('body');

        if ($this->Blog->save()) {
            Flash::success('success');
            return redirect()->route('blog.show', ['id' => $id]);
        } else {
            Flash::error('error');
            return redirect()->back();
        }
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
        if ($Blog->delete()) {
            Flash::success('success');
            return redirect()->route('blog.index');
        } else {
            Flash::error('error');
            return redirect()->back();
        }
    }
}
