<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold"><a href="<?= base_url('input/view'); ?>"><?= $title; ?></a> <small class="text-info"></small></h1>
    <?= $this->session->flashdata('message'); ?>
    <!-- Pengawasan Harian Bibit Tahap I -->
    <?php
    $datalokBibit = $this->loask->getBibitUserPertama($user['id_user']);
    ?>
    <?php if (!empty($datalokBibit)) {
    ?>
        <div class="card shadow mb-4">
            <a href="#collapseBibitTS" title="Klik untuk memperkecil dan memperbesar" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseBibitTS">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-list-ol"></i> Pengawasan Harian Bibit (Tahap I)</h6>
            </a>
            <div class="collapse show" id="collapseBibitTS">
                <div class="card-body">
                    <div class="row">
                        <?php
                        $i = 1;
                        foreach ($datalokBibit as $lokbibit) : ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-200 ml-0">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-1">
                                                <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Kabupaten</div>
                                                <div class="h1 mb-0 font-weight-bold text-capitalize text-gray-800"><?= $lokbibit['nm_kabupaten']; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-map-marker-alt fa-3x  text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="text card-footer btn-icon-split btn-sm text-lg" href="<?= base_url('input/viewdetailpengawasanbibitpertama/') . $lokbibit['id_kabupaten']; ?>" title="Lihat Detail Pengawasan ">
                                        <span class="text font-weight-bold"> Lihat Data</span>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } ?>
    <!-- pengawasan harian  -->
    <div class="card shadow mb-4">
        <a href="#collapseBahan" title="Klik untuk memperkecil dan memperbesar" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseBahan">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-list-ol"></i> Hasil Pengawasan Harian </h6>
        </a>
        <div class="collapse show" id="collapseBahan">
            <div class="card-body">
                <div class="table-responsive " style="font-family: Calibri;">
                    <table class="table table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr class="text-center table-active text-lg">
                                <th>No</th>
                                <th>Lokasi</th> <!-- Kab.Kec.Des -->
                                <th>Blok/Petak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($lokasi as $value) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="font-weight-bold">Kab. <?= $value['nm_kabupaten'] . " <br> Kec. " . $value['nm_kecamatan'] . "<br> Desa " . $value['nm_desa']; ?></td>
                                    <td>
                                        <div class="row">
                                            <?php
                                            $diblok = 0;
                                            $desblok = $this->loaskAnggota->getBlokHarian($value['id_desa'], $user['id_user']);
                                            foreach ($desblok as $blok) {
                                                $blokpetak = $this->loaskAnggota->LoadPetak($blok['id_blok'], $user['id_user']);
                                            ?>
                                                <div class="col-sm-12">
                                                    <ul style="list-style-type:circle;" class="pl-4 m-0 mb-1 border-bottom-info">
                                                        <li class="text-info">
                                                            Kab. <?= $value['nm_kabupaten'] . ", Kec. " . $value['nm_kecamatan'] . ", Desa " . $value['nm_desa']; ?>, <b><?= $blok['nm_blok']; ?></b>
                                                            <ul style="list-style-type:disc">
                                                                <div class="row font-weight-bold">
                                                                    <?php
                                                                    foreach ($blokpetak as $petak) {
                                                                    ?>
                                                                        <div class="col-sm-2 btn-light m-1">
                                                                            <a href="<?= base_url('input/viewdetailpengawasan/') . $value['id_kabupaten'] . "-" . $value['id_kecamatan'] . "-" . $value['id_desa'] . "-" . $blok['id_blok'] . "-" . $petak['id_petak'] . "-" . $user['id_user']; ?>" class="" title="Lihat Laporan Harian">
                                                                                <li>
                                                                                    <?= $petak['nm_petak']; ?>
                                                                                </li>
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->