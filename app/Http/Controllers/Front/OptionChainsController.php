<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class OptionChainsController extends Controller
{
    public function __invoke()
    {
        $title = 'Options Chains';

        $facts = [' Fun fact: In 1992, Michael Jordan convinced Charles Barkley to take stock options into Nike (NKE), instead of cash only. Turns out, Mr. Barkley ended up making 10x more than what he would have. Now that is a GOAT move', 'QQQ & SPY now have daily expirations.', 'In 2023, average daily trading volume for options grew 21% Year over Year.'];

        $randomFact = Arr::random($facts);

        return view('pages.front.option-change.index', compact('title', 'randomFact'));
    }
}
