<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Main Blog page
     */
    public function index()
    {
        return view('pages.front.blog.index', [
            'title' => 'Blog'
        ]);
    }
}
