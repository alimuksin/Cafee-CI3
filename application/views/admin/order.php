<div class="card">
	<div class="card-header">
		<h4 class="card-title">Data Order</h4>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="basic-datatables" class="table table-striped table-sm table-head-bg-primary"  width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Order ID</th>
						<th>Nama Customer</th>
						<th>No Meja</th>
						<th>Waktu</th>
						<th>Status Pesanan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($checkout)){ $no=1; foreach ($checkout as $key)  { ?>
					<tr id="<?= $key->id_checkout; ?>">
						<td><?= $no++; ?></td>
						<td><?= $key->id_checkout; ?></td>
						<td>
							<?php
							if($key->id_customer == NULL){
								echo $key->nama;
							}else{
								echo $this->db->get_where('customer', array('id_customer' => $key->id_customer))->row()->nama_customer;
							} ?>
						</td>
						<td><?= $key->meja_checkout; ?></td>
						<td class="text-nowrap"><?= format_tanggal($key->waktu_checkout); ?></td>
						<td><?= proses($key->status_checkout); ?></td>
						<td>
							<div class="form-button-action">
								<a  title="" class="btn btn-link btn-primary btn-lg" href="<?=base_url('admin/orderDetail?orderId='.$key->id_checkout); ?>">
									<i class="fa fa-info"></i>
								</a>
								<a href="<?=base_url('admin/hapusorder/'.$key->id_checkout); ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
									<i class="fa fa-times"></i>
								</a>
								
							</div>
						</td>
					</tr>
					<?php } }?>
				</tbody>
			</table>
		</div>
	</div>
</div>