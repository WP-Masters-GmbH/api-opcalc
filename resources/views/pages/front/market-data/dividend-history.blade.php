<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Market Data, financial tools, and resources</h1>
            <p>Cultivating Financial Empowerment: OpCalc's Comprehensive Hub for Stock and Options Trading Resources, Tools, and Data</p>
            <div class="list-links">
                <h2>Free financial tools</h2>
                <ul>
                    <li><a href="https://www.optionsprofitcalculator.com" target="_blank">Options Profit Calculator</a></li>
                    <li><a href="{{ route('dollar-cost-averaging-calculator') }}">DCA (Dollar Cost Averaging Calculator)</a></li>
                    <li><a href="{{ route('earnings-simulator') }}">Earning simulator</a></li>
                </ul>
            </div>

            <div class="list-links">
                <h2>Options Data</h2>
                <ul>
                    <li><a href="{{ route('highest-iv-options') }}">Highest IV Option contracts</a></li>
                    <li><a href="{{ route('highest-volume-options') }}">Highest Volume Option contracts</a></li>
                    <li><a href="{{ route('lowest-iv-options') }}">Lowest IV Option contracts</a></li>
                    <li><a href="{{ route('lowest-volume-options') }}">Lowest Volume Option contracts</a></li>
                    <li><a href="{{ route('option-pinning-strategy') }}">Option Pin Theory</a></li>
                    <li><a href="{{ route('eod-option-chains', ['AA', date('Y-m-d')]) }}">EOD option prices</a></li>
                    <li><a href="{{ route('all-usa-stocks') }}">List of all stocks with tradable options</a></li>
                </ul>
            </div>

            <div class="list-links">
                <h2>Stocks Data</h2>
                <ul>
                    <li><a href="{{ route('stocks-by-market-cap') }}">Stocks listed by MarketCap</a></li>
                    <li><a href="{{ route('highest-beta-stocks') }}">Highest Beta Stocks</a></li>
                    <li><a href="{{ route('lowest-beta-stocks') }}">Lowest Beta stocks</a></li>
                    <li><a href="{{ route('eod-stock-prices', ['AA', date('Y-m-d')]) }}">EOD stock data</a></li>
                </ul>
            </div>

            <div class="list-links">
                <h2>Dividend Data</h2>
                <ul>
                    <li><a href="{{ route('dividend-history', ['AA']) }}">Dividend History</a></li>
                    <li><a href="{{ route('highest-dividend-yield-stocks') }}">Stocks with highest dividend yield</a></li>
                    <li><a href="{{ route('upcoming-ex-dividend-dates') }}">Upcoming ex-dividend dates</a></li>
                    <li><a href="{{ route('monthly-dividend-stocks') }}">Stocks with monthly dividends</a></li>
                    <li><a href="{{ route('blog') }}">Our Blog</a></li>
                </ul>
            </div>

            <div class="list-links">
                <h2>Ratings & Analysts predictions</h2>
                <ul>
                    <li><a href="{{ route('rating-analysts-prediction', ['AA']) }}">Stock Analysts Estimates, Ratings and Price Targets</a></li>
                </ul>
            </div>
        </section>
    </main>
</x-front.layout>
