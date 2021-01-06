<div class="bg-gradient-primary text-white p-2 text-center"><b>Grafik Aktivitas Kegiatan Pengawasan Tally Sheet</b></div>
<div class="chart-area">
    <canvas id="myAreaChartTallysheet"></canvas>
</div>
<hr>
<div class="bg-gradient-success text-white p-2 text-center"><b>Grafik Jumlah Bibit</b></div>
<div class="chart-area">
    <canvas id="myAreaChartTallysheetBibit"></canvas>
</div>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart myAreaChartTallysheet
    var ctx = document.getElementById("myAreaChartTallysheet");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php
                foreach ($tgltallysheet as $value) {
                    echo '"' . $value['tgltally'] . '",';
                }
                ?>
            ],
            datasets: [{
                label: "Kegiatan Pengawasan ",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [
                    <?php
                    foreach ($tgltallysheet as $val) {
                        $jumtgl = $this->report->getKegiatanTallysheet($val['tgltally']);
                        echo $jumtgl['jum'] . ", ";
                    }
                    ?>
                ],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return 'Vol ' + number_format(value);
                        }
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgba(255,255,255, 0.9)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 20,
                borderColor: '#dddfeb',
                borderWidth: 2,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': Vol ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });

    // Area Chart myAreaChartBibit
    var ctxx = document.getElementById("myAreaChartTallysheetBibit");
    var myLineChart = new Chart(ctxx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                foreach ($bibitsheet as $value) {
                    echo '"' . $value['nm_bibit'] . '",';
                }
                ?>
            ],
            datasets: [{
                label: "Jumlah Bibit ",
                lineTension: 0.3,
                backgroundColor: "rgba(10, 209, 133, 0.6)",
                borderColor: "rgba(10, 209, 133, 0.6)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(101, 303, 444, 0.9)",
                pointBorderColor: "rgba(101, 303, 444, 0.9)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(18, 77, 72, 0.3)",
                pointHoverBorderColor: "rgba(18, 77, 72, 0.3)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [
                    <?php
                    foreach ($bibitsheet as $val) {
                        $jumtgl = $this->report->getBibitTotal($val['id_bibit']);
                        $total = $jumtgl['pertama'] + $jumtgl['kedua'] + $jumtgl['ketiga'];
                        echo $total . ", ";
                    }
                    ?>
                ],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return 'Vol ' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [0],
                        zeroLineBorderDash: [0]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgba(255,255,255, 0.9)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 20,
                borderColor: '#dddfeb',
                borderWidth: 2,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' Batang';
                    }
                }
            }
        }
    });
</script>