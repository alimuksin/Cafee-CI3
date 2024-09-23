<div class="card">
	<div class="card-header">
		<div class="float-right">
			<button class="btn btn-danger btn-sm" onclick="history.back()"><i class="flaticon-left-arrow-1"></i> Kembali</button>
		</div>
		<h4 class="card-title">Edit Menu</h4>
	</div>
	<div class="card-body">
		<form action="<?=base_url('admin/updateMember') ?>" method="post" enctype="multipart/form-data">
		    <div class="form-group">
		        <label> Nama Pengguna</label>
		        <input type="text" readonly name="nama" class="form-control" value="<?=$data->nama_customer; ?>" required>
		        <input type="hidden" name="id" value="<?=$data->id_customer; ?>">
		    </div>

		    <div class="form-group">
		        <label> Email</label>
		        <input readonly type="email" name="email" class="form-control" value="<?=$data->email_customer; ?>" required>
		    </div>

		    <div class="form-group">
		        <label> Telp</label>
		        <input readonly type="number" name="telp" class="form-control" value="<?=$data->telp_customer; ?>" required>
		    </div>

		    <div class="form-group">
		     	<label>Status <span class="text-danger">*</span></label>
		     	<select class="form-control" name="status"  required>
			      	<option <?php if($data->status_customer == 1){echo "selected";} ?> value="1">Aktif</option>
			      	<option <?php if($data->status_customer == 2){echo "selected";} ?> value="2">Tidak Aktif</option>
		     	</select>
		    </div>
		    
		    <div class="text-center">
		      	<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
			</div>
		</form>
	</div>
</div>