<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class KeyGenerator extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function key()
    {
        return Str::random(32);
    }

    //
}
