<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Dollar Cost Averaging Calculator for Stocks</h1>
            <p>Amplify Your Portfolio: Embrace Next-Gen Investing with Our Dynamic Dollar Cost Averaging Calculator for Stocks</p>
            <div class="backtester-container">
                <div class="sidebar-backtester">
                    <div class="red-symbol">Symbol</div>
                    <div class="symbol-container">
                        <input type="text" id="symbol" placeholder="e.g. AAPL">
                        <span class="help-element" title="Description"><i class="fa-regular fa-circle-question"></i></span>
                    </div>
                    <div class="description-under-input">Search for equities or indexes by symbol [or name]</div>
                    <div class="dates-flex">
                        <div class="date-item">
                            <label for="start-month">Start Month</label>
                            <input type="text" class="month-backtester" id="start-month">
                        </div>
                        <div class="date-item">
                            <label for="start-year">Start Year</label>
                            <input type="text" class="year-backtester" id="start-year">
                        </div>
                        <div class="date-item">
                            <label for="end-month">End Month</label>
                            <input type="text" class="month-backtester" id="end-month">
                        </div>
                        <div class="date-item">
                            <label for="end-year">End Year</label>
                            <input type="text" class="year-backtester" id="end-year">
                        </div>
                    </div>
                    <div class="entry-title">Entry</div>
                    <div class="box-inputs">
                        <label for="initial-investment">Initial Investment</label>
                        <div class="box-item">
                            <input type="number" id="initial-investment" placeholder="1000">
                            <span class="help-element" title="Description"><i class="fa-regular fa-circle-question"></i></span>
                        </div>
                        <label for="monthly-investment">Monthly Investment</label>
                        <div class="box-item">
                            <input type="number" id="monthly-investment" placeholder="500">
                            <span class="help-element" title="Description"><i class="fa-regular fa-circle-question"></i></span>
                        </div>
                    </div>
                    <button id="run-dca-calculation">Run DCA Calculation</button>
                </div>
                <div class="results-backtester">
                    <div class="title-result">Results</div>
                    <div class="backtester-list">
                        <div class="backlist-item">
                            <div class="backlist-head">
                                <span class="round-circle" style="background: red"></span>
                                <span class="symbol-name">AAPL</span>
                            </div>
                            <div class="backlist-body">
                                <div class="block-backlist">
                                    <div class="backlist-column-title">Return</div>
                                    <div class="backlist-column-description">0$ <small>0%</small></div>
                                </div>
                                <div class="block-backlist">
                                    <div class="backlist-column-title">Total Trades</div>
                                    <div class="backlist-column-description">0</div>
                                </div>
                                <div class="block-backlist">
                                    <div class="backlist-column-title">Percent Profitable</div>
                                    <div class="backlist-column-description">0%</div>
                                </div>
                                <div class="block-backlist">
                                    <div class="backlist-column-title">Max Drawdown</div>
                                    <div class="backlist-column-description">0$ <small>0%</small></div>
                                </div>
                                <div class="block-backlist">
                                    <div class="backlist-column-title">Biggest Gain</div>
                                    <div class="backlist-column-description">0$ <small>0%</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-front.layout>
