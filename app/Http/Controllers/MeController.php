<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Storage, Auth;

class MeController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function anyIndex()
    {
        return view('me.index');
    }

    /**
     * Edit user profile
     *
     * @return Response
     */
    public function getProfile()
    {
        return view('me.profile');
    }

    /**
     * Edit user avatar
     *
     * @return Response
     */
    public function anyAvatar()
    {
        return view('me.avatar');
    }

    /**
     * Update user avatar
     *
     * @return Response
     */
    public function postUpdateAvatar(Request $request)
    {
        $avatar = $request->input('avatar');
        $avatar = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatar));
        $avatarPath = '/images/avatars/avatar-' . Auth::user()->id . '.jpg';
        Storage::disk('local')->put($avatarPath, $avatar);
        $User = Auth::user();
        $User->avatar = $avatarPath;
        if ($User->save()) {
            echo 'avatar updated successfully';
        } else {
            abort(500);
        }
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
        //
    }
}
