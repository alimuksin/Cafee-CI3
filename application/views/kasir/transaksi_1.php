<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
    	<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
    		<div>
    			<h2 class="text-white pb-2 fw-bold">Pesanan Baru</h2>
    			<h5 class="text-white op-7 mb-2">
                <a href="<?php echo base_url('kasir/cart'); ?>" title="View Cart"><i class="icart"></i> (<?php echo ($this->cart->total_items() > 0)?$this->cart->total_items().' Items':'Empty'; ?>)</a>
				</h5>
    		</div>
    		<div class="ml-md-auto py-2 py-md-0">
    			<a href="<?= base_url('kasir/menu') ?>" class="btn btn-white btn-border btn-round mr-2">Manage Menu</a>
    			<a href="<?= base_url('kasir/transaksi') ?>" class="btn btn-secondary btn-round">Add Transaksi</a>
    		</div>
    	</div>
    </div>
</div>

<div class="page-inner mt--5">
    <!-- List all products -->
    <div class="row col-lg-12">
        <?php if(!empty($products)){ foreach($products as $row){ ?>
            <div class="card col-lg-3">
                <img class="card-img-top" src="<?php echo base_url('uploads/product_images/'.$row['image']); ?>" alt="">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Price: <?php echo '$'.$row["price"].' USD'; ?></h6>
                    <p class="card-text"><?php echo $row["description"]; ?></p>
                    <a href="<?php echo base_url('products/addToCart/'.$row['id']); ?>" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        <?php } }else{ ?>
            <p>Product(s) not found...</p>
        <?php } ?>
    </div>
</div>