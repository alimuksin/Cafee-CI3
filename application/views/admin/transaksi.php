<div class="card">
	<div class="card-header">
		<h4 class="card-title">Data Transaksi</h4>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="basic-datatables" class="table table-striped table-sm table-head-bg-primary text-nowrap" width="100%">
				<thead>
					<tr>
						<th width="1px">No</th>
						<th>Transkasi ID</th>
						<th>Jenis Transaksi</th>
						<th>Status</th>
						<th>Waktu</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($data)){ $no=1; foreach ($data as $key)  { ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $key->order_id; ?></td>
						<td><?php if ($key->jenis_transaksi == 1) {
							echo "<span class='text-success'>Online</span>";
						}else{
							echo "Cash";
						} ?></td>
						<td>
							<?php 
								$trans = $this->db->get_where('transaksi', array('id_checkout' => $key->id_checkout))->row();
								$counttrans = $this->db->get_where('transaksi', array('id_checkout' => $key->id_checkout))->num_rows();
								if ($counttrans > 0) {
									echo transaksi($trans->status_transaksi);
								}else{
									echo "<span class='badge badge-warning'>Belum dibayar</span>";
								}
							?>
						</td>
						<td><?= format_tanggal($key->waktu_checkout); ?></td>
						<td>
							<div class="form-button-action">
								<a title="" class="btn btn-link btn-primary btn-lg" href="<?=base_url('admin/transaksiDetail?orderId='.$key->id_checkout); ?>">
									<i class="fa fa-info"></i>
								</a>
								<a href="<?=base_url('admin/hapustransaksi/'.$key->id_transaksi); ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
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