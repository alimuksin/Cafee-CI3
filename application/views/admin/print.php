<style type="text/css">
	@page { margin: 0 }
body { margin: 0; font-size:10px;font-family: monospace;}
td { font-size:10px; }
.sheet {
  margin: 0;
  overflow: hidden;
  position: relative;
  box-sizing: border-box;
  page-break-after: always;
}

/** Paper sizes **/
body.struk        .sheet { width: 58mm; }
body.struk .sheet        { padding: 2mm; }

.txt-left { text-align: left;}
.txt-center { text-align: center;}
.txt-right { text-align: right;}

/** For screen preview **/
@media screen {
  body { background: #e0e0e0;font-family: monospace; }
  .sheet {
    background: white;
    box-shadow: 0 .5mm 2mm rgba(0,0,0,.3);
    margin: 5mm;
  }
}

/** Fix for Chrome issue #273306 **/
@media print {
    body { font-family: monospace; }
    body.struk                 { width: 58mm; text-align: left;}
    body.struk .sheet          { padding: 2mm; }
    .txt-left { text-align: left;}
    .txt-center { text-align: center;}
    .txt-right { text-align: right;}
}
</style>

<html>
    <head>
        <title>Cetak Nota <?= $d->id_checkout ?></title>
    </head>
    <body class="struk" onload="printOut()">
        <section class="sheet">
        <?php
            echo '<table cellpadding="0" cellspacing="0" width="100%" style="margin-botton: 20px">
                    <tr>
                        <td style="text-align: center">'.$profile->name_kon.'</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">'.$profile->alamat_kon.'</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">Telp: '.$profile->telp_kon.'</td>
                    </tr>
                </table>';
                echo "<br>";
            echo(str_repeat("=", 40));
            ?>
        
            <table cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td align="left" class="txt-left">Nota&nbsp;</td>
                        <td align="left" class="txt-left">:</td>
                        <td align="left" class="txt-left">&nbsp;Invoice-<?= $d->id_checkout ?></td>
                    </tr>
                    <tr>
                        <td align="left" class="txt-left">Kasir</td>
                        <td align="left" class="txt-left">:</td>
                        <td align="left" class="txt-left">&nbsp;<?= $this->session->userdata('name_user') ?></td>
                    </tr>
                    <tr>
                        <td align="left" class="txt-left">Tgl.&nbsp;</td>
                        <td align="left" class="txt-left">:</td>
                        <td align="left" class="txt-left">&nbsp;<?= format_waktu_lengkap($d->detail->waktu_transaksi) ?></td>
                    </tr>
                    <tr>
                        <td align="left" class="txt-left">Nama Customer &nbsp;</td>
                        <td align="left" class="txt-left">:</td>
                        <td align="left" colspan="3" class="txt-left"><?= $d->id_customer == NULL ? $d->nama:$cus->nama_customer  ?></td>
                    </tr>
                </table>
               	<?php 
               		$this->db->select('*');
               		$this->db->join('checkoutproduk', 'produk.id_produk=checkoutproduk.id_produk');
               		$this->db->where('id_checkout', $d->id_checkout);
               		$produk = $this->db->get('produk')->result(); 
               	?>
                <table cellpadding="0" cellspacing="0" style="width:100%">
                    <tr>
                        <td align="left" class="txt-left">Items</td>
                        <td align="left" class="txt-left">QTY</td>
                        <td align="left" class="txt-left">Harga</td>
                        <td align="left" class="txt-left">Total</td>
                    </tr>
                    <?php foreach ($produk as $key) {
                    	echo "<tr>";
                    	echo "<td>".$key->nama_produk."</td>";
                    	echo "<td>".$key->jml_checkout."</td>";
                    	echo "<td>".rupiah($key->harga_produk)."</td>";
                    	echo "<td>".rupiah($key->harga_produk*$key->jml_checkout)."</td>";
                    	echo "</tr>";
                    }
                    echo '<tr>
                        <td align="left" class="txt-left">Biaya Admin</td>
                        <td align="left" class="txt-left">1</td>
                        <td align="left" class="txt-left">'.$d->detail->byr_admin.'</td>
                        <td align="left" class="txt-left">'.$d->detail->byr_admin.'</td>
                    </tr>';
                    echo '<tr><td colspan="4">'. str_repeat('-', 38).'</td></tr>';
                    $titleST = 'Sub&nbspTotal';
	                $titleST = $titleST. str_repeat("&nbsp;", ( 19 - strlen($titleST)) );
	                $ST      = Rupiah($d->detail->total_transaksi, 2);
	                $ST      = str_repeat("&nbsp;", ( 23 - strlen($ST)) ). $ST;
                    echo '<tr><td colspan="4">'. $titleST. $ST.'</td></tr>';

                    echo '<tr><td colspan="4"></td></tr>';
                    $titleST = 'Cash&nbsp';
	                $titleST = $titleST. str_repeat("&nbsp;", ( 19 - strlen($titleST)) );
	                $ST      = Rupiah($d->detail->jml_bayar, 2);
	                $ST      = str_repeat("&nbsp;", ( 23 - strlen($ST)) ). $ST;
                    echo '<tr><td colspan="4">'. $titleST. $ST.'</td></tr>';
                    echo '<tr><td colspan="4"></td></tr>';
                    $titleST = 'Kembali&nbsp';
	                $titleST = $titleST. str_repeat("&nbsp;", ( 19 - strlen($titleST)) );
	                $ST      = Rupiah($d->detail->jml_bayar-$d->detail->total_transaksi, 2);
	                $ST      = str_repeat("&nbsp;", ( 23 - strlen($ST)) ). $ST;
                    echo '<tr><td colspan="4">'. $titleST. $ST.'</td></tr>';

                


                    ?>
                </table>
                <p align="center">*Terima kasih atas kunjungan anda*</p>
            
        </section>
        
    </body>
</html>

<script>
    window.print();
</script>