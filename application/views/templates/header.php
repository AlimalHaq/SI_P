<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>
    <script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>
    <!-- Get TinyMCE -->
    <script src="<?= base_url('assets/'); ?>tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#urlExt',
            height: 400,
            forced_root_block: "",
            force_br_newlines: true,
            force_p_newlines: false,
            plugins: [
                'autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect table | bold italic | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media ',
            toolbar2: 'print preview | forecolor backcolor emoticons | fontselect | fontsizeselect | codesample code fullscreen',
            templates: [{
                    title: 'Test template 1',
                    content: ''
                },
                {
                    title: 'Test template 2',
                    content: ''
                }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
        });
    </script>
    <!-- End Get TinyMCE -->
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for page Data Tables -->
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.PieceLabel.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.js"></script>
    <script src="https://cdn.jsdelivr.net/angular.chartjs/latest/angular-chart.js"></script> -->



    <style>
        .scrol {
            clear: both;
            border: 0px solid 3FF6600;
            overflow: auto;
            float: left;
            width: 100%;
            content: inherit;
        }

        .scrolBar {
            clear: both;
            border: 0px solid 3FF6600;
            max-width: 100%;
            min-width: 70%;
            overflow: auto;
            float: left;
        }

        .texthoverwhite {
            color: blue;
        }

        .reporthover {
            color: #000000;
        }

        .texthoverwhite:hover {
            color: #ffffff;
        }

        .petakHov:hover {
            background-color: lightgrey;
        }

        .hovbg:hover {
            background-color: #f2f2f2;
        }

        .scroll {
            clear: both;
            border: 0px solid 3FF6600;
            max-height: 110px;
            overflow: auto;
            float: left;
            width: 100%;
        }

        .scroll:hover {
            background-color: #f2f2f2;
        }

        .scrolllokasi {
            clear: both;
            border: 0px solid 3FF6600;
            max-height: 210px;
            overflow: auto;
            float: left;
            width: 100%;
        }

        .scrolllokasi:hover {
            background-color: ghostwhite;
        }

        .tooltip-inner {
            background-color: rgba(9, 9, 9, .6);
            color: #ffffff;
            font-weight: bold;
            border: 1px solid #737373;
        }

        .zoom:hover {
            -ms-transform: scale(1.2);
            /* IE 9 */
            -webkit-transform: scale(1.2);
            /* Safari 3-8 */
            transform: scale(1.2);
        }
    </style>

</head>

<body id="page-top">
    <?php
    // $ipnya = "$clien_ip | $clien_ip2";
    // $sudahada = $this->db->get_where('tb_visitor', ['user' => $user['id_user'], 'ip' => $ipnya])->row_array();
    // if ($sudahada < 1) {
    //     # code...
    //     $datVisitor = [
    //         'user' => "$user[id_user]",
    //         'count' => '1',
    //         'ip' => $ipnya,
    //         'browser' => "$client_browser",
    //         'os' => "$_SERVER[HTTP_USER_AGENT]",
    //         'waktu' => time()
    //     ];
    //     $this->db->insert('tb_visitor', $datVisitor);
    // } else {
    //     $nilaiCount = $sudahada['count'] + 1;
    //     $this->db->update('tb_visitor', ['count' => $nilaiCount, 'waktu' => time()], ['id' => $sudahada['id']]);
    // }
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">