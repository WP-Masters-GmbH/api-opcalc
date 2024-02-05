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

    /**
     * Option Pin Theory Page
     */
    public function optionPinningStrategy()
    {
        return view('pages.front.option-pinning-strategy', [
            'title' => 'Option Pin Theory'
        ]);
    }
}
