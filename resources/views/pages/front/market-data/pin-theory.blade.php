<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Option Pin Theory Price</h1>
            <p>Find out anticipated stock prices for this week!</p>
            <p>Pin Theory is a specific strike price chosen by market makers for upcoming expiration dates . The theory is that the stock will landed on the “pinned” strike by expiration.</p>

            <div class="data-table-container">
                <div id="table-data"></div>
            </div>

            <script>
                jQuery(document).ready(function ($) {
                    //define data array
                    var tabledata = [
                            <?php if(!empty($tableData)) :  ?>
                            <?php
                            $index = 0;
                            foreach($tableData as $symbol => $symbol_data) :
                                $symbol = $symbol_data['symbol'];

                                if(!isset($stocksOI[$symbol]['strike'])) {
                                    continue;
                                }

                                $pinned_price = isset($stocksOI[$symbol]['strike']) ? $stocksOI[$symbol]['strike'] : 0;
                                $expiry = isset($stocksOI[$symbol]['expiry']) ? $stocksOI[$symbol]['expiry'] :'n/a';
                                $oi = isset($stocksOI[$symbol]['openInt']) ? $stocksOI[$symbol]['openInt'] : 0;
                            ?>

                        {id:<?php echo $index; ?>, symbol:"<?php echo $symbol; ?>", market:"<?php echo $symbol_data['close']; ?>", pinned_price:"<?php echo $pinned_price; ?>", change:"<?php echo $symbol_data['change']; ?>", expiry:"<?php echo $expiry; ?>", oi:"<?php echo $oi; ?>"},
                        <?php $index++; endforeach; ?>
                        <?php endif; ?>
                    ];

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

                    var change_color = function(cell, formatterParams){
                        var percents = cell.getRow().getData().change;
                        return color_by_percent_value(percents);
                    }

                    var change_market = function(cell, formatterParams){
                        var price = cell.getRow().getData().market;
                        return '$'+price;
                    }

                    var change_pinned_price = function(cell, formatterParams){
                        var price = cell.getRow().getData().pinned_price;
                        return '<b>$'+price+'</b>';
                    }

                    var change_price_format = function(cell, formatterParams){
                        var price = cell.getRow().getData().oi;

                        // Удаление запятых для обработки числа
                        var num = parseFloat(price.replace(/,/g, ''));

                        // Форматирование числа в зависимости от его величины
                        if (num >= 1000000000) {
                            return (num / 1000000000).toFixed(2) + 'b';
                        } else if (num >= 1000000) {
                            return (num / 1000000).toFixed(2) + 'm';
                        } else if (num >= 1000) {
                            return (num / 1000).toFixed(2) + 'k';
                        } else {
                            return num.toString();
                        }
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
                            {column:"pinned_price", dir:"desc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Symbol", field:"symbol", headerFilter:false},
                            {title:"Market", field:"market", headerFilter:false, sorter:customSorter, formatter:change_market},
                            {title:"Pinned Price", field:"pinned_price", headerFilter:false, sorter:customSorter, formatter:change_pinned_price},
                            {title:"Change", field:"change", headerFilter:false, sorter:customSorter, formatter:change_color},
                            {title:"Expiry", field:"expiry", headerFilter:false},
                            {title:"OI", field:"oi", headerFilter:false, sorter:customSorter, formatter:change_price_format},
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
