<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php
    if (empty($details['nm_kabupaten'])) {
        redirect('input/view');
    }
    $aprvBahan = "bahan";
    ?>
    <div class="row">
        <div class="col-sm-10">
            <h1 class="h3 mb-4 text-gray-800 font-weight-bold"><a href="<?= base_url('input/view'); ?>"><?= $title; ?></a> <small class="text-info">/Detail Bahan-bahan</small></h1>
        </div>
        <div class="col-sm-2 text-right">
            <a href="<?= base_url('input/view'); ?> " class="btn btn-sm btn-info" title="kembali ke halaman pengawasan harian"><i class="fas fa-fw fa-chevron-circle-left fa-sm"></i> kembali</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <a href="#collapseSpkbibit" title="Klik untuk memperkecil dan memperbesar" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSpkbibit">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-list"></i> Detail Pengawasan Harian Bahan | Kab. <?= $details['nm_kabupaten']; ?> | Kec. <?= $details['nm_kecamatan']; ?> | Desa <?= $details['nm_desa']; ?> | <?= $details['nm_blok']; ?> | <?= $details['nm_petak']; ?> | <?= $details['nm_user']; ?></h6>
        </a>
        <div class="collapse show" id="collapseSpkbibit">
            <div class="card-body" id="reportHarian">
                <div class="row">
                    <div class="row m-3">
                        <div class="col-sm-6">
                            <img class="img" src="<?= base_url('assets/'); ?>img/logo-si.png" alt="" width="50%">
                        </div>
                        <div class="col-sm-6 text-right">
                            <img class="img" src="<?= base_url('assets/'); ?>img/logo-vale.png" alt="" width="20%">
                        </div>
                    </div>
                    <div class="col-lg-12 text-center mb-4 font-weight-bold">
                        <h5 class="font-weight-bold">HASIL PENGAWASAN DAN PENILAIAN HARIAN</h5>
                        <h5 class="font-weight-bold">PEMBUATAN TANAMAN (P0) REHABILITASI DAS PT VALE INDONESIA,TBK</h5>
                        <hr>
                    </div>
                    <div class="col-lg-6 text-uppercase font-weight-bold">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td>Kabupaten</td>
                                <td>:</td>
                                <td><?= $details['nm_kabupaten']; ?></td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td>:</td>
                                <td><?= $details['nm_kecamatan']; ?></td>
                            </tr>
                            <tr>
                                <td>Desa</td>
                                <td>:</td>
                                <td><?= $details['nm_desa']; ?></td>
                            </tr>
                            <tr>
                                <td>Pelaksana</td>
                                <td>:</td>
                                <td>PTSI</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6 text-uppercase font-weight-bold">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td>Nama Petugas</td>
                                <td>:</td>
                                <td><?= $details['petugas_lap']; ?></td>
                            </tr>
                            <tr>
                                <td>Blok</td>
                                <td>:</td>
                                <td><?= $details['nm_blok']; ?></td>
                            </tr>
                            <tr>
                                <td>Petak</td>
                                <td>:</td>
                                <td><?= $details['nm_petak']; ?></td>
                            </tr>
                            <tr>
                                <td>Luas</td>
                                <td>:</td>
                                <td><?php
                                    $totalluasharian = $this->det->getDataPengawasanTotLuas($details['id_petak'], $details['id_user']);
                                    ?>
                                    <?= $totalluasharian['totluas']; ?> Ha
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-12 text-1x"><small>
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr class="text-center text-uppercase">
                                        <th>No</th>
                                        <th>Jenis Kegiatan</th>
                                        <th>Satuan</th>
                                        <th>Progress</th>
                                        <th>Bobot</th>
                                        <th>Kendala/Rekomendasi</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-left">I.</th>
                                        <th colspan="6">BAHAN-BAHAN</th>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    $TotPersentaseBh = 0;
                                    $datanx = $this->det->getDataPengawasanBahan($details['id_petak']);
                                    foreach ($datanx as $dat) {
                                        $totalnilaiharian = $this->det->getDataPengawasanTotNilai($dat['id_spkbahan'], $dat['id_petak']);
                                        $sql = $this->db->get_where('harianbahan', ['id_spkbahan' => $dat['id_spkbahan'], 'id_petak' => $details['id_petak'], 'id_user' => $details['id_user'],])->result_array();
                                        $bobot = $this->bobot->getBobotHarian($dat['id_kegiatan']);
                                        $persentase = ($dat['nilai_spkbahan'] == 0) ? 0 : ($totalnilaiharian['totnilai'] / $dat['nilai_spkbahan']) * $bobot['bobot'];
                                        $TotPersentaseBh = $TotPersentaseBh + $persentase;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $dat['nm_kegiatan']; ?></td>
                                            <td class="text-center"><?= $dat['satuan']; ?></td>
                                            <td class="text-center <?= ($dat['nilai_spkbahan'] < $totalnilaiharian['totnilai']) ? "text-warning" : ""; ?> <?= ($dat['nilai_spkbahan'] > $totalnilaiharian['totnilai']) ? "text-danger" : "text-success"; ?>" data-toggle="tooltip" data-placement="top" title="<?= number_format($totalnilaiharian['totnilai'], 2, '.', ','); ?> dari <?= number_format($dat['nilai_spkbahan'], 2, '.', ','); ?>"><?= number_format($totalnilaiharian['totnilai'], 2, '.', ','); ?></td>
                                            <td class="text-center <?= ($persentase >= $bobot['bobot']) ? "text-success" : "text-danger"; ?> " style='cursor:pointer' data-toggle='tooltip' data-placement="right" title="Dari <?= $bobot['bobot']; ?>">
                                                <?php
                                                echo round($persentase, 2) . "%";
                                                ?>
                                            </td>
                                            <td><?php
                                                foreach ($sql as $value) {
                                                    echo "- " . $value['keterangan'] . ".<br> ";
                                                } ?>
                                            </td>
                                            <td class="text-center">
                                                <small>
                                                    <a href="" class="badge badge-info p-2" data-toggle="modal" data-target="#Details<?= $dat['id_spkbahan']; ?>" title="Detail"><i class="fas fa-fw fa-info fa-1x"></i></a>
                                                </small>
                                                <!-- Modal Add SPK Kategori bibit-->
                                                <div class="modal fade" id="Details<?= $dat['id_spkbahan']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newRoleLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="newRoleLabel">Detail Kegiatan <b><?= $dat['nm_kegiatan']; ?></b></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body scrol">
                                                                <table class="table table-sm">
                                                                    <tr class="table-active">
                                                                        <th>*</th>
                                                                        <th>Tgl Pengawasan/Input</th>
                                                                        <th>Petugas</th>
                                                                        <th>Koordinat</th>
                                                                        <th>Progress</th>
                                                                        <th>Luas</th>
                                                                        <th>Keterangan</th>
                                                                        <th>Foto</th>
                                                                        <th>Approvals</th>
                                                                    </tr>
                                                                    <?php
                                                                    $ni = 1;
                                                                    foreach ($sql as $val) { ?>
                                                                        <tr>
                                                                            <td><?= $ni++; ?></td>
                                                                            <td><?= $val['tgl'] . "<br>" . date('m d Y', $val['tgl_create']); ?></td>
                                                                            <td><?= $val['petugas_lap']; ?></td>
                                                                            <td><?= $val['koordinat']; ?></td>
                                                                            <td><?= $val['nilai_harianbahan']; ?></td>
                                                                            <td><?= $val['luas']; ?></td>
                                                                            <td class="text-left"><?= $val['keterangan']; ?></td>
                                                                            <td>
                                                                                <center data-toggle="tooltip" data-placement="left" title="Klik untuk memperbesar.">
                                                                                    <?php
                                                                                    if (file_exists("assets/img/peng-bahan/" . $val['foto'])) { ?>
                                                                                        <button type="button" class="btn btn-info " data-toggle="modal" data-target="#fotoView<?= $val['id_harianbahan'] ?>" style="cursor:zoom-in">
                                                                                            <i class="fas fa-seedling fa-fa-3x"></i>
                                                                                        </button>
                                                                                    <?php
                                                                                    } else { ?>
                                                                                        <button type="button" class="btn btn-info text-sm">
                                                                                            Image not <br> found..
                                                                                        </button>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </center>
                                                                                <!-- Modal Foto View -->
                                                                                <div class="modal fade" id="fotoView<?= $val['id_harianbahan'] ?>" tabindex="-1" aria-labelledby="fotoView<?= $val['id_harianbahan'] ?>Label" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-xl" style="width: 100%;">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-body modal-open text-center m-0 p-0" style="background-color: transparent;">
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-bahan/" . $val['foto']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bahan/<?= $val['foto']; ?>" alt="" width="100%" title="<?= $val['foto']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                                <hr>
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-bahan/" . $val['foto_2']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bahan/<?= $val['foto_2']; ?>" alt="" width="100%" title="<?= $val['foto_2']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto_2']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                                <hr>
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-bahan/" . $val['foto_3']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bahan/<?= $val['foto_3']; ?>" alt="" width="100%" title="<?= $val['foto_3']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto_3']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                                <hr>
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-bahan/" . $val['foto_4']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bahan/<?= $val['foto_4']; ?>" alt="" width="100%" title="<?= $val['foto_4']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto_4']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                                <hr>
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-bahan/" . $val['foto_5']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bahan/<?= $val['foto_5']; ?>" alt="" width="100%" title="<?= $val['foto_5']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto_5']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <?php
                                                                                $usersupadmin = $this->db->get_where('user_role', ['id' => $user['role_id']])->row_array();
                                                                                if ($val['status'] == 1) {
                                                                                ?>
                                                                                    <div class="btn btn-success btn-icon-split">
                                                                                        <span class="icon text-white-50">
                                                                                            <i class="fas fa-check"></i>
                                                                                        </span>
                                                                                        <span class="text"> Approved</span>
                                                                                    </div>
                                                                                <?php
                                                                                } else if ($val['status'] == 2) {
                                                                                ?>
                                                                                    <div class="btn btn-warning btn-icon-split">
                                                                                        <span class="icon text-white-50">
                                                                                            &times;
                                                                                        </span>
                                                                                        <span class="text"> Rejected</span>
                                                                                    </div>
                                                                                <?php
                                                                                } elseif ($usersupadmin['id'] == '1' || $usersupadmin['id'] == '9' || $usersupadmin['id'] == '10') {
                                                                                ?>
                                                                                    <a class="btn btn-sm btn-info font-weight-bold" onclick="return confirm('Proses Approval pengawasan?')" href="<?= base_url('input/approve/') . $aprvBahan . "/" . $val['id_harianbahan'] . "/" . $urlx; ?>">
                                                                                        Approve
                                                                                    </a>
                                                                                    <hr class="m-1">
                                                                                    <a class="btn btn-sm btn-danger font-weight-bold" onclick="return confirm('Yakin akan me Reject Pengawasan ini? Reject akan menghapus dari daftar pengawasan harian.')" href="<?= base_url('input/reject/') . $aprvBahan . "/" . $val['id_harianbahan'] . "/"  . $urlx; ?>">
                                                                                        Reject
                                                                                    </a>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <div class="btn btn-danger btn-icon-split" data-toggle="tooltip" data-placement="right" title="Menunggu Approval/Persetujuan">
                                                                                        <span class="icon text-white-50">
                                                                                            <i class="fas fa-sync"></i>
                                                                                        </span>
                                                                                        <span class="text"> Proses</span>
                                                                                    </div>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }
                                                                    ?>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    $persentaseBahan = $TotPersentaseBh;
                                    ?>
                                    <tr>
                                        <th class="text-left">II</th>
                                        <th colspan="6">PENGADAAN BIBIT</th>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    $TotPersentaseBi = 0;
                                    $datanx = $this->det->getDataPengawasanBibit($details['id_petak']);
                                    foreach ($datanx as $dat) {
                                        $bibitnya = $this->det->getDataPengawasanBibitnya($dat['id_spkbibit']);
                                        $nilaibibitnya = $this->det->getRealisasiBibitnya($dat['id_spkbibit']);
                                        $bobotBi = $this->bobot->getBobotHarianBibit($dat['kategori']);
                                        $persentaseBi = ($nilaibibitnya['nilaibibit'] == 0) ? '0' : $nilaibibitnya['nilaibibit'] / $dat['nilai_spkbibit'] * $bobotBi['bobot'];
                                        $TotPersentaseBi = $TotPersentaseBi + $persentaseBi
                                    ?>
                                        <tr class="font-weight-bold">
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $dat['kategori']; ?></td>
                                            <td></td>
                                            <td class="text-center"><b class="<?= ($nilaibibitnya['nilaibibit'] < $dat['nilai_spkbibit']) ? "text-danger" : ""; ?> <?= ($nilaibibitnya['nilaibibit'] > $dat['nilai_spkbibit']) ? "text-warning" : "text-success"; ?>"><?= number_format($nilaibibitnya['nilaibibit'], 0, ',', '.'); ?></b> dari <b class="text-success"><?= number_format($dat['nilai_spkbibit'], 0, ',', '.'); ?></b></td>
                                            <td class="text-center <?= ($persentaseBi >= $bobotBi['bobot']) ? "text-success" : "text-danger"; ?> " style='cursor:pointer' data-toggle='tooltip' data-placement="right" title="Dari <?= $bobotBi['bobot']; ?>">
                                                <?php
                                                echo round($persentaseBi, 2) . "%";
                                                ?>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        foreach ($bibitnya as $bibit) {
                                            $totalnilaiharian = $this->det->getDataPengawasanTotNilaiBibit($bibit['id_bibit'], $details['id_petak']);
                                            $sql = $this->db->get_where('harianbibit', ['id_bibit' => $bibit['id_bibit'], 'id_petak' => $details['id_petak'], 'id_user' => $details['id_user'],])->result_array();
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td> &nbsp; &nbsp; - <?= $bibit['nm_bibit']; ?></td>
                                                <td class="text-center"><?= $bibit['satuan']; ?></td>
                                                <td class="text-center <?= ($nilaibibitnya['nilaibibit'] < $dat['nilai_spkbibit']) ? "text-danger" : ""; ?> <?= ($nilaibibitnya['nilaibibit'] > $dat['nilai_spkbibit']) ? "text-warning" : "text-success"; ?>" data-toggle="tooltip" data-placement="left" title="<?= number_format($nilaibibitnya['nilaibibit'], 0, ',', '.'); ?> dari <?= number_format($dat['nilai_spkbibit'], 0, ',', '.'); ?>"><?= number_format($totalnilaiharian['totnilai'], 0, ',', '.'); ?></td>
                                                <td></td>
                                                <td><?php
                                                    foreach ($sql as $ket) {
                                                        echo $ket['keterangan'] . ". ";
                                                    } ?>
                                                </td>
                                                <td class="text-center">
                                                    <small><a href="" class="badge badge-info p-2" data-toggle="modal" data-target="#Details<?= $bibit['id_bibit']; ?>" title="Detail"><i class="fas fa-fw fa-info fa-1x"></i></a></small>
                                                    <!-- Modal Detail Pengawasan bibit-->
                                                    <div class="modal fade" id="Details<?= $bibit['id_bibit']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newRoleLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="newRoleLabel">Detail <b><?= $bibit['nm_bibit']; ?></b></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body scrol">
                                                                    <table class="table table-sm">
                                                                        <tr class="text-center">
                                                                            <th>*</th>
                                                                            <th>Tgl Pengawasan/Input</th>
                                                                            <th>Petugas</th>
                                                                            <th>Koordinat</th>
                                                                            <th>Progress</th>
                                                                            <th>Luas</th>
                                                                            <th>Keterangan</th>
                                                                            <th>Foto</th>
                                                                            <th>Approvals</th>
                                                                        </tr>
                                                                        <?php
                                                                        $ni = 1;
                                                                        foreach ($sql as $val) { ?>
                                                                            <tr>
                                                                                <td><?= $ni++; ?></td>
                                                                                <td><?= $val['tgl'] . "<br>" . date('m d Y', $val['tgl_create']); ?></td>
                                                                                <td><?= $val['petugas_lap']; ?></td>
                                                                                <td><?= $val['koordinat']; ?></td>
                                                                                <td><?= $val['nilai_harianbibit']; ?></td>
                                                                                <td><?= $val['luas']; ?></td>
                                                                                <td class="text-left"><?= $val['keterangan']; ?></td>
                                                                                <td>
                                                                                    <center data-toggle="tooltip" data-placement="left" title="Klik untuk memperbesar.">
                                                                                        <?php
                                                                                        if (file_exists("assets/img/peng-bibit/" . $val['foto'])) { ?>
                                                                                            <button type="button" class="btn btn-info " data-toggle="modal" data-target="#fotoView<?= $val['id_harianbibit'] ?>" style="cursor:zoom-in">
                                                                                                <i class="fas fa-seedling fa-fa-3x"></i>
                                                                                            </button>
                                                                                        <?php
                                                                                        } else { ?>
                                                                                            <button type="button" class="btn btn-info text-sm">
                                                                                                Image not <br> found..
                                                                                            </button>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </center>
                                                                                    <!-- Modal Foto View -->
                                                                                    <div class="modal fade" id="fotoView<?= $val['id_harianbibit'] ?>" tabindex="-1" aria-labelledby="fotoView<?= $val['id_harianbibit'] ?>Label" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-xl" style="width: 100%;">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-body modal-open text-center m-0 p-0" style="background-color: transparent;">
                                                                                                    <?php
                                                                                                    $BahanimageURL = base_url("assets/img/peng-bibit/" . $val['foto']);
                                                                                                    $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                    ?>
                                                                                                    <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bibit/<?= $val['foto']; ?>" alt="" width="100%" title="<?= $val['foto']; ?>"></a>
                                                                                                    <h3 class="badge-dark badge-lg m-0"><?= $val['foto']; ?></h3>
                                                                                                    <?php
                                                                                                    if (!empty($BahanUrlMap)) {
                                                                                                    ?>
                                                                                                        <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                            <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                        </a>
                                                                                                    <?php } ?>
                                                                                                    <hr>
                                                                                                    <?php
                                                                                                    $BahanimageURL = base_url("assets/img/peng-bibit/" . $val['foto_2']);
                                                                                                    $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                    ?>
                                                                                                    <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bibit/<?= $val['foto_2']; ?>" alt="" width="100%" title="<?= $val['foto_2']; ?>"></a>
                                                                                                    <h3 class="badge-dark badge-lg m-0"><?= $val['foto_2']; ?></h3>
                                                                                                    <?php
                                                                                                    if (!empty($BahanUrlMap)) {
                                                                                                    ?>
                                                                                                        <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                            <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                        </a>
                                                                                                    <?php } ?>
                                                                                                    <hr>
                                                                                                    <?php
                                                                                                    $BahanimageURL = base_url("assets/img/peng-bibit/" . $val['foto_3']);
                                                                                                    $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                    ?>
                                                                                                    <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bibit/<?= $val['foto_3']; ?>" alt="" width="100%" title="<?= $val['foto_3']; ?>"></a>
                                                                                                    <h3 class="badge-dark badge-lg m-0"><?= $val['foto_3']; ?></h3>
                                                                                                    <?php
                                                                                                    if (!empty($BahanUrlMap)) {
                                                                                                    ?>
                                                                                                        <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                            <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                        </a>
                                                                                                    <?php } ?>
                                                                                                    <hr>
                                                                                                    <?php
                                                                                                    $BahanimageURL = base_url("assets/img/peng-bibit/" . $val['foto_4']);
                                                                                                    $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                    ?>
                                                                                                    <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bibit/<?= $val['foto_4']; ?>" alt="" width="100%" title="<?= $val['foto_4']; ?>"></a>
                                                                                                    <h3 class="badge-dark badge-lg m-0"><?= $val['foto_4']; ?></h3>
                                                                                                    <?php
                                                                                                    if (!empty($BahanUrlMap)) {
                                                                                                    ?>
                                                                                                        <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                            <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                        </a>
                                                                                                    <?php } ?>
                                                                                                    <hr>
                                                                                                    <?php
                                                                                                    $BahanimageURL = base_url("assets/img/peng-bibit/" . $val['foto_5']);
                                                                                                    $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                    ?>
                                                                                                    <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-bibit/<?= $val['foto_5']; ?>" alt="" width="100%" title="<?= $val['foto_5']; ?>"></a>
                                                                                                    <h3 class="badge-dark badge-lg m-0"><?= $val['foto_5']; ?></h3>
                                                                                                    <?php
                                                                                                    if (!empty($BahanUrlMap)) {
                                                                                                    ?>
                                                                                                        <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                            <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                        </a>
                                                                                                    <?php } ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <?php
                                                                                    $usersupadmin = $this->db->get_where('user_role', ['id' => $user['role_id']])->row_array();
                                                                                    if ($val['status'] == 1) {
                                                                                    ?>
                                                                                        <div class="btn btn-success btn-icon-split">
                                                                                            <span class="icon text-white-50">
                                                                                                <i class="fas fa-check"></i>
                                                                                            </span>
                                                                                            <span class="text"> Approved</span>
                                                                                        </div>
                                                                                    <?php
                                                                                    } else if ($val['status'] == 2) {
                                                                                    ?>
                                                                                        <div class="btn btn-warning btn-icon-split">
                                                                                            <span class="icon text-white-50">
                                                                                                &times;
                                                                                            </span>
                                                                                            <span class="text"> Rejected</span>
                                                                                        </div>
                                                                                    <?php
                                                                                    } elseif ($usersupadmin['id'] == '1' || $usersupadmin['id'] == '9' || $usersupadmin['id'] == '10') {
                                                                                    ?>
                                                                                        <a class="btn btn-sm btn-info font-weight-bold" onclick="return confirm('Proses Approval pengawasan?')" href="<?= base_url('input/approve/') . $aprvBibit . "/" . $val['id_harianbibit'] . "/" . $urlx; ?>">
                                                                                            Approve
                                                                                        </a>
                                                                                        <hr class="m-1">
                                                                                        <a class="btn btn-sm btn-danger font-weight-bold" onclick="return confirm('Yakin akan me Reject Pengawasan ini? Reject akan menghapus dari daftar pengawasan harian.')" href="<?= base_url('input/reject/') . $aprvBibit . "/" . $val['id_harianbibit'] . "/"  . $urlx; ?>">
                                                                                            Reject
                                                                                        </a>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                        <div class="btn btn-danger btn-icon-split" data-toggle="tooltip" data-placement="right" title="Menunggu Approval/Persetujuan">
                                                                                            <span class="icon text-white-50">
                                                                                                <i class="fas fa-sync"></i>
                                                                                            </span>
                                                                                            <span class="text"> Proses</span>
                                                                                        </div>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php }
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    $persentaseBibit = $TotPersentaseBi;
                                    ?>
                                    <tr>
                                        <th class="text-left">III</th>
                                        <th colspan="5">KEGIATAN DI LAPANGAN</th>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    $TotPersentaseLa = 0;
                                    $datanx = $this->det->getDataPengawasanLap($details['id_petak']);
                                    foreach ($datanx as $dat) {
                                        $totalnilaiharian = $this->det->getDataPengawasanTotNilaiLap($dat['id_spklapangan'], $dat['id_petak']);
                                        $sql = $this->db->get_where('harianlapangan', ['id_spklapangan' => $dat['id_spklapangan'], 'id_petak' => $dat['id_petak'], 'id_user' => $details['id_user'],])->result_array();
                                        $bobotLa = $this->bobot->getBobotHarianLap($dat['id_kegiatan']);
                                        $persentaseLap = ($dat['nilai_spklapangan'] == 0) ? 0 : ($totalnilaiharian['totnilai'] / $dat['nilai_spklapangan']) * $bobotLa['bobot'];
                                        $TotPersentaseLa = $TotPersentaseLa + $persentaseLap;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $dat['nm_kegiatan']; ?></td>
                                            <td class="text-center"><?= $dat['satuan']; ?></td>
                                            <td class="text-center font-weight-bold <?= ($dat['nilai_spklapangan'] < $totalnilaiharian['totnilai']) ? "text-warning" : ""; ?> <?= ($dat['nilai_spklapangan'] > $totalnilaiharian['totnilai']) ? "text-danger" : "text-success"; ?>" data-toggle="tooltip" data-placement="top" title="<?= number_format($totalnilaiharian['totnilai'], 2, '.', ','); ?> dari <?= number_format($dat['nilai_spklapangan'], 2, '.', ','); ?>"><?= number_format($totalnilaiharian['totnilai'], 2, '.', ','); ?></td>
                                            <td class="text-center <?= ($persentaseLap >= $bobotLa['bobot']) ? "text-success" : "text-danger"; ?> " style='cursor:pointer' data-toggle='tooltip' data-placement="right" title="Dari <?= $bobotLa['bobot']; ?>">
                                                <?php
                                                echo round($persentaseLap, 2) . "%";
                                                ?>
                                            </td>
                                            <td><?php
                                                foreach ($sql as $value) {
                                                    echo "- " . $value['keterangan'] . ". <br>";
                                                } ?>
                                            </td>
                                            <td class="text-center">
                                                <small><a href="" class="badge badge-info p-2" data-toggle="modal" data-target="#Details<?= $dat['id_spklapangan']; ?>" title="Detail"><i class="fas fa-fw fa-info fa-1x"></i></a></small>
                                                <!-- Modal Add SPK Kategori lapangan-->
                                                <div class="modal fade text-left" id="Details<?= $dat['id_spklapangan']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newRoleLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="newRoleLabel">Detail Kegiatan <b><?= $dat['nm_kegiatan']; ?></b></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body scrol">
                                                                <table class="table table-sm">
                                                                    <tr class="text-center">
                                                                        <th>*</th>
                                                                        <th>Tgl Pengawasan/Input</th>
                                                                        <th>Petugas</th>
                                                                        <th>Koordinat</th>
                                                                        <th>Progress</th>
                                                                        <th>Luas</th>
                                                                        <th>Keterangan</th>
                                                                        <th>Foto</th>
                                                                        <th>Video</th>
                                                                        <th>Approvals</th>
                                                                    </tr>
                                                                    <?php
                                                                    $ni = 1;
                                                                    foreach ($sql as $val) { ?>
                                                                        <tr class="text-center">
                                                                            <td><?= $ni++; ?></td>
                                                                            <td><?= $val['tgl'] . "<br>" . date('m d Y', $val['tgl_create']); ?></td>
                                                                            <td class="text-left"><?= $val['petugas_lap']; ?></td>
                                                                            <td><?= $val['koordinat']; ?></td>
                                                                            <td><?= $val['nilai_harianlapangan']; ?></td>
                                                                            <td><?= $val['luas']; ?></td>
                                                                            <td><?= $val['keterangan']; ?></td>
                                                                            <td>
                                                                                <center data-toggle="tooltip" data-placement="left" title="Klik untuk memperbesar.">
                                                                                    <?php
                                                                                    if (file_exists("assets/img/peng-lapangan/" . $val['foto'])) { ?>
                                                                                        <button type="button" class="btn btn-info " data-toggle="modal" data-target="#fotoView<?= $val['id_harianlapangan'] ?>" style="cursor:zoom-in">
                                                                                            <i class="fas fa-seedling fa-fa-3x"></i>
                                                                                        </button>
                                                                                    <?php
                                                                                    } else { ?>
                                                                                        <button type="button" class="btn btn-info text-sm">
                                                                                            Image not <br> found..
                                                                                        </button>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </center>
                                                                                <!-- Modal Foto View -->
                                                                                <div class="modal fade" id="fotoView<?= $val['id_harianlapangan'] ?>" tabindex="-1" aria-labelledby="fotoView<?= $val['id_harianlapangan'] ?>Label" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-xl" style="width: 100%;">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-body modal-open text-center m-0 p-0" style="background-color: transparent;">
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-lapangan/" . $val['foto']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-lapangan/<?= $val['foto']; ?>" alt="" width="100%" title="<?= $val['foto']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                                <hr>
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-lapangan/" . $val['foto_2']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-lapangan/<?= $val['foto_2']; ?>" alt="" width="100%" title="<?= $val['foto_2']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto_2']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                                <hr>
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-lapangan/" . $val['foto_3']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-lapangan/<?= $val['foto_3']; ?>" alt="" width="100%" title="<?= $val['foto_3']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto_3']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                                <hr>
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-lapangan/" . $val['foto_4']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-lapangan/<?= $val['foto_4']; ?>" alt="" width="100%" title="<?= $val['foto_4']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto_4']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                                <hr>
                                                                                                <?php
                                                                                                $BahanimageURL = base_url("assets/img/peng-lapangan/" . $val['foto_5']);
                                                                                                $BahanUrlMap = get_image_location($BahanimageURL);
                                                                                                ?>
                                                                                                <a href="<?= $BahanimageURL; ?>" target="_blank"><img class="img" src="<?= base_url('assets/'); ?>img/peng-lapangan/<?= $val['foto_5']; ?>" alt="" width="100%" title="<?= $val['foto_5']; ?>"></a>
                                                                                                <h3 class="badge-dark badge-lg m-0"><?= $val['foto_5']; ?></h3>
                                                                                                <?php
                                                                                                if (!empty($BahanUrlMap)) {
                                                                                                ?>
                                                                                                    <a target="_blank" href="https://maps.google.com/maps?q=<?= $BahanUrlMap; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat Lokasi di google maps.">
                                                                                                        <button class="btn btn-info btn-outline-primary m-1 pl-5 pr-5"> <i class="fas fa-map-marked-alt"></i> Klik untuk melihat titik lokasi pengambilan gambar di google maps</button>
                                                                                                    </a>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#videoView<?= $val['id_harianlapangan'] ?>">
                                                                                    <i class="fas fa-file-video"></i>
                                                                                </button>
                                                                                <div class="modal" id="videoView<?= $val['id_harianlapangan'] ?>" tabindex="-1" aria-labelledby="videoView<?= $val['id_harianlapangan'] ?>Label" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" style="width: 100%;">
                                                                                        <div class="modal-content" style=" background-color: black;">
                                                                                            <div class="modal-body modal-open text-center m-0 p-0">
                                                                                                <video width="100%" controls>
                                                                                                    <source src="<?= base_url('assets/'); ?>img/peng-video/<?= $val['video']; ?>" type="video/mp4">
                                                                                                    Your browser does not support the video tag.
                                                                                                </video>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <?php
                                                                                $usersupadmin = $this->db->get_where('user_role', ['id' => $user['role_id']])->row_array();
                                                                                if ($val['status'] == 1) {
                                                                                ?>
                                                                                    <div class="btn btn-success btn-icon-split">
                                                                                        <span class="icon text-white-50">
                                                                                            <i class="fas fa-check"></i>
                                                                                        </span>
                                                                                        <span class="text"> Approved</span>
                                                                                    </div>
                                                                                <?php
                                                                                } else if ($val['status'] == 2) {
                                                                                ?>
                                                                                    <div class="btn btn-warning btn-icon-split">
                                                                                        <span class="icon text-white-50">
                                                                                            &times;
                                                                                        </span>
                                                                                        <span class="text"> Rejected</span>
                                                                                    </div>
                                                                                <?php
                                                                                } elseif ($usersupadmin['id'] == '1' || $usersupadmin['id'] == '9' || $usersupadmin['id'] == '10') {
                                                                                ?>
                                                                                    <a class="btn btn-sm btn-info font-weight-bold" onclick="return confirm('Proses Approval pengawasan?')" href="<?= base_url('input/approve/') . $aprvLapangan . "/" . $val['id_harianlapangan'] . "/" . $urlx; ?>">
                                                                                        Approve
                                                                                    </a>
                                                                                    <hr class="m-1">
                                                                                    <a class="btn btn-sm btn-danger font-weight-bold" onclick="return confirm('Yakin akan me Reject Pengawasan ini? Reject akan menghapus dari daftar pengawasan harian.')" href="<?= base_url('input/reject/') . $aprvLapangan . "/" . $val['id_harianlapangan'] . "/"  . $urlx; ?>">
                                                                                        Reject
                                                                                    </a>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <div class="btn btn-danger btn-icon-split" data-toggle="tooltip" data-placement="right" title="Menunggu Approval/Persetujuan">
                                                                                        <span class="icon text-white-50">
                                                                                            <i class="fas fa-sync"></i>
                                                                                        </span>
                                                                                        <span class="text"> Proses</span>
                                                                                    </div>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }
                                                                    ?>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    $persentaseLapangan = $TotPersentaseLa;
                                    $TotalPersen = $persentaseBahan + $persentaseBibit + $persentaseLapangan;
                                    $persenHarian = round($TotalPersen, 2);
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th colspan="3" class="text-right">Total</th>
                                        <th></th>
                                        <th class="<?= ($persenHarian == 100) ? "text-success" : "text-danger" ?>"><?= $persenHarian; ?>%</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </small>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h5 class="font-weight-bold">KENDALA ATAU REKOMENDASI :</h5>
                <hr class="m-0 pb-2">
                <p>
                    <span class="text-danger">* Realisasi progress pengawasan <b>belum terpenuhi</b> dari SPK yang telah ditentukan.</span><br>
                    <span class="text-success">* Realisasi progress pengawasan <b>telah terpenuhi</b> dari SPK yang telah ditentukan.</span><br>
                    <span class="text-warning">* Realisasi progress pengawasan <b>melebihi</b> dari SPK yang telah ditentukan.</span>
                </p>
                <button class="btn btn-sm btn-warning" onclick="printContent('reportHarian')"><i class="fas fa-print"></i> Print this Tally Sheet</button>
            </div>
        </div>
    </div>
    <?php
    include 'grafikharian.php';
    ?>
</div>
<!-- /.container-fluid -->

</div>

<?php
function get_image_location($image = '')
{
    error_reporting(0);
    $exif = exif_read_data($image, 0, true);
    if ($exif && isset($exif['GPS'])) {
        $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
        $GPSLatitude    = $exif['GPS']['GPSLatitude'];
        $GPSLongitudeRef = $exif['GPS']['GPSLongitudeRef'];
        $GPSLongitude   = $exif['GPS']['GPSLongitude'];

        $lat_degrees = count($GPSLatitude) > 0 ? gps2Num($GPSLatitude[0]) : 0;
        $lat_minutes = count($GPSLatitude) > 1 ? gps2Num($GPSLatitude[1]) : 0;
        $lat_seconds = count($GPSLatitude) > 2 ? gps2Num($GPSLatitude[2]) : 0;

        $lon_degrees = count($GPSLongitude) > 0 ? gps2Num($GPSLongitude[0]) : 0;
        $lon_minutes = count($GPSLongitude) > 1 ? gps2Num($GPSLongitude[1]) : 0;
        $lon_seconds = count($GPSLongitude) > 2 ? gps2Num($GPSLongitude[2]) : 0;

        $lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
        $lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;

        $latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60 * 60)));
        $longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60 * 60)));

        return $latitude . "," . $longitude;
    } else {
        return false;
    }
}
function gps2Num($coordPart)
{
    $parts = explode('/', $coordPart);
    if (count($parts) <= 0)
        return 0;
    if (count($parts) == 1)
        return $parts[0];
    return floatval($parts[0]) / floatval($parts[1]);
}
?>
<!-- End of Main Content -->