<style type="text/css">

    .nav-tabs .nav-item .nav-link{
        background-color: #C45E0B;
        color: #fff;
    }
    .nav-tabs .nav-link.active {
        color: #fff;
        border-color: #291301;
        background-color: #6D3202;
    }
</style>

<div class="container mt-5">
    <div class="home-kedua mb-4 row">
        <div class="col-md-12">

            <!-- Tabs navs -->
            <ul class="nav nav-tabs justify-content-center mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">PROFILE</a
                    >
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false" >TRANSAKSI</a
                >
                </li>
            </ul>

            <div class="tab-content" id="ex1-content">
                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                    <?php if(@$_SESSION['sukses']){ ?>
                        <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="success">
                            Profile berhasil diperbarui
                            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?= $this->session->flashdata('sukses'); ?>
                    <?php unset($_SESSION['sukses']); } ?>
                    <h5 class="home-judul text-start mb-3">DATA PENGGUNA</h5>
                    <form method="post" action="<?= base_url('customer/profile') ?>"> 

                        <input type="hidden" id="id" name="id" value="<?php if ($profile->id_customer == NUll) {echo "";}else{
                                            echo $profile->id_customer;
                                        } ?>" required class="form-control" />

                        <div class="form-outline mb-3">
                            <input type="text" id="nama" name="nama" value="<?php if ($profile->nama_customer == NUll) {echo "";}else{
                                            echo $profile->nama_customer;
                                        } ?>" required class="form-control" />
                            <label class="form-label text-utama fw-bold" for="nama">Nama Lengkap</label>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="text" id="email" name="email" required class="form-control" value="<?php if ($profile->email_customer == NUll) {echo "";}else{
                                            echo $profile->email_customer;
                                        } ?>"/>
                            <label class="form-label text-utama fw-bold" for="email">Email</label>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="text" id="telp" name="telp" class="form-control" value="<?php if ($profile->telp_customer == NUll) {echo "";}else{
                                            echo $profile->telp_customer;
                                        } ?>" required  />
                            <label class="form-label text-utama fw-bold" for="telp">Telephone</label>
                        </div>

                         <div class="form-outline mb-3">
                            <input type="text" id="password" name="password" class="form-control" />
                            <label class="form-label text-utama fw-bold" for="telp">Password</label>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="text" disabled id="status" name="status" class="form-control text-utama"  value="<?php if ($profile->status_customer == 1) {echo "Aktiv";}else{ echo 'Tidak Aktiv'; } ?>" required />
                            <label class="form-label text-utama fw-bold" for="status">Status Akun</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-utama">UPDATE PROFILE</button>
                        </div>

                    </form>
                </div>
                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    
                    <h5 class="home-judul text-start">RIWAYAT TRANSAKSI</h5>
                    <div class="row">
                        <?php if(!empty($transaksiproduk)){ foreach ($transaksiproduk as $tp) { ?>
                            <div class="col-md-4 mb-3 filterDiv">
                                <ul class="list-group">
                                    <li class="list-group-item bg-utama" aria-current="true">Invoice : <?=$tp->id_checkout; ?></li>
                                    <li class="list-group-item">
                                        <p>Tanggal : <?= format_tanggal($tp->waktu_checkout); ?></p>
                                        <?php 
                                            $statustransaksi  = $this->db->get_where('transaksi', array('id_checkout' => $tp->id_checkout))->row();
                                            
                                            $countST  = $this->db->get_where('transaksi', array('id_checkout' => $tp->id_checkout))->num_rows();
                                            date_default_timezone_set("Asia/Jakarta");
                                            $d = strtotime(date('Y-m-d H:i:s'));
                                            
                                            if ($countST > 0) {
                                                echo "<p>Metode Pembayaran : ";
                                                echo $statustransaksi->jenis_transaksi == 1 ? $statustransaksi->payment_name : "Cash";
                                                echo "</p>";
                                                $times = $statustransaksi->expired_time;
                                                if ($statustransaksi->status_transaksi == 'PAID') {
                                                    echo "<p>Status :<span class='text-success'> Sukses</span></p>";
                                                }else if ($statustransaksi->status_transaksi == 'UNPAID') {
                                                    echo "<p>Status :<span class='text-primary'> Pending</span></p>";
                                                    echo "<p><small><em>Silahkan datang ke kasir untuk melakukan pembayaran</em></small></p>";
                                                }else {
                                                    if ($d <= $times) {
                                                        echo "<p>Status :<span class='text-warning'> Belum dibayar</span><a href='".base_url('bayar/konf/'.$tp->id_checkout)."'> [lihat kode bayar]</span></a></p>";
                                                    }else{
                                                        echo "<p>Status :<span class='text-danger'> GAGAL</span></p>";
                                                    }
                                                }
                                                
                                            }else{
                                                $timecek = strtotime($tp->waktu_checkout);
                                                
                                                $new_time = $timecek + 2 * 60; //Tambah 5 menit
                                                $new_datetime = $new_time; //convert timestamp
                                                echo '<p>Batas Pembayaran : <br>'.format_tanggal(date( "d-m-Y H:i:s" ,$new_time)).'</p>';
                                                if ($d >= $new_datetime) {
                                                   echo "<p>Status :<span class='text-danger'> Gagal </span></p>";
                                                }else{
                                                    echo "<p>Status : <span class='text-warning'><a href='".base_url('cekout/bayar/'.$tp->id_checkout)."'>[bayar Sekarang]</span></a></p>";
                                                }

                                            }
                                        ?>
                                        
                                        <p class="mt-2">List Produk</p>
                                        <div class="table-responsive">
                                            <table class="table table-responsive table-sm table-bordered">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Harga</th>
                                                </tr>
                                                <?php 
                                                    $this->db->select('*');
                                                    $this->db->join('produk', 'produk.id_produk = checkoutproduk.id_produk');
                                                    $this->db->where('checkoutproduk.id_checkout', $tp->id_checkout);
                                                    $getPRoduk =$this->db->get('checkoutproduk')->result();
                                                    $no=1; foreach ($getPRoduk AS $gp){
                                                ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $gp->nama_produk.' ('.$gp->jml_checkout.'x)' ?></td>
                                                    <td><?= rupiah($gp->harga_produk*$gp->jml_checkout) ?></td>
                                                </tr>
                                            <?php }
                                                $where = array('id_checkout' => $tp->id_checkout);
                                                $totalOrder = $this->db->get_where('checkout', $where)->row();
                                                echo "
                                                <tr class='bg-hover'>
                                                    <th colspan='2'>Total Bayar</th>
                                                    <th><strong>".rupiah($totalOrder->total_checkout)."</strong></th>
                                                </tr>";
                                            ?>
                                            
                                            </table>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php }} ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>