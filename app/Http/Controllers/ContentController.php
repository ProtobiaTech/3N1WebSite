<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth, Flash;
use App\User, App\ContentVote, App\Content;

class ContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * The content vote
     *
     * @param string $contentId
     * @param string $voteType
     * @param string $route
     *
     * @return Response
     */
    public function getVote($contentId, $voteType, $route)
    //public function getVote($contentId, $value, $route)
    {
        $Content = Content::findOrFail($contentId);
        $ContentVote = (new ContentVote)->where(['entity_Id' => $contentId, 'user_id' => Auth::user()->id])->first();

        //
        if ($voteType === 'vote_up') {
            if ($ContentVote) {
                if ($ContentVote->value !== ContentVote::VALUE_UP) {
                    $ContentVote->value = ContentVote::VALUE_UP;
                    $ret = $ContentVote->save();
                    event(new \App\Events\ContentWasVote($Content, 'vote_up_changed'));
                }
            } else {
                $ContentVote = (new ContentVote);
                $ContentVote->user_id = Auth::user()->id;
                $ContentVote->entity_id = $contentId;
                $ContentVote->value = ContentVote::VALUE_UP;
                $ret = $ContentVote->save();
                event(new \App\Events\ContentWasVote($Content, 'vote_up'));
            }

        //
        } else if ($voteType === 'vote_up_cancel') {
            $ret = $ContentVote->delete();
            event(new \App\Events\ContentWasVote($Content, 'vote_up_cancel'));

        //
        } else if ($voteType === 'vote_down') {
            if ($ContentVote) {
                if ($ContentVote->value !== ContentVote::VALUE_DOWN) {
                    $ContentVote->value = ContentVote::VALUE_DOWN;
                    $ret = $ContentVote->save();
                    event(new \App\Events\ContentWasVote($Content, 'vote_down_changed'));
                }
            } else {
                $ContentVote = (new ContentVote);
                $ContentVote->user_id = Auth::user()->id;
                $ContentVote->entity_id = $contentId;
                $ContentVote->value = ContentVote::VALUE_DOWN;
                $ret = $ContentVote->save();
                event(new \App\Events\ContentWasVote($Content, 'vote_down'));
            }

        //
        } else if ($voteType === 'vote_down_cancel') {
            $ret = $ContentVote->delete();
            event(new \App\Events\ContentWasVote($Content, 'vote_down_cancel'));
        }

        if (isset($ret) && $ret) {
            Flash::success(trans('app.Successful operation'));
            return redirect()->route($route, ['id' => $contentId]);
        } else {
            Flash::error(trans('app.Operation failed'));
            return redirect()->route($route, ['id' => $contentId]);
        }
    }
}
