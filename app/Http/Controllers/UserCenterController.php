<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Storage, Input, Auth;
use App\User, App\Notice;

class UserCenterController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
    public function show($id, Request $request)
    {
        $assign['user'] = User::findOrFail($id);
        if (Auth::check() && $id == Auth::user()->id) {
            // Notices
            if (!$request->has('notice') || $request->get('notice') === 'uncheck') {
                $assign['notices'] = Auth::user()->uncheckNotices;
                $assign['noticeType'] = 'uncheck';
            } else if ($request->get('notice') === 'checked') {
                $assign['notices'] = Auth::user()->checkedNotices;
                $assign['noticeType'] = 'checked';
            } else if ($request->get('notice') === 'all') {
                $assign['notices'] = Auth::user()->allNotices;
                $assign['noticeType'] = 'All';
            }

            return view('uc.show-me', $assign);
        } else {
            return view('uc.show-user', $assign);
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
        if ($id == Auth::user()->id) {
            $assign['user'] = User::findOrFail($id);
            return view('uc.edit', $assign);
        }
    }

    /**
     * Edit the avatar
     *
     * @return Response
     */
    public function editAvatar()
    {
        if (Input::get('id') == Auth::user()->id) {
            $assign['user'] = User::findOrFail(Input::get('id'));
            return view('uc.edit-avatar', $assign);
        } else {
             return redirect()->route('uc.edit-avatar', ['id' => Auth::user()->id]);
        }
    }

    /**
     * Update the avatar
     *
     * @return Response
     */
    public function updateAvatar(Request $request)
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
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
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
