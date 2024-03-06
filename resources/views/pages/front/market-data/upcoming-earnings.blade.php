<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Upcoming earning dates & estimates</h1>
            <p>Check out stocks with upcoming earning dates within the next 30 days</p>

            <div class="data-table-container">
                <div id="table-data"></div>
            </div>

            <script>
                jQuery(document).ready(function ($) {
                    //define data array
                    var tabledata = [
                            <?php if(!empty($earnings)) :  ?>
                            <?php
                            foreach($earnings as $index => $earning) :

                            if(!isset($eod_stocks[$earning['symbol']])) {
                                continue;
                            }

                            ?>
                        {id:<?php echo $index; ?>, ticker:"<?php echo $earning['symbol']; ?>", market:"<?php echo $eod_stocks[$earning['symbol']]['close']; ?>", upcoming_earnings:"<?php echo date('Y-m-d', strtotime($earning['est_earnings_date'])); ?>", eps_estimate:"<?php echo $earning['e_eps']; ?>", rev_estimate:"<?php echo $earning['e_rev']; ?>", one_year_gain:"<?php echo round($eod_stocks[$earning['symbol']]['1yr'], 2); ?>"},
                        <?php endforeach; ?>
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

                    var change_price_format = function(cell, formatterParams){
                        var price = cell.getRow().getData().rev_estimate;

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

                    var change_color = function(cell, formatterParams){
                        var percents = cell.getRow().getData().one_year_gain;
                        return color_by_percent_value(percents);
                    }

                    var change_date_format = function(cell, formatterParams){
                        var date = cell.getRow().getData().upcoming_earnings;

                        // Проверяем, что строка даты не пуста
                        if (date) {
                            // Разделяем дату на год, месяц и день
                            var parts = date.split('-'); // parts[0] - год, parts[1] - месяц, parts[2] - день

                            // Возвращаем дату в новом формате
                            return parts[2] + '/' + parts[1] + '/' + parts[0];
                        }

                        // В случае, если дата не указана, вернуть пустую строку или null
                        return '';
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
                            {column:"upcoming_earnings", dir:"asc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Ticker", field:"ticker", headerFilter:false},
                            {title:"Market", field:"market", headerFilter:false},
                            {title:"Upcoming Earnings", field:"upcoming_earnings", headerFilter:false, formatter:change_date_format},
                            {title:"EPS Estimate", field:"eps_estimate", headerFilter:false},
                            {title:"REV Estimate", field:"rev_estimate", headerFilter:false, formatter:change_price_format},
                            {title:"1YR Gain", field:"one_year_gain", headerFilter:false, formatter:change_color}
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
