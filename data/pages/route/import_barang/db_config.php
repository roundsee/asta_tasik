<?php

        $dbHost = "localhost";

        $dbDatabase = "h_php";

        $dbPasswrod = "";

        $dbUser = "root";

        $mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);

        if ($mysqli->connect_error) {
            die("Koneksi database gagal: " . $mysqli->connect_error);
        } else {
            echo "Koneksi database berhasil.";
        }

?>
