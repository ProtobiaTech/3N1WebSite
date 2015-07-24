<?php

namespace App\Http\Controllers;

use App\Category, App\Content;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Index page
     *
     * @return Response
     */
    public function index()
    {
        // Data excellent topic @todo
        $assign['topics'] = Content::limit(12)->topics()->get();
        return view('homes.index', $assign);
    }

}
