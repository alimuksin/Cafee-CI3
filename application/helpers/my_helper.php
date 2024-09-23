<?php
function konfigurasi($title)
{
    $CI = get_instance();
    $CI->load->model('Global_model');
    $CI->load->model('Auth_model');
    $auth = $CI->Auth_model->get_by_id('id');
    $site = $CI->Global_model->getKonfigurasi();
    $data = array(
        'title'         => $title,
        'name_kon'      => $site['name_kon'],
        'id_kon'        => $site['id_kon'],
        'alamat_kon'    => $site['alamat_kon'],
        'telp_kon'      => $site['telp_kon'],
        'rek_kon'       => $site['rek_kon'],
        'bank_kon'      => $site['bank_kon'],
        'pemilik_kon'   => $site['pemilik_kon'],
        
        'site'          => $site,
        'c_judul'       => $title,
        'userdata'      => $auth,

        'tripay_server'     => $site['tripay_server'],
        'tripay_private'    => $site['tripay_private'],
        'tripay_api'        => $site['tripay_api'],
        'tripay_code'       => $site['tripay_code'],
        'byr_admin'       => $site['byr_admin'],
    );
    return $data;
}

function tanggal()
{
    date_default_timezone_set('Asia/Jakarta');
    return date('Y-m-d');
}

function tanggal_indo()
{
    date_default_timezone_set('Asia/Jakarta');
    return date('d-m-Y H:i:s');
}

function tanggal_new()
{
    date_default_timezone_set('Asia/Jakarta');
    /* script menentukan hari */
    $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
    $hr = $array_hr[date('N')];
    /* script menentukan tanggal */
    $tgl= date('j');
    /* script menentukan bulan */
    $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
    $bln = $array_bln[date('n')];
    /* script menentukan tahun */
    $thn = date('Y');
    /* script perintah keluaran*/
    return $hr . ", " . $tgl . " " . $bln . " " . $thn . " " . date('H:i');
}

function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    $time = substr($tgl, 11, 5);
    return $tanggal . ' ' . bulan($bulan) . ' ' . $tahun;
}

function tgl_lengkap($tanggals)
{
    $tanggal = substr($tanggals, 8, 2);
    $bulan = substr($tanggals, 5, 2);
    $tahun = substr($tanggals, 0, 4);
    $time = substr($tanggals, 11, 5);
    return $tanggal . ' ' . bulan($bulan) . ' ' . $tahun . ' ' . $time;
}

function bulan($bln)
{
    switch ($bln) {
      case 1:
      return "Jan";
      break;
      case 2:
      return "Feb";
      break;
      case 3:
      return "Mar";
      break;
      case 4:
      return "Apr";
      break;
      case 5:
      return "Mei";
      break;
      case 6:
      return "Jun";
      break;
      case 7:
      return "Jul";
      break;
      case 8:
      return "Agt";
      break;
      case 9:
      return "Sep";
      break;
      case 10:
      return "Okt";
      break;
      case 11:
      return "Nov";
      break;
      case 12:
      return "Des";
      break;
    }
}

function nama_hari($tanggal)
{
    $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];
    $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
    $nama_hari = "";
    if ($nama == "Sunday") {
        $nama_hari = "Minggu";
    } elseif ($nama == "Monday") {
        $nama_hari = "Senin";
    } elseif ($nama == "Tuesday") {
        $nama_hari = "Selasa";
    } elseif ($nama == "Wednesday") {
        $nama_hari = "Rabu";
    } elseif ($nama == "Thursday") {
        $nama_hari = "Kamis";
    } elseif ($nama == "Friday") {
        $nama_hari = "Jumat";
    } elseif ($nama == "Saturday") {
        $nama_hari = "Sabtu";
    }
    return $nama_hari;
}

function xTimeAgo($oldTime, $newTime, $timeType)
{
    $timeCalc = strtotime($newTime) - strtotime($oldTime);
    if ($timeType == "x") {
        if ($timeCalc = 60) {
            $timeType = "m";
        }
        if ($timeCalc = (60*60)) {
            $timeType = "h";
        }
        if ($timeCalc = (60*60*24)) {
            $timeType = "d";
        }
    }
    if ($timeType == "s") {
        $timeCalc .= " seconds ago";
    }
    if ($timeType == "m") {
        $timeCalc = round($timeCalc/60) . " menit yang lalu";
    }
    if ($timeType == "h") {
        $timeCalc = round($timeCalc/60/60) . " jam yang lalu";
    }
    if ($timeType == "d") {
        $timeCalc = round($timeCalc/60/60/24) . " hari yang lalu";
    }

    return $timeCalc;
}

function timeAgo2($timestamp)
{
    date_default_timezone_set('Asia/Jakarta');
    $skrg=date("Y-m-d H:i:s");
    $isi= str_replace("-", "", xTimeAgo($skrg, $timestamp, "m"));
    $isi2= str_replace("-", "", xTimeAgo($skrg, $timestamp, "h"));
    $isi3= str_replace("-", "", xTimeAgo($skrg, $timestamp, "d"));
    $go="";
    if ($isi > 60) {
        $go=$isi2;
    } elseif ($isi2 > 24) {
        $go=$isi3;
    } elseif ($isi < 61) {
        $go=$isi;
    }
    return $go;
}

function format_tanggal($waktu) {
        $hari_array = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );
        $hr = date('w', strtotime($waktu));
        $hari = $hari_array[$hr];
        $tanggal = date('j', strtotime($waktu));
        $bulan_array = array(
            1 => 'Janu',
            2 => 'Feb',
            3 => 'Maret',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agust',
            9 => 'Sept',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];
        $tahun = date('Y', strtotime($waktu));
        $jam = date( 'H:i:s', strtotime($waktu));
        
        //untuk menampilkan hari, tanggal bulan tahun jam
        //return "$hari, $tanggal $bulan $tahun $jam";

        //untuk menampilkan hari, tanggal bulan tahun
        return "$hari, $tanggal $bulan $tahun";
}

function format_waktu_lengkap($waktu) {
        $hari_array = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );
        $hr = date('w', strtotime($waktu));
        $hari = $hari_array[$hr];
        $tanggal = date('j', strtotime($waktu));
        $bulan_array = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];
        $tahun = date('Y', strtotime($waktu));
        $jam = date( 'H:i:s', strtotime($waktu));
        
        //untuk menampilkan hari, tanggal bulan tahun jam
        //return "$hari, $tanggal $bulan $tahun $jam";

        //untuk menampilkan hari, tanggal bulan tahun
        return "$hari, $tanggal $bulan $tahun $jam";
}

function rupiah($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

function status($nilai){
    if($nilai== 1) {
        $hasil = "<span class='text-success'> AKTIF </span>";
    } elseif ($nilai == 0) {
        $hasil = "<span class='text-danger'> TIDAK AKTIF </span>";
    } elseif ($nilai == 2) {
        $hasil = "<span class='text-warning'> BANNED </span>";
    }           
    return $hasil;
}

function statusbayar($nilai){
    if($nilai== 'PAID') {
        $hasil = "<span class='text-success'> Sudah dibayar </span>";
    } elseif ($nilai == 'UNPAID') {
        $hasil = "<span class='text-danger'> Belum dibayar </span>";
    }           
    return $hasil;
}

function cetak_tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    $time = substr($tgl, 11, 5);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function proses($nilai){
    if($nilai== 0) {
        $hasil = "<span class='badge text-light bg-primary'> <i class='fas fa-check mr-1'></i> Diterima </span>";
    } elseif ($nilai == 1) {
        $hasil = "<span class='badge text-light bg-danger'> Sedang diproses </span>";
    } elseif ($nilai == 2) {
        $hasil = "<span class='badge text-light bg-success'> <i class='fas fa-check mr-1'></i> <i class='fas fa-chekclist'></i> Selesai </span>";
    }           
    return $hasil;
}

function transaksi($nilai){
    if($nilai == 'PAID') {
        $hasil = "<span class='badge badge-success'>LUNAS</span>";
    } elseif ($nilai == 'UNPAID') {
        $hasil = "<span class='badge badge-warning'>PENDING</span>";
    } else {
        $hasil = "<span class='badge badge-danger'>GAGAL</span>";
    }           
    return $hasil;
}