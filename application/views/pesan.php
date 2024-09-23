<div class="container mt-5">
    <div class="home-kedua mb-4 row">
        <div class="col-md-6">
            <h5 class="home-judul text-start">PESAN </h5>
            <div class="row">
                <?php foreach($product as $row) { 
                    echo '
                        <div class="col-lg-4 col-md-6 col-6 mb-4">
                            <div class="card">
                                <img class="img-product" src="'.base_url().'uploads/produk/'.$row->gambar_produk.'" width="100%">
                                <div class="card-footer p-2">
                                    <span class="text-utama">'.$row->nama_produk.' (<small>'.$row->variasi_produk.'</small>)</span>
                                    <br>
                                    <div class="">
                                        <h5 class="">Rp '.rupiah($row->harga_produk).'</h5>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="number" name="quantity" value="1" placeholder="Jumlah" class="form-control quantity" id="'.$row->id_produk.'" />
                                        <span class="input-group-text" id="basic-addon1">pcs</span>
                                    </div>
                                    <div class="d-grid">
                                        <button type="button" name="add_cart" class="btn btn-success add_cart" data-productname="'.$row->nama_produk.'" data-price="'.$row->harga_produk.'" data-productid="'.$row->id_produk.'" data-variasi="'.$row->variasi_produk.'" />Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }?>
            </div>
        </div>

        <div class="col-md-6 d-none d-md-block d-lg-block">
            <div id="cart_details"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var product_id = $(this).data("productid");
            var product_name = $(this).data("productname");
            var product_price = $(this).data("price");
            var variasi = $(this).data("variasi");
            var quantity = $('#' + product_id).val();
            if(quantity != '' && quantity > 0)
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>pesan/add",
                    method:"POST",
                    data:{product_id:product_id, product_name:product_name, product_price:product_price, quantity:quantity, variasi:variasi},
                    success:function(data)
                    {
                        alert("Product Added into Cart");
                        $('#cart_details').html(data);
                        $('#quantity').val('1');
                        $('#' + product_id).val('');
                        $("#cart-counter").load(location.href + " #cart-counter");
                        loadJumlah();
                    }
                });
            } else {
            alert("Please Enter quantity");
            }
        });
        
        $('#cart_details').load("<?php echo base_url(); ?>pesan/load");

        $(document).on('click', '.remove_inventory', function(){
            var row_id = $(this).attr("id");
            if(confirm("Are you sure you want to remove this?"))
            
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>pesan/remove",
                    method:"POST",
                    data:{row_id:row_id},
                    success:function(data)
                    {
                    alert("Product removed from Cart");
                    $('#cart_details').html(data);
                        loadJumlah();
                    }
                });
            } else {
                return false;
            }
        });

    $(document).on('click', '#clear_cart', function(){
    if(confirm("Are you sure you want to clear cart?"))
    {
    $.ajax({
        url:"<?php echo base_url(); ?>pesan/clear",
        success:function(data)
        {
        alert("Your cart has been clear...");
            $('#cart_details').html(data);
            loadJumlah();
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