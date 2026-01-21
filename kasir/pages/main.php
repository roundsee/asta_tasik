<?php
//error_reporting(0);
$dir = "../../";
session_start();


if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
  echo "<link href='../../dist/style.css' rel='stylesheet' type='text/css'>
  <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<div class='wrapper'><a href=../../index.php><b>LOGIN</b></a></div></center>";
} else {
  include $dir . "config/koneksi.php";
  include $dir . "config/fungsi_kode_otomatis.php";
  include $dir . "config/fungsi_rupiah.php";
  include $dir . "config/fungsi_indotgl.php";
  include $dir . "config/library.php";

  $en = $_SESSION['employee_number'];
  $foto = mysqli_query($koneksi, "SELECT * from employee where employee_number='$_SESSION[employee_number]' ");
  $f_foto = mysqli_fetch_array($foto);
  $filefoto = $f_foto['photo'];
  if ($filefoto == 'profil.jpg') {
    $filefoto = 'member.jpg';
  }
?>


  <?php
  function getBrowser()
  {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
      $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
      $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
      $platform = 'windows';
    }
    if (preg_match('/android/i', $u_agent)) {
      $platform = 'android';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
      $bname = 'Internet Explorer';
      $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
      $bname = 'Mozilla Firefox';
      $ub = "Firefox";
    } elseif (preg_match('/OPR/i', $u_agent)) {
      $bname = 'Opera';
      $ub = "Opera";
    } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
      $bname = 'Google Chrome';
      $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
      $bname = 'Apple Safari';
      $ub = "Safari";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
      $bname = 'Netscape';
      $ub = "Netscape";
    } elseif (preg_match('/Edge/i', $u_agent)) {
      $bname = 'Edge';
      $ub = "Edge";
    } elseif (preg_match('/Trident/i', $u_agent)) {
      $bname = 'Internet Explorer';
      $ub = "MSIE";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
      ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
      // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
      //we will have two since we are not using 'other' argument yet
      //see if version is before or after the name
      if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
        $version = $matches['version'][0];
      } else {
        $version = $matches['version'][1];
      }
    } else {
      $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
      $version = "?";
    }

    return array(
      'userAgent' => $u_agent,
      'name'      => $bname,
      'version'   => $version,
      'platform'  => $platform,
      'pattern'    => $pattern
    );
  }

  // now try it
  $ua = getBrowser();
  $yourbrowser = "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " . $ua['platform'] . " reports: <br >" . $ua['userAgent'];
  // print_r($yourbrowser);
  ?>

  <style>
    /*body{*/
  </style>


  <!-- Content Wrapper. Contains page content -->
  <div class="list-gds">
    <?php include "content.php"; ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- REQUIRED SCRIPTS -->


<?php
}
?>

<!-- // live chat -->

<script type="text/javascript">
  // window.$crisp = [];
  // window.CRISP_WEBSITE_ID = "ef340481-a118-419d-a7f5-ebd227358ffb";
  // (function() {
  //   d = document;
  //   s = d.createElement("script");
  //   s.src = "https://client.crisp.chat/l.js";
  //   s.async = 1;
  //   d.getElementsByTagName("head")[0].appendChild(s);
  // })();
  var _delay = 3000;

  function checkLoginStatus() {
    $.get("checkStatus.php", function(data) {
      if (!data) {
        window.location = "../../logout.php";
      }
      setTimeout(function() {
        checkLoginStatus();
      }, _delay);
    });
  }
  checkLoginStatus();
</script>-->
<!-- <script type="text/javascript">