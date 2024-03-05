<?php

namespace App\Services\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

/**
 * Option Chain Service.
 */
class OptionChainService
{
    /**
     * Get Information for current symbol.
     * It returns an array [$dates, $calls, $puts, $strikes, $startDate, $currentStockInfo].
     *
     * @param string $symbol Symbol for finding options.
     * @param string|null $date Date for filtering.
     * @return array|null Options.
     */
    public function getData(string $symbol, ?string $date): ?array
    {
        $symbolData = Redis::get("current_option_$symbol");

        $currentStockInfoRaw = Redis::get("current_stocks_info_$symbol");

        $currentStockInfo = json_decode($currentStockInfoRaw);

        if (empty($symbolData)) {
            return null;
        }

        $symbolCollection = collect(json_decode($symbolData)->option);

        $datesGrouped = $symbolCollection->groupBy('expiration');

        $dates = $this->parseDates($datesGrouped->keys(), $symbol);

        $startDate = !empty($date) ? $date : $datesGrouped->keys()[0];

        $calls = $symbolCollection->filter(function ($item) use ($startDate) {
            return $item->putCall === 'call' && $item->expiration === $startDate;
        });

        $puts = $symbolCollection->filter(function ($item) use ($startDate) {
            return $item->putCall === 'put' && $item->expiration === $startDate;
        });

        $strikes = $symbolCollection->map(function ($item) use ($startDate) {
            if ($item->expiration === $startDate) {
                return $item->strike;
            }
        })->unique()->values();

        return [$dates, $calls, $puts, $strikes, $startDate, $currentStockInfo];
    }

    /**
     * Format the start date from Y-m-d to M. d Y.
     *
     * @param string $dateString Date in the format Y-m-d.
     * @return void
     */
    public function getFormatedStartDate(string $dateString): string
    {
        $carbonDate = \Carbon\Carbon::createFromFormat('Y-m-d', $dateString);
        return $carbonDate->format('M. d Y');
    }

    /**
     * Return a collection with available dates.
     * Data format: [year] => [month => [...dates]]
     *
     * @param Collection $dates Dates Collection.
     * @return Collection Dates.
     */
    private function parseDates(Collection $dates, string $symbol): Collection
    {
        $dates = $dates->reduce(function ($carry, $date) use ($symbol) {
            $dateParts = explode('-', $date);
            $year = $dateParts[0];
            $month = Carbon::createFromFormat('m', $dateParts[1])->format('M');

            $carry[$year][$month][] = [
                'day' => (int)$dateParts[2],
                'date' => $date,
                'link' => route('option-chain-symbol', compact('symbol', 'date'))
            ];

            return $carry;
        }, []);

        return collect($dates);
    }

    /**
     * Return a random fact about options.
     *
     * @return string Random fact.
     */
    public function getRandomFact(): string
    {
        $facts = [
            'In 1992, Michael Jordan convinced Charles
            Barkley to take stock options into Nike (NKE),
            instead of cash only. Turns out, Mr. Barkley ended
            up making 10x more than what he would have. Now that is a GOAT move.',
            'QQQ & SPY now have daily expirations.',
            'In 2023, average daily trading volume for options grew 21% Year over Year.'
        ];

        return Arr::random($facts);
    }
}
