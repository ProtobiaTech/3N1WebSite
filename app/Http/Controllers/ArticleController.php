<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flash, Auth;
use App\Article, App\Category, App\User;

class ArticleController extends Controller
{
    /**
     * The Content instance
     *
     * @var \App\Content
     */
    public $Article;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Article $Article)
    {
        $this->Article = $Article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $assign['articles'] = $this->Article->articles()->get();
        return view('article.index', $assign);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $assign['categorys'] = (new Category)->getArticle4TopCategorys();
        return view('article.create', $assign);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->Article->title           =   $request->input('title');
        $this->Article->category_id     =   $request->input('category_id');
        $this->Article->body            =   $request->input('body');
        $this->Article->type_id         =   Category::TYPE_ARTICLE;
        $this->Article->user_id         =   Auth::user()->id;

        if ($this->Article->save()) {
            Flash::success('success');
            return redirect()->route('article.show', ['id' => $this->Article->id]);
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
        $assign['article'] = $this->Article->findOrFail($id);
        // view_count +1
        $assign['article']->timestamps = false;
        $assign['article']->view_count = $assign['article']->view_count + 1;
        $assign['article']->save();

        return view('article.show', $assign);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $assign['article'] = $this->Article->findOrFail($id);
        $assign['categorys'] = (new Category)->getArticle4TopCategorys();
        return view('article.edit', $assign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $Article = $this->Article->findOrFail($id);
        $Article->title           =   $request->input('title');
        $Article->category_id     =   $request->input('category_id');
        $Article->body            =   $request->input('body');
        $Article->type_id         =   Category::TYPE_ARTICLE;
        $Article->user_id         =   Auth::user()->id;

        if ($Article->save()) {
            Flash::success('success');
            return redirect()->route('article.show', ['id' => $this->Article->id]);
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
        $Article = $this->Article->findOrFail($id);
        if ($Article->delete()) {
            Flash::success('success');
            return redirect()->route('article.index');
        } else {
            Flash::error('error');
            return redirect()->back();
        }
    }
}
