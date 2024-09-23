<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
    	<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    		<div>
    			<h2 class="text-white pb-2 fw-bold">Data Menu</h2>
    		</div>
    		<div class="ml-md-auto py-2 py-md-0">
    			<a href="<?= base_url('kasir') ?>" class="btn btn-white btn-border btn-round">Kembali</a>
				<button class="btn btn-white btn-border btn-round" data-toggle="modal" data-target="#exampleModal">Tambah</button>
    		</div>
    	</div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="card">
    	
		<div class="card-body">
		
			<div class="table-responsive">
				<table id="basic-datatables" class="table table-sm table-head-bg-primary" width="100%	">
					<thead>
						<tr>
							<th width="1px">No</th>
							<th>Images</th>
							<th>Nama</th>
							<th>Harga</th>
							<th>Variasi</th>
							<th>Stok</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($data)){ $no=1; foreach ($data as $key)  { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td> <img width="100" src="<?=base_url('uploads/produk/'.$key->gambar_produk) ?>"> </td>
							<td><?= $key->nama_produk; ?></td>
							<td><?= rupiah($key->harga_produk); ?></td>
							<td><?= $key->variasi_produk; ?></td>					
							<td><?php if ($key->stok_produk ==1) {
								echo "Ready";
							}else if ($key->stok_produk ==0){
								echo "Kosong";
							}else{
								echo "Habis";
							} ?></td>				
							<td>
								<div class="form-button-action">
									<a href="<?=base_url('kasir/editmenu/'.$key->id_produk) ?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
										<i class="fa fa-edit"></i>
									</a>
									<a href="<?=base_url('kasir/hapusMenu/'.$key->id_produk) ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger btn-lg" data-original-title="Edit Task">
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
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Tambah Makanan</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<form action="<?=base_url('kasir/addMenu') ?>" method="post" enctype="multipart/form-data">
		      	<div class="modal-body">
                    <div class="form-group">
		        		<label>Jenis Menu <span class="text-danger">*</span></label>
		        		<select name="jenis" class="form-control">
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
		        	</div>
		        	<div class="form-group">
		        		<label>Nama Menu <span class="text-danger">*</span></label>
		        		<input type="text" placeholder="Nama Menu" class="form-control" name="nama" required>
		        	</div>
		        	<div class="form-group">
		        		<label>Harga <span class="text-danger">*</span></label>
		        		<input type="number" placeholder="Harga" class="form-control" name="harga" required>
		        	</div>
		        	<div class="form-group">
		        		<label>Stok <span class="text-danger">*</span></label>
		        		<select class="form-control" name="stok"  required>
		        			<option value="1">Ada</option>
		        			<option value="0">Kosong</option>
		        			<option value="2">Habis</option>
		        		</select>
		        	</div>
		        	<div class="form-group">
		        		<label>Variasi Rasa <span class="text-danger">*</span></label>
		        		<br>
		        		<input type="radio" value="*" name="variasi"> <label class="pr-3">Tidak ada</label>
		        		<input type="radio" value="Pedas" name="variasi"> <label class="pr-3">Pedas</label>
		        		<input type="radio" value="Manis" name="variasi"> <label class="pr-3">Manis</label>
		        		<input type="radio" value="Sedang" name="variasi"> <label class="pr-3">Sedang</label>
		        		<input type="radio" value="Extra Pedas" name="variasi"> <label class="pr-3">Extra Pedas</label>
		        	</div>
		        	<div class="form-group">
		        		<label>Foto Produk <span class="text-danger">*</span></label><br>
		        		<input type="file" name="image" required accept="image/*">
		        		<br>
		        		<small class="text-muted">File yang diizinkan png, jpeg, jpg</small>
		        	</div>
		        	<div class="form-group">
		        		<label>Deskripsi</label>
		        		<textarea class="form-control" placeholder="Deskripsi Makanan" rows="5" name="desk"></textarea>
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