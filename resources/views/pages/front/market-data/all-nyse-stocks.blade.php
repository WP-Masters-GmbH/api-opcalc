<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>All NYSE Stocks with options contracts</h1>
            <p>Discover Options Contracts for Every Listed Company with our Comprehensive Table</p>

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
                                $etf = 'YES';
                                $num_expiry_dates = $symbol_data['expirations_num'];
                                $option_chain = "{$symbol} Options chain";
                                $weeklies = $num_expiry_dates > 12 ? 'YES' : 'NO';
                            ?>
                        {id:<?php echo $index; ?>, symbol:"<?php echo $symbol; ?>", weeklies:"<?php echo $weeklies; ?>", etf:"<?php echo $etf; ?>", expiry_dates:"<?php echo $num_expiry_dates; ?>", option_chain:"<?php echo $option_chain; ?>"},
                        <?php $index++; endforeach; ?>
                        <?php endif; ?>
                    ];

                    var add_link_to_page = function(cell, formatterParams){
                        var symbol = cell.getRow().getData().symbol;
                        var option_chain = cell.getRow().getData().option_chain;

                        return '<a href="/market-data/option-chains/'+symbol+'">'+option_chain+'</a>';
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
                            {column:"expiry_dates", dir:"desc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Ticker", field:"symbol", headerFilter:false},
                            {title:"Weeklies", field:"weeklies", headerFilter:false},
                            {title:"ETF/INDEXS", field:"etf", headerFilter:false},
                            {title:"NUM # Expiry Dates", field:"expiry_dates", headerFilter:false, sorter:customSorter},
                            {title:"Options Chain", field:"option_chain", formatter:add_link_to_page, headerFilter:false},
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
