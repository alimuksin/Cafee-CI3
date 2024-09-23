<style>
    .box{
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
    .grid-item {
        font-size: 30px;
        text-align: center;
        color: white;
        font-weight: bold;
        padding: 30px;
    }

    .grid-item1 {
        font-size: 30px;
        text-align: center;
        color: white;
        font-weight: bold;
    }

    .grid-item1 {
        font-size: 30px;
        text-align: center;
        color: white;
        font-weight: bold;
    }
</style>

<div class="container mt-5">
    <div class="home-kedua mb-4 row">
        <div class="col-md-12">
            <h5 class="home-judul text-start">RESERVASI</h5>
            <p class="text-start">Silahkan Pilih Meja</p>
            <div class="row justify-content-center">
                <?php foreach ($mejas as $row) { ?>
                <div class="col-md-2 mb-2">
                        
                    <?php if ($row->status_meja == 0){ 
                        echo '<div class="box grid-item bg-primary">
                            <div class="box-body">

                                Meja '.$row->nomor_meja.' <br><br><p>Kosong</p>
                                <a href="'.base_url('pesan').'" class="stretched-link"></a>
                            </div>
                        </div>';
                    }else if ($row->status_meja == 1) {
                        echo '<div class="box grid-item bg-warning text-dark">
                            <div class="box-body">
                                Meja '.$row->nomor_meja.' <br><br><p>Dibooking</p>
                                <a href="'.base_url('pesan').'" class="stretched-link"></a>
                            </div>
                        </div>';
                    }else{
                        echo '<div class="box grid-item bg-danger">
                            <div class="box-body">
                                Meja '.$row->nomor_meja.' <br><br><p>Dipakai</p>
                                <a href="'.base_url('pesan').'" class="stretched-link"></a>
                            </div>
                        </div>';
                    }
                    ?>
                    
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_detail">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lanjutkan Proses</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="bodymodal_edit">
                
            </div>

            </div>
        </div>
    </div>
</div>

<script>
    function showpilih(id){
        $.ajax({
            type: "post",
            url: "<?=site_url('pesan/srvLoad_pilih');?>",
            data: "id="+id,
            dataType: "html",
            success: function (response) {
                $('#bodymodal_edit').empty();
                $('#bodymodal_edit').append(response);
            }
        });
    }
</script>



<script>
$(document).ready(function(){
 
 $('.add_cart').click(function(){
  var product_id = $(this).data("productid");
  var product_name = $(this).data("productname");
  var product_price = $(this).data("price");
  var quantity = $('#' + product_id).val();
  if(quantity != '' && quantity > 0)
  {
   $.ajax({
    url:"<?php echo base_url(); ?>pesan/add",
    method:"POST",
    data:{product_id:product_id, product_name:product_name, product_price:product_price, quantity:quantity},
    success:function(data)
    {
        alert("Product Added into Cart");
        $('#cart_details').html(data);
        $('#' + product_id).val('');
        $("#cart-counter").load(location.href + " #cart-counter");
        location.reload();
    }
   });
  }
  else
  {
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
     location.reload();
    }
   });
  }
  else
  {
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