<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPrice extends Model
{
    use HasFactory;

    protected $table = 'stock_quotes';

    /**
     * prepare Data for Beta Stocks Table
     */
    public static function prepareBetaStocksData($rows)
    {
        // Prepare Symbols Data
        $selected_symbols = [];
        $symbols = [];
        foreach($rows as $row) {
            $symbols[$row['symbol']][$row['quotedate']] = $row;

            uksort($symbols[$row['symbol']], function($a, $b) {
                return -strcmp($a, $b);
            });

            if(!in_array($row['symbol'], $selected_symbols)) {
                $selected_symbols[] = $row['symbol'];
            }
        }

        // Prepare data for table
        $table_data = [];
        foreach($symbols as $symbol => $symbol_items) {
            $table_data[$symbol] = array_values(array_slice($symbol_items, 0, 2));
            $one_year_ago = date('Y-m-d', strtotime('-1 year', strtotime($table_data[$symbol][0]['quotedate'])));
            $three_year_ago = date('Y-m-d', strtotime('-3 year', strtotime($table_data[$symbol][0]['quotedate'])));

            // Функция для поиска даты с учетом отклонения
            $findDate = function($symbol_items, $targetDate, $daysOffset) {
                for ($i = 0; $i <= $daysOffset; $i++) {
                    $checkDate = date('Y-m-d', strtotime("-$i days", strtotime($targetDate)));
                    if (isset($symbol_items[$checkDate])) {
                        return $symbol_items[$checkDate];
                    }
                }
                return 'none'; // If date not found
            };

            // Search 1 and 3 year
            $table_data[$symbol][] = $findDate($symbol_items, $one_year_ago, 3);
            $table_data[$symbol][] = $findDate($symbol_items, $three_year_ago, 3);
        }

        return $table_data;
    }
}
