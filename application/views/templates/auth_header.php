<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <style>
        .bg {
            /* background-repeat: no-repeat; */
            background-attachment: fixed;
            background-position: top;
            background-size: 100% 100%;
            background-image: url(<?= base_url('assets/'); ?>img/bg.jpg)
        }
    </style>

    <title>
        <?= $title; ?>
    </title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg">

    <?php
    // $ipnya = "$clien_ip | $clien_ip2";
    // $sudahada = $this->db->get_where('tb_visitor', ['user' => $userlo, 'ip' => $ipnya])->row_array();
    // if ($sudahada < 1) {
    //     # code...
    //     $datVisitor = [
    //         'user' => "$userlo",
    //         'count' => '1',
    //         'ip' => $ipnya,
    //         'browser' => "$client_browser",
    //         'os' => "$_SERVER[HTTP_USER_AGENT]",
    //         'waktu' => time(),
    //         'ket' => "$title"
    //     ];
    //     $this->db->insert('tb_visitor', $datVisitor);
    // } else {
    //     $nilaiCount = $sudahada['count'] + 1;
    //     $this->db->update('tb_visitor', ['count' => $nilaiCount, 'waktu' => time(), 'ket' => "$title"], ['id' => $sudahada['id']]);
    // }
    ?>