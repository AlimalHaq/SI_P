<?php
$realisasi = $this->report->LoadHarianRealisasi($lokasi['id_petak']);
$tglbahan = $this->report->LoadKueriHarianTglBahan($lokasi['id_petak']);
$tglbibit = $this->report->LoadKueriHarianTglBibitNotin($lokasi['id_petak']);
$tgllapangan = $this->report->LoadKueriHarianTglLapangan($lokasi['id_petak']);
?>
<div class="row">
    <div class="col-xl-5 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-chart-pie"></i> Persentase Realisasi Jenis Kegiatan</h6>
            </div>
            <div class="card-body">
                <canvas id="myChart" width="100%" height="100%" style="padding: 30px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-7 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-chart-line"></i> History Kegiatan Pengawasan</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChartLine"></canvas>
                </div>

                <script>
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
                    // Tes 2 
                    var ctx = document.getElementById("myChart");
                    var myChart = new Chart(ctx, {
                        type: 'polarArea',
                        data: {
                            labels: ["Bahan", "Bibit", "Lapangan"],
                            datasets: [{
                                label: 'Realisasi',
                                data: ['<?= $realisasi['bahanreal']; ?>', '<?= $realisasi['bibitreal']; ?>', '<?= $realisasi['lapanganreal']; ?>'],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.6)',
                                    'rgba(54, 162, 235, 0.6)',
                                    'rgba(255, 206, 86, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(153, 102, 255, 0.6)',
                                    'rgba(255, 159, 64, 0.6)'
                                ],
                                borderColor: [
                                    'rgba(255,99,0,1)',
                                    'rgba(54, 162, 0, 1)',
                                    'rgba(255, 206, 0, 1)',
                                    'rgba(75, 192, 0, 1)',
                                    'rgba(153, 102, 0, 1)',
                                    'rgba(255, 159, 0, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scale: {
                                ticks: {
                                    beginAtZero: true,
                                },
                            },
                            animation: {
                                animateRotate: true,
                                animateScale: true
                            },
                            legend: {
                                display: true,
                                // position: 'right',
                            },
                            tooltips: {
                                display: true,
                                backgroundColor: "rgba(0,0,0, 0.9)",
                                bodyFontColor: "#ffffff",
                                titleMarginBottom: 10,
                                titleFontColor: '#ffffff',
                                titleFontSize: 20,
                                bodyFontSize: 18,
                                borderColor: '#dddfeb',
                                borderWidth: 2,
                                xPadding: 15,
                                yPadding: 14,
                                displayColors: true,
                                intersect: true,
                                mode: 'index',
                                caretPadding: 10,
                                callbacks: {
                                    label: function(tooltipItem, chart) {
                                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                        return datasetLabel + ' : ' + number_format(tooltipItem.yLabel, 2, ',', '.') + '% (Persen)';
                                    }
                                }
                            },
                            pieceLabel: {
                                render: function(args) {
                                    return args.label + " " + Math.round(args.value) + "%";
                                },
                                fontColor: '#4f0202',
                                fontSize: 16,
                                position: 'inside',
                                segment: true
                            },

                        }
                    });

                    // Area Chart myAreaChartBibit
                    var ctx = document.getElementById("myAreaChartLine");
                    var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [
                                <?php
                                $res = array();
                                foreach ($tglbahan as $value) {
                                    // echo '"' . $value['tglbahan'] . '",';
                                    $res[] = $value['tglbahan'];
                                }
                                foreach ($tglbibit as $valuebi) {
                                    // echo  '"' . $valuebi['tglbibit'] . '",';
                                    $res[] = $valuebi['tglbibit'];
                                }
                                foreach ($tgllapangan as $valuela) {
                                    // echo '"' . $valuela['tgllapangan'] . '",';
                                    $res[] = $valuela['tgllapangan'];
                                }
                                $angka = ($res);
                                //mengurutkan angka dengan fungsi sort()
                                sort($angka);
                                //menampilkan isi array angka dengan looping for
                                $jumlah = count($angka);
                                for ($x = 0; $x < $jumlah; $x++) {
                                    echo '"' . $angka[$x] . '",';
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
                                    $noq = 0;
                                    $resq = array();
                                    foreach ($tglbahan as $value) {
                                        $resq[] = $value['tglbahan'];
                                    }
                                    foreach ($tglbibit as $valuebi) {
                                        $resq[] = $valuebi['tglbibit'];
                                    }
                                    foreach ($tgllapangan as $valuela) {
                                        $resq[] = $valuela['tgllapangan'];
                                    }
                                    $angkaq = ($resq);
                                    sort($angkaq);
                                    $jumlahq = count($angkaq);
                                    for ($xq = 0; $xq < $jumlahq; $xq++) {
                                        $nilaix = $this->report->LoadKueriHarianTglNilai($lokasi['id_petak'], $angkaq[$xq]); //petak dan tanggalnya
                                        echo $nilaix['nilai'] . ',';
                                        $noq = $noq + $nilaix['nilai'];
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
                                        maxTicksLimit: 15
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        maxTicksLimit: 7,
                                        padding: 10,
                                        // Include a dollar sign in the ticks
                                        callback: function(value, index, values) {
                                            return 'Vol ' + number_format(value);
                                        }
                                    }
                                }],
                            },

                            animation: {
                                duration: 7,
                                onComplete: function() {
                                    var chartInstance = this.chart,
                                        ctx = chartInstance.ctx;
                                    ctx.textAlign = 'center';
                                    ctx.fillStyle = "rgba(0, 99, 132, 0.6)";
                                    ctx.textBaseline = 'bottom';

                                    this.data.datasets.forEach(function(dataset, i) {
                                        var meta = chartInstance.controller.getDatasetMeta(i);
                                        meta.data.forEach(function(bar, index) {
                                            var data = dataset.data[index];
                                            ctx.fillText(data, bar._model.x, bar._model.y - 8);

                                        });
                                    });
                                }
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                backgroundColor: "rgba(0,0,0, 0.9)",
                                bodyFontColor: "#ffffff",
                                titleMarginBottom: 10,
                                titleFontColor: '#ffffff',
                                titleFontSize: 20,
                                bodyFontSize: 18,
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
                                        return datasetLabel + ' : ' + number_format(tooltipItem.yLabel) + ' Aktivitas';
                                    }
                                }
                            }
                        }
                    });

                    // tes lagi 
                    // angular.module("app", ["chart.js"]).controller("ChartCtrl", function($scope) {

                    //     $scope.labels = ["January", "February", "March", "April", "May", "June", "July"];

                    //     $scope.data = [65, 59, 80, 81, 56, 55, 40];
                    //     var sum = $scope.data.reduce(function add(a, b) {
                    //         return a + b;
                    //     }, 0);
                    //     $scope.options = {
                    //         pieceLabel: {
                    //             render: function(args) {
                    //                 return args.label + " " + Math.round(args.value * 100 / sum, 2) + "%";
                    //             },
                    //             fontColor: '#000',
                    //             position: 'outside',
                    //             segment: true
                    //         },
                    //         legend: {
                    //             display: true
                    //         },
                    //     };
                    // });
                </script>
                <hr>
                <div class="alert alert-primary" role="alert">
                    Total <b><?= $noq; ?></b> Kegiatan Pengawasan dalam <b><?= $jumlahq; ?></b> Hari!
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
<!-- <div class="col-sm-6">
        <div ng-app="app" ng-controller="ChartCtrl">
            <canvas id="pie" class="chart chart-polar-area" chart-data="data" chart-labels="labels" chart-options="options" width="100%" height="100%">
            </canvas>
        </div>
    </div> -->