<?php


require('library/php-excel-reader/excel_reader2.php');

require('library/SpreadsheetReader.php');

require('db_config.php');


if(isset($_POST['Submit'])){


  $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];

  if(in_array($_FILES["file"]["type"],$mimes)){


    $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);

    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);


    $Reader = new SpreadsheetReader($uploadFilePath);


    $totalSheet = count($Reader->sheets());


    echo "You have total ".$totalSheet." sheets".


    $html="<table border='1'>";

    $html.="<tr><th>1</th>
    <th>2</th>
    <th>3</th>
    <th>4</th>
    <th>5</th>
    <th>6</th>
    <th>7</th>
    <th>8</th>
    <th>9</th>
    <th>10</th>
    <th>11</th>
    <th>12</th>
    <th>13</th>
    <th>14</th>
    <th>15</th>
    <th>16</th>
    <th>17</th>
    <th>18</th>
    <th>19</th>
    <th>20</th>
    <th>21</th>
    <th>22</th>
    <th>23</th>
    <th>24</th>
    <th>25</th>
    <th>26</th>
    <th>27</th>
    </tr>";


    /* For Loop for all sheets */

    for($i=0;$i<$totalSheet;$i++){


      $Reader->ChangeSheet($i);


      foreach ($Reader as $Row)

      {

        $html.="<tr>";

        $f0 = isset($Row[0]) ? $Row[0] : '';
        $f1 = isset($Row[1]) ? $Row[1] : '';
        $f2 = isset($Row[2]) ? $Row[2] : '';
        $f3 = isset($Row[3]) ? $Row[3] : '';
        $f4 = isset($Row[4]) ? $Row[4] : '';
        $f5 = isset($Row[5]) ? $Row[5] : '';
        $f6 = isset($Row[6]) ? $Row[6] : '';
        $f7 = isset($Row[7]) ? $Row[7] : '';
        $f8 = isset($Row[8]) ? $Row[8] : '';
        $f9 = isset($Row[9]) ? $Row[9] : '';
        $f10 = isset($Row[10]) ? $Row[10] : '';
        $f11 = isset($Row[11]) ? $Row[11] : '';
        $f12 = isset($Row[12]) ? $Row[12] : '';
        $f13 = isset($Row[13]) ? $Row[13] : '';
        $f14 = isset($Row[14]) ? $Row[14] : '';
        $f15 = isset($Row[15]) ? $Row[15] : '';
        $f16 = isset($Row[16]) ? $Row[16] : '';
        $f17 = isset($Row[17]) ? $Row[17] : '';
        $f18 = isset($Row[18]) ? $Row[18] : '';
        $f19 = isset($Row[19]) ? $Row[19] : '';
        $f20 = isset($Row[20]) ? $Row[20] : '';
        $f21 = isset($Row[21]) ? $Row[21] : '';
        $f22 = isset($Row[22]) ? $Row[22] : '';
        $f23 = isset($Row[23]) ? $Row[23] : '';
        $f24 = isset($Row[24]) ? $Row[24] : '';
        $f25 = isset($Row[25]) ? $Row[25] : '';
        $f26 = isset($Row[26]) ? $Row[26] : '';

        $html.="<td>".$f0."</td>";
        $html.="<td>".$f1."</td>";
        $html.="<td>".$f2."</td>";
        $html.="<td>".$f3."</td>";
        $html.="<td>".$f4."</td>";
        $html.="<td>".$f5."</td>";
        $html.="<td>".$f6."</td>";
        $html.="<td>".$f7."</td>";
        $html.="<td>".$f8."</td>";
        $html.="<td>".$f9."</td>";
        $html.="<td>".$f10."</td>";
        $html.="<td>".$f11."</td>";
        $html.="<td>".$f12."</td>";
        $html.="<td>".$f13."</td>";
        $html.="<td>".$f14."</td>";
        $html.="<td>".$f15."</td>";
        $html.="<td>".$f16."</td>";
        $html.="<td>".$f17."</td>";
        $html.="<td>".$f18."</td>";
        $html.="<td>".$f19."</td>";
        $html.="<td>".$f20."</td>";
        $html.="<td>".$f21."</td>";
        $html.="<td>".$f22."</td>";
        $html.="<td>".$f23."</td>";
        $html.="<td>".$f24."</td>";
        $html.="<td>".$f25."</td>";
        $html.="<td>".$f26."</td>";

        $html.="</tr>";


        // $query = "insert into items(title,description) values('".$title."','".$description."')";

        // $query = "insert into mutasi_a(tgl,regional) values('".$title."','".$description."')";


        	$query = "insert into mutasi_a(
        	tgl	,
        	regional	,
        	kd_cus	,
        	nama_outlet	,
        	kd_sage	,
        	nama_barang	,
        	satuan	,
        	qty_awal	,
        	nilai_awal	,
        	qty_beli	,
        	nilai_beli	,
        	qt_produksi	,
        	nilai_produksi	,
        	qt_terima_int	,
        	nilai_terima_int	,
        	qt_tersedia	,
        	nilai_tersedia	,
        	harga_rata	,
        	qt_kirim_int	,
        	nilai_kirim_int	,
        	qt_pake	,
        	nilai_pake	,
        	qt_jual	,
        	nilai_jual	,
        	hpp_jual	,
        	qt_akhir	,
        	nilai_akhir)
        	values(
        	'".$f0."',
        	'".$f1."',
        	'".$f2."',
        	'".$f3."',
        	'".$f4."',
        	'".$f5."',
        	'".$f6."',
        	'".$f7."',
        	'".$f8."',
        	'".$f9."',
        	'".$f10."',
        	'".$f11."',
        	'".$f12."',
        	'".$f13."',
        	'".$f14."',
        	'".$f15."',
        	'".$f16."',
        	'".$f17."',
        	'".$f18."',
        	'".$f19."',
        	'".$f20."',
        	'".$f21."',
        	'".$f22."',
        	'".$f23."',
        	'".$f24."',
        	'".$f25."',
        	'".$f26."'
        )";	

        $mysqli->query($query);

       }


    }


    $html.="</table>";

    echo $html;

    echo "<br />Data Inserted in dababase";


  }else { 

    die("<br/>Sorry, File type is not allowed. Only Excel file."); 

  }


}


?>