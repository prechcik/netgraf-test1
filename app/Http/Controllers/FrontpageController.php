<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;

class FrontpageController extends Controller
{
    public function show() {
        $d = (new APIController)->get(1);

        return view('welcome', [
            'data' => $d
        ]);
    }
}
