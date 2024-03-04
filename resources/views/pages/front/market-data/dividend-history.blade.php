<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>{{$symbol}} Dividend History</h1>

            <div class="data-table-container">
                @if(!empty($table_data))
                    <div id="table-data"></div>
                @else
                    <p>{{$symbol}} stock does not payout dividends as of {{$current_date}}</p>
                @endif
            </div>

            <script>
                jQuery(document).ready(function ($) {
                    //define data array
                    var tabledata = [
                            <?php if(!empty($table_data)) :  ?>
                            <?php

                            $index = 0;
                            foreach($table_data as $symbol => $item) :
                            ?>
                        {id:<?php echo $index; ?>, date:"<?php echo $item['ex_date']; ?>", amount:"$<?php echo $item['amount']; ?>", yoy:"<?php echo round($item['yoy_increase'], 2); ?>", declared:"<?php echo date('M d, Y', strtotime($item['declared'])); ?>", record:"<?php echo date('M d, Y', strtotime($item['record'])); ?>", payable:"<?php echo date('M d, Y', strtotime($item['payable'])); ?>"},
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

                    var change_color = function(cell, formatterParams){
                        var percents = cell.getRow().getData().yoy;
                        return color_by_percent_value(percents);
                    }

                    // Custom sorter for dates
                    var dateSorter = function(a, b, aRow, bRow, column, dir, sorterParams){
                        // This assumes your date is in the format "MMM d, YYYY", e.g. "Jun 14, 2012"
                        var format = "MMM D, YYYY"; // specify the format of your date strings
                        var aDate = moment(a, format),
                            bDate = moment(b, format);

                        return aDate - bDate; // this will sort by date value
                    };

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
                            {column:"date", dir:"desc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Ex-Date", field:"date", headerFilter:false},
                            {title:"Amount", field:"amount", headerFilter:false},
                            {title:"YoY increase", field:"yoy", formatter:change_color, headerFilter:false},
                            {title:"Declared", field:"declared", sorter:dateSorter, headerFilter:false},
                            {title:"Record", field:"record", sorter:dateSorter, headerFilter:false},
                            {title:"Payable", field:"payable", sorter:dateSorter, headerFilter:false},
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
