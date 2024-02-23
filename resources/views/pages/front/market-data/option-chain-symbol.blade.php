<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Chains data for {{$symbol}}</h1>
            <p>Description</p>

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
                            foreach($table_data as $symbol_data) :
                            ?>
                        {id:<?php echo $index; ?>,  expiration: "<?php echo $symbol_data['expiration']; ?>",
                                dte: "<?php echo $symbol_data['dte']; ?>",
                                putCall: "<?php echo $symbol_data['putCall']; ?>",
                                underlying: "<?php echo $symbol_data['underlying']; ?>",
                                optionRange: "<?php echo $symbol_data['optionRange']; ?>",
                                price: "<?php echo $symbol_data['price']; ?>",
                                volume: "<?php echo $symbol_data['volume']; ?>",
                                openInt: "<?php echo $symbol_data['openInt']; ?>",
                                strike: "<?php echo $symbol_data['strike']; ?>"},
                        <?php $index++; endforeach; ?>
                        <?php endif; ?>
                    ];


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
                            {column:"expiration", dir:"desc"},
                        ],
                        columnDefaults:{
                            tooltip:true,         //show tool tips on cells
                        },
                        columns:[                 //define the table columns
                            {title:"Expiration", field:"expiration", headerFilter:false},
                            {title:"DTE", field:"dte", headerFilter:false},
                            {title:"Put or Call", field:"putCall", headerFilter:false},
                            {title:"Underlying", field:"underlying", headerFilter:false},
                            {title:"Option Range", field:"optionRange", headerFilter:false},
                            {title:"Price", field:"price", headerFilter:false},
                            {title:"Volume", field:"volume", headerFilter:false},
                            {title:"Open Int", field:"openInt", headerFilter:false},
                            {title:"Strike", field:"strike", headerFilter:false},
                        ],
                    });
                });
            </script>
        </section>
    </main>
</x-front.layout>
