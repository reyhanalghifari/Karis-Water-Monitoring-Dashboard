<?php

$session = \Config\Services::session();
 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Karis Water Monitoring Dashboard</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url('assets/css/metisMenu.min.css'); ?>" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="<?php echo base_url('assets/css/timeline.css'); ?>" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url('assets/css/startmin.css'); ?>" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?php echo base_url('assets/css/morris.css'); ?>" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Karis Water Monitoring Dashboard</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Top Navigation: Left Menu -->
                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"><i class="fa fa-home fa-fw"></i></a></li>
                </ul>

                <!-- Top Navigation: Right Menu -->
                <ul class="nav navbar-right navbar-top-links">
                    <!-- <li class="dropdown navbar-inverse">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i><?php echo $session->get('nama_lengkap'); ?><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo base_url('user-profile'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                             -->
                             <li class="divider"></li>
                            <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Sidebar -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">

                        <ul class="nav" id="side-menu">
                            <!-- <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                </div>
                            </li> -->

                            <li>
                                <a href="<?php echo base_url(''); ?>" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            
                            <?php if ($session->get('account_type') == "superadmin" || ($session->get('account_type') == "operator" && $session->get('tipe_cabang') == "pusat") ) { ?>
                            <li>
                                <a href="<?php echo base_url('penjualan/add_cabang'); ?>"><i class="fa fa-dashboard fa-fw"></i> Form Penjualan Untuk Cabang</a>
                            </li>
                            <?php } ?>

                            <?php if ($session->get('account_type') == "superadmin" || $session->get('account_type') == "kepala_cabang" || ($session->get('account_type') == "operator" && $session->get('tipe_cabang') == "cabang") ) { ?>
                            <li>
                                <a href="<?php echo base_url('penjualan/add'); ?>"><i class="fa fa-dashboard fa-fw"></i> Form Penjualan</a>
                            </li>
                            <?php } ?>

                            <?php if ($session->get('account_type') == "superadmin" || $session->get('account_type') == "operator" || $session->get('account_type') == "kepala_cabang") { ?>
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Data Master<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if ($session->get('account_type') == "superadmin") { ?>
                                    <li>
                                        <a href="<?php echo base_url('barang'); ?>">Barang</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('cabang'); ?>">Cabang Distribusi</a>
                                    </li>
                                    <?php } ?>
                            
                                    <?php if ($session->get('account_type') == "superadmin" || $session->get('account_type') == "operator" || $session->get('account_type') == "kepala_cabang") { ?>
                                    <li>
                                        <a href="<?php echo base_url('pelanggan'); ?>">Pelanggan</a>
                                    </li>
                                    <?php } ?>

                                    <li>
                                        <a href="<?php echo base_url('penjualan'); ?>">Riwayat Penjualan</a>
                                    </li>
                                    
                                    <!-- <li>
                                        <a href="#">Third Level <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                        </ul>
                                    </li> -->
                                </ul>
                            </li>
                            <?php } ?>

                            <?php if ($session->get('account_type') == "superadmin") { ?>
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Administrasi<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url('user'); ?>">User</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('user-cabang'); ?>">Penempatan User di Cabang</a>
                                    </li>
                                </ul>
                            </li>
                            <?php } ?>

                            <li>
                                <a href="<?php echo base_url('penjualan/laporan'); ?>" class="active"><i class="fa fa-dashboard fa-fw"></i> Laporan Penjualan</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <?= $this->renderSection('content') ?>

        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url('assets/js/metisMenu.min.js') ?>"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url('assets/js/startmin.js') ?>"></script>

        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/dataTables/dataTables.bootstrap.min.js') ?>"></script>
 
 
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-karis-water').DataTable({
                    responsive: true
                });

                $('#dataTables-karis-water-bulanan').DataTable({
                    responsive: true
                });

                $('#dataTables-karis-water-mingguan').DataTable({
                    responsive: true
                });

                $('#dataTables-karis-water-tahunan').DataTable({
                    responsive: true
                });
            });
        </script>

        <script type="text/javascript">
            $(".btn.btn-danger.btn-delete").click(function(){
                console.log($(this).attr('data-url'));
                $('#delete-form-button-yes').attr('href', $(this).attr('data-url'));
            });
        </script>
    </body>
</html>
