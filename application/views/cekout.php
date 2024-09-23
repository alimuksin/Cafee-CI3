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
</style>
<div class="container mt-5">
    <div class="home-kedua mb-4 row">
        <h5 class="home-judul text-center fw-bold">KERANJANG PESANAN </h5>

        <div class="row justify-content-center m-0">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="payment-form" method="post" action="<?= base_url('snap/finish') ?>">
                            <input type="hidden" name="result_type" id="result-type" value="">
                            <input type="hidden" name="result_data" id="result-data" value="">
                            <div class="row">
                                <div class="col-8 mb-2">
                                    <label>Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                    
                                </div>
                                <div class="col-4 mb-2">
                                    <label>Meja *</label>
                                    <input type="text" class="form-control" id="meja" name="meja" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label>Telp</label>
                                        <input type="number" class="form-control" id="telp" name="telp">
                                    </div>
                                </div>
                            </div>
                            <div class="invoice">
                                <?php $i = 1; foreach ($this->cart->contents() as $items): ?>
                                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                                <ul class="list-group">
                                    <li class="list-group-item rounded-0">
                                        <?php echo $items['name']; ?> (<?php echo $this->cart->format_number($items['price']); ?>)
                                        <span style="margin: 0px 20px">
                                            <?php echo $items['qty']; ?> x
                                        </span>
                                        <input type="hidden" name="produk[]" id="produk[]" value="<?php echo $items['price']; ?>">
                                        <input type="hidden" name="qty[]" id="qty[]" value="<?php echo $items['qty']; ?>">
                                       
                                        <span class="float-end">
                                            <?php echo $this->cart->format_number($items['subtotal']); ?>
                                        </span>
                                    </li>
                                </ul>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                                <ul class="list-group">
                                    <li class="list-group-item bg-hover rounded-0">
                                        <span class="float-end fw-bold">
                                            Total | <?php echo $this->cart->format_number($this->cart->total()); ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-3 float-end">
                                <a href="<?=base_url('pesan') ?>" class="btn btn-utama">Tambah Pesanan</a>
                                <input type="text" id="amount" name="amount" value="<?= $this->cart->total(); ?>">
                                <!-- <input type="text" id="amount" name="amount" > -->
                                <button class="btn btn-utama" id="pay-button">BAYAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#pay-button').click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        var amount          = $("#amount").val();
        var nama            = $("#nama").val();
        var email           = $("#email").val();
        var telp            = $("#telp").val();
        var meja            = $("#meja").val();
        var produk          = [];
        var qty             = [];
        
        $('.produk').each(function(){
            produk.push($(this).text());
        });
        $('.qty').each(function(){
            qty.push($(this).text());
        });

        $.ajax({
            type : "POST",
            url: '<?=site_url()?>snap/token',
            cache: false,
            data    : {email:email, amount:amount, nama:nama, telp:telp, meja:meja, produk:produk, qty:qty},

            success: function(data) {
                //location = data;
                console.log('token = '+data);
                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');
                function changeResult(type,data){
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {
                  
                    onSuccess: function(result){
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result){
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result){
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script>