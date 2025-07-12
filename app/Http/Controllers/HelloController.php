<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function show () {
        $name = "<strong>Chữ in đậm</strong>";
        return view('Home',['name' => $name]);
        $hello;
    }
}
