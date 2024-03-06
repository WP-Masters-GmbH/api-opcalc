<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>{{ $yesterday }} Worst performing stocks</h1>

            <div class="data-table-container">
                <div id="table-data"></div>
            </div>

            <script>
                jQuery(document).ready(function ($) {
                    //define data array
                    var tabledata = [
                            <?php if(!empty($market_data)) :  ?>
                            <?php
                            $index = 0;
                            foreach($market_data as $symbol => $symbol_data) :

                            if($symbol_data['change_percent'] > -2) {
                                continue;
                            }
                            ?>
                        {id:<?php echo $index; ?>, ticker:"<?php echo $symbol_data['symbol']; ?>", close:"<?php echo $symbol_data['close']; ?>", gain:"<?php echo round($symbol_data['change_percent'], 2); ?>", volume:"<?php echo $symbol_data['volume']; ?>", market_cap:"<?php echo $symbol_data['market_cap']; ?>", beta:"<?php echo $symbol_data['beta']; ?>"},
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

                    var gain_color = function(cell, formatterParams){
                        var percents = cell.getRow().getData().gain;
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
                            {column:"gain", dir:"asc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Ticker", field:"ticker", headerFilter:false},
                            {title:"Closing Price", field:"close", headerFilter:false},
                            {title:"Gain", field:"gain", headerFilter:false, formatter:gain_color, sorter:customSorter},
                            {title:"Volume", field:"volume", headerFilter:false},
                            {title:"Beta", field:"beta", headerFilter:false},
                            {title:"Market Cap", field:"market_cap", headerFilter:false},
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
