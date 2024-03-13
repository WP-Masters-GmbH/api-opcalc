document.addEventListener("DOMContentLoaded", function () {
    const analysts = document.querySelector("#analysts");
    const optionsMarket = document.querySelector("#options-market");

    if (analysts) {
        const data = {
            datasets: [
                {
                    data: [10, 10, 10, 10, 10],
                    backgroundColor: [
                        "#C11F1F",
                        "#c65326",
                        "#d1cb34",
                        "#7ce9cb",
                        "#34d1a6",
                    ],
                    borderColor: [
                        "#C11F1F",
                        "#c65326",
                        "#d1cb34",
                        "#7ce9cb",
                        "#34d1a6",
                    ],
                },
            ],
        };

        const options = {
            cutout: "70%",
            circumference: 180,
            rotation: -90,
            spacing: 20,
            plugins: {
                tooltip: {
                    enabled: false,
                },
            },
        };

        new Chart(analysts, {
            type: "doughnut",
            data: data,
            options,
        });
        new Chart(optionsMarket, {
            type: "doughnut",
            data: data,
            options,
        });
    }

    const ratingSymbolTable = document.querySelector("#ratings-symbol-table");

    if (ratingSymbolTable) {
        let tableData = [];

        const ratingSymbolTableI = new Tabulator("#ratings-symbol-table", {
            data: tableData,
            layout: "fitColumns",
            responsiveLayout: "hide",
            addRowPos: "top",
            history: true,
            pagination: "local",
            paginationSize: 50,
            paginationCounter: "rows",
            movableColumns: true,
            resizableColumns: true,
            initialSort: [{ column: "date", dir: "asc" }],
            columnDefaults: {
                tooltip: true,
            },
            columns: [
                { title: "Date", field: "date", headerFilter: false },
                { title: "Firm", field: "firm", headerFilter: true },
                { title: "Status", field: "status", headerFilter: false },
                {
                    title: "Price Target",
                    field: "price_target",
                    headerFilter: false,
                },
                { title: "Upside", field: "upside", headerFilter: false },
            ],
            rowClick: function (e, row) {
                if (row.isSelected()) {
                    row.deselect();
                } else {
                    row.select();
                }
            },
        });
    }
});
