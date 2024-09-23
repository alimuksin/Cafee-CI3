<div class="card">
	<div class="card-header">
		<div class="float-right">
			<button class="btn btn-danger btn-sm" onclick="history.back()"><i class="flaticon-left-arrow-1"></i> Kembali</button>
		</div>
		<h4 class="card-title">Edit Menu</h4>
	</div>
	<div class="card-body">
		<form action="<?=base_url('admin/updatePengguna') ?>" method="post" enctype="multipart/form-data">
		    <div class="form-group">
		        <label> Nama Pengguna <span class="text-danger">*</span></label>
		        <input type="text" name="nama" class="form-control" value="<?=$data->name_user; ?>" required>
		        <input type="hidden" name="id" value="<?=$data->id_user; ?>">
		    </div>

		    <div class="form-group">
		        <label> Email <span class="text-danger">*</span></label>
		        <input type="email" name="email" class="form-control" value="<?=$data->email_user; ?>" required>
		    </div>

		    <div class="form-group">
		        <label> Password</label>
		        <input type="password" name="password" class="form-control">
		    </div>
		    <div class="form-group">
		     	<label>Role <span class="text-danger">*</span></label>
		     	<select class="form-control" name="role"  required>
			      	<option <?php if($data->role_user == 1){echo "selected";} ?> value="1">Admin</option>
			      	<option <?php if($data->role_user == 2){echo "selected";} ?> value="2">Kasir</option>
		     	</select>
		    </div>
		    
		    <div class="text-center">
		      	<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
			</div>
		</form>
	</div>
</div>