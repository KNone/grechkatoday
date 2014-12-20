define(['jquery', 'chartjs'], function ($, Chart) {
    'use strict';
    var chartPainter = {
        context: '',
        $chartBlock: '',
        $weekButton: '',
        $monthButton: '',
        currentLine: '',
        init: function ($chartBlock) {
            chartPainter.$chartBlock = $chartBlock;
            chartPainter.context = $('canvas', $chartBlock).get(0).getContext('2d');
            chartPainter.$weekButton = $('.k-chart-button-week', $chartBlock);
            chartPainter.$monthButton = $('.k-chart-button-month', $chartBlock);
            chartPainter.drawChartByWeek();
            chartPainter.initButtons();
        },
        initButtons: function () {
            chartPainter.$weekButton.on('click', function () {
                chartPainter.drawChartByWeek();
            });
            chartPainter.$monthButton.on('click', function () {
                chartPainter.drawChartByMonth();
            });
        },
        prepareJson: function (json) {
            var data = {
                labels: [],
                values: []
            };
            for (var i = 0; i < json.length; ++i) {
                data.labels.push(json[i].date);
                data.values.push(json[i].value);
            }

            return data;
        },
        drawChart: function (json) {
            var data = chartPainter.prepareJson(json);
            var chartData = {
                labels: data.labels,
                datasets: [
                    {
                        label: "",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: data.values
                    }
                ]
            };

            if (chartPainter.currentLine !== '') {
                chartPainter.currentLine.clear();
                chartPainter.currentLine.destroy();
            }
            chartPainter.currentLine = new Chart(chartPainter.context).Line(
                chartData,
                {
                    scaleShowGridLines: false,
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    scaleGridLineWidth: 1,
                    bezierCurve: false,
                    pointDot: true,
                    pointDotRadius: 4,
                    pointDotStrokeWidth: 1,
                    pointHitDetectionRadius: 4,
                    datasetStroke: true,
                    datasetStrokeWidth: 2,
                    datasetFill: true
                }
            );

        },
        drawChartByWeek: function () {
            chartPainter.$weekButton.attr('disabled', 'disabled');
            chartPainter.$monthButton.removeAttr('disabled');
            chartPainter.loadPrices('week', function (json) {
                chartPainter.drawChart(json);
            })
        },
        drawChartByMonth: function () {
            chartPainter.$monthButton.attr('disabled', 'disabled');
            chartPainter.$weekButton.removeAttr('disabled');
            chartPainter.loadPrices('month', function (json) {
                chartPainter.drawChart(json);
            })
        },
        loadPrices: function (interval, successCallback) {
            $.ajax({
                url: '/api/price/statistics/' + interval,
                type: 'post'
            }).success(function (json) {
                successCallback(json);
            });
        }
    };

    return chartPainter;
});