<hr>
<canvas id="myChartas" class="batasi"></canvas>
<hr>
<script>
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
    var ctx = document.getElementById('myChartas').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            datasets: [{
                    label: 'Realisasi',
                    data: [
                        <?php
                        // load Realisasi Persentase bahan SPK/realisasi*bobot
                        $totPerBhn = 0;
                        $kegiatanbahanReal = $this->report->LoadKegiatanBahanKab($kab['id_kabupaten']);
                        foreach ($kegiatanbahanReal as $keyb) {
                            $SpkBahan = $this->report->LoadBahanHarianSpkKab($kab['id_kabupaten'], $keyb['id_kegiatan']);
                            $nilai = $this->bobot->getHarianBahan($keyb['id_kegiatan'], $keyb['id_kabupaten']);
                            $bobot = $this->bobot->getBobotHarian($keyb['id_kegiatan']);
                            $persentase = ($SpkBahan['spk'] == 0) ? 0 : ($nilai['getHarianBahan'] / $SpkBahan['spk']) * $bobot['bobot'];
                            $hasilPersen = $persentase / $bobot['bobot'] * 100;
                            echo '"' . round($hasilPersen, 2) . '",';
                            $totPerBhn = $totPerBhn + $persentase;
                        }
                        $persBahan = $totPerBhn;

                        // load Realisasi Persentase Bibit SPK/realisasi*bobot
                        $totPerBibit = 0;
                        $kegiatanBibitReal = $this->report->LoadKegiatanBibitKab($kab['id_kabupaten']);
                        foreach ($kegiatanBibitReal as $keyb) {
                            $SpkBibit = $this->report->LoadBibitKabSpkTotal($kab['id_kabupaten'], $keyb['kategori']);
                            $bobot = $this->bobot->getBobotHarianBibit($keyb['kategori']);
                            $persentase = ($SpkBibit['TotalSpk'] == 0) ? 0 : ($SpkBibit['totReal'] / $SpkBibit['TotalSpk']) * $bobot['bobot'];
                            $hasilPersen = $persentase / $bobot['bobot'] * 100;
                            echo '"' . round($hasilPersen, 2) . '",';
                            $totPerBibit = $totPerBibit + $persentase;
                        }
                        $persBibit = $totPerBibit + $persBahan;

                        // load Realisasi Persentase Lapangan SPK/realisasi*bobot
                        $totPerLap = 0;
                        $kegiatanLapReal = $this->report->LoadKegiatanLapanganKab($kab['id_kabupaten']);
                        foreach ($kegiatanLapReal as $keyLa) {
                            $SpkLap = $this->report->LoadLapanganHarianSpkKab($kab['id_kabupaten'], $keyLa['id_kegiatan']);
                            $nilai = $this->bobot->getHarianLap($keyLa['id_kegiatan'], $keyLa['id_kabupaten']);
                            $bobot = $this->bobot->getBobotHarian($keyLa['id_kegiatan']);
                            $persentase = ($SpkLap['spk'] == 0) ? 0 : ($nilai['getHarianLap'] / $SpkLap['spk']) * $bobot['bobot'];
                            $hasilPersen = $persentase / $bobot['bobot'] * 100;
                            // echo '"' . round($hasilPersen, 2) . '",';
                            echo '"' . round($hasilPersen, 2) . '",';
                            $totPerLap = $totPerLap + $persentase;
                        }
                        $persLap = $totPerLap + $persBibit;

                        ?>
                    ],
                    backgroundColor: 'rgba(54, 62, 235, 0.8)',
                    borderColor: 'rgba(54, 62, 235,7)',
                    pointRadius: 3,
                    // backgroundColor: 'rgba(154, 62, 235, 0.8)',
                    // borderColor: 'rgba(154, 62, 235,7)',
                },
                <?php
                // Realisasi berdasarkan Minggu Ini
                if (isset($_GET['tglmulai']) != "") {
                ?> {
                        label: "Minggu Ini",
                        fillColor: "rgba(82, 2, 2, 5)",
                        strokeColor: "rgba(82, 29, 2, 5)",
                        pointColor: "rgba(82, 29, 2, 5)",
                        pointStrokeColor: "#000",
                        pointHighlightFill: "#000",
                        pointHighlightStroke: "rgba(255, 159, 64, 5)",
                        backgroundColor: 'rgba(38, 77, 2, 0.8)',
                        borderColor: 'rgba(82, 2, 2,7)',
                        data: [
                            <?php
                            $dates = array();
                            $tglmulai = $_GET['tglmulai'];
                            $dates[] = $tglmulai;
                            for ($i = 1; $i < 7; $i++) {
                                $date = strtotime($tglmulai);
                                $date = strtotime("+" . $i . " day", $date);
                                $dates[] = date("Y-m-d", $date);
                            }
                            // Bahan 
                            foreach ($kegiatanbahanReal as $keyb) {
                                $Totalbahan = 0;
                                $SpkBahan = $this->report->LoadBahanHarianSpkKab($kab['id_kabupaten'], $keyb['id_kegiatan']);
                                foreach ($dates as $tgl) {
                                    $tglreal = $this->report->LoadBahanMingguan($keyb['id_kegiatan'], $tgl, $kab['id_kabupaten']);
                                    $Totalbahan = $Totalbahan + $tglreal;
                                }
                                $persenMingguIniBahan = ($Totalbahan == 0) ? 0 : ($Totalbahan / $SpkBahan['spk']) * 100;
                                echo '"' . round($persenMingguIniBahan, 2) . '",';
                            }
                            // Bibit
                            foreach ($kegiatanBibitReal as $keyb) {
                                $TotalBibit = 0;
                                $totSpk = $this->report->LoadBibitKabSpkTotal($kab['id_kabupaten'], $keyb['kategori']);
                                foreach ($dates as $tgl) {
                                    $realtgl = $this->report->LoadBibitHarianKabKat($kab['id_kabupaten'], $tgl, $keyb['kategori']);
                                    $TotalBibit = $TotalBibit + $realtgl;
                                }
                                $persenMingguIniBibit = ($TotalBibit == 0) ? 0 : ($TotalBibit / $totSpk['TotalSpk']) * 100;
                                echo '"' . round($persenMingguIniBibit, 2) . '",';
                            }
                            // Lapangan
                            foreach ($kegiatanLapReal as $keyLa) {
                                $TotalLapangan = 0;
                                $SpkLap = $this->report->LoadLapanganHarianSpkKab($kab['id_kabupaten'], $keyLa['id_kegiatan']);
                                foreach ($dates as $tgl) {
                                    $realtglLap = $this->report->LoadLapanganMingguan($keyLa['id_kegiatan'], $tgl, $kab['id_kabupaten']);
                                    $TotalLapangan = $TotalLapangan + $realtglLap;
                                }
                                $persenMingguIniLap = ($TotalLapangan == 0) ? 0 : ($TotalLapangan / $SpkLap['spk']) * 100;
                                echo '"' . round($persenMingguIniLap, 2) . '",';
                            }

                            ?>
                            // Changes this dataset to become a line
                        ],
                        type: 'line' //line
                    }
                <?php
                }
                ?>

            ],
            labels: [
                <?php
                // load kegiatan bahan 
                $kegiatanbahan = $this->report->LoadKegiatanBahanKab($kab['id_kabupaten']);
                foreach ($kegiatanbahan as $key) {
                    echo '"' . $key['nm_kegiatan'] . '",';
                }
                // Load Kegiatan Bibit 
                $kegiatanbibit = $this->report->LoadKegiatanBibitKab($kab['id_kabupaten']);
                foreach ($kegiatanbibit as $keyb) {
                    echo '"' . $keyb['kategori'] . '",';
                }
                // Load Kegiatan Lapangan 
                $kegiatanlapangan = $this->report->LoadKegiatanLapanganKab($kab['id_kabupaten']);
                foreach ($kegiatanlapangan as $keyl) {
                    echo '"' . $keyl['nm_kegiatan'] . '",';
                }
                ?>
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    boxWidth: 80,
                    fontColor: 'black',
                }
            },
            pieceLabel: {
                fontColor: '#4f0202',
                fontSize: 10,
                position: 'inside',
                segment: true
            },
            animation: {
                duration: 6000,
                fontSize: 10,
                onComplete: function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;
                    ctx.textAlign = 'center';
                    ctx.fillStyle = "rgba(0, 0, 0, 1)";
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = number_format(dataset.data[index], '2', '.', ',') + '%';
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);

                        });
                    });
                }
            },
        }
    });
</script>
<b>Total Realisasi : <?= round($persLap, 2) . "%"; ?></b>
<hr>