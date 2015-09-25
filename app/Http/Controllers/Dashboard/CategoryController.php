<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flash, Input;
use App\User, App\Topic, App\Category;

class CategoryController extends Controller
{
    /**
     * The Category instance
     *
     * @var \App\Category
     */
    public $Category;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $Category)
    {
        $this->Category = $Category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!Input::has('typeId')) {
            return redirect()->route('dashboard.category.index', ['typeId' => 1]);
        }
        $typeId = Input::get('typeId');

        $assign['categorys'] = $this->Category->whereRaw('parent_id = 0 and type_id = ' . $typeId)->orderByRaw('weight asc, id asc')->get();
        return view('dashboard.category.index', $assign);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $typeId = Input::get('typeId');

        $assign['types'][0]['id'] = $typeId;
        switch ($typeId) {
            case Category::TYPE_TOPIC:
                $assign['types'][0]['name'] = trans('app.Topic');
                break;
            case Category::TYPE_BLOG:
                $assign['types'][0]['name'] = trans('app.Blog');
                break;
            case Category::TYPE_ARTICLE:
                $assign['types'][0]['name'] = trans('app.Article');
                break;
        }

        if ($typeId == Category::TYPE_TOPIC) {
            $assign['categorys'] = $this->Category->getTopic4TopCategorys();
            return view('dashboard.category.create-topic', $assign);
        } else {
            return view('dashboard.category.create', $assign);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if ($Category = $this->Category->create($request->all())) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('dashboard.category.index', ['typeId' => $Category->type_id]);
        } else {
            Flash::error(trans('app.Operation failed'));
            return redirect()->back()->withInput($request->all());
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
        $Category = $this->Category->findOrFail($id);
        $assign['category'] = $Category;
        $assign['types'][0]['id'] = $Category->id;
        switch ($Category->type_id) {
            case Category::TYPE_TOPIC:
                $assign['types'][0]['name'] = trans('app.Topic');
                break;
            case Category::TYPE_BLOG:
                $assign['types'][0]['name'] = trans('app.Blog');
                break;
            case Category::TYPE_ARTICLE:
                $assign['types'][0]['name'] = trans('app.Article');
                break;
        }

        return view('dashboard.category.edit', $assign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $Category = $this->Category->findOrFail($id);
        $Category->name = $request->get('name');
        $Category->description = $request->get('description');

        if ($Category->save()) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('dashboard.category.index', ['typeId' => $Category->type_id]);
        } else {
            Flash::error(trans('app.Operation failed'));
            return redirect()->back()->withInput($request->all());
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
        $Category = $this->Category->findOrFail($id);

        // Determine whether the deleted
        if ($Category->childCategorys->toArray() or $Category->contents->toArray()) {
            Flash::error(trans('category.Can not be deleted this category because of the associated content or sub-categories'));
            return redirect()->back();
        } else {
            if ($Category->delete()) {
                Flash::success(trans('app.Successful operation'));
                return redirect()->back();
            } else {
                Flash::error(trans('app.Operation failed'));
                return redirect()->back();
            }
        }
    }

    /**
     * The order page
     */
    public function order()
    {
        $Category = $this->Category->findOrFail(Input::get('id'));
        if ($Category->parent_id == 0) {
            $assign['categorys'] = $this->Category->orderBy('weight', 'asc')->whereRaw('parent_id = 0 and type_id = ' . $Category->type_id )->get();
        } else {
            $assign['categorys'] = $this->Category->orderBy('weight', 'asc')->where('parent_id', '=', $Category->parent_id )->get();
        }

        return view('dashboard.category.order', $assign);
    }

    /**
     * Handle order
     */
    public function orderHandle()
    {
        $datas = Input::except('_token');
        foreach ($datas as $id => $weight) {
            $this->Category->findOrFail($id)->update(['weight' => $weight]);
        }

        Flash::info('app.Operation complete');
        return redirect()->back();
    }
}
