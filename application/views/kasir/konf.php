<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
    	<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<h2 class="text-white fw-bold">Detail Transkasi | <?= $detailCheckout->id_checkout; ?></h2>
    	</div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row row-card-no-pd mt--2 shadow">
    	<div class="card-body">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card-title">Detail Customer</div>
                    <table class="table table-striped table-sm" width="100%">
                        <tr>
                            <td width="10%" class="text-nowrap">ID ORDER</td>
                            <td width="1px">:</td>
                            <td><?= $detailCheckout->id_checkout ?></td>
                        </tr>
                        <tr>
                            <td width="10%" class="text-nowrap">Nama Customer</td>
                            <td width="1px">:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td width="10%" class="text-nowrap">Nomor Meja</td>
                            <td width="1px">:</td>
                            <td><?= $detailCheckout->meja_checkout ?></td>
                        </tr>
                        <tr>
                            <td width="10%" class="text-nowrap">Total Bayar</td>
                            <td width="1px">:</td>
                            <td><?= $detailCheckout->total_checkout ?></td>
                        </tr>
                        <tr>
                            <td width="10%" class="text-nowrap">Status Bayar</td>
                            <td width="1px">:</td>
                            <td><?= transaksi($detailTransaksi->status_transaksi) ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Detail Produk</div>
                        </div>
                        <div class="card-body">
                            <?php
                                $this->db->select('*');
                                $this->db->join('produk', 'produk.id_produk=checkoutproduk.id_produk');
                                $this->db->where('checkoutproduk.id_checkout', $detailCheckout->id_checkout);
                                $datas = $this->db->get('checkoutproduk')->result();

                                foreach ($datas as $row) {
                            ?>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="<?= base_url().'uploads/produk/'.$row->gambar_produk ?>" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1"><?= $row->nama_produk.' ('.$row->variasi_produk.')';?></h6>
                                    <small class="text-muted"><?= rupiah($row->harga_produk).' ('.$row->jml_checkout.'x)'; ?></small>
                                </div>
                                <div class="d-flex ml-auto align-items-center pt-1 pr-2">
                                    <small class="text-muted">Rp. <?= rupiah($row->harga_produk*$row->jml_checkout) ?></small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <?php } ?>
                            
                            <div class="d-flex">
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Biaya Admin :</h6>
                                </div>
                                <div class="d-flex ml-auto align-items-center pt-1 pr-2">
                                    <h6 class="fw-bold mb-1">Rp. <?php echo rupiah($detailTransaksi->byr_admin); ?></h6>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex bg-primary text-white">
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Total Bayar :</h6>
                                </div>
                                <div class="d-flex ml-auto align-items-center pt-1 pr-2">
                                    <h6 class="fw-bold mb-1">Rp. <?php echo rupiah($detailTransaksi->total_transaksi); ?></h6>
                                </div>
                            </div>
                            <div class="d-flex bg-primary text-white border-top">
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Jumlah Bayar :</h6>
                                </div>
                                <div class="d-flex ml-auto align-items-center pt-1 pr-2">
                                    <h6 class="fw-bold mb-1">Rp. <?php echo rupiah($detailTransaksi->jml_bayar); ?></h6>
                                </div>
                            </div>
                            <div class="d-flex border-top">
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Kembali :</h6>
                                </div>
                                <div class="d-flex ml-auto align-items-center pt-1 pr-2">
                                    <h6 class="fw-bold mb-1">Rp. <?php echo rupiah($detailTransaksi->jml_bayar - $detailTransaksi->total_transaksi); ?></h6>
                                </div>
                            </div>
                            
                            <a class="btn btn-primary" href="#" onclick="openWin()" >
                                <i class="fas fa-print"></i> Cetak Struk
                            </a>
                            <div class="separator-dashed"></div>


                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  	function openWin()
	{
		var myWindow=window.open('<?=base_url('kasir/print/'.$detailTransaksi->id_checkout) ?>','','width=500,height=700');
		
		// myWindow.document.close();
		// myWindow.focus();
		// myWindow.print();
		// myWindow.close();
		myWindow.focus();
		myWindow.print();
			
	}
</script>