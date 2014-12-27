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
            chartPainter.$weekButton = $('.chart-button-week', $chartBlock);
            chartPainter.$monthButton = $('.chart-button-month', $chartBlock);
            chartPainter.drawChartByWeek();
            chartPainter.toggleButtonStyle(chartPainter.$weekButton);
            chartPainter.initButtons();
        },
        initButtons: function () {
            chartPainter.$weekButton.on('click', function (e) {
                e.preventDefault();
                chartPainter.toggleButtonStyle($(this));
                chartPainter.drawChartByWeek();
            });
            chartPainter.$monthButton.on('click', function (e) {
                e.preventDefault();
                chartPainter.toggleButtonStyle($(this));
                chartPainter.drawChartByMonth();
            });
        },
        toggleButtonStyle: function ($activeButton) {
            chartPainter.$monthButton.removeClass('active');
            chartPainter.$weekButton.removeClass('active');

            $activeButton.addClass('active');
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
                        fillColor: "rgba(100,182,177,0.2)",
                        strokeColor: "rgba(100,182,177,1)",
                        pointColor: "rgba(100,182,177,1)",
                        pointStrokeColor: "rgba(70,67,58,0)",
                        pointHighlightFill: "rgba(206,83,77,1)",
                        pointHighlightStroke: "rgba(206,83,77,0.2)",
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
                    scaleShowGridLines: true,
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
            chartPainter.$weekButton.parent('li').addClass('b-list__item_state_selected');
            chartPainter.$monthButton.parent('li').removeClass('b-list__item_state_selected');
            chartPainter.loadPrices('week', function (json) {
                chartPainter.drawChart(json);
            })
        },
        drawChartByMonth: function () {
            chartPainter.$monthButton.parent('li').addClass('b-list__item_state_selected');
            chartPainter.$weekButton.parent('li').removeClass('b-list__item_state_selected');
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