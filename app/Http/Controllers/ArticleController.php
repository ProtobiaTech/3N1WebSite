<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flash, Auth, Purifier;
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
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => ['create', 'edit', 'update', 'destroy']]);

        $this->Article = $Article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $assign['articles'] = $this->Article->getHotContents(8);
        $assign['categorys'] = (new Category)->getArticle4TopCategorys(4);
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createTarget()
    {
        $assign['articles'] = $this->Article->getHotContents(8);
        $assign['categorys'] = (new Category)->getArticle4TopCategorys(4);
        $assign['targetType'] = [
            'iframe'    =>      Article::TYPE_TARGET_IFRAME,
            'origin'    =>      Article::TYPE_TARGET_ORIGIN,
        ];
        return view('article.create-target', $assign);
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
            'title'         =>  'required|max:60|min:4|unique:' . $this->Article->getTable(),
            'body'          =>  'required|min:25',
            'category_id'   =>  'required|integer',
        ]);
        $this->Article->title           =   $request->input('title');
        $this->Article->category_id     =   $request->input('category_id');
        $this->Article->body            =   $request->input('body');
        $this->Article->type_id         =   Category::TYPE_ARTICLE;
        $this->Article->user_id         =   Auth::user()->id;

        if ($this->Article->save()) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('article.show', ['id' => $this->Article->id]);
        } else {
            Flash::error(trans('app.Operation failed'));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeTarget(Request $request)
    {
        $this->validate($request, [
            'title'         =>  'required|max:60|min:4|unique:' . $this->Article->getTable(),
            'category_id'   =>  'required|integer',
            'href'          =>  'required|min:3',
            'target_type'   =>  'required|integer',
        ]);

        $this->Article->title           =   $request->input('title');
        $this->Article->category_id     =   $request->input('category_id');
        $this->Article->type_id         =   Category::TYPE_ARTICLE;
        $this->Article->user_id         =   Auth::user()->id;
        $this->Article->href            =   $request->get('href');
        $this->Article->target_type     =   $request->get('target_type');

        if ($this->Article->save()) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('article.index');
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
        $assign['article'] = $this->Article->findOrFail($id);
        if ($assign['article']->target_type) {
            return $this->showTarget($assign['article']);
        }

        // event view_count +1
        event(new \App\Events\ContentWasShow($assign['article']));

        return view('article.show', $assign);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showTarget($article)
    {
        $href = $article->href;
        if (substr($article->href, 0, 7) !== 'http://') {
            $href = 'http://' . $href;
        }

        if ($article->target_type == Article::TYPE_TARGET_ORIGIN) {
            return redirect()->to($href);
        } else if ($article->target_type == Article::TYPE_TARGET_IFRAME) {
            $article->href = $href;
            $siteName = \App\System::getSystemDatas()->site_name;
            return view('layouts.frame', ['content' => $article, 'siteName' => $siteName]);
        }
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
        $request->merge([
            'body'  =>  Purifier::clean($request->input('body'), 'ugc'),
        ]);
        $this->validate($request, [
            'title'         =>  'required|max:60|min:4',
            'body'          =>  'required|min:25',
            'category_id'   =>  'required|integer',
        ]);
        $Article = $this->Article->findOrFail($id);
        $Article->title           =   $request->input('title');
        $Article->category_id     =   $request->input('category_id');
        $Article->body            =   $request->input('body');
        $Article->type_id         =   Category::TYPE_ARTICLE;
        $Article->user_id         =   Auth::user()->id;

        if ($Article->save()) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('article.show', ['id' => $id]);
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
        $Article = $this->Article->findOrFail($id);
        if ($Article->delete()) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('article.index');
        } else {
            Flash::error(trans('app.Operation failed'));
            return redirect()->back();
        }
    }
}
