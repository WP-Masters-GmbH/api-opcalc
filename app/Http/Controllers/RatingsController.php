<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingsController extends Controller
{
    /**
     * Ratings Page.
     */
    public function getRating(Request $request)
    {
        $symbol = $request->route('symbol');
        $symbol = mb_strtoupper($symbol);
        $title = "Rating for $symbol";

        if (!$symbol) {
            abort(404);
        }

        return view('pages.front.ratings.index', compact('title', 'symbol'));
    }
}
