<?php

namespace App\Services\Commands\FindFreshStocks;

use GuzzleHttp\Client;

class FindFreshStocksService
{
    private const ROBINHOOD_URL = 'https://robinhood.com/us/en/stocks/';
    private const CNBC_URL = 'https://www.cnbc.com/quotes/';
    private const MARKET_WATCH = 'https://www.marketwatch.com/investing/stock/';
    private const GOOGLE = 'https://www.google.com/finance/quote/AAPL';


    public function __construct(public string $symbol, private Client $client = new Client())
    {
    }

    /**
     * Search information in GOOGLE.
     *
     * @return string
     */
    public function findInGoogle()
    {
        $additional_url = ':NASDAQ?sca_esv=597798541&output=search&source=lnms&sa=X&sqi=2&ved=2ahUKEwi80JGr9NeDAxWDS_EDHVpWB90Q0pQJegQIDRAB';

        $target_url = self::GOOGLE . $this->symbol . $additional_url;

        $response = $this->client->get($target_url);

        $html = $response->getBody()->getContents();

        return $this->symbol;
    }


     /**
     * Search information in Robinhood.
     *
     * @return string
     */
    public function findInRobinhood()
    {
        return $this->symbol;
    }

    /**
     * Search information in Robinhood.
     *
     * @return string
     */
    public function findInCnbc()
    {
        return $this->symbol;
    }


    /**
     * Search information in Market Watch.
     *
     * @return string
     */
    public function findInMarketWatch()
    {
        return $this->symbol;
    }
}
