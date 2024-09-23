<style>
    label{
        color: white;
        padding-bottom: 5px;
    }
    .invoice{
        margin-top: 10px;
        background-color: #fff;
        min-height: 100px;
    }
    .form-control{
        border: 1px solid #291301;
    }
</style>
<div class="container-fluid mt-5 pt-3">
    <div class="home-kedua mb-4 row">
        <h5 class="home-judul text-center fw-bold mb-4">KERANJANG PESANAN
        </h5>
        <div class="row justify-content-center m-0">
            <div class="col-md-6">
                <div class="card border border-utama">
                    <div class="card-body p-0">
                        <form method="post" action="<?= base_url('cekout/konfirmasi') ?>">
                            <input type="hidden" value="<?php if ($this->session->userdata('id_customer') != NULL) {
                                echo $this->session->userdata('id_customer');
                            }else{
                                echo 0;
                            } ?>" name="id_customer">
                            <div class="row p-2">
                                <div class="col-md-6 mb-2">
                                    <label>Nama Lengkap</label>
                                    <input type="text" disabled class="form-control" id="nama" name="nama" value="<?php if ($this->session->userdata('nama_customer') == NUll) {echo "";}else{
                                            echo $this->session->userdata('nama_customer');
                                        } ?>" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Telp</label>
                                    <input type="number" disabled class="form-control" id="telp" value="<?php if ($this->session->userdata('telp_customer') == NUll) {echo "";}else{
                                        echo $this->session->userdata('telp_customer');
                                    } ?>" required name="telp">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="mb-2">
                                        <label>Meja *</label>
                                        <?php $mejacount = $this->db->get_where('meja', array('status_meja' => 0))->num_rows();
                                            
                                        if ($mejacount <= 0) {
                                            echo '<input type="text" class="form-control" value="meja penuh" readonly style="background-color: #291301; color: white;">';
                                        }else{ ?>
                                            <select class="form-control" name="meja" required>
                                                <option value="">Pilih Meja</option>
                                                <?php foreach ($meja as $m) { ?>
                                                    <option value="<?= $m->id_meja ?>">Meja No <?= $m->nomor_meja ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>

                                <fieldset class="question">
                                    <label for="pesansekarang">Pesan untuk sekarang ?</label>
                                    <br>
                                    <input class="form-check-input pesansekarang" checked type="checkbox" name="pesansekarang" value="1" />
                                    <span class="text-white">Yes</span>
                                </fieldset>

                                <br>
                                <br>
                                <br>

                                <fieldset class="answer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label>Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label>Waktu</label>
                                                <input type="time" class="form-control" name="waktu">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                
                                <script>
                                        $(".answer").hide();
                                        $(".pesansekarang").click(function() {
                                            if($(this).is(":checked")) {
                                                $(".answer").hide();
                                            } else {
                                                $(".answer").show();                                                
                                            }
                                        });
                                    </script>
                                
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <label>Catatan</label>
                                        <textarea class="form-control" name="catatan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice">
                                <ul class="list-group">
                                    <li class="list-group-item rounded-0 bg-hover">
                                        <strong>Detail Pesanan</strong>
                                    </li>
                                </ul>

                                <div class="table-responsive">
                                    <table class="table table-bordered mt-2 table-sm">
                                        <tr class="bg-primary">
                                            <th class="text-white">Item</th>
                                            <th class="text-white">Harga</th>
                                            <th class="text-white">QTY</th>
                                            <th class="text-white">#</th>
                                            <th class="text-white">Jumlah</th>
                                        </tr>
                                        <?php if (!empty($this->cart->contents())) { $i = 1; foreach ($this->cart->contents() as $items): ?>
                                        <?= form_hidden($i.'[rowid]', $items['rowid']); ?>
                                            <input type="hidden" name="produk[]" id="produk[]" value="<?= $items['id']; ?>">
                                            <input type="hidden" name="qty[]" id="qty[]" value="<?= $items['qty']; ?>">
                                            <tr>
                                                <td>
                                                    <?= $items['name']; ?>
                                                    (<em class="text-primary"><?= $items['variasi']; ?></em>)
                                                </td>
                                                <td>
                                                    <?= rupiah($items['price']); ?>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?= $items['qty']; ?>
                                                </td>
                                                <td>
                                                    <button type="button" name="remove" class="btn btn-sm text-danger remove_inventory" id='<?= $items["rowid"]; ?>'>
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <?= rupiah($items['subtotal']); ?>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; }else{
                                            echo '<tr><td colspan="5"><p class="text-center mt-3">Uppps !!! Anda belum memesan menu</p></td></tr>';
                                        } ?>

                                    </table>
                                </div>
                                
                                <ul class="list-group">
                                    <li class="list-group-item bg-hover rounded-0">
                                        <span class="float-end fw-bold">
                                            <input type="hidden" name="total_checkout" value="<?= $this->cart->total() ?>">
                                            Total | <?= rupiah($this->cart->total()); ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <?php $mejacount = $this->db->get_where('meja', array('status_meja' => 0))->num_rows();
                                if ($this->cart->total() < '10000') {
                                    echo "<div class='text-center'><p class='mt-3 text-white'>Minimal transaksi Rp.10.000</p>";
                                    echo '<a href="'.base_url('pesan').'" class="btn btn-utama mb-3">Tambah Pesanan</a></div>';
                                }else{
                                if ($mejacount > 0) {?>
                                <div class="mt-4 mb-2 float-end text-center" style="padding-right: 10px; padding-left: 20px;">
                                    <a href="<?=base_url('pesan') ?>" class="btn btn-utama mb-2">Tambah Pesanan</a>
                                    <?php if ($this->cart->total() == 0) {
                                        echo "";   
                                    }else{
                                        echo '<button class="btn btn-utama mb-2" id="pay-button">Lanjutkan</button>';
                                    }
                                    ?>
                                    
                                    <?php }else{
                                        echo "<div class='text-center mt-3 mb-3 h4 text-white'>Meja Penuh</div>";
                                    }} ?>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
    $('#cart_details').load("<?= base_url(); ?>pesan/load");
    $('#product_detail_cart_count').load("<?= base_url(); ?>pesan/udpateCount");

    $(document).on('click', '.remove_inventory', function(){
        var row_id = $(this).attr("id");
        if(confirm("Are you sure you want to remove this?"))
        {
            $.ajax({
                url:"<?= base_url(); ?>pesan/remove",
                method:"POST",
                data:{row_id:row_id},
                success:function(data)
                {
                    alert("Product removed from Cart");
                    location.reload();
                }
            });
        }
        else
        {
            return false;
        }
    });
});
</script>