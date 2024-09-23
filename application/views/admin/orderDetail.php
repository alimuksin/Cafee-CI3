<style type="text/css">
	.scroll {
	    max-height: 500px;
	    overflow-y: auto;
}
</style>
<div class="card">
	<div class="card-header">
		<div class="float-right">
			<button class="btn btn-danger btn-sm" onclick="history.back()"><i class="flaticon-left-arrow-1"></i> Kembali</button>
		</div>
		<h4 class="card-title">Data Order : <?= $checkout->id_checkout; ?></h4>
	</div>
	<div class="card-body scroll">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Detail Customer</div>
					</div>
					<div class="card-body pb-0 table-responsive">
						<table class="table table-sm">
							<?php 
								$cus = $this->db->get_where('customer', array('id_customer' => $checkout->id_customer))->row();
								$total = $this->db->get_where('transaksi', array('id_checkout' => $checkout->id_checkout))->row();
							?>
							<tr>
								 <th scope="col">Nama Cutomer</th>
								<td>:</td>
								<td><?= $checkout->id_customer == NULL ? $checkout->nama : $cus->nama_customer ?></td>
							</tr>
							<tr>
								 <th scope="col">Telp</th>
								<td>:</td>
								<td><?= $checkout->id_customer == NULL ? "Non member" :$cus->telp_customer ?></td>
							</tr>
							<tr>
								 <th scope="col">Email</th>
								<td>:</td>
								<td><?= $checkout->id_customer == NULL ? "Non member" :$cus->email_customer ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Detail Produk</div>
					</div>
					<div class="card-body">
						<?php
							$this->db->select('*');
							$this->db->join('produk', 'produk.id_produk=checkoutproduk.id_produk');
							$this->db->where('checkoutproduk.id_checkout', $checkout->id_checkout);
							$datas = $this->db->get('checkoutproduk')->result();

							foreach ($datas as $row) {
						?>
						<div class="d-flex">
							<div class="avatar">
								<img src="<?= base_url().'uploads/produk/'.$row->gambar_produk ?>" alt="..." class="avatar-img rounded-circle">
							</div>
							<div class="flex-1 pt-1 ml-2">
								<h6 class="fw-bold mb-1"><?= $row->nama_produk.' ('.$row->variasi_produk.')';?></h6>
								<small class="text-muted"><?= rupiah($row->harga_produk).' ('.$row->jml_checkout.'x)'; ?></small>
							</div>
							<div class="d-flex ml-auto align-items-center pt-1 pr-2">
								<small class="text-muted">Rp. <?= rupiah($row->harga_produk*$row->jml_checkout) ?></small>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<?php } ?>
						
						<div class="separator-dashed"></div>
						<div class="d-flex bg-primary text-white">
							<div class="flex-1 pt-1 ml-2">
								<h6 class="fw-bold mb-1">Total :</h6>
							</div>
							<div class="d-flex ml-auto align-items-center pt-1 pr-2">
								<h6 class="fw-bold mb-1">Rp. <?php echo rupiah($checkout->total_checkout); ?></h6>
							</div>
						</div>
						<div class="separator-dashed"></div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>