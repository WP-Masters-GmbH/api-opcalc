<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Main Page
     */
    public function index()
    {
        return view('welcome');
    }
}
