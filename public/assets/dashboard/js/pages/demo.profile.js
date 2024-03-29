! function(l) {
    "use strict";

    function t() { this.$body = l("body"), this.charts = [] }
    t.prototype.respChart = function(e, r, a, o) {
        var n = Chart.controllers.bar.prototype.draw;
        Chart.controllers.bar = Chart.controllers.bar.extend({
                draw: function() {
                    n.apply(this, arguments);
                    var t = this.chart.chart.ctx,
                        e = t.fill;
                    t.fill = function() {
                        t.save(),
                            t.shadowColor = "rgba(0,0,0,0.01)",
                            t.shadowBlur = 20,
                            t.shadowOffsetX = 4,
                            t.shadowOffsetY = 5,
                            e.apply(this, arguments),
                            t.restore()
                    }
                }
            }),
            Chart.defaults.global.defaultFontColor = "#8391a2",
            Chart.defaults.scale.gridLines.color = "#8391a2";
        var s = e.get(0).getContext("2d"),
            i = l(e).parent();
        return function() {
            var t;
            switch (e.attr("width", l(i).width()), r) {
                case "Line":
                    t = new Chart(s, { type: "line", data: a, options: o });
                    break;
                case "Doughnut":
                    t = new Chart(s, { type: "doughnut", data: a, options: o });
                    break;
                case "Pie":
                    t = new Chart(s, { type: "pie", data: a, options: o });
                    break;
                case "Bar":
                    t = new Chart(s, { type: "bar", data: a, options: o });
                    break;
                case "Radar":
                    t = new Chart(s, { type: "radar", data: a, options: o });
                    break;
                case "PolarArea":
                    t = new Chart(s, { data: a, type: "polarArea", options: o })
            }
            return t
        }()
    }, t.prototype.initCharts = function() {
        var t, e;
        0 < l("#high-performing-product").length &&
            ((t = document.getElementById("high-performing-product").getContext("2d").createLinearGradient(0, 500, 0, 150)).addColorStop(0, "#fa5c7c"),
                t.addColorStop(1, "#727cf5"), e = {
                    labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                    datasets: [{
                            label: "Este Ano",
                            backgroundColor: t,
                            borderColor: t,
                            hoverBackgroundColor: t,
                            hoverBorderColor: t,
                            data: este_ano
                        },
                        {
                            label: "Ano Passado",
                            backgroundColor: "#e3eaef",
                            borderColor: "#e3eaef",
                            hoverBackgroundColor: "#e3eaef",
                            hoverBorderColor: "#e3eaef",
                            data: ano_passado
                        }
                    ]
                }, [].push(this.respChart(l("#high-performing-product"), "Bar", e, {
                    maintainAspectRatio: !1,
                    datasets: { bar: { barPercentage: .7, categoryPercentage: .5 } },
                    legend: { display: !1 },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !1,
                                color: "rgba(0,0,0,0.05)"
                            },
                            stacked: !1,
                            ticks: { stepSize: 20 }
                        }],
                        xAxes: [{
                            stacked: !1,
                            gridLines: { color: "rgba(0,0,0,0.01)" }
                        }]
                    }

                })))
    }, t.prototype.init = function() {
        var e = this;
        Chart.defaults.global.defaultFontFamily = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            e.charts = this.initCharts(), l(window).on("resize",
                function(t) {
                    l.each(e.charts,
                        function(t, e) { try { e.destroy() } catch (t) {} }), e.charts = e.initCharts()
                })
    }, l.Profile = new t, l.Profile.Constructor = t
}(window.jQuery),
function() {
    "use strict";
    window.jQuery.Profile.init()
}();