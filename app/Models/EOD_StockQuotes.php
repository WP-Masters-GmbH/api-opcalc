<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EOD_StockQuotes extends Model
{
    use HasFactory;

    protected $table = 'eod_stock_quotes';

    /**
     * prepare Data for Beta Stocks Table
     */
    public static function prepareMarketData($rows)
    {
        // Prepare Symbols Data
        $symbols = [];
        foreach($rows as $row) {
            if(isset($symbols[$row['symbol']]['date']) && strtotime($symbols[$row['symbol']]['date']) < strtotime($row['date'])) {
                $symbols[$row['symbol']] = $row;
            } elseif(!isset($symbols[$row['symbol']]['date'])) {
                $symbols[$row['symbol']] = $row;
            }
        }

        return $symbols;
    }

    /**
     * Get Top sum openInt object
     */
    public static function getTopStrikeByOI($calls, $puts)
    {
        // Prepare Symbols Data
        $preparedData = [];
        foreach($calls as $index => $call_data) {
            if($call_data->optionRange == 'in') {
                $preparedData[] = [
                    'strike' => $call_data->strike,
                    'openInt' => $call_data->openInt + $puts[$index + 1]->openInt,
                    'expiry' => $call_data->expiration
                ];
            }
        }

        // Sort the array in descending order by openInt
        usort($preparedData, function($a, $b) {
            return $b['openInt'] <=> $a['openInt'];
        });

        return $preparedData[0];
    }

}
