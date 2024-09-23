<div class="page-header">
    <h4 class="page-title">Setting</h4>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center fw-bold">Info Website</h5>
                <form method="post" action="<?= base_url('admin/updateinfo') ?>">
                    <div class="form-group">
                        <label>Nama Cafe</label>
                        <input type="hidden" name="id" value="<?= $id_kon ?>">
                        <input type="text" name="name_kon" class="form-control form-control-sm" required value="<?= $name_kon ?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat Cafe</label>
                        <input type="text" name="alamat_kon" class="form-control form-control-sm" required value="<?= $alamat_kon ?>">
                    </div>
                    <div class="form-group">
                        <label>Telp</label>
                        <input type="number" name="telp" class="form-control form-control-sm" required value="<?= $telp_kon ?>">
                    </div>
                    <button class="btn btn-primary btn-sm btn-block">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-6">
        <div class="card card-body">
            <h5 class="text-center fw-bold">Pembayaran Transfer</h5>
            <form method="post" action="<?= base_url('admin/updateTf') ?>">
                <div class="form-group">
                    <label>No Rek</label>
                    <input type="hidden" name="id" value="<?= $id_kon ?>">
                    <input type="number" name="rek_kon" class="form-control form-control-sm" required value="<?= $rek_kon ?>">
                </div>
                <div class="form-group">
                    <label>Bank</label>
                    <input type="text" name="bank_kon" class="form-control form-control-sm" required value="<?= $bank_kon ?>">
                </div>
                <div class="form-group">
                    <label>Pemilik Rekening</label>
                    <input type="text" name="pemilik_kon" class="form-control form-control-sm" required value="<?= $pemilik_kon ?>">
                </div>
                <button class="btn btn-primary btn-sm btn-block">SIMPAN</button>
            </form>
        </div>
    </div> -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center fw-bold">Pembayaran Online</h5>
                <p>Pembayran online menggunakan bantuan aplikasi pihak ke 3 yakni : TRIPAY. untuk dokumentasi bisa dilihat <a href="https://tripay.co.id/developer" target="_blank">disini</a></p>
                <form method="post" action="<?= base_url('admin/updateTripay') ?>">
                    <input type="hidden" name="id" value="<?= $id_kon ?>">
                    <div class="form-group">
                        <label>Mode</label>
                        <select name="mode" class="form-control form-control-sm">
                            <option <?php if($tripay_server == 0){echo "selected";} ?> value="0">Sanbox</option>
                            <option <?php if($tripay_server == 1){echo "selected";} ?> value="1">Porduction</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kode Merchant</label>
                        <input type="text" name="tripay_code" class="form-control form-control-sm" required value="<?= $tripay_code ?>">
                    </div>
                    <div class="form-group">
                        <label>Private Key</label>
                        <input type="text" name="tripay_private" class="form-control form-control-sm" required value="<?= $tripay_private ?>">
                    </div>
                    <div class="form-group">
                        <label>Public Key</label>
                        <input type="text" name="tripay_api" class="form-control form-control-sm" required value="<?= $tripay_api ?>">
                    </div>
                    <div class="form-group">
                        <label>Biaya Admin</label>
                        <input type="number" name="byr_admin" class="form-control form-control-sm" required value="<?= $byr_admin ?>">
                    </div>
                    <button class="btn btn-primary btn-sm btn-block">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>

</div>
    