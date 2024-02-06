<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Lowest Ranked Beta Stocks for <?php echo "{$month} {$year}"; ?></h1>
            <p>Discover the current stocks with the highest recorded Beta values!</p>
            <p>Betaisa technical stat that helps traders correlate the risk vs reward ratio and overall volatile of a stock. The higher the beta, the higher the volatile.</p>

            <div class="data-table-container">
                <div id="table-data"></div>
            </div>

            <script>
                jQuery(document).ready(function ($) {
                    //define data array
                    var tabledata = [
                            <?php if(!empty($table_data)) :  ?>
                            <?php

                            $index = 0;
                            foreach($table_data as $symbol => $symbol_data) :
                            $row = $symbol_data[0];
                            $close_price = round($row['close'], 2);

                            // Other Table Data
                            $market_cap = $market_data[$symbol]['market_cap'];
                            $beta = $market_data[$symbol]['beta'];

                            // Calculate Change
                            $change = 'n/a';
                            if(isset($symbol_data[0]['close']) && $symbol_data[0]['close'] > 0 && isset($symbol_data[1]['close']) && $symbol_data[1]['close'] > 0) {
                                $change = round((($symbol_data[0]['close'] - $symbol_data[1]['close']) / $symbol_data[0]['close']) * 100, 2).'%';
                            }

                            // Calculate One Year
                            $one_year = 'n/a';
                            if(isset($symbol_data[0]['close']) && $symbol_data[0]['close'] > 0 && isset($symbol_data[2]['close']) && $symbol_data[2]['close'] > 0) {
                                $one_year = round((($symbol_data[0]['close'] - $symbol_data[2]['close']) / $symbol_data[0]['close']) * 100, 2);
                            }

                            // Calculate Three Years
                            $three_years = 'n/a';
                            if(isset($symbol_data[0]['close']) && $symbol_data[0]['close'] > 0 && isset($symbol_data[3]['close']) && $symbol_data[3]['close'] > 0) {
                                $three_years = round((($symbol_data[0]['close'] - $symbol_data[3]['close']) / $symbol_data[0]['close']) * 100, 2);
                            }
                            ?>
                        {id:<?php echo $index; ?>, symbol:"<?php echo $symbol; ?>", market:"<?php echo $close_price; ?>", change:"<?php echo $change; ?>", one_year:"<?php echo $one_year; ?>", three_year:"<?php echo $three_years; ?>", market_cap:"<?php echo $market_cap; ?>", beta:"<?php echo $beta; ?>"},
                        <?php $index++; endforeach; ?>
                        <?php endif; ?>
                    ];

                    function color_by_percent_value(percents) {
                        if(percents != 'n/a') {
                            if(parseFloat(percents) > 0) {
                                return '<span style="color: green;font-weight: bold;">'+percents+'%<span>';
                            } else {
                                return '<span style="color: red;font-weight: bold;">'+percents+'%<span>';
                            }
                        } else {
                            return percents;
                        }
                    }

                    var three_years_color = function(cell, formatterParams){
                        var percents = cell.getRow().getData().three_year;
                        return color_by_percent_value(percents);
                    }

                    var one_year_color = function(cell, formatterParams){
                        var percents = cell.getRow().getData().one_year;
                        return color_by_percent_value(percents);
                    }

                    //initialize table
                    var table = new Tabulator("#table-data", {
                        data:tabledata,           //load row data from array
                        layout:"fitColumns",      //fit columns to width of table
                        responsiveLayout:"hide",  //hide columns that don't fit on the table
                        addRowPos:"top",          //when adding a new row, add it to the top of the table
                        history:true,             //allow undo and redo actions on the table
                        pagination:"local",       //paginate the data
                        paginationSize:50,         //allow 7 rows per page of data
                        paginationCounter:"rows", //display count of paginated rows in footer
                        movableColumns:true,      //allow column order to be changed
                        initialSort:[             //set the initial sort order of the data
                            {column:"beta", dir:"asc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Symbol", field:"symbol", headerFilter:false},
                            {title:"Market", field:"market", headerFilter:false},
                            {title:"Change", field:"change", headerFilter:false},
                            {title:"1yr Gain", field:"one_year", formatter:one_year_color, headerFilter:false},
                            {title:"3yr Gain", field:"three_year", formatter:three_years_color, headerFilter:false},
                            {title:"Market Cap", field:"market_cap", headerFilter:false},
                            {title:"Beta", field:"beta", headerFilter:false}
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
