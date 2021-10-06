<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-sm-10">
            <h1 class="h3 mb-4 text-gray-800 font-weight-bold"><a href="<?= base_url('report'); ?>"><?= $title; ?></a></h1>
        </div>
        <div class="col-sm-2 text-right">
            <a href="<?= base_url('report'); ?>" class="btn btn-info btn-sm" title="kembali ke halaman pengawasan harian"><i class="fas fa-fw fa-chevron-circle-left fa-sm"></i> kembali</a>
        </div>
    </div>
    <hr>
    <?= $this->session->flashdata('message'); ?>
    <!-- Query All Report -->
    <div class="card shadow mb-4">
        <a href="#reportHarian" title="Klik untuk memperkecil dan memperbesar" class="d-block card-header py-3">
            All Report
        </a>
        <div class="collapse show p-2 scrol" id="reportHarian">
            <div class="col-sm-12" style="min-width: 999px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 text-1x">
                            <small>
                                <table class="table table-sm">
                                    <tr>
                                        <th>Kabupaten</th>
                                        <th>Kecamatan</th>
                                        <th>Desa</th>
                                        <th>Blok</th>
                                        <th>Petak</th>
                                        <th>Kategori</th>
                                        <th>Jenis Kegiatan</th>
                                        <th>Satuan</th>
                                        <th>Rencana</th>
                                        <th>Bobot</th>
                                        <th>Progress</th>
                                        <th>Progress Bobot</th>
                                        <th>Kendala</th>
                                    </tr>
                                    <?php
                                    $lokasiPengawasan = $this->report->getPengawasanlokasi();
                                    foreach ($lokasiPengawasan as $keyKab) {
                                        // Bahan 
                                        $kegBahan = $this->report->getBahan($keyKab['id_petak']);
                                        // Bibit Kategori
                                        $kategori = $this->db->get_where('spkbibit', ['id_petak' => $keyKab['id_petak']])->result_array();
                                        // Lapangan
                                        $lapangan = $this->report->getLapangan($keyKab['id_petak']);

                                    ?>
                                        <tr>
                                            <td>
                                                <table>
                                                    <!-- untuk Bahan -->
                                                    <?php
                                                    foreach ($kegBahan as $value) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_kabupaten']; ?></td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td> <?= $keyKab['nm_kabupaten']; ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td> <?= $keyKab['nm_kabupaten']; ?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_kabupaten']; ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <!-- untuk bahan -->
                                                    <?php
                                                    foreach ($kegBahan as $value) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_kecamatan']; ?></td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td> <?= $keyKab['nm_kecamatan']; ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td> <?= $keyKab['nm_kecamatan']; ?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_kecamatan']; ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <!-- Untuk Bahan  -->
                                                    <?php
                                                    foreach ($kegBahan as $value) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_desa']; ?></td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td> <?= $keyKab['nm_desa']; ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td> <?= $keyKab['nm_desa']; ?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_desa']; ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <!-- untuk bahan -->
                                                    <?php
                                                    foreach ($kegBahan as $value) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_blok']; ?></td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td> <?= $keyKab['nm_blok']; ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td> <?= $keyKab['nm_blok']; ?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_blok']; ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <!-- Untuk Bahan -->
                                                    <?php
                                                    foreach ($kegBahan as $value) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_petak']; ?></td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td> <?= $keyKab['nm_petak']; ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td> <?= $keyKab['nm_petak']; ?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) { ?>
                                                        <tr>
                                                            <td><?= $keyKab['nm_petak']; ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <?php
                                                    foreach ($kegBahan as $value) { ?>
                                                        <tr>
                                                            <td>BAHAN-BAHAN</td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td>PENGADAAN BIBIT</td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td>PENGADAAN BIBIT</td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) { ?>
                                                        <tr>
                                                            <td>KEGIATAN DI LAPANGAN</td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <!-- Untuk Bahan -->
                                                    <?php
                                                    foreach ($kegBahan as $value) { ?>
                                                        <tr>
                                                            <td><?= $value['nm_kegiatan']; ?></td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td> <?= $valueKat['kategori']; ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td> - <?= $valueBibit['nm_bibit']; ?></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) { ?>
                                                        <tr>
                                                            <td><?= $valueLap['nm_kegiatan']; ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <?php
                                                    foreach ($kegBahan as $value) { ?>
                                                        <tr>
                                                            <td><?= $value['satuan']; ?></td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td> <?= $valueKat['satuan_spkbibit']; ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $valueBibit['satuan']; ?></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) { ?>
                                                        <tr>
                                                            <td><?= $valueLap['satuan']; ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <?php
                                                    foreach ($kegBahan as $value) { ?>
                                                        <tr>
                                                            <td><?= number_format($value['nilai_spkbahan'], 2, ',', '.'); ?></td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td> <?= number_format($valueKat['nilai_spkbibit'], 2, ',', '.'); ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) { ?>
                                                        <tr>
                                                            <td><?= number_format($valueLap['nilai_spklapangan'], 2, ',', '.'); ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <!-- Cari Bobot berdasarkan SPK -->
                                                <table>
                                                    <?php
                                                    foreach ($kegBahan as $value) {
                                                        $bobot = $this->bobot->getBobotHarian($value['id_kegiatan']); ?>
                                                        <tr>
                                                            <td> <?= number_format($bobot['bobot'], 2, ',', '.'); ?> </td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                        $bobotBi = $this->bobot->getBobotHarianBibit($valueKat['kategori']); ?>
                                                        <tr>
                                                            <td> <?= number_format($bobotBi['bobot'], 2, ',', '.'); ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) {
                                                        $bobotLa = $this->bobot->getBobotHarianLap($valueLap['id_kegiatan']); ?>
                                                        <tr>
                                                            <td><?= number_format($bobotLa['bobot'], 2, ',', '.'); ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <!-- Cari Progressnya -->
                                                <table>
                                                    <?php
                                                    foreach ($kegBahan as $value) {
                                                        $nilai = $this->report->getBahanProgres($keyKab['id_petak'], $value['id_spkbahan']); ?>
                                                        <tr>
                                                            <td> <?= number_format($nilai['totnilai'], 2, ',', '.'); ?> </td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $realisasi = $this->report->getRealisasiBibitnya($valueKat['id_spkbibit']);
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td><?= number_format($realisasi['nilaibibit'], 0, ',', '.'); ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                            $progresbibit = $this->report->getBibitProgres($valueBibit['id_bibit'], $keyKab['id_petak']);
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <?= number_format($progresbibit['total'], 0, ',', '.'); ?></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) {
                                                        $progreslapangan = $this->report->getLapanganProgres($keyKab['id_petak'], $valueLap['id_spklapangan']);
                                                    ?>
                                                        <tr>
                                                            <td><?= number_format($progreslapangan['totnilai'], 2, '.', ','); ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <!-- Cari Progress Bobotnya -->
                                                <table>
                                                    <?php
                                                    foreach ($kegBahan as $value) {
                                                        $nilai = $this->report->getBahanProgres($keyKab['id_petak'], $value['id_spkbahan']);
                                                        $bobot = $this->bobot->getBobotHarian($value['id_kegiatan']);
                                                        $persentase = ($value['nilai_spkbahan'] == 0) ? 0 : ($nilai['totnilai'] / $value['nilai_spkbahan']) * $bobot['bobot']; ?>
                                                        <tr>
                                                            <td> <?= number_format($persentase, 2, ',', '.'); ?> </td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $realisasi = $this->report->getRealisasiBibitnya($valueKat['id_spkbibit']);
                                                        $bobotBi = $this->bobot->getBobotHarianBibit($valueKat['kategori']);
                                                        $persentaseBi = ($realisasi['nilaibibit'] == 0) ? '0' : $realisasi['nilaibibit'] / $valueKat['nilai_spkbibit'] * $bobotBi['bobot'];
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td><?= number_format($persentaseBi, 2, ',', '.'); ?></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                        ?>
                                                            <tr>
                                                                <td></td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) {
                                                        $progreslapangan = $this->report->getLapanganProgres($keyKab['id_petak'], $valueLap['id_spklapangan']);
                                                        $bobotLa = $this->bobot->getBobotHarianLap($valueLap['id_kegiatan']);
                                                        $persentaseLap = ($valueLap['nilai_spklapangan'] == 0) ? 0 : ($progreslapangan['totnilai'] / $valueLap['nilai_spklapangan']) * $bobotLa['bobot'];
                                                    ?>
                                                        <tr>
                                                            <td><?= number_format($persentaseLap, 2, ',', '.'); ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                            <td>
                                                <!-- Cari Keterangannya -->
                                                <table>
                                                    <?php
                                                    foreach ($kegBahan as $value) {
                                                        $ket = $this->report->getBahanKet($keyKab['id_petak'], $value['id_spkbahan']);
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                foreach ($ket as $valueket) {
                                                                    echo $valueket['keterangan'] . "- ";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr> <?php
                                                            } ?>
                                                    <!-- Untuk Bibit -->
                                                    <?php
                                                    foreach ($kategori as $valueKat) {
                                                        $bibit = $this->report->getBibit($valueKat['id_spkbibit']);
                                                    ?>
                                                        <tr>
                                                            <td></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($bibit as $valueBibit) {
                                                            $harianbibit = $this->db->get_where('harianbibit', ['id_bibit' => $valueBibit['id_bibit'], 'id_petak' => $keyKab['id_petak']])->result_array();
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <?php
                                                                    foreach ($harianbibit as $harbit) {
                                                                        echo $harbit['keterangan'] . ". ";
                                                                    } ?>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                    <!-- untuk lapangan  -->
                                                    <?php
                                                    foreach ($lapangan as $valueLap) {
                                                        $harianlapangan = $this->db->get_where('harianlapangan', ['id_spklapangan' => $valueLap['id_spklapangan'], 'id_petak' => $keyKab['id_petak']])->result_array();
                                                    ?>
                                                        <tr>
                                                            <td> <?php
                                                                    foreach ($harianlapangan as $ket) {
                                                                        echo $ket['keterangan'] . ". ";
                                                                    }
                                                                    ?></td>
                                                        </tr> <?php
                                                            }
                                                                ?>
                                                </table>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END All Report -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->