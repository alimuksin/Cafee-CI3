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
			<a class="btn btn-primary btn-sm" href="#" onclick="openWin()" ><i class="flflaticon-envelope"></i> PRINT</a>
		</div>
		<h4 class="card-title">Data Order : <?= $data->id_checkout; ?></h4>
	</div>
	<div class="card-body scroll">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Detail Transaksi</div>
					</div>
					<div class="card-body">
						<?php 
							$trans = $this->db->get_where('transaksi', array('id_checkout' => $data->id_checkout))->row();
							$cus = $this->db->get_where('customer', array('id_customer' => $data->id_customer))->row();
							$total = $this->db->get_where('transaksi', array('id_checkout' => $data->id_checkout))->row();
						?>
						<div class="flex-1 pt-1 ml-2 mb-2">
							<h6 class="fw-bold mb-1">No Invoice</h6>
							<small class="text-muted"><?= $trans->order_id ?></small>
						</div>

						<div class="flex-1 pt-1 ml-2 mb-2">
							<h6 class="fw-bold mb-1">Jenis Transaksi</h6>
							<small class="text-muted"><?= ($trans->jenis_transaksi == 1) ? 'Tripay' : "Cash" ?></small>
						</div>

						<div class="flex-1 pt-1 ml-2 mb-2">
							<h6 class="fw-bold mb-1">Nama Cutomer</h6>
							<small class="text-muted"><?= $data->id_customer == NULL ? $data->nama:$cus->nama_customer  ?></small>
						</div>
						<div class="flex-1 pt-1 ml-2 mb-2">
							<h6 class="fw-bold mb-1">Jenis Cutomer</h6>
							<small class="text-muted"><?= $data->id_customer == NULL ? "Non Member" : "Member" ?></small>
						</div>

						<div class="flex-1 pt-1 ml-2 mb-2">
							<h6 class="fw-bold mb-1">Waktu</h6>
							<small class="text-muted"><?= $trans->waktu_transaksi ?></small>
						</div>
						<div class="flex-1 pt-1 ml-2 mb-2">
							<h6 class="fw-bold mb-1">Statsu Pembayaran</h6>
							<small class="text-muted"><?php if ($trans->status_transaksi == 'PAID') {
										echo "<span class='badge badge-success'>Sukses</span>";
									}else{
										echo "<span class='badge badge-danger'>Gagal</span>";
									} ?></small>
						</div>
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
							$this->db->where('checkoutproduk.id_checkout', $data->id_checkout);
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
						
						<div class="d-flex">
							<div class="flex-1 pt-1 ml-2">
								<h6 class="fw-bold mb-1">Biaya Admin :</h6>
							</div>
							<div class="d-flex ml-auto align-items-center pt-1 pr-2">
								<h6 class="fw-bold mb-1">Rp. <?php echo rupiah($total->byr_admin); ?></h6>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex bg-primary text-white">
							<div class="flex-1 pt-1 ml-2">
								<h6 class="fw-bold mb-1">Total :</h6>
							</div>
							<div class="d-flex ml-auto align-items-center pt-1 pr-2">
								<h6 class="fw-bold mb-1">Rp. <?php echo rupiah($total->total_transaksi); ?></h6>
							</div>
						</div>
						<div class="separator-dashed"></div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
  	function openWin()
	{
		var myWindow=window.open('<?=base_url('admin/print/'.$data->id_checkout) ?>','','width=500,height=700');
		
		// myWindow.document.close();
		// myWindow.focus();
		// myWindow.print();
		// myWindow.close();
		myWindow.focus();
		myWindow.print();
			
	}
</script>
