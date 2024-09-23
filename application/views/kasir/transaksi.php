<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
    	<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<!-- <h2 class="text-white fw-bold">Pesanan Baru</h2> -->
    	</div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row row-card-no-pd mt--2 shadow">
    	<div class="card-body">
			<div class="row">
				<div class="col-md-6" style="padding-left: 20px">
        			<h4>List menu</h4>
					
						<div class="form-group">
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Cari Produk [ENTER]" id="cari" name="keyword">
								<button id="cari" onclick="cari()" class="btn btn-primary"><i class="fas fa-search"></i> </button>
							</div>
						</div>

					<div id="load"></div>
				</div>

				<div class="col-md-6 border-left">
					<h4>KERANJANG BELANJA</h4>
					<hr>
					<form action="<?= base_url('kasir/checkout') ?>" method="post">
						<div id="load-pesanan"></div>
						<hr>
						<div class="mt-2">
							<div class="row mb-2">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Nama Customer</label>
										<input type="text" name="nama_customer" class="form-control" placeholder="Nama Customer" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Meja</label>
										<select name="meja" required class="form-control">
											<?php foreach ($meja as $m) { ?>

												<option value="<?= $m->id_meja ?>">Meja No <?= $m->nomor_meja ?></option>

											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Metode Pembayaran</label>
										<select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
											<option value="2">Cash</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Total Uang</label>
										<input type="number" name="jml_bayar" placeholder="00000" class="form-control">
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
							<div class="float-right">
								<button type="button" id="clear_cart" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Kosongkan </button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
    </div>
</div>

<script>
	$(function(){
		loadPesanan();      
    });
	function loadPesanan(){
        $("#load-pesanan").html('<span class="text-center"><i class="fas fa-spin fa-spinner"></i> Loading data...</span>');
        $("#load-pesanan").load("<?=site_url('kasir/pesanan')?>");
    }
</script>

<script>
// AJAX call for autocomplete 
$(document).ready(function(){
	$("#cari").change(function(){
		$.ajax({
			type: "POST",
			url: "<?= base_url('kasir/cariproduk') ?>",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#load").hide();
				$("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
			},
			success: function(html){
				$("#tunggu").html('');
				$("#load").show();
				$("#load").html(html);
			}
		});
	});

	$('#clear_cart').on('click', function(e){
		e.preventDefault();

		//pop up
		swal({
			title: "konfirmasi ??",
			text: 'Kosongkan keranjang', 
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url:"<?php echo base_url(); ?>kasir/clear/",
					method:"POST",
					success:function(data)
					{
						swal("Keranjang berhasil dikosongkan!", {
							icon: "warning",
						});
						loadPesanan();
					}
				});
			} else {
				swal("Tidak ada perubahan data", {
					icon: "warning",
				});
			}
		});
	});
});
</script>

