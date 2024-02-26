window.addEventListener("DOMContentLoaded", function () {
    const rangeSwitcher = document.querySelector("#range");
    if (rangeSwitcher) {
        rangeSwitcher.addEventListener("change", function (e) {
            const type = e.currentTarget.value;
            const rows = document.querySelectorAll(
                `.options tbody tr[data-type="${type}"]`
            );

            const allRows = document.querySelectorAll(
                ".options .table1 tbody tr, .options .table3 tbody tr"
            );

            if (rows.length > 0) {
                allRows.forEach((el) => {
                    el.classList.add("invisible");
                });
                rows.forEach((item) => {
                    item.classList.remove("invisible");
                });
            } else {
                allRows.forEach((el) => {
                    el.classList.remove("invisible");
                });
            }
        });
    }

    const optionTypeSwitcher = document.querySelector("#option-types");
    if (optionTypeSwitcher) {
        optionTypeSwitcher.addEventListener("click", function (e) {
            const value = e.currentTarget.value;

            const [table1, table2, table3] = document.querySelectorAll(
                ".table1,.table2,.table3"
            );

            if (value === "puts") {
                table1.classList.add("hidden");
                table3.classList.remove("hidden");
                table2.classList.remove("hidden");
                table1.parentElement.removeAttribute("style");
            } else if (value === "calls") {
                table1.parentElement.style.flexDirection = "row-reverse";
                table1.classList.remove("hidden");
                table2.classList.remove("hidden");
                table3.classList.add("hidden");
                table2
                    .querySelector("thead tr")
                    .classList.remove("lg:border-l-0");
                table2.querySelector("tbody").classList.remove("lg:border-l-0");
            } else {
                table1.parentElement.removeAttribute("style");
                table1.classList.remove("hidden");
                table3.classList.remove("hidden");
                table2.classList.remove("hidden");
                table2.querySelector("thead tr").classList.add("lg:border-l-0");
                table2.querySelector("tbody").classList.add("lg:border-l-0");
            }
        });
    }

    const underlyingSelector = document.querySelector("#underlying");
    if (underlyingSelector) {
        $("#underlying").select2({
            placeholder: "Select a symbol",
            tags: true,
            width: "100%",
        });

        $("#underlying").on("select2:select", function (e) {
            window.location.href = e.currentTarget.value;
        });
    }
});
