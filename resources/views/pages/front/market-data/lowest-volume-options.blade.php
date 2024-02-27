<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Options with lowest trading volume for <?php echo "{$month} {$year}"; ?></h1>
            <p>Discovery the current option contracts with the most lowest volume!</p>
            <p>Volume refers to total amount of trading activity on an options contract. Traders can research contracts with high volume to find trades.</p>

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
                                $market = $stocks_list[$symbol]['close'];
                                $earnings = isset($earnings_estimates[$symbol]['est_earnings_date']) ? $earnings_estimates[$symbol]['est_earnings_date'] : 'None';
                                $change_percent = isset($symbol_data['close']) && $symbol_data['close'] > 0 ? round($symbol_data['change_percent'] / $symbol_data['close'], 2) : $symbol_data['change_percent'];
                            ?>
                        {id:<?php echo $index; ?>, symbol:"<?php echo $symbol; ?>", market:"<?php echo $market; ?>", change:"<?php echo $symbol_data['change']; ?>", volume:"<?php echo $symbol_data['volume']; ?>", type:"<?php echo ucfirst($symbol_data['putCall']); ?>", strike:"<?php echo $symbol_data['strikePrice']; ?>", price:"<?php echo $symbol_data['price']; ?>", expiry:"<?php echo $symbol_data['expiration']; ?>", earnings:"<?php echo $earnings; ?>"},
                        <?php $index++; endforeach; ?>
                        <?php endif; ?>
                    ];

                    function color_by_percent_value(percents) {
                        if(percents != 'n/a') {
                            if(parseFloat(percents) > 0) {
                                return '<span style="color: green;font-weight: bold;">'+percents+'<span>';
                            } else if(parseFloat(percents) < 0) {
                                return '<span style="color: red;font-weight: bold;">'+percents+'<span>';
                            } else {
                                return '<span style="font-weight: bold;">'+percents+'<span>';
                            }
                        } else {
                            return percents;
                        }
                    }

                    var change_color = function(cell, formatterParams){
                        var percents = cell.getRow().getData().change;
                        return color_by_percent_value(percents);
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
                            {column:"volume", dir:"desc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Symbol", field:"symbol", headerFilter:false},
                            {title:"Market", field:"market", headerFilter:false},
                            {title:"Change", field:"change", formatter:change_color, headerFilter:false},
                            {title:"Volume", field:"volume", headerFilter:false, sorter:customSorter},
                            {title:"Type", field:"type", headerFilter:false},
                            {title:"Strike", field:"strike", headerFilter:false},
                            {title:"Price", field:"price", headerFilter:false},
                            {title:"Expiry", field:"expiry", headerFilter:false},
                            {title:"Earnings", field:"earnings", headerFilter:false}
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
