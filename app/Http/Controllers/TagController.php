<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    function show(){
        $data = Tag::all();
        return view('tag', ['tags'=>$data]);
    }
}
