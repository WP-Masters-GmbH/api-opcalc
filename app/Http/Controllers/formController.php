<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class formController extends Controller
{
    /**
     * Redirect to Chain Symbol
     */
    public function searchChainSymbol(Request $request)
    {
        $symbol = $request->input('symbol');

        // Redirect to the 'option-chain-symbol' route with the symbol parameter
        return redirect()->route('option-chain-symbol', [
            'symbol' => $symbol
        ]);
    }
}
