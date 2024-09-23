<html>
<head>
  <title>Cetak PDF</title>

  <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #04AA6D;
  color: white;
}
</style>

</head>
<body>
    <div style="text-align: center;">
      <b><?php echo $ket; ?></b><br />
    </div>
    <br />
    
<table id="customers" style="margin-bottom: 20px; width: 30%;">
  <tr>
    <th width="1px">No</th>
    <th width="10%">Tanggal</th>
    <th width="10%">Kode Inv</th>
    <th width="50%">Produk</th>
    <th width="10%">Status</th>
    <th width="10%">Total Checkout</th>
    <th width="10%">Admin</th>
    <th width="10%">Total Bayar</th>
  </tr>
    <?php
    if( ! empty($transaksi)){
      $no = 1;
      foreach($transaksi as $data){
            $tgl = date('d-m-Y', strtotime($data->tanggal));
        echo "<tr>";
        echo "<td style='text-align: center'>".$no++."</td>";
        echo "<td>".$tgl."</td>";
        echo "<td>".$data->order_id."</td>";

        $produk = $this->shopping_cart_model->getctranskasiProduk($data->id_checkout);
        echo "<td>";
        foreach ($produk as $p) {
            echo "- ".$p->nama_produk." (".$p->jml_checkout.")<br>";
        }
        echo "</td>";
        echo ($data->status_transaksi == 'PAID') ? "<td>Sukses</td>" : "<td>Gagal</td>";
        echo "<td>".rupiah($data->total_checkout)."</td>";
        echo "<td>".rupiah($data->total_transaksi-$data->total_checkout)."</td>";
        echo "<td>".rupiah($data->total_transaksi)."</td>";
        echo "</tr>";
      }
    }
    ?>
  </table>
</body>
</html>