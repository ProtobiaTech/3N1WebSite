<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OtherController extends Controller
{
    /**
     * Simditor upload img
     */
    public function simditorImgUpload(Request $request)
    {
        $file = $request->file('img')->move('simditor-upload', time() . str_random('12'));
        if ($file) {
            return [
                'success'       =>      true,
                'msg'           =>      'msg',
                'file_path'     =>      '/' . $file->getPathName(),
            ];

        }
    }
}
