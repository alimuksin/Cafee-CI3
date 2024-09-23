<div class="container-fluid mt-5 pt-3">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="app-card mt-4 p-4" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <?php if ($detailTransaksi != NULL) {?>
                <div class="text-center">
                    <h5>Detail Transaksi - <?= $detailTransaksi->id_checkout ?></h5>
                </div>
                
                <?php 
                    date_default_timezone_set("Asia/Jakarta");
                    $batastransaksi = $detailTransaksi->expired_time;
                    $ontime = strtotime(date("Y-m-d H:i:s"));
                    
                    if ($detailTransaksi->status_transaksi == "PAID") { echo "<h2 class='text-success text-center'>Sudah dibayar </h2>";
                    echo '<div class="d-grid text-center">
                        <a href="'.base_url("pesan").'" style="background-color: #291301; color: white; border: 0; padding-top: 10px; padding-bottom: 10px;">Pesan Lagi</a>
                    </div>';
                        }else{ echo '<p class="text-center text-danger">
                            Pastikan anda melakukan pembayaran sebelum melewati batas
                            <br>pembayaran dan dengan nominal yang tepat
                        </p>';
                            
                            if ($batastransaksi < $ontime) {
                                echo "
                                <div class='text-center mt-3'>
                                    <p class='text-danger'>Waktu pembayaran sudah habis</p>
                                    <a class='btn btn-utama' href='".base_url('pesan')."'>Pesan Lagi</a>
                                </div>";
                            }else{

                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="m-0 mb-2">Jumlah Pembayaran</p>
                            <h5 class="m-0 mb-2" style="font-size: 26px;">
                                <?= "Rp " . number_format($detailTransaksi->total_transaksi, 0, ",", "."); ?></h5 >
                            <p>Metode Pembayaran </p>
                            <div class="row">
                                <div class="col-4">
                                    <img src="<?=base_url('') ?>/assets/payment/<?= $detailTransaksi->payment_transaksi ?>.<?php if ($detailTransaksi->payment_transaksi == "BSIVA" && $detailTransaksi->payment_transaksi == "INDOMARET" && $detailTransaksi->payment_transaksi == "OVO" && $detailTransaksi->payment_transaksi == "QRIS") {
                                        echo "png";
                                    }else{
                                        echo "webp";
                                    } ?>" width="100%">
                                </div>
                            </div>
                            <p class="mt-3 mb-0">Kode Pembayaran/Nomor Virtual Account</p>
                            <div class="row">
                                <div class="col-6 m-0">
                                    <span id="p" style="color: #291301;">
                                        <strong><?= $detailTransaksi->pay_code; ?></strong>
                                    </span>
                                </div>
                                <div class="col-6 m-0">
                                    <button class="btn btn-sm" style="background-color: #6D3202; color:white; padding: 5px 10px 5px 10px" onclick="jscopy('p')">Copy</button>
                                </div>
                            </div>

                            <p class="mt-3">Batas Pembayaran<br>
                                <span class="h4" style="color: #291301;">
                                    <strong><?= format_waktu_lengkap(date("Y-m-d H:i:s", $detailTransaksi->expired_time));?></strong>
                                </span>
                            </p>
                            <p class="mt-3">Status Transaksi<br>
                                <span style="color: #291301;">
                                    <strong><?php if ($detailTransaksi->status_transaksi == "PAID") {
                                        echo "<span class='text-success'>Sudah dibayar </span>";
                                    }else{  echo "<span class='text-danger'>Belum dibayar </span>";} ;?></strong>
                                </span>
                            </p>
                            <?php }}}else{
                                echo "<div class='text-center'>Waktu pembayaran sudah habis</div>";
                            } ?>
                        </div>
                        <?php if ($detailTransaksi->status_transaksi == "UNPAID") { ?>
                            <div class="col-md-6">
                                <h6>PERHATIAN</h6>
                                <ul>
                                    <li class="text-primary" style="list-style-type: disc;"><small>Mohon lakukan pembayaran dalam <b>1x24 jam</b></small></li>
                                    <li class="text-primary" style="list-style-type: disc;"><small>Sistem akan otomatis mendeteksi apabila pembayaran sudah masuk</small> </li>
                                    <li class="text-primary" style="list-style-type: disc;"><small>Apabila sudah transfer dan status pembayaran belum berubah, mohon konfirmasi pembayaran manual di bawah</small> </li>
                                     <li class="text-primary" style="list-style-type: disc;">
                                         <small>Pesanan akan dibatalkan secara otomatis jika Anda tidak melakukan pembayaran.</small>
                                     </li>
                                </ul>
                            </div>
                        <?php } ?>
                        <div class="text-center mt-3">
                            <a href="<?=base_url('customer/akun') ?>"style="background-color: #291301; color: white; border: 0; padding-top: 7px; padding-bottom: 7px; padding-left: 20px; padding-right: 20px; border-radius: 7px">Kembali</a>
                            <a href="#"style="background-color: #6D3202; color: white; border: 0; padding-top: 7px; padding-bottom: 7px; padding-left: 20px; padding-right: 20px; border-radius: 7px" data-mdb-toggle="modal" data-mdb-target="#exampleModal">Cara Pembayaran</a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Petunjuk Pembayaran</h5>
                                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php 
                                        
                                            $ins = json_decode($detailTransaksi->instructions);
                                            foreach($ins as $key => $val){
                                            echo "<div class='font-medium m-b-4'>".$val->title."</div>";
                                            echo "<ol class='m-b-16'>";
                                            foreach($val->steps as $k => $v){
                                                echo "<li>".$v."</li>";
                                            }
                                            echo "</ol>";
                                            }
                                        ?>
                                    </div>
                                    <div class="modal-footer d-grid">
                                        <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--//col-->
        </div><!--//row-->
    </div>   

    <script>
function csclink(elementID){
var jc = document.getElementById(elementID).href;
cp(jc);
}
function jscopy(elementID){
var jc = document.getElementById(elementID).textContent;
alert("Kode pembayaran berhasil di copy");
cp(jc);
}
function cp(jc) {
   var el = document.createElement('textarea');
   el.value = jc;
   el.setAttribute('readonly', '');
   el.style = {position: 'absolute', left: '-9999px'};
   document.body.appendChild(el);
   el.select();
   document.execCommand('copy');
   document.body.removeChild(el);  
   document.getElementById("PesanCopy").innerHTML = el.value;
   alert("Kode pembayaran berhasil di copy");
  }
</script>