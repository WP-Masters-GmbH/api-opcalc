<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ajaxController extends Controller
{
    public function dcaCalculation(Request $request)
    {

        // Возвращаем ответ
        return response()->json([
            'list_items' => view('ajax.dcaCalculator', [
                'final_data' => [],
                'under_charts' => []
            ])->render()
        ]);
    }
}
