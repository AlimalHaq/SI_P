<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 font-weight-bold text-primary"><?= $title; ?> - Laporan Kegiatan Pengawasan Harian</h1>

    <div class="card">
        <div class="row no-gutters">
            <div class="col-sm-2">
                <div class="list-group" id="list-tab" role="tablist">
                    <?php
                    foreach ($kabupaten as $kab) {
                    ?>
                        <a class="list-group-item list-group-item-action" id="list-<?= $kab['id_kabupaten']; ?>-list" data-toggle="list" href="#list-<?= $kab['id_kabupaten']; ?>" role="tab" aria-controls="<?= $kab['id_kabupaten']; ?>"><i class="fas fa-fw fa-check-square"></i> <?= $kab['nm_kabupaten']; ?></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="" role="tabpanel" aria-labelledby=""><br>
                        <div class="text-center">
                            <h1 class="text-gray-900 mb-2 display-4">Pilih Kabupaten!</h1>
                        </div>
                    </div>
                    <?php
                    foreach ($kabupaten as $kab) {
                    ?>
                        <div class="tab-pane fade" id="list-<?= $kab['id_kabupaten']; ?>" role="tabpanel" aria-labelledby="list-<?= $kab['id_kabupaten']; ?>-list">
                            <div class="accordion" id="accordion<?= $kab['id_kabupaten']; ?>">
                                <?php
                                // Tampilkan Kecamatan 
                                $ka = $kab['id_kabupaten'];
                                $nom = 1;
                                $kec = $this->db->get_where('dt_kecamatan', ['id_kabupaten' => $ka])->result_array();
                                foreach ($kec as $valKec) {
                                    $show = ($nom == 1) ? "show" : "hide";
                                ?>
                                    <div class="card">
                                        <div class="card-header" id="heading<?= $valKec['id_kecamatan']; ?>">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $valKec['id_kecamatan']; ?>" aria-expanded="true" aria-controls="collapse<?= $valKec['id_kecamatan']; ?>">
                                                    Kecamatan <?= $valKec['nm_kecamatan']; ?>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapse<?= $valKec['id_kecamatan']; ?>" class="collapse <?= $show; ?>" aria-labelledby="heading<?= $valKec['id_kecamatan']; ?>" data-parent="#accordion<?= $kab['id_kabupaten']; ?>">
                                            <div class="card-body">
                                                <!-- Tampilkan Desa  -->
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                            <?php
                                                            $nod = 1;
                                                            $desa = $this->db->get_where('dt_desa', ['id_kecamatan' => $valKec['id_kecamatan']])->result_array();
                                                            foreach ($desa as $valDes) {
                                                                $active = ($nod == 1) ? "active" : " ";
                                                                $selected = ($nod == 1) ? "true" : "false";
                                                            ?>
                                                                <a class="text-info nav-link <?= $active; ?>" id="v-pills-<?= $valDes['id_desa']; ?>-tab" data-toggle="pill" href="#v-pills-<?= $valDes['id_desa']; ?>" role="tab" aria-controls="v-pills-<?= $valDes['id_desa']; ?>" aria-selected="<?= $selected; ?>"><b> - Desa <?= $valDes['nm_desa']; ?></b>
                                                                    <p class="text-xs"> <?= $valDes['ket_desa']; ?></p>
                                                                </a>
                                                            <?php
                                                                $nod++;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9 border-left-info ">
                                                        <div class="tab-content" id="v-pills-tabContent">
                                                            <?php
                                                            $nodv = 1;
                                                            foreach ($desa as $valDes) {
                                                                $active = ($nodv == 1) ? "show active" : " ";
                                                                $getBlok = $this->loask->getBlokHarian($kab['id_kabupaten'], $valKec['id_kecamatan'], $valDes['id_desa']);
                                                            ?>
                                                                <div class="tab-pane fade <?= $active; ?>" id="v-pills-<?= $valDes['id_desa']; ?>" role="tabpanel" aria-labelledby="v-pills-<?= $valDes['id_desa']; ?>-tab">
                                                                    <div class="card-header">
                                                                        <h6 class="m-0 text-success">
                                                                            Desa <?= $valDes['nm_desa'] . ", Kec. " . $valKec['nm_kecamatan'] . ", Kab. " . $kab['nm_kabupaten']; ?>
                                                                        </h6>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <p>
                                                                            <?php foreach ($getBlok as $blok) {
                                                                            ?>
                                                                                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseBlok<?= $blok['id_blok']; ?>" aria-expanded="false" aria-controls="collapseBlok<?= $blok['id_blok']; ?>">
                                                                                    <?= $blok['nm_blok']; ?>
                                                                                </button>
                                                                            <?php
                                                                            } ?>
                                                                        </p>
                                                                        <?php foreach ($getBlok as $blok) {
                                                                            $getPetak = $this->loask->LoadPetak($kab['id_kabupaten'], $valKec['id_kecamatan'], $valDes['id_desa'], $blok['id_blok']);
                                                                        ?>
                                                                            <div class="collapse m-1" id="collapseBlok<?= $blok['id_blok']; ?>">
                                                                                <div class="card card-body text-dark">
                                                                                    <?= $blok['nm_blok'] . ", Desa " . $valDes['nm_desa'] . ", Kec. " . $valKec['nm_kecamatan'] . ", Kab. " . $kab['nm_kabupaten']; ?>
                                                                                    <hr>
                                                                                    <div class="row">
                                                                                        <?php foreach ($getPetak as $valPetak) {
                                                                                        ?>
                                                                                            <a href="<?= base_url('report/harian/') . $kab['id_kabupaten'] . "-" . $valKec['id_kecamatan'] . "-" . $valDes['id_desa'] . "-" . $blok['id_blok'] . "-" . $valPetak['id_petak']; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Lihat Laporan Harian <?= $blok['nm_blok'] . ", " . $valPetak['nm_petak']; ?>" class="col-sm-2 btn btn-light m-1"><?= $valPetak['nm_petak']; ?></a>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                        } ?>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                                $nodv++;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $nom++;
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="card shadow mb-4">
        <div class="card-header">
            <b>TALLY SHEET BIBIT</b>
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($tallysheet as $value) { ?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-200 ml-0">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-1">
                                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Kabupaten</div>
                                        <div class="h1 mb-0 font-weight-bold text-capitalize text-gray-800"><?= $value['nm_kabupaten'] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-map-marker-alt fa-3x  text-primary"></i>
                                    </div>
                                </div>
                            </div>
                            <a class="text card-footer btn-icon-split btn-sm text-lg" href="<?= base_url('report/tallysheet/') . $value['id_kabupaten']; ?>" title="Lihat Detail Pengawasan ">
                                <span class="text font-weight-bold"> Lihat Data</span>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="card-footer">
            <?php include 'grafikpengawasantallysheet.php'; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->