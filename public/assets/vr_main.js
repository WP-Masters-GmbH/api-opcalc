$(document).ready(function() {
    // Для выбора только месяца
    $('[data-toggle="datepicker-month"]').datepicker({
        startView: 1,
        minViewMode: 1,
        format: 'mm'
    });

    // Для выбора только года
    $('[data-toggle="datepicker-year"]').datepicker({
        startView: 2,
        minViewMode: 2,
        format: 'yyyy'
    });

    $('.select2').select2();

    $('.help-element').tooltip({
        content: function () {
            return $(this).prop('title');
        },
    });

    $('body').on('click', "#download-table-xlsx", function () {
        table.download("csv", "backtester.csv");
    });

    $('body').on('click', "#download-logs-table-csv", function () {
        logs_table.download("csv", "backtester_logs.csv");
    });

    function validate_run_backtester() {
        var errors = 0;

        if ($('#selected-symbol').val().length > 0) {
            $('#selected-symbol').next().removeClass('required-backtester');
        } else {
            $('#selected-symbol').next().addClass('required-backtester');
            errors++;
        }

        $(".dates-flex input").each(function (index) {
            if ($(this).val().length > 0) {
                $(this).removeClass('required-backtester');
            } else {
                errors++;
                $(this).addClass('required-backtester');
            }
        });

        $(".box-inputs input").each(function (index) {
            if ($(this).val().length > 0) {
                $(this).removeClass('required-backtester');
            } else {
                errors++;
                $(this).addClass('required-backtester');
            }
        });

        return errors;
    }

    $('body').on('click', '#run-dca-calculation', function () {
        // Test all required variables is selected
        var errors = validate_run_backtester();

        // If all fields is set
        if (errors === 0) {

            $('.backtester-charts').hide();
            $('.backtester-table').hide();
            $('.backtester-list').hide();
            $('.backtester-loading').show();

            var data_json = {
                symbol: $('#selected-symbol').val(),
                start_month: $('#start-month').val(),
                start_year: $('#start-year').val(),
                end_month: $('#end-month').val(),
                end_year: $('#end-year').val(),
                initial_investment: $('#initial-investment').val(),
                monthly_investment: $('#monthly-investment').val()
            };

            $.ajax({
                type: 'POST',
                url: '/ajax/dca_calculation',
                data: data_json,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('.backtester-list').html(response.list_items);
                    $('.backtester-loading').hide();
                    $('.backtester-list').show();
                    if (response.graph_items.datasets) {
                        $('.backtester-charts').show();
                        $('.backtester-table').show();
                        initializeChartsStats(response.graph_items, response.graph_items);
                        table.setData(response.table_items);
                        updateTableColumns(response.table_logs);
                        console.log('Count Rows: '+response.count_rows) ;
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });

    function updateTableColumns(newData) {
        var keys = getUniqueKeys(newData);
        var columns = createColumns(keys);
        logs_table.setColumns(columns); // Обновление определений колонок
        logs_table.setData(Object.values(newData)); // Обновление данных
    }

    function getUniqueKeys(data) {
        let keys = new Set();
        Object.values(data).forEach(obj => {
            Object.keys(obj).forEach(key => {
                keys.add(key);
            });
        });
        return Array.from(keys);
    }

    // Создание определений колонок
    function createColumns(keys) {
        return keys.map(key => ({title: key, field: key}));
    }

    function initializeChartsStats(dataBalance, startValueBalance) {
        if (typeof secondChart !== 'undefined') {
            secondChart.destroy();
        }

        const newItem = {};

        newItem.datasets = dataBalance.datasets.map((item) => ({
            ...item,
            data: item.data.map((itemData) => itemData.percent),
        }));

        newItem.labels = dataBalance.labels;

        var secondctx = document.getElementById('chartBacktester').getContext('2d');
        secondChart = new Chart(secondctx, {
            type: 'line',
            data: newItem,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                        },
                        ticks: {
                            callback: function (value, index, values) {
                                if (typeof value === 'string') {
                                    value = value.split(' ')[0];
                                }
                                return value;
                            },
                        },
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                        },
                        suggestedMin: 0,
                        suggestedMax: 0,
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function (value, index, ticks) {
                                const valueMain = value.toFixed(2);
                                return Number(valueMain) !== 0
                                    ? ((Number(valueMain) * 100) | 0) + '%'
                                    : 0;
                            },
                        },
                    },
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function (contextTitle) {
                                let label = '';

                                contextTitle.forEach((item) => {
                                    label =
                                        startValueBalance.datasets[item.datasetIndex].data[
                                            item.dataIndex
                                            ].profit ?? 0;
                                });

                                return label;
                            },
                            label: function (context) {
                                const datasetIndex = context.datasetIndex;
                                const dataIndex = context.dataIndex;
                                const dataset = context.chart.data.datasets[datasetIndex];
                                let label = context.dataset.label ?? '';

                                if (!!label) {
                                    label += ': ';
                                }

                                if (dataIndex === 0) {
                                    return label + '0%';
                                }

                                const currentValue = (
                                    Number(dataset.data[dataIndex]) * 100
                                ).toFixed(2);
                                label += currentValue + '%';

                                return label;
                            },
                        },
                    },
                },
            },
        });
    }
});
