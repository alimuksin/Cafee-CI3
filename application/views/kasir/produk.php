
<style>
    .img-product{
        height: 120px;
    }
</style>
<div class="row">
    <?php if($count == NULL) {
        echo '<div class="text-center"> Tidak ada produk</div>';
    }else{ ?>
        <?php foreach ($list as $row) { ?>
            <div class="col-md-4">
                <img class="img-product" src="<?= base_url().'uploads/produk/'.$row->gambar_produk ?>" width="100%">
                <div class="card-footer p-2">
                    <span class="text-utama"><?=$row->nama_produk ?> (<small><?= $row->variasi_produk ?></small>)</span>
                    <br>
                    <div class="">
                        <h5 class="">Rp <?= rupiah($row->harga_produk) ?></h5>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" name="quantity" value="1" placeholder="Jumlah" class="form-control quantity" id="<?= $row->id_produk ?>" />
                        <span class="input-group-text" id="basic-addon1">pcs</span>
                    </div>
                        <button type="button" name="add_cart" class="btn btn-success add_cart" data-productname="<?= $row->nama_produk ?>" data-price="<?= $row->harga_produk ?>" data-productid="<?= $row->id_produk ?>" data-variasi="<?= $row->variasi_produk ?>" >Add to Cart</button>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<script>
$(document).ready(function(){
    
    function loadPesanan(){
        $("#load-pesanan").html('<span class="text-center"><i class="fas fa-spin fa-spinner"></i> Loading data...</span>');
        $("#load-pesanan").load("<?=site_url('kasir/pesanan')?>");
    }

    $('.add_cart').click(function(){
        var product_id  = $(this).data("productid");
        var harga        = $(this).data("price");
        var quantity    = $('#' + product_id).val();
        if(quantity     != '' && quantity > 0)
        {
            $.ajax({
                url:"<?php echo base_url(); ?>kasir/addpesanan",
                method:"POST",
                data:{product_id:product_id, quantity:quantity, harga:harga},
                success:function(data)
                {
                    alert("Product Added into Cart");
                    $('#cart_details').html(data);
                    $('#' + product_id).val('');
                    $("#cart-counter").load(location.href + " #cart-counter");
                    loadPesanan();
                }
            });
        } else
        {
            alert("Please Enter quantity");
        }
    });

    
});
</script>