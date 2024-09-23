<div class="card">
	<div class="card-header">
		<div class="float-right">
			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add">Tambah</button>
		</div>
		<h4 class="card-title">Data Pengguna</h4>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="basic-datatables" class="table table-striped table-sm table-head-bg-primary text-nowrap">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Role</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data->result() as $key) { ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $key->name_user; ?></td>
						<td><?= $key->email_user; ?></td>
						<td><?= $key->role_user; ?></td>
						<td>
							<div class="form-button-action">
								<a href="<?=base_url('admin/editpengguna/'.$key->id_user) ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
									<i class="fa fa-edit"></i>
								</a>
								<a href="<?=base_url('admin/hapuspengguna/'.$key->id_user) ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
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


<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<form method="post" action="<?=base_url('admin/penggunaAdd') ?>">
		      	<div class="modal-body">
		        	<div class="form-group">
		        		<label> Nama Pengguna</label>
		        		<input type="text" name="nama" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label> Email</label>
		        		<input type="email" name="email" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label> Password</label>
		        		<input type="password" name="pass" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label> Role User</label>
		        		<select class="form-control" name="role" required>
		        			<option value="1">Admin</option>
		        			<option value="2">Kasir</option>
		        		</select>
		        	</div>
		      	</div>
		      	<div class="modal-footer">
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
		      	</div>
		    </form>
	    </div>
  	</div>
</div>