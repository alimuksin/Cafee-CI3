<style>
	.avatar{
		width: 2rem;
		height: 2rem;
	}

</style>

<div class="table-responsive">
	<table class="table-bordered table-sm" width="100%">
		<thead>
			<tr>
				<th>Item</th>
				<th>QTY</th>
				<th class="text-center">#</th>
			</tr>
		</thead>

		<tbody>
			<?php $total = 0; $no=1; foreach ($cart as $row) {
				
			?>
				<tr>
					<td>
						<h6 class="text-uppercase mb-1"><?= $row->nama_produk ?> (<span class="text-muted"><?= $row->variasi_produk ?></span>)</h6>
						<strong>@ <?= rupiah($row->harga_produk) ?></strong>
						<input type="hidden" name="id[<?= $no; ?>]" value="<?= $row->id_produk ?>">
					</td>
					<td>
						<input type="hidden" name="qty[<?= $no; ?>]" class="form-control form-control-sm" value="<?= $row->jml ?>">
						<?= $row->jml ?>
					</td>
					<td>
						<small class="text-muted">
							<strong><?= rupiah($row->harga*$row->jml); ?></strong>
							<a href="#" name="remove" class="btn btn-sm text-danger remove" id='<?= $row->id; ?>'>
								<i class="fa fa-trash"></i>
							</a>
						</small>
					</td>
				</tr>
				<?php $total += $row->juml_bayar; ?>
			<?php  $no++; } ?>
			<tr class="bg-dark text-light">
				<th colspan="2">Total Bayar</th>
				<th>
					<input type="hidden" name="total" value="<?= ($total) ?>">
					<?= rupiah($total) ?>
				</th>
			</tr>
		</tbody>
	</table>
	
</div>

	
		
	
	<div class="mb-3"></div>

<script>

	$(document).ready(function(){
		
		function loadPesanan(){
			$("#load-pesanan").html('<span class="text-center"><i class="fas fa-spin fa-spinner"></i> Loading data...</span>');
			$("#load-pesanan").load("<?=site_url('kasir/pesanan')?>");
		}

		$('.remove').on('click', function(e){
			e.preventDefault(); //cancel default action
			var id = $(this).attr("id")


			//pop up
			swal({
				title: "konfirmasi ??",
				text: 'Delete this data ',
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
			if (willDelete) {
					
				
				$.ajax({
					url:"<?php echo base_url(); ?>kasir/removeItem/"+id,
					method:"POST",
					success:function(data)
					{
						swal("Data berhasil dihapus!", {
							icon: "success",
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

