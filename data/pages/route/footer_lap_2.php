<?php

$message = ''; // Variabel untuk menyimpan pesan

// Fungsi untuk mengubah nama file atau folder
function renameItem($oldPath, $newName) {
    $dir = dirname($oldPath);
    $newPath = $dir . '/' . $newName;
    if (rename($oldPath, $newPath)) {
        return "Rename successful!";
    } else {
        return "Rename failed.";
    }
}

// Fungsi untuk menghapus file atau folder
function deleteItem($path) {
    if (is_dir($path)) {
        // Hapus folder dan semua isinya secara rekursif
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filePath = $path . '/' . $file;
            deleteItem($filePath); // Rekursif
        }
        if (rmdir($path)) {
            return "Folder deleted successfully!";
        } else {
            return "Folder deletion failed.";
        }
    } else {
        // Hapus file
        if (unlink($path)) {
            return "File deleted successfully!";
        } else {
            return "File deletion failed.";
        }
    }
}

// Fungsi untuk membuat ZIP dari folder
function zipFolder($folder, $zipFile) {
    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE) !== TRUE) {
        return false;
    }

    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($folder),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($folder) + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }

    $zip->close();
    return true;
}

// Proses rename jika ada data yang dikirim
if (isset($_POST['rename_id']) && isset($_POST['newName'])) {
    $fileId = $_POST['rename_id'];
    $newName = $_POST['newName'];
    $filePath = base64_decode($fileId);
    $message = renameItem($filePath, $newName);
}

// Proses delete jika ada data yang dikirim
if (isset($_POST['delete_id'])) {
    $fileId = $_POST['delete_id'];
    $filePath = base64_decode($fileId);
    $message = deleteItem($filePath);
}

// Proses download jika ada data yang dikirim
if (isset($_GET['download_id'])) {
    $fileId = $_GET['download_id'];
    $filePath = base64_decode($fileId);

    if (is_file($filePath)) {
        // Download file
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } elseif (is_dir($filePath)) {
        // Download folder sebagai ZIP
        $zipFile = $filePath . '.zip';
        if (zipFolder($filePath, $zipFile)) {
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '.zip"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($zipFile));
            readfile($zipFile);
            unlink($zipFile); // Hapus file ZIP setelah diunduh
            exit;
        } else {
            $message = "Failed to create ZIP archive.";
        }
    }
}

// Fungsi untuk menampilkan daftar file dan folder
function listFilesAndFolders($dir) {
    $files = scandir($dir);
    echo "<ul>";
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        $filePath = $dir . '/' . $file;
        $fileId = base64_encode($filePath); // Encode path untuk ID unik
        echo "<li>";
        echo "<form method='post' style='display:inline;'>";
        echo "<input type='hidden' name='rename_id' value='" . $fileId . "'>";
        if (is_dir($filePath)) {
            echo "<strong>Folder:</strong> " . $file . " ";
            echo "<input type='text' name='newName' value='" . $file . "'>";
            echo "<button type='submit'>Rename</button>";
            echo "<a href='?download_id=" . $fileId . "'>Download</a>";
            listFilesAndFolders($filePath); // Rekursif untuk menampilkan isi folder
        } else {
            echo "File: " . $file . " ";
            echo "<input type='text' name='newName' value='" . $file . "'>";
            echo "<button type='submit'>Rename</button>";
            echo "<a href='?download_id=" . $fileId . "'>Download</a>";
        }
        echo "</form>";
        echo "<form method='post' style='display:inline;' onsubmit=\"return confirm('Are you sure you want to delete this item?')\">";
        echo "<input type='hidden' name='delete_id' value='" . $fileId . "'>";
        echo "<button type='submit'>Delete</button>";
        echo "</form>";
        echo "</li>";
    }
    echo "</ul>";
}

$directory = './'; // Direktori saat ini

?>

<!DOCTYPE html>
<html>
<head>
    <title>File and Folder Lister</title>
</head>
<body>

<h2>Daftar File dan Folder di Direktori: <?php echo $directory; ?></h2>

<?php if ($message != ''): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<?php listFilesAndFolders($directory); ?>

</body>
</html>