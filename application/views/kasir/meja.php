<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
    	<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    		<div>
    			<h2 class="text-white pb-2 fw-bold">Data Meja</h2>
    		</div>
    		<div class="ml-md-auto py-2 py-md-0">
    			<a href="<?= base_url('kasir') ?>" class="btn btn-white btn-border btn-round">Kembali</a>
				<button class="btn btn-white btn-border btn-round" data-toggle="modal" data-target="#add">Tambah</button>
    		</div>
    	</div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="card">
    	<div class="card-body">
        <table id="basic-datatables" class="table table-striped table-sm table-head-bg-primary" >
				<thead>
					<tr>
						<th width="1px">#</th>
						<th>Nomor Meja</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($meja)){ $no=1; foreach ($meja as $key)  { ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= 'No - '.$key->nomor_meja; ?></td>
						<td><?php if ($key->status_meja == 1) {
							echo "<span class='badge badge-warning'>Sudah dibooking</span>";
						}else if ($key->status_meja == 2) {
							echo "<span class='badge badge-success'>Isi</span>";
						}else{
							echo "<span class='badge badge-primary'> Kosong</span>";
						} ?></td>
						<td class="">
							<div class="btn-group">
								<?php if ($key->status_meja == 1) {
							echo "<a href='".base_url('kasir/mejaupdate?id='.$key->id_meja.'&status=0')."' class='btn btn-xs btn-primary'>Kosongkan</a>";
							echo "<a href='".base_url('kasir/mejaupdate?id='.$key->id_meja.'&status=2')."' class='btn btn-xs btn-success'>Isi</a>";
						}else if ($key->status_meja == 2) {
							echo "<a href='".base_url('kasir/mejaupdate?id='.$key->id_meja.'&status=0')."' class='btn btn-xs btn-primary'>Kosongkan</a>";
							echo "<a href='".base_url('kasir/mejaupdate?id='.$key->id_meja.'&status=1')."' class='btn btn-xs btn-warning'>Diboking</a>";
						}else{
							echo "<a href='".base_url('kasir/mejaupdate?id='.$key->id_meja.'&status=1')."' class='btn btn-xs btn-warning'>Diboking</a>";
							echo "<a href='".base_url('kasir/mejaupdate?id='.$key->id_meja.'&status=2')."' class='btn btn-xs btn-success'>Isi</a>";
						} ?>
								
								<a href="<?=base_url('kasir/hapusmeja/'.$key->id_meja); ?>" data-toggle="tooltip" title="" class="btn btn-danger btn-xs" data-original-title="Remove">
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



<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<form method="post" action="<?= base_url('kasir/addMeja');?>">
		      	<div class="modal-body">
		        	<div class="form-group">
		        		<label>Nomor Meja</label>
		        		<input type="number" name="nomor" class="form-control" required>
		        	</div>
		        	<div class="form-group">
		        		<label>Status Meja</label>
		        		<select name="status" required class="form-control">
		        			<option value="0">Ready</option>
		        			<option value="1">Sudah dibooking</option>
		        			<option value="2">Sedang dipakai</option>
		        		</select>
		        	</div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
		        	<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
		      	</div>
		   	</form>
	    </div>
  	</div>
</div>