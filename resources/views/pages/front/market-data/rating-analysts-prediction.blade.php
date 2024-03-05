<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>{{ $symbol }} Stock Analysts Estimates, Ratings and Price Targets</h1>

            <div class="data-table-container">
                <div id="table-data"></div>
            </div>

            <script>
                jQuery(document).ready(function ($) {
                    //define data array
                    var tabledata = [
                            <?php if(!empty($analysts)) :  ?>
                            <?php

                            $index = 0;
                            foreach($analysts as $symbol => $analyst) :
                            $upside_downside = !empty($analyst['upside_downside']) ? str_replace('%', '', str_replace('+', '', $analyst['upside_downside'])) : 0;

                            if(empty($analyst['price_target'])) {
                                continue;
                            }
                            ?>
                        {id:<?php echo $index; ?>, date:"<?php echo date('Y-m-d', strtotime($analyst['date'])); ?>", firm:"<?php echo $analyst['brokerage']; ?>", status:"<?php echo $analyst['action']; ?>", price_target:"<?php echo $analyst['price_target']; ?>", upside:"<?php echo $upside_downside; ?>"},
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

                    var percents_color = function(cell, formatterParams){
                        var percents = cell.getRow().getData().upside;
                        return color_by_percent_value(percents);
                    }

                    var show_simple_date = function(cell, formatterParams){
                        var dateString = cell.getRow().getData().date;
                        var date = new Date(dateString);
                        return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
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
                            {column:"date", dir:"desc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Date", field:"date", headerFilter:false, formatter:show_simple_date},
                            {title:"Firm", field:"firm", headerFilter:false},
                            {title:"Status", field:"status", headerFilter:false},
                            {title:"Price Target", field:"price_target", headerFilter:false},
                            {title:"Upside", field:"upside", headerFilter:false, formatter:percents_color}
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
