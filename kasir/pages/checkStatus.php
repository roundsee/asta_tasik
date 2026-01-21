<?php
session_start();
if (!empty($_SESSION['namauser']) && !empty($_SESSION['passuser'])) {
    echo true;
} else {
    echo false;
}
