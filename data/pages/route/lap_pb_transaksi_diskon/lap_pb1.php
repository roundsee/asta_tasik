<?php
// Sertakan file koneksi
include '../../../../config/koneksi.php';

// Fungsi untuk menampilkan pesan status
function show_status($message, $type = 'success') {
    echo '<div class="alert alert-' . $type . '" role="alert">' . $message . '</div>';
}

// Pastikan $koneksi dan $nama_db didefinisikan dalam koneksi.php
if (!isset($koneksi) || !isset($nama_db)) {
    echo "File koneksi tidak mendefinisikan \$koneksi atau \$nama_db.";
    exit;
}

// Mendapatkan daftar tabel dari database
$query_tabel = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$nama_db'";
$result_tabel = mysqli_query($koneksi, $query_tabel);

// Jika tabel dipilih, tampilkan isinya
if (isset($_GET['table'])) {
    $nama_tabel = $_GET['table'];

    // Mendapatkan daftar kolom dari tabel
    $query_kolom = "SHOW COLUMNS FROM $nama_tabel";
    $result_kolom = mysqli_query($koneksi, $query_kolom);
    $daftar_kolom = array();
    while ($row_kolom = mysqli_fetch_assoc($result_kolom)) {
        $daftar_kolom[] = $row_kolom['Field'];
    }

    // Proses Hapus Data
    if (isset($_GET['hapus'])) {
        $id_hapus = $_GET['hapus'];
        $query_hapus = "DELETE FROM $nama_tabel WHERE " . $daftar_kolom[0] . " = '$id_hapus'"; // Asumsi kolom pertama adalah ID
        if (mysqli_query($koneksi, $query_hapus)) {
            show_status('Data berhasil dihapus.', 'success');
        } else {
            show_status('Data gagal dihapus: ' . mysqli_error($koneksi), 'danger');
        }
    }

    // Proses Edit Data
    if (isset($_POST['edit'])) {
        $id_edit = $_POST['id'];
        $query_edit = "UPDATE $nama_tabel SET ";
        $updates = array();
        foreach ($daftar_kolom as $kolom) {
            if ($kolom != $daftar_kolom[0]) { // Kecuali kolom ID
                $updates[] = "$kolom = '" . $_POST[$kolom] . "'";
            }
        }
        $query_edit .= implode(", ", $updates);
        $query_edit .= " WHERE " . $daftar_kolom[0] . " = '$id_edit'";

        if (mysqli_query($koneksi, $query_edit)) {
            show_status('Data berhasil diupdate.', 'success');
        } else {
            show_status('Data gagal diupdate: ' . mysqli_error($koneksi), 'danger');
        }
    }

    // Proses Download Data (Contoh sederhana, perlu disesuaikan)
    if (isset($_GET['download'])) {
        $id_download = $_GET['download'];
        // Ambil data dari database berdasarkan ID
        $query_download = "SELECT * FROM $nama_tabel WHERE " . $daftar_kolom[0] . " = '$id_download'";
        $result_download = mysqli_query($koneksi, $query_download);
        $data = mysqli_fetch_assoc($result_download);

        // Buat file untuk di-download (contoh: CSV)
        $filename = "data_" . $id_download . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, $daftar_kolom); // Header kolom
        fputcsv($output, $data); // Data
        fclose($output);
        exit();
    }

    // Ambil semua data dari database
    $query = "SELECT * FROM $nama_tabel";
    $result = mysqli_query($koneksi, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Database</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Tabel Database</h1>

        <?php if (!isset($_GET['table'])): ?>
            <h2>Pilih Tabel:</h2>
            <ul>
                <?php
                if (mysqli_num_rows($result_tabel) > 0) {
                    while ($row_tabel = mysqli_fetch_assoc($result_tabel)) {
                        $nama_tabel = $row_tabel['TABLE_NAME'];
                        echo "<li><a href='?table=" . $nama_tabel . "'>" . $nama_tabel . "</a></li>";
                    }
                } else {
                    echo "Tidak ada tabel ditemukan di database.";
                }
                ?>
            </ul>
        <?php else: ?>
            <h2>Data Tabel: <?php echo htmlspecialchars($nama_tabel); ?></h2>
            <table class="table">
                <thead>
                    <tr>
                        <?php
                        foreach ($daftar_kolom as $kolom) {
                            echo "<th>" . htmlspecialchars($kolom) . "</th>";
                        }
                        ?>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            foreach ($daftar_kolom as $kolom) {
                                echo "<td>" . htmlspecialchars($row[$kolom]) . "</td>";
                            }
                            echo "<td>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal" . htmlspecialchars($row[$daftar_kolom[0]]) . "'>Edit</button>
                                    <a href='?table=" . htmlspecialchars($nama_tabel) . "&download=" . htmlspecialchars($row[$daftar_kolom[0]]) . "' class='btn btn-success btn-sm'>Download</a>
                                    <a href='?table=" . htmlspecialchars($nama_tabel) . "&hapus=" . htmlspecialchars($row[$daftar_kolom[0]]) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                                </td>";
                            echo "</tr>";
                            ?>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal<?php echo htmlspecialchars($row[$daftar_kolom[0]]); ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo htmlspecialchars($row[$daftar_kolom[0]]); ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?php echo htmlspecialchars($row[$daftar_kolom[0]]); ?>">Edit Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="?table=<?php echo htmlspecialchars($nama_tabel); ?>">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row[$daftar_kolom[0]]); ?>">
                                                <?php
                                                foreach ($daftar_kolom as $kolom) {
                                                    if ($kolom != $daftar_kolom[0]) {
                                                        echo "<div class='form-group'>";
                                                        echo "<label for='" . htmlspecialchars($kolom) . "'>" . htmlspecialchars($kolom) . ":</label>";
                                                        echo "<input type='text' class='form-control' id='" . htmlspecialchars($kolom) . "' name='" . htmlspecialchars($kolom) . "' value='" . htmlspecialchars($row[$kolom]) . "'>";
                                                        echo "</div>";
                                                    }
                                                }
                                                ?>
                                                <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='" . (count($daftar_kolom) + 1) . "'>Tidak ada data.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
             <a href="lap_pb1.php" class="btn btn-secondary">Kembali ke Daftar Tabel</a>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
// Tutup koneksi
mysqli_close($koneksi);
?>