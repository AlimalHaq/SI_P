<div class="col-sm-12">
    <div class="card border-bottom-primary shadow h-200 ml-0">
        <div class="card-header">
            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-chart-bar"></i>Diagram Kemajuan Rehabilitasi DAS - Semua Kabupaten</h4>
        </div>
        <div class="card-body">
            <canvas id="GrafBarChart"></canvas>
        </div>
    </div>
</div>

<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#000';

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
    var ctx = document.getElementById('GrafBarChart').getContext('2d');
    var GrafBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            datasets: [{
                    label: 'Realisasi ',
                    data: [
                        <?php
                        foreach ($kabupaten as $value) {
                            $spkTotal = $this->report->LoadSPK($value['id_kabupaten']);
                            $spkReal = $this->report->LoadRealisasi($value['id_kabupaten']);
                            if ($spkReal['totalRealisasi'] == '') {
                                echo '0, ';
                            } else {
                                $nilai = ($spkReal['totalRealisasi'] / $spkTotal['totalSpk']) * 100;
                                echo '"' . round($nilai, 2) . '",';
                            }
                        }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(184, 8, 2, 2)',
                        'rgba(184, 87, 2, 2)',
                        'rgba(184, 157, 2, 2)',
                        'rgba(117, 184, 2, 2)',
                        'rgba(8, 184, 2, 2)',
                        'rgba(2, 126, 184, 2)',
                        'rgba(2, 60, 184, 2)',
                        'rgba(66, 2, 184, 2)',
                        'rgba(120, 2, 184, 2)',
                        'rgba(184, 2, 181, 2)',
                        'rgba(184, 2, 135, 2)',
                        'rgba(184, 2, 93, 2)',
                        'rgba(184, 2, 44, 2)',
                        'rgba(145, 0, 3, 2)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    fontSize: 20,

                },
                {
                    label: "Target Realisasi",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100],

                    // Changes this dataset to become a line
                    type: 'line'
                }
            ],
            labels: [
                <?php
                foreach ($kabupaten as $value) {
                    echo '"' . $value['nm_kabupaten'] . '",';
                }
                ?>
            ],
            fontSize: 20,
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        fontSize: 20,
                        beginAtZero: true,
                    }
                }]
            },
            legend: {
                display: false
            },
            pieceLabel: {
                fontColor: '#4f0202',
                fontSize: 20,
                position: 'inside',
                segment: true
            },
            animation: {
                duration: 6000,
                onComplete: function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;
                    ctx.textAlign = 'center';
                    ctx.fillStyle = "rgba(0, 0, 132, 1)";
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = number_format(dataset.data[index], '2', '.', ',') + "%";
                            ctx.fillText(data, bar._model.x, bar._model.y - 20);

                        });
                    });
                }
            },
        }
    });
</script>