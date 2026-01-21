<?php
function acak($panjang)
{
    //$karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $karakter='1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}

function acak2($panjang)
{
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}

function acak3($panjang)
{
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //$karakter='1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}

//cara memanggilnya
// echo "<br/>Acak 1 :";
// echo $hasil_1= acak(4);
// echo "<br/>Acak 2 :";
// echo $hasil_2= acak2(4);
?>