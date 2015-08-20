<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;

use App\System;

class SystemController extends Controller
{
    /**
     * The System instance
     *
     * @var \App\System
     */
    public $System;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(System $System)
    {
        $this->System = $System;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $assign['system'] = $this->System->findOrFail(1);
        return view('dashboard.system.index', $assign);
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
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
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
        $id = 1;
        $assign['system'] = $this->System->findOrFail($id);
        return view('dashboard.system.edit', $assign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $System = $this->System->findOrFail($id);
        if ($System->update($request->except(['_token', '_method']))) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route('dashboard.system.edit', $id);
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
        //
    }
}
