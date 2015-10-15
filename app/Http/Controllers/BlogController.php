<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth, Flash, Input, Purifier;
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
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => ['create', 'edit', 'update', 'destroy']]);

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
            $where['category_id'] = Input::get('category_id');
            $assign['blogs'] = (new Blog)->getData(6, $where);
        } else {
            $assign['blogs'] = (new Blog)->getData(6);
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
        $request->merge([
            'body'  =>  Purifier::clean($request->input('body'), 'ugc'),
        ]);
        $this->validate($request, [
            'title'         =>  'required|max:60|min:4|unique:' . $this->Blog->getTable(),
            'body'          =>  'required|min:25',
            'category_id'   =>  'required|integer',
        ]);
        $this->Blog->title          =   $request->input('title');
        $this->Blog->category_id    =   $request->input('category_id');
        $this->Blog->body           =   $request->input('body');
        $this->Blog->type_id        =   Category::TYPE_BLOG;
        $this->Blog->user_id        =   Auth::user()->id;

        if ($this->Blog->save()) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('blog.show', ['id' => $this->Blog->id]);
        } else {
            Flash::error(trans('app.Operation failed'));
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
        // event view_count +1
        event(new \App\Events\ContentWasShow($assign['blog']));

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
    public function update($id, Request $request)
    {
        $request->merge([
            'body'  =>  Purifier::clean($request->input('body'), 'ugc'),
        ]);
        $this->validate($request, [
            'title'         =>  'required|max:60|min:4',
            'body'          =>  'required|min:25',
            'category_id'   =>  'required|integer',
        ]);
        $Blog = $this->Blog->findOrFail($id);
        $Blog->title        =   $request->input('title');
        $Blog->category_id  =   $request->input('category_id');
        $Blog->body         =   $request->input('body');

        if ($Blog->save()) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('blog.show', ['id' => $id]);
        } else {
            Flash::error(trans('app.Operation failed'));
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
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('blog.index');
        } else {
            Flash::error(trans('app.Operation failed'));
            return redirect()->back();
        }
    }
}
