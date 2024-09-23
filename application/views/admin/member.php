<div class="card">
	<div class="card-header">
		<h4 class="card-title">Data Member</h4>
	</div>
	<div class="card-body">
		<p>Password reset adalah = <b>password</b></p>
		<div class="table-responsive">
			<table id="basic-datatables" class="table table-striped table-sm table-head-bg-primary text-nowrap">
				<thead>
					<tr>
						<th width="1px">No</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Telp</th>
						<th>Password</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($customer as $key) { ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $key->nama_customer; ?></td>
						<td><?= $key->email_customer; ?></td>
						<td><?= $key->telp_customer; ?></td>
						<td><?= $key->password_customer; ?></td>
						<td><?= status($key->status_customer); ?></td>
						<td>
							<div class="form-button-action">
								<a href="<?=base_url('admin/resetMember/'.$key->id_customer) ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Reset Password">
									<i class="fa fa-key"></i>
								</a>

								<a href="<?=base_url('admin/editMember/'.$key->id_customer) ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
									<i class="fa fa-edit"></i>
								</a>
								<a href="<?=base_url('admin/hapusMember/'.$key->id_customer) ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
									<i class="fa fa-times"></i>
								</a>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>