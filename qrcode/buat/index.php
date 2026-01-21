<?php
include('QRGenerator.php');
$qrcode = new QRGenerator('mitra',100);  // 100 is the qr size
print "<img src='". $qrcode->generate() ."'>"
?>