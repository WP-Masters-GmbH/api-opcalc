(function () {
    const s = document.createElement("link").relList;
    if (s && s.supports && s.supports("modulepreload")) return;
    for (const e of document.querySelectorAll('link[rel="modulepreload"]'))
        n(e);
    new MutationObserver((e) => {
        for (const t of e)
            if (t.type === "childList")
                for (const o of t.addedNodes)
                    o.tagName === "LINK" && o.rel === "modulepreload" && n(o);
    }).observe(document, { childList: !0, subtree: !0 });
    function c(e) {
        const t = {};
        return (
            e.integrity && (t.integrity = e.integrity),
            e.referrerPolicy && (t.referrerPolicy = e.referrerPolicy),
            e.crossOrigin === "use-credentials"
                ? (t.credentials = "include")
                : e.crossOrigin === "anonymous"
                ? (t.credentials = "omit")
                : (t.credentials = "same-origin"),
            t
        );
    }
    function n(e) {
        if (e.ep) return;
        e.ep = !0;
        const t = c(e);
        fetch(e.href, t);
    }
})();
const l = document.querySelector(".show-menu"),
    u = document.querySelector(".close-menu"),
    a = document.querySelector(".mobile-menu");
l &&
    u &&
    a &&
    (l.addEventListener("click", function (r) {
        r.preventDefault(), a.classList.add("mobile-menu_active");
    }),
    u.addEventListener("click", function (r) {
        r.preventDefault(), a.classList.remove("mobile-menu_active");
    }));
const d = document.querySelectorAll(".rates-tab");
d.length > 0 &&
    d.forEach((r) => {
        r.addEventListener("click", function (s) {
            s.preventDefault();
            const c = s.currentTarget.dataset.table;
            console.log(c);
            const n = document.querySelector(`#table-${c}`);
            if (n) {
                const t = document.querySelectorAll(".rates-table_active");
                t.length > 0 &&
                    t.forEach((o) => {
                        o.classList.remove("rates-table_active");
                    }),
                    n.classList.add("rates-table_active");
            }
            const e = document.querySelectorAll(".rates-tab_active");
            e.length > 0 &&
                e.forEach((t) => {
                    t.classList.remove("rates-tab_active");
                }),
                s.currentTarget.classList.add("rates-tab_active");
        });
    });
const i = document.querySelector("#home-search");
if (i) {
    const r = document.querySelector(".search-hints");
    i.addEventListener("click", function (c) {
        r &&
            (r.classList.contains("search-hints_active") ||
                r.classList.add("search-hints_active"));
    }),
        document.body.addEventListener("click", function (c) {
            c.target.outerHTML &&
                !r.contains(c.target) &&
                i !== c.target &&
                r.classList.remove("search-hints_active");
        });
    const s = document.querySelectorAll(".search-variants li");
    s.length > 0 &&
        s.forEach((c) => {
            c.addEventListener("click", function (n) {
                n.preventDefault();
                const e = n.currentTarget.textContent;
                (i.value = e), r.classList.remove("search-hints_active");
            });
        });
}
