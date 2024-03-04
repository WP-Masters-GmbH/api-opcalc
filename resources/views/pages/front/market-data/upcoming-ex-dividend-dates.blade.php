<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Dividend Paying stocks with upcoming ex-dividend dates</h1>

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

                            if(!isset($dividendsData[$symbol]['ex_date']) || empty($dividendsData[$symbol]['ex_date'])) {
                                continue;
                            }

                            $dividend_yield = isset($dividendsData[$symbol]['current_yield']) ? round($dividendsData[$symbol]['current_yield'] * 100, 2) : 0;
                            $last_dividend_amount = isset($dividendsData[$symbol]['last_dividend_amount']) ? round($dividendsData[$symbol]['last_dividend_amount'], 2) : 0;
                            $ex_date = isset($dividendsData[$symbol]['ex_date']) && !empty($dividendsData[$symbol]['ex_date']) ? $dividendsData[$symbol]['ex_date'] : 'n/a';
                            $mark = isset($symbol_data['close']) && !empty($symbol_data['close']) ? round($symbol_data['close'], 2) : 0;

                            if($dividend_yield == 0) {
                                continue;
                            }
                            ?>
                        {id:<?php echo $index; ?>, symbol:"<?php echo $symbol; ?>", mark:"<?php echo $mark; ?>", dividend_yield:"<?php echo $dividend_yield; ?>", annual_dividend_increase:"<?php echo $last_dividend_amount; ?>", ex_dividend_date:"<?php echo $ex_date?>"},
                        <?php $index++; endforeach; ?>
                        <?php endif; ?>
                    ];

                    function color_by_percent_value(percents) {
                        if(percents != 'n/a') {
                            if(parseFloat(percents) > 0) {
                                return '<span style="color: green;font-weight: bold;">'+percents+'%<span>';
                            } else if(parseFloat(percents) < 0) {
                                return '<span style="color: red;font-weight: bold;">'+percents+'%<span>';
                            } else {
                                return '<span style="font-weight: bold;">'+percents+'%<span>';
                            }
                        } else {
                            return percents;
                        }
                    }

                    function customSorter(a, b, aRow, bRow, column, dir, sorterParams){
                        // функция для конвертации значения с T и B в числа
                        function convertValue(value) {
                            let number = parseFloat(value);
                            if (value.includes('T')) {
                                return number * 1e12; // конвертация триллионов в числа
                            } else if (value.includes('B')) {
                                return number * 1e9; // конвертация биллионов в числа
                            }
                            return number; // если нет суффикса, возвращаем как есть
                        }

                        let valA = convertValue(a);
                        let valB = convertValue(b);

                        return valA - valB;
                    }

                    var change_color = function(cell, formatterParams){
                        var percents = cell.getRow().getData().dividend_yield;
                        return color_by_percent_value(percents);
                    }

                    var change_color_two = function(cell, formatterParams){
                        var percents = cell.getRow().getData().annual_dividend_increase;
                        return color_by_percent_value(percents);
                    }

                    var dollar_add = function(cell, formatterParams){
                        var price = cell.getRow().getData().mark;
                        return '$'+price;
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
                            {column:"ex_dividend_date", dir:"asc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Ticker", field:"symbol", headerFilter:false},
                            {title:"Mark", field:"mark", headerFilter:false, sorter:customSorter, formatter:dollar_add},
                            {title:"Dividend Yield", field:"dividend_yield", headerFilter:false, sorter:customSorter, formatter:change_color},
                            {title:"Annual Dividend Increase", field:"annual_dividend_increase", headerFilter:false, sorter:customSorter, formatter:change_color_two},
                            {title:"Next EX-Dividend Date", field:"ex_dividend_date", headerFilter:false},
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
