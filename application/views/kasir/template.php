
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Kasir Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?=base_url('dist/admin') ?>/img/icon.ico" type="image/x-icon"/>

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

	<link rel="stylesheet" href="<?=base_url('dist/admin') ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url('dist/admin') ?>/css/atlantis.min.css">

	<link rel="stylesheet" href="<?=base_url('dist/admin') ?>/css/demo.css">
	<script src="<?=base_url('dist/admin') ?>/js/core/jquery.3.2.1.min.js"></script>
	<!-- Datatables -->
<script src="<?=base_url('dist/admin') ?>/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="<?=base_url('dist/admin') ?>/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	<!-- Sweet Alert -->
	<script src="<?=base_url('dist/admin') ?>/js/plugin/sweetalert/sweetalert.min.js"></script>
</head>
<body>
	<div class="wrapper overlay-sidebar">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue2">
				
				<a href="<?= base_url('login/login') ?>" class="logo">
					<img src="<?=base_url('dist/admin') ?>/img/logo.svg" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="topbar-toggler more ml-auto"><i class="icon-menu"></i></button>
				
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
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Quick Actions</span>
									<span class="subtitle op-8">Shortcuts</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<a class="col-6 col-md-4 p-0" href="<?= base_url('kasir/') ?>">
												<div class="quick-actions-item">
													<i class="flaticon-home"></i>
													<span class="text">Home</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="<?= base_url('kasir/menu') ?>">
												<div class="quick-actions-item">
													<i class="flaticon-database"></i>
													<span class="text">Menu</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="<?= base_url('kasir/meja') ?>">
												<div class="quick-actions-item">
													<i class="flaticon-box"></i>
													<span class="text">Meja</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="<?= base_url('kasir/order') ?>">
												<div class="quick-actions-item">
													<i class="flaticon-interface-1"></i>
													<span class="text">Order</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="<?= base_url('kasir/transaksi') ?>">
												<div class="quick-actions-item">
													<i class="flaticon-pen"></i>
													<span class="text">Pesanan Baru</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="<?=base_url('dist/admin') ?>/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		

		<div class="main-panel">
			<div class="content">
				<?= $contents ?>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto">
						<strong>Bintang Kopi - <?= date('Y') ?></strong>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>				
				</div>
			</footer>
		</div>
		
		
	</div>
	<!--   Core JS Files   -->
	
	<script src="<?=base_url('dist/admin') ?>/js/core/popper.min.js"></script>
	<script src="<?=base_url('dist/admin') ?>/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="<?=base_url('dist/admin') ?>/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?=base_url('dist/admin') ?>/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?=base_url('dist/admin') ?>/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>



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