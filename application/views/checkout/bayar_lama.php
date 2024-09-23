<style type="text/css">
    .invoice{
        background-color: #fff;
        min-height: 100px;
    }

    label{
        color: #fff;
    }

    .radio-item [type="radio"] {
        display: none;
    }
    .radio-item + .radio-item {
        margin-top: 15px;
    }
    .radio-item label {
        padding: 20px 60px;
        background: var(--warna-utama);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 400;
        width: 100%;
        white-space: nowrap;
        position: relative;
        transition: 0.4s ease-in-out 0s;
    }
    .radio-item label:after,
    .radio-item label:before {
        content: "";
        position: absolute;
        border-radius: 50%;
    }
    .radio-item label:after {
        height: 19px;
        width: 19px;
        border: 2px solid #fff;
        left: 19px;
        top: calc(50% - 12px);
    }
    .radio-item label:before {
        background: #fff;
        height: 20px;
        width: 20px;
        left: 21px;
        top: calc(50%-5px);
        transform: scale(5);
        opacity: 0;
        visibility: hidden;
        transition: 0.4s ease-in-out 0s;
    }
    .radio-item [type="radio"]:checked ~ label {
        border-color: #FFF;
    }
    .radio-item [type="radio"]:checked ~ label::before {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }


</style>
<div class="container mt-5">
    <div class="home-kedua mb-4 row">
        <h5 class="home-judul text-center fw-bold">KERANJANG PESANAN
        </h5>

        <div class="row justify-content-center m-0">
            <div class="col-md-6">
                <div class="card p-0">
                    <div class="card-body p-0">
                        
                            <input type="hidden" name="result_type" id="result-type" value="">
                            <input type="hidden" name="result_data" id="result-data" value="">
                            <div class="invoice">
                                <ul class="list-group">
                                    <li class="list-group-item rounded-0 text-utama">
                                        <strong>ID Order : <?= $datauser->id_checkout; ?></strong>
                                    </li>
                                </ul>

                                <ul class="list-group">
                                    <li class="list-group-item rounded-0 bg-hover">
                                        Detail Produk
                                    </li>
                                </ul>
                                <ul class="list-group">
                               
                                    <?php foreach ($dataorder as $or) {?>
                                        <li class="list-group-item rounded-0">
                                            <?= $or->nama_produk ?> (<?= $or->jml_checkout ?>x)
                                            <span class="float-end">
                                                <?= rupiah($or->harga_produk) ?>
                                            </span>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <ul class="list-group">
                                    <li class="list-group-item rounded-0 bg-hover">
                                        <span class="float-end fw-bold">
                                           Total Bayar : <?= rupiah($totalOrder);?>
                                            <input type="hidden" name="amount" id="amount" value="<?= $totalOrder; ?>">
                                        </span>
                                    </li>
                                </ul>
                                
                            </div>
                            <div class="mt-3 mb-3 text-center">
                                <p class="">Pilih Metode Pembayaran :</p>
                                <div class="radio-list">
                                    <div class="row p-2" id="myRadioGroup">
                                        <div class="col-md-6 mb-2">
                                            <div class="radio-item">
                                                <input type="radio" class="radio" name="cars" id="radio1" value="bayar-manual" />
                                                <label for="radio1">MANUAL</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="radio-item">
                                                <input name="cars" value="bayar-otomatis" id="radio2" type="radio">
                                                <label for="radio2">OTOMATIS</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div id="bayar-manual" class="desc p-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="post" action="<?=site_url()?>/bayar/manual">
                                                <input type="hidden"  name="orderId" id="orderId" value="<?= $datauser->id_checkout ?>">
                                                <span class="text-white">PEMBAYARAN MANUAL</span>
                                                <br>
                                                <select class="form-control mt-2" name="manual" required>
                                                    <option value="">--Pilih Bank Tujuan</option>
                                                    <?php $manual = $this->db->get_where('setting', array('type' => 'manual'))->result();
                                                        foreach ($manual as $m){
                                                            echo '<option value="'.$m->id_setting.'">'.$m->title.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                                <div class="mt-2 mb-2">
                                                    <button class="btn btn-utama" type="submit">BAYAR SEKARANG</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="bayar-otomatis" class="desc">
                                    <form  method="post" action="<?=site_url()?>/bayar/otomatis">
                                        <input type="hidden"  name="orderId" id="orderId" value="<?= $datauser->id_checkout ?>">
                                        <?php require '_tripay.php';?>
                                        <div class="mt-2 mb-2">
                                            <button class="btn btn-utama" type="submit">BAYAR SEKARANG</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("div.desc").hide();
        $("input[name$='cars']").click(function() {
            var test = $(this).val();
            $("div.desc").hide();
            $("#" + test).show();
        });
    });
</script>