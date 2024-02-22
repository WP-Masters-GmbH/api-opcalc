<?php

namespace App\Services\Controllers\Front;

use Illuminate\Support\Facades\Redis;
use App\Collections\OptionChainsCollection;

class OptionChainsService
{
    public function getSymbolData(string $symbol): array|null
    {
        $response = Redis::get("laravel_database_current_option_$symbol");

        if (!empty($response)) {
            $optionData = (array)json_decode($response);

            $optionCollection = collect($optionData);

            $parsedCollection = $optionCollection->map(function (array $item) {
                return new OptionChainsCollection(
                    $item['dte'],
                    $item['expiration'],
                    $item['putCall'],
                    $item['volumet'],
                    $item['openInt'],
                    $item['strike'],
                    $item['price'],
                    $item['optionRaneg'],
                    $item['underlying']
                );
            });

            $calls = $parsedCollection->filter(function (OptionChainsCollection $item) {
                return $item->putCall === 'call';
            });

            $puts = $parsedCollection->filter(function (OptionChainsCollection $item) {
                return $item->putCall === 'put';
            });


            return compact('calls', 'puts');
        }

        return null;
    }
}
