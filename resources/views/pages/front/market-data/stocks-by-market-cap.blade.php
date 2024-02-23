<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Stocks ranked by market cap</h1>

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
                            ?>
                        {id:<?php echo $index; ?>, symbol:"<?php echo $symbol; ?>", close:"<?php echo $symbol_data['close']; ?>", change_percent:"<?php echo $symbol_data['change_percent']; ?>", '52wl':"<?php echo $symbol_data['52wl']; ?>", '52wh':"<?php echo $symbol_data['52wh']; ?>", market_cap:"<?php echo $symbol_data['market_cap']; ?>"},
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
                        var percents = cell.getRow().getData().change_percent;
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
                            {column:"market_cap", dir:"desc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Symbol", field:"symbol", headerFilter:false},
                            {title:"Close Price", field:"close", headerFilter:false},
                            {title:"Change Percent", field:"change_percent", formatter:change_color, headerFilter:false},
                            {title:"52 Week Low", field:"52wl", headerFilter:false},
                            {title:"52 Week High", field:"52wh", headerFilter:false},
                            {title:"Market Cap", field:"market_cap", headerFilter:false}
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
