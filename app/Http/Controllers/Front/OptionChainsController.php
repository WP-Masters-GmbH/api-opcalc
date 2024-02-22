<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Services\Controllers\Front\OptionChainsService;
use Illuminate\Support\Facades\Request;

class OptionChainsController extends Controller
{
    private ?OptionChainsService $service;

    public function __construct(OptionChainsService $optionChainsService)
    {
        $this->service = $optionChainsService;
    }

    public function __invoke(string $slug)
    {
        $options = $this->service->getSymbolData($slug);

        if (empty($options)) {
            abort(404);
        }

        $title = 'Options Chains';

        $facts = ['In 1992, Michael Jordan convinced Charles Barkley to take stock options into Nike (NKE), instead of cash only. Turns out, Mr. Barkley ended up making 10x more than what he would have. Now that is a GOAT move', 'QQQ & SPY now have daily expirations.', 'In 2023, average daily trading volume for options grew 21% Year over Year.'];

        $randomFact = Arr::random($facts);

        return view('pages.front.option-change.index', compact('title', 'randomFact', 'options', 'slug'));
    }
}
