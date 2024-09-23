<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
    	<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    		<div>
    			<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
    			<h5 class="text-white op-7 mb-2">Selamat datang <strong><?= $this->session->userdata('name_user') ?></strong></h5>
    		</div>
    		<div class="ml-md-auto py-2 py-md-0">
    			<a href="<?= base_url('kasir/menu') ?>" class="btn btn-white btn-border btn-round mr-2">Manage Menu</a>
    			<a href="<?= base_url('kasir/transaksi') ?>" class="btn btn-secondary btn-round">Add Pesanan</a>
    		</div>
    	</div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row row-card-no-pd mt--2">
    	<div class="col-sm-6 col-md-3">
    		<div class="card card-stats card-round">
    			<div class="card-body ">
    				<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
                                <i class="flaticon-users text-primary"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Customer</p>
								<h4 class="card-title"><?= $this->db->get('customer')->num_rows(); ?></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-3">
			<div class="card card-stats card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="flaticon-coins text-primary"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Total Transaksi</p>
								<h4 class="card-title"><?= $this->db->get('transaksi')->num_rows(); ?></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="col-sm-6 col-md-3">
			<div class="card card-stats card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="flaticon-star text-primary"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Makanan</p>
								<h4 class="card-title"><?= $this->db->get_where('produk', array('jenis_produk' => 'makanan'))->num_rows(); ?></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="col-sm-6 col-md-3">
			<div class="card card-stats card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="flaticon-star text-primary"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Minuman</p>
								<h4 class="card-title"><?= $this->db->get_where('produk', array('jenis_produk' => 'minuman'))->num_rows(); ?></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
					