! function(o) {
    "use strict";

    function e() { this.$body = o("body"), this.charts = [] }
    e.prototype.initCharts = function() {
            window.Apex = {
                chart: {
                    parentHeightOffset: 0,
                    toolbar: { show: !1 }
                },
                grid: { padding: { left: 0, right: 0 } },
                colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
            };

            var e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
                t = o("#revenue-chart").data("colors");
            t && (e = t.split(","));
            var r = {
                chart: {
                    height: 364,
                    type: "line",
                    dropShadow: { enabled: !0, opacity: .2, blur: 7, left: -7, top: 7 }
                },
                dataLabels: { enabled: !1 },
                stroke: { curve: "smooth", width: 4 },
                series: [{ name: "Esta Semana", data: saldo_esta_semana },
                    { name: "Semana Passada", data: semana_passada }
                ],
                colors: e,
                zoom: { enabled: !1 },
                legend: { show: !1 },
                xaxis: {
                    type: "string",
                    categories: ["Seg", "Ter", "Quar", "Quin", "Sex", "Sab", "Dom"],
                    tooltip: { enabled: !1 },
                    axisBorder: { show: !1 }
                },
                yaxis: { labels: { formatter: function(e) { return e }, offsetX: -15 } }
            };
            new ApexCharts(document.querySelector("#revenue-chart"), r).render();


            e = ["#727cf5", "#e3eaef"];
            (t = o("#high-performing-product").data("colors")) && (e = t.split(","));
            r = {
                chart: {
                    height: 257,
                    type: "bar",
                    stacked: !0
                },
                plotOptions: { bar: { horizontal: !1, columnWidth: "20%" } },
                dataLabels: { enabled: !1 },
                stroke: { show: !0, width: 2, colors: ["transparent"] },
                series: [{ name: "Total", data: total }],
                zoom: { enabled: !1 },
                legend: { show: !1 },
                colors: e,
                xaxis: {
                    categories: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                    axisBorder: { show: !1 }
                },
                yaxis: { labels: { formatter: function(e) { return e }, offsetX: -15 } },
                fill: { opacity: 1 },
                tooltip: {
                    y: {
                        formatter: function(e) {

                            return "€" + e
                        }
                    }
                }
            };
            new ApexCharts(document.querySelector("#high-performing-product"), r).render();

            e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
            (t = o("#average-sales").data("colors")) && (e = t.split(","));

            r = {
                chart: { height: 208, type: "donut" },
                legend: { show: !1 },
                stroke: { colors: ["transparent"] },
                series: [44, 55, 41, 17],
                labels: ["Direct", "Affilliate", "Sponsored", "E-mail"],
                colors: e,
                responsive: [{ breakpoint: 480, options: { chart: { width: 200 }, legend: { position: "bottom" } } }]
            };
            new ApexCharts(document.querySelector("#average-sales"), r).render()
        },
        e.prototype.initMaps = function() {
            0 < o("#world-map-markers").length && o("#world-map-markers").vectorMap({
                map: "world_mill_en",
                normalizeFunction: "polynomial",
                hoverOpacity: .7,
                hoverColor: !1,
                regionStyle: { initial: { fill: "#e3eaef" } },
                markerStyle: {
                    initial: {
                        r: 9,
                        fill: "#727cf5",
                        "fill-opacity": .9,
                        stroke: "#fff",
                        "stroke-width": 7,
                        "stroke-opacity": .4
                    },
                    hover: { stroke: "#fff", "fill-opacity": 1, "stroke-width": 1.5 }
                },
                backgroundColor: "transparent",
                markers: [{ latLng: [45.89997479, 6.116670287], name: "França" }, { latLng: [40.64100311, -8.650997534], name: "Portugal" },
                    { latLng: [55.93329002, -4.750030763], name: "Inglatera" }, { latLng: [53.00000109, 6.550002585], name: "Holanda" }
                ],
                zoomOnScroll: !1
            })
        },

        e.prototype.init = function() {
            o("#dash-daterange").daterangepicker({ singleDatePicker: !0 }), this.initCharts(), this.initMaps()
        }, o.Dashboard = new e, o.Dashboard.Constructor = e
}(window.jQuery),
function(t) {
    "use strict";
    t(document).ready(function(e) { t.Dashboard.init() })
}(window.jQuery);