<div class="card">
	<div class="card-header">
		<div class="float-right">
			<button class="btn btn-danger btn-sm" onclick="history.back()"><i class="flaticon-left-arrow-1"></i> Kembali</button>
		</div>
		<h4 class="card-title">Edit Menu</h4>
	</div>
	<div class="card-body">
		<form action="<?=base_url('admin/updateMenu') ?>" method="post" enctype="multipart/form-data">
		    <div class="form-group">
		        <label>Nama Porduk <span class="text-danger">*</span></label>
		        <input type="hidden" name="jenis" value="<?=$data->jenis_produk; ?>">
		        <input type="hidden" name="id" value="<?=$data->id_produk; ?>">
		        <input type="text" placeholder="Nama Porduk" class="form-control" value="<?=$data->nama_produk; ?>" name="nama" required>
		    </div>
		    <div class="form-group">
		     	<label>Harga <span class="text-danger">*</span></label>
		     	<input type="number" placeholder="Harga" class="form-control" value="<?= rupiah($data->harga_produk) ?>" name="harga" required>
		    </div>
		    <div class="form-group">
		     	<label>Stok <span class="text-danger">*</span></label>
		     	<select class="form-control" name="stok"  required>
			      	<option <?php if($data->stok_produk == 1){echo "selected";} ?> value="1">Ada</option>
			      	<option <?php if($data->stok_produk == 0){echo "selected";} ?> value="0">Kosong</option>
			      	<option <?php if($data->stok_produk == 2){echo "selected";} ?> value="2">Habis</option>
		     	</select>
		    </div>
		    <div class="form-group">
		     	<label>Variasi Rasa <span class="text-danger">*</span></label>
		     	<br>
		     	 <!-- Pedas  Manis  Sedang  Extra Pedas -->
		     	<?php if($data->jenis_produk == 'makanan') { ?>
					<input type="radio" <?php if($data->variasi_produk == "Pedas"){echo "checked";} ?> value="Pedas" name="variasi"> <label class="pr-3">Pedas</label>
		        		<input type="radio" <?php if($data->variasi_produk == "Manis"){echo "checked";} ?> value="Manis" name="variasi"> <label class="pr-3">Manis</label>
		        		<input type="radio" <?php if($data->variasi_produk == "Sedang"){echo "checked";} ?> value="Sedang" name="variasi"> <label class="pr-3">Sedang</label>
		        		<input type="radio" <?php if($data->variasi_produk == "Extra Pedas"){echo "checked";} ?> value="Extra Pedas" name="variasi"> <label class="pr-3">Extra Pedas</label>
				<?php }else{ ?>

					<input type="radio" <?php if($data->variasi_produk == "Dingin"){echo "checked";} ?> value="Dingin" name="variasi"> <label class="pr-3">Dingin</label>
		        		<input type="radio" <?php if($data->variasi_produk == "Panas"){echo "checked";} ?> value="Panas" name="variasi"> <label class="pr-3">Panas</label>
				<?php } ?>
				<input type="radio" <?php if($data->variasi_produk == "*"){echo "checked";} ?> value="*" name="variasi"> <label class="pr-3">*</label>
		     	
		    </div>
		    <div class="form-group">
		     	<label>Foto Produk <span class="text-danger">*</span></label><br>
		     	<img width="100" src="<?=base_url('uploads/produk/'.$data->gambar_produk) ?>"> <br><br>
		     	<input type="file" name="image" accept="image/*">
		     	<input type="hidden" name="lama" value="<?= $data->gambar_produk ?>">
		     	<br>
		     	<small class="text-muted">File yang diizinkan png, jpeg, jpg</small>
		    </div>
		    <div class="form-group">
		       	<label>Deskripsi</label>
		       	<textarea class="form-control" placeholder="Deskripsi Produk" rows="5" name="desk"><?=$data->desk_produk; ?></textarea>
		    </div>
		    <div class="text-center">
		      	<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
			</div>
		</form>
	</div>
</div>