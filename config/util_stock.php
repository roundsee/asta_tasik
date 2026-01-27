<?php
include "koneksi.php";

function mutasidetail($kd_brg, $lokasi,$qty,$dk,$user, $refcode, $keterangan){
    $tanggal = date("Y-m-d H:i:s");

    $query = mysqli_query($koneksi, "SELECT stok FROM inventory WHERE kd_cus='$lokasi' and kd_brg = '$kd_brg'");
    $q1 = mysqli_fetch_array($query);
    $awal = 0;
    if(mysqli_num_rows($q1) > 0){
        $awal = $q1['stok'];
    }else{
        $query = "insert into inventory (kd_cus,kd_brg,stok) values ('$lokasi','$kd_brg',0)";
        $result = mysqli_query($koneksi, $query);
    }

    if($dk == 'D'){
        $akhir = $awal-$qty;
    }
    if($dk == 'K'){
        $akhir = $awal+$qty;
    }

    $query = "update inventory set stok = $akhir where kd_cus = '$lokasi' and kd_brg='$kd_brg'";
    $result = mysqli_query($koneksi, $query);

    $query = "insert into mutasi_stok_detail(tanggal,kd_brg,lokasi,awal,jumlah,akhir,satuan,refcode,keterangan)
    values ('$tanggal','$kd_brg','$lokasi','$dk',$awal,$qty,$akhir,'$satuan','$refcode','$keterangan')";

    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Update mutasi stock detail gagal : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    }


}




?>