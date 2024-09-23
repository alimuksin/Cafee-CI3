
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $title; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?=base_url('dist/admin') ?>/img/icon.ico" type="image/x-icon"/>
    <link href="<?=base_url('dist/') ?>/plugins/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />
    <!-- Fonts and icons -->
    <script src="<?=base_url('dist/admin') ?>/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?=base_url('dist/admin') ?>/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?=base_url('dist/admin') ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url('dist') ?>/plugins/dtbs/datatables.min.css">
    <link rel="stylesheet" href="<?=base_url('dist/admin') ?>/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?=base_url('dist/admin') ?>/css/demo.css">
    <style type="text/css">
        .card{
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .table td, .table th{
            height: 30px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">
                
                <a href="#" class="logo text-white fw-bold">
                    Bintang Kopi
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                
                <div class="container-fluid">
                    
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="notification">4</span>
                            </a>
                            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">You have 4 new notification</div>
                                </li>
                                <li>
                                    <div class="notif-scroll scrollbar-outer">
                                        <div class="notif-center">
                                            <a href="#">
                                                <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        New user registered
                                                    </span>
                                                    <span class="time">5 minutes ago</span> 
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">           
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <span class="avatar-title rounded-circle border border-white bg-info"><?= substr($this->session->userdata('name_user'), 0, 1) ?></span>
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    <?= $this->session->userdata('name_user') ?>
                                    <span class="user-level"><?php if ($this->session->userdata('role_user') == 1) {
                            echo "Admin";
                        }else{
                            echo "Kasir";
                        } ?></span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="<?= base_url('welcome/logout') ?>">
                                            <span class="link-collapse">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">

                        <li class="nav-item <?php if($this->uri->segment(2)=="index"){echo 'active';}?>">
                            <a href="<?=base_url('admin') ?>">
                                <i class="fa-solid fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item <?php if($this->uri->segment(2)=="order" OR $this->uri->segment(2)=="orderDetail"){echo 'active';}?>">
                            <a href="<?=base_url('admin/order') ?>">
                                <i class="fa-solid fa-pen-square"></i>
                                <p>Order</p>
                            </a>
                        </li>

                        <li class="nav-item <?php if($this->uri->segment(2)=="transaksi" OR $this->uri->segment(2)=="transaksiDetail"){echo 'active';}?>">
                            <a href="<?=base_url('admin/transaksi') ?>">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                <p>Transaksi</p>
                            </a>
                        </li>

                        <li class="nav-item <?php if($this->uri->segment(2)=="member"){echo 'active';}?>">
                                <a href="<?=base_url('admin/member') ?>">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Member</p>
                                </a>
                            </li>

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">PRODUCT</h4>
                        </li>

                        
                        <li class="nav-item <?php if($this->uri->segment(2)=="makanan" OR $this->uri->segment(2)=="minuman"){echo 'active submenu';}?>">
                            <a data-toggle="collapse" href="#menu">
                                <i class="fa-solid fa-mug-hot"></i>
                                <p>Menu</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php if($this->uri->segment(2)=="makanan" OR $this->uri->segment(2)=="minuman" OR $this->uri->segment(2)=="editmenu"){echo 'show';}?>" id="menu">
                                <ul class="nav nav-collapse">
                                    <li <?php if($this->uri->segment(2)=="makanan"){echo 'class="active"';}?>>
                                        <a href="<?= base_url('admin/makanan') ?>">
                                            <span class="sub-item">Makanan</span>
                                        </a>
                                    </li>
                                    <li <?php if($this->uri->segment(2)=="minuman"){echo 'class="active"';}?>>
                                        <a href="<?= base_url('admin/minuman') ?>">
                                            <span class="sub-item">Minuman</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(2)=="meja"){echo 'active';}?>">
                            <a href="<?=base_url('admin/meja') ?>">
                                <i class="fa-solid fa-box-archive"></i>
                                <p>Meja</p>
                            </a>
                        </li>

                        <?php if ($this->session->userdata('id_user') == 1) { ?>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">ADMINISTRATOR</h4>
                            </li>

                            <li class="nav-item <?php if($this->uri->segment(2)=="laporan"){echo 'active';}?>">
                                <a href="<?=base_url('admin/laporan') ?>">
                                    <i class="fa-solid fa-print"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                            
                            <li class="nav-item <?php if($this->uri->segment(2)=="pengguna" OR $this->uri->segment(2)=="editpengguna"){echo 'active';}?>">
                                <a href="<?=base_url('admin/pengguna') ?>">
                                    <i class="fa-solid fa-user"></i>
                                    <p>Pengguna</p>
                                </a>
                            </li>
                            <li class="nav-item <?php if($this->uri->segment(2)=="setting"){echo 'active';}?>">
                                <a href="<?=base_url('admin/setting') ?>">
                                    <i class="fa-solid fa-globe"></i>
                                    <p>Setting</p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <?= $contents; ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright ml-auto fw-bold">
                        <?= date('Y') ?> @ <?= $name_kon; ?>
                    </div>              
                </div>
            </footer>
        </div>
        
    </div>
    <!--   Core JS Files   -->
    <script src="<?=base_url('dist/admin') ?>/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?=base_url('dist/admin') ?>/js/core/popper.min.js"></script>
    <script src="<?=base_url('dist/admin') ?>/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?=base_url('dist/admin') ?>/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?=base_url('dist/admin') ?>/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?=base_url('dist/admin') ?>/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


    <!-- Chart JS -->
    <script src="<?=base_url('dist/admin') ?>/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?=base_url('dist/admin') ?>/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?=base_url('dist/admin') ?>/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <!-- <link rel="stylesheet" href="<?=base_url('dist') ?>/plugins/dtbs/datatables.min.css"> -->
    <script src="<?=base_url('dist') ?>/plugins/dtbs/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="<?=base_url('dist/admin') ?>/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?=base_url('dist/admin') ?>/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?=base_url('dist/admin') ?>/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Sweet Alert -->
    <script src="<?=base_url('dist/admin') ?>/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Atlantis JS -->
    <script src="<?=base_url('dist/admin') ?>/js/atlantis.min.js"></script>
</body>
</html>

<script >
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
            lengthMenu: [
                [10, 5, 25, 50, -1],
                [10, 5, 25, 50, 'All']
            ],
            ordering: false,
            responsive: true,
        });

        $('#table1').DataTable({
            lengthChange: false,
            ordering: false,
            responsive: true,
            searching: false,
            info : false,
        });

        $('#table2').DataTable({
            lengthChange: false,
            ordering: false,
            responsive: true,
            searching: false,
            info : false,
        });

        $('#table3').DataTable({
            lengthChange: false,
            ordering: false,
            responsive: true,
            searching: false,
            info : false,
        });
    });

</script>
