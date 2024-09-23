<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card card-body">
			<h5 class="text-center fw-bold">Laporan Transaksi</h5>
			<div class="mt-3 mb-3 text-center">
				<a href="<?= base_url('admin/cetak_harian') ?>" class="btn btn-primary btn-sm ">Cetak Hari ini</a>
			</div>
			<form method="post" action="<?=base_url('admin/cetak') ?>">
				<div class="form-group">
					<label>Filter Tanggal</label>
					<div class="input-group mb-3">
						<input type="date" class="form-control" name="tgl_awal" placeholder="Tanggal" aria-label="Tanggal" aria-describedby="basic-addon1">
					  	<div class="input-group-prepend">
					    	<span class="input-group-text" id="basic-addon1">S/d</span>
					  	</div>
					  	<input type="date" class="form-control" name="tgl_akhir" placeholder="Tanggal" aria-label="Tanggal" aria-describedby="basic-addon1">
					</div>
					<div class="form-group">
						<label>Jenis Laporan</label>
						<select class="form-control" name="jenis">
							<option value="pdf">PDF</option>
							<option value="excel">EXCEL</option>
						</select>
					</div>

					<button type="submit" class="btn btn-primary btn-sm mt-3 btn-block">Cetak</button>

				</div>
			</form>
		</div>
	</div>
</div>