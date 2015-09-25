<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Notice, App\Content;

class NoticeController extends Controller
{
    /**
     *
     */
    public $Notice;

    /**
     *
     */
    public function __construct(Notice $Notice)
    {
        $this->middleware('owner:Notice', ['except' => []]);
        $this->Notice = $Notice;
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
    public function show($id)
    {
        $Notice = $this->Notice->findOrFail($id);
        $Notice->is_checked = true;

        if (request()->ajax()) {
            if ($Notice->save()) {
                return $Notice;
            } else {
                abort(500);
            }
        } else {
            if ($Notice->save()) {
                // comment
                $route = (new Content)->getAppointRoute('show', $Notice->entity_id);
                $redirectUrl = route($route, $Notice->entity->entity_id) . '#section-comment-' . $Notice->entity->id;

                // reply
                if ($Notice->type_id == Notice::TYPE_REPLY_COMMENT) {
                    $route = (new Content)->getAppointRoute('show', $Notice->entity->entity->entity_id);
                    $redirectUrl = route($route, $Notice->entity->entity->entity_id);
                    $redirectUrl .= '#section-comment-' . $Notice->entity->entity->id;
                } else if ($Notice->type_id == Notice::TYPE_REPLY_CONTENT) {
                    $redirectUrl = route($route, $Notice->entity->entity_id) . '#section-content-replys';
                }
                return redirect()->to($redirectUrl);
            } else {
                return redirect()->back();
            }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
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
