<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Dollar Cost Averaging Calculator for Stocks</h1>
            <p>Amplify Your Portfolio: Embrace Next-Gen Investing with Our Dynamic Dollar Cost Averaging Calculator for Stocks</p>
            <div class="backtester-container">
                <div class="sidebar-backtester">
                    <div class="red-symbol">Symbol</div>
                    <div class="symbol-container">
                        <select class="select2" id="selected-symbol" data-placeholder="Search symbol">
                            <option value="" disabled selected hidden>Search symbol</option>
                            <option value="NONE">NONE</option>
                            <?php foreach ($symbols as $symbol) : ?>
                            <option value="<?php echo $symbol; ?>"><?php echo $symbol; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-element" title="Description"><i class="fa-regular fa-circle-question"></i></span>
                    </div>

                    <div class="description-under-input">Search for equities or indexes by symbol [or name]</div>
                    <div class="dates-flex">
                        <div class="date-item">
                            <label for="start-month">Start Month</label>
                            <input type="text" data-toggle="datepicker-month" id="start-month">
                        </div>
                        <div class="date-item">
                            <label for="start-year">Start Year</label>
                            <input type="text" data-toggle="datepicker-year" id="start-year">
                        </div>
                        <div class="date-item">
                            <label for="end-month">End Month</label>
                            <input type="text" data-toggle="datepicker-month" id="end-month">
                        </div>
                        <div class="date-item">
                            <label for="end-year">End Year</label>
                            <input type="text" data-toggle="datepicker-year" id="end-year">
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
                    <div class="backtester-loading" style="display: none;">
                        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    </div>
                    <div class="backtester-list">
                        <div class="backtester-start-search"><span><i class="fa-solid fa-chart-simple"></i></span>
                        <p>Run DCA calculator to see analyse results</p></div>
                    </div>
                    <div class="backtester-charts" style="display: none">
                        <canvas id="chartBacktester" style="height: 500px"></canvas>
                    </div>
                    <div class="backtester-table" style="display: none">
                        <button class="button" id="download-table-xlsx">Download CSV</button>
                        <div id="dca-table"></div>
                        <div class="table-logs">
                            <button class="button" id="download-logs-table-csv">Download CSV</button>
                            <div id="dca-logs-table"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-front.layout>
