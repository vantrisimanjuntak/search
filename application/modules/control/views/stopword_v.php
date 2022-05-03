<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= base_url('assets/images/wp/stta.png') ?>" type="image/x-icon">


    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/control_template/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/control_template/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/control_template/vendors/bootstrap/dist/css/bootstrap.min.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/control_template/vendors/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/control_template/vendors/themify-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/control_template/vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/control_template/vendors/selectFX/css/cs-skin-elastic.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/control_template/vendors/jqvmap/dist/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/control_template/assets/css/style.css') ?>">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2-11.4.8/package/dist/sweetalert2.min.css') ?>">


</head>

<body>

    <div class="success_add_stopword" data-flashdata="<?= $this->session->flashdata('berhasil_tambah_stopword'); ?>"></div>
    <div class="success_delete_stopword" data-flashdata="<?= $this->session->flashdata('berhasil_hapus_stopword'); ?>"></div>
    <!-- Left Panel -->

    <?php $this->load->view('control/side'); ?>

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= strtoupper($session_access_user); ?>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>
                            <a class="nav-link" href="<?= base_url('control/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>


                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->


        <div class="card">
            <div class="card-header">
                <strong class="card-title">STOPWORD</strong>
            </div>
            <div class="container-fluid mb-4 mt-3" style="font-family: 'PT Serif', serif; ">
                <form action="<?= base_url('control/tambahStopword'); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="" class="col-md-5 col-lg-4 col-xl-3 col-form-label">Stopword</label>
                                <div class="col-md-7 col-lg-8 col-xl-7">
                                    <input type="text" name="stopword" required id="stopword" autocomplete="off" class="form-control">
                                    <small id="alertStopword"></small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary float-right tambah-stopword">
                                    <i class="fa fa-plus-square fa-1x" aria-hidden="true"></i>&nbsp;&nbsp;Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Stopword</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($allStopword->result_array() as $data) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['stopword']; ?></td>
                                <td>
                                    <a href="#" style="text-decoration: none;">
                                        <button type="button" class="btn btn-success">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <button type="button" class="btn btn-danger hapus-stopword" id="<?= $data['id']; ?>">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src="<?= base_url('assets/javascript/jquery-3.5.1.js') ?>" type="text/javascript"></script>


    <script src="<?= base_url('assets/control_template/vendors/popper.js/dist/umd/popper.min.js') ?> "></script>
    <script src="<?= base_url('assets/control_template/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/chart.js/dist/Chart.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/assets/js/dashboard.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/assets/js/widgets.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/jqvmap/dist/jquery.vmap.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/jqvmap/dist/maps/jquery.vmap.world.js') ?>"></script>

    <!-- DataTables JS -->
    <script src="<?= base_url('assets/control_template/vendors/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/jszip/dist/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/pdfmake/build/pdfmake.min.js'); ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/pdfmake/build/vfs_fonts.js'); ?>"></script>

    <script src="<?= base_url('assets/control_template/vendors/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/vendors/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>
    <script src="<?= base_url('assets/control_template/assets/js/init-scripts/data-table/datatables-init.js') ?>"></script>

    <script type="text/javascript" src="<?= base_url('assets/javascript/main.js'); ?>"></script>


    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>
    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <!-- SweetAlert2 JS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/sweetalert2-11.4.8/package/dist/sweetalert2.all.min.js') ?>"></script>

</body>

</html>