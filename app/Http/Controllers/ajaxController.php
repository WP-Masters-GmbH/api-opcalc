<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ajaxController extends Controller
{
    /**
     * Calculation to get Charts
     */
    public function dcaCalculation(Request $request)
    {
        $start_month = $request->input('start_month');
        $start_year = $request->input('start_year');
        $end_month = $request->input('end_month');
        $end_year = $request->input('end_year');

        // Создаем объекты Carbon для начальной и конечной даты
        $start_date = Carbon::create($start_year, $start_month, 1);
        $end_date = Carbon::create($end_year, $end_month, 1)->endOfMonth();

        // Форматируем даты в нужный формат
        $total_range = $start_date->format('m/d/Y') . ' - ' . $end_date->format('m/d/Y');

        $post_data = [
            'form_params' => [
                'symbols' => [
                    $request->input('symbol')
                ],
                'selected_tab_mode' => 'equity',
                'selected_strategy' => 'Buy & Hold',
                'dates_range' => $total_range,
                'entry_position_size' => 'Dollar amount',
                'entry_position_size_value' => $request->input('monthly_investment'),
                'entry_criteria' => [
                    [
                        'position_criteria' => 'Every x amount of days',
                        'position_value' => 30
                    ]
                ],
                'initial_investment' => $request->input('initial_investment')
            ]
        ];

        $response = json_decode($this->sendRequest('https://optionscout.test-domain-wp.com/app/control/ajax/backtester.php', $post_data), true);

        // Возвращаем ответ
        return response()->json($response);
    }

    /**
     * Send request to API
     */
    public function sendRequest($url, $post_data)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, $post_data);
        $body = $response->getBody();
        $content = $body->getContents();

        return $content;
    }
}
