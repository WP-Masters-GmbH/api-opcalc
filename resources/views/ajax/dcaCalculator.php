<?php

if (isset($dataBalance['datasets']) && ! empty($dataBalance['datasets'])) :
    foreach ($dataBalance['datasets'] as $index => $symbol_data) :
        $is_equity   = strpos($symbol_data['label'], 'EQUITY') !== false;
        $dates_names = array_keys($final_data[ $symbol_data['label'] ]);
        $start_date  = $dates_names[0];
        $end_date    = $dates_names[ count($dates_names) - 1 ];

        $symbol_table_data = isset($under_charts[$symbol_data['label']]) ? $under_charts[$symbol_data['label']] : [];
        ?>
        <div class="backlist-item">
            <div class="backlist-head">
                <span class="round-circle" style="background: <?php echo $symbol_data['borderColor']; ?>"></span>
                <span class="symbol-name"><?php echo $symbol_data['label']; ?> <small><?php echo $is_equity ? "[{$start_date} - {$end_date}]" : ''; ?></small></span>
            </div>
            <div class="backlist-body">
                <div class="block-backlist">
                    <div class="backlist-column-title">Return</div>
                    <div class="backlist-column-description"><?php echo isset($symbol_table_data['last_profit']) ? round($symbol_table_data['last_profit']['amount'], 2) : 0 ?>$ <small><?php echo isset($symbol_table_data['last_profit']) ? round($symbol_table_data['last_profit']['percent'] * 100, 2) : 0 ?>%</small></div>
                </div>
                <div class="block-backlist">
                    <div class="backlist-column-title">Total Trades</div>
                    <div class="backlist-column-description"><?php echo isset($symbol_table_data['total_trades']) ? $symbol_table_data['total_trades'] : 0 ?></div>
                </div>
                <div class="block-backlist">
                    <div class="backlist-column-title">Percent Profitable</div>
                    <div class="backlist-column-description"><?php echo isset($symbol_table_data['last_percent']) ? round($symbol_table_data['last_percent'] * 100, 2) : 0 ?>%</div>
                </div>
                <div class="block-backlist">
                    <div class="backlist-column-title">Max Drawdown</div>
                    <div class="backlist-column-description"><?php echo isset($symbol_table_data['max_drawdown']) ? round($symbol_table_data['max_drawdown']['amount'], 2) : 0 ?>$ <small><?php echo isset($symbol_table_data['max_drawdown']) ? round($symbol_table_data['max_drawdown']['percent'] * 100, 2) : 0 ?>%</small></div>
                </div>
                <div class="block-backlist">
                    <div class="backlist-column-title">Biggest Gain</div>
                    <div class="backlist-column-description"><?php echo isset($symbol_table_data['biggest_gain']) ? round($symbol_table_data['biggest_gain']['amount'], 2) : 0 ?>$ <small><?php echo isset($symbol_table_data['biggest_gain']) ? round($symbol_table_data['biggest_gain']['percent'] * 100, 2) : 0 ?>%</small></div>
                </div>
            </div>
        </div>
    <?php
    endforeach;
else :
    echo "<div class='backtester-start-search'><span><i class='fa-solid fa-filter'></i></span><p>Nothing found, try change Dates range or Symbol</p></div>";
endif;
