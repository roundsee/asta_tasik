<?php
$dir = "../../../../";

$judulform = "Daftar Pembelian";

$data = 'data_analisa_stok';
$rute = 'analisa_stok';
$aksi = 'aksi_analisa_stok';

$tujuan = 'analisa_stok';

$tabel = 'pembelian';

$f1 = 'kd_beli';
$f2 = 'tgl_beli';
$f3 = 'kd_supp';
$f4 = 'ket_payment';
$f5 = 'status_payment';
$f6 = 'jenis_po';
$f7 = 'ppn';


$j1 = 'Kode Pembelian';
$j2 = 'Tanggal';
$j3 = 'Kode Supplier';
$j4 = 'Ket Payment';
$j5 = 'Status';
$j6 = 'Jenis';
$j7 = 'PB1';

$tabel2 = 'pembelian_detail';

$ff1 = 'kd_beli';
$ff2 = 'kd_brg';
$ff3 = 'jml';
$ff4 = 'price';
$ff5 = 'currency';
$ff6 = 'kurs';
$ff7 = 'disc';
$ff8 = 'urut';
$ff9 = 'satuan';
$ff10 = 'jumlah_pcs';



$jj1 = 'Kode Beli';
$jj2 = 'Kode Barang';
$jj3 = 'Jumlah';
$jj4 = 'Price';
$jj5 = 'Currency';
$jj6 = 'Kurs';
$jj7 = 'Disc';
$jj8 = 'urut';
$jj9 = 'satuan';



$tabel3 = 'analisa_stok';
// Variabel untuk nama kolom
$fff1 = 'tgl';                    // Tanggal
$fff2 = 'kd_brg';                 // Kode Barang
$fff3 = 'stok_awal';              // Stok Awal
$fff4 = 'qty_jual';               // Jumlah Terjual
$fff5 = 'qty_beli';               // Jumlah Beli
$fff6 = 'rata_rata_7_hari';       // Rata-rata Penjualan 7 Hari
$fff7 = 'qty_jual_tertinggi';     // Penjualan Tertinggi
$fff8 = 'waktu_kirim_supplier';   // Waktu Kirim Supplier
$fff9 = 'qty_order';              // Jumlah yang Dipesan
$fff10 = 'stok_akhir';           // Saldo Akhir
$fff11 = 'qty_order_max_stok';

// Variabel untuk label deskriptif
$jjj1 = 'Tanggal';                // Tanggal
$jjj2 = 'Kode Barang';            // Kode Barang
$jjj3 = 'Stok Awal';              // Stok Awal
$jjj4 = 'Jumlah Terjual';         // Jumlah Terjual
$jjj5 = 'Jumlah Beli';            // Jumlah Beli
$jjj6 = 'Rata-rata Penjualan 7 Hari';  // Rata-rata Penjualan 7 Hari
$jjj7 = 'Penjualan Tertinggi';    // Penjualan Tertinggi
$jjj8 = 'Waktu Kirim Supplier';   // Waktu Kirim Supplier
$jjj9 = 'Jumlah yang Dipesan';    // Jumlah yang Dipesan
$jjj10 = 'Stok Akhir';           // Saldo Akhir
$jjjqq = 'Qty Order Max Stok';




$tabel_attachment = 'pengajuan_attachment';
$fa1 = 'no_pengajuan';
$fa2 = 'tgl';
$fa3 = 'ket';
$fa4 = 'photo';
$fa5 = 'file';

$ja1 = 'No Pengajuan';
$ja2 = 'Tgl';
$ja3 = 'Ket';
$ja4 = 'Photo';
$ja5 = 'File';

$tabel_note = 'pengajuan_note';
$fn1 = 'no_pengajuan';
$fn2 = 'tgl';
$fn3 = 'ket';
$fn4 = 'supervisi';


$jn1 = 'No Pengajuan';
$jn2 = 'Tgl Note';
$jn3 = 'Keterangan';
$jn4 = 'Supervisi';

session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include $dir . "config/koneksi.php";
	include $dir . "config/library.php";

	$route = $_GET['route'];
	$act = $_GET['act'];

	//Hapus 
	if ($route == $tujuan and $act == 'hapus') {

		mysqli_query($koneksi, "DELETE from $tabel where $f1 = '$_GET[id]'");
		mysqli_query($koneksi, "DELETE from $tabel2 where $ff1 = '$_GET[id]'");

		echo "<script>alert('Data berhasil dihapus ');</script>";
		echo "<script>history.go(-1)</script>";
	} elseif ($route == $tujuan and $act == 'hapus-detail') {

		// $query = mysqli_query($koneksi, "SELECT * FROM $tabel2 WHERE no_pengajuan = '$_GET[id]' AND no_account='$_GET[id2]' "); 


		mysqli_query($koneksi, "DELETE from $tabel2 where $ff1 = '$_GET[id]' AND $ff2='$_GET[id2]' ");

		// echo "<script>alert('Data berhasil dihapus ');</script>";
		echo "<script>history.go(-1)</script>";
	}


	// Tambah
	// Misalnya, variabel ini harus diatur sebelumnya

	// // Tambah
	// elseif ($route == $tujuan && $act == 'input_analisa_stok') {
	// 	// Query untuk mengambil tanggal terbaru
	// 	$query_tgl_terbaru = "SELECT MAX(tgl) as tgl_terbaru FROM analisa_stok";
	// 	$result_tgl_terbaru = mysqli_query($koneksi, $query_tgl_terbaru);

	// 	if ($result_tgl_terbaru && mysqli_num_rows($result_tgl_terbaru) > 0) {
	// 		$row_tgl_terbaru = mysqli_fetch_assoc($result_tgl_terbaru);
	// 		$tgl_terbaru = $row_tgl_terbaru['tgl_terbaru'];

	// 		// Hitung tanggal H+1
	// 		$tgl_besok = date('Y-m-d', strtotime($tgl_terbaru . ' +1 day'));

	// 		// Query untuk mengambil semua kode barang unik
	// 		$query_kd_brg = "SELECT DISTINCT kd_brg FROM analisa_stok";
	// 		$result_kd_brg = mysqli_query($koneksi, $query_kd_brg);

	// 		if ($result_kd_brg && mysqli_num_rows($result_kd_brg) > 0) {
	// 			while ($row_kd_brg = mysqli_fetch_assoc($result_kd_brg)) {
	// 				$kd_brg = $row_kd_brg['kd_brg'];

	// 				// Query untuk menghitung rata-rata 7 hari qty_jual dan qty_jual_tertinggi berdasarkan kd_brg tertentu
	// 				$query_rata_rata_dan_tertinggi = "
	// 							 SELECT 
	// 									 AVG(qty_jual) as rata_rata_7_hari,
	// 									 MAX(qty_jual) as qty_jual_tertinggi
	// 							 FROM analisa_stok
	// 							 WHERE kd_brg = '$kd_brg' 
	// 							 AND tgl BETWEEN DATE_SUB('$tgl_terbaru', INTERVAL 6 DAY) AND '$tgl_terbaru'
	// 					 ";

	// 				$result_rata_rata_dan_tertinggi = mysqli_query($koneksi, $query_rata_rata_dan_tertinggi);

	// 				if ($result_rata_rata_dan_tertinggi && mysqli_num_rows($result_rata_rata_dan_tertinggi) > 0) {
	// 					$row_rata_rata_dan_tertinggi = mysqli_fetch_assoc($result_rata_rata_dan_tertinggi);
	// 					$rata_rata_7_hari = $row_rata_rata_dan_tertinggi['rata_rata_7_hari'];
	// 					$qty_jual_tertinggi = $row_rata_rata_dan_tertinggi['qty_jual_tertinggi'];

	// 					// Query untuk mencari kd_supp di tabel supplier_barang berdasarkan kd_brg
	// 					$query_kd_supp = "SELECT kd_supp FROM supplier_barang WHERE kd_brg = '$kd_brg'";
	// 					$result_kd_supp = mysqli_query($koneksi, $query_kd_supp);

	// 					if ($result_kd_supp && mysqli_num_rows($result_kd_supp) > 0) {
	// 						$row_kd_supp = mysqli_fetch_assoc($result_kd_supp);
	// 						$kd_supp = $row_kd_supp['kd_supp'];

	// 						// Query untuk mencari durasi_waktu di tabel supplier berdasarkan kd_supp
	// 						$query_durasi_waktu = "SELECT durasi_waktu FROM supplier WHERE kd_supp = '$kd_supp'";
	// 						$result_durasi_waktu = mysqli_query($koneksi, $query_durasi_waktu);

	// 						if ($result_durasi_waktu && mysqli_num_rows($result_durasi_waktu) > 0) {
	// 							$row_durasi_waktu = mysqli_fetch_assoc($result_durasi_waktu);
	// 							$waktu_kirim_supplier = $row_durasi_waktu['durasi_waktu'];

	// 							// Hitung qty_order dan qty_order_max_jual
	// 							$qty_order = $rata_rata_7_hari * $waktu_kirim_supplier;
	// 							$qty_order_max_jual = $qty_jual_tertinggi * $waktu_kirim_supplier;

	// 							// Ambil stok akhir dari tanggal terbaru
	// 							$query_stok_akhir = "SELECT stok_akhir FROM analisa_stok WHERE kd_brg = '$kd_brg' AND tgl = '$tgl_terbaru'";
	// 							$result_stok_akhir = mysqli_query($koneksi, $query_stok_akhir);

	// 							if ($result_stok_akhir && mysqli_num_rows($result_stok_akhir) > 0) {
	// 								$row_stok_akhir = mysqli_fetch_assoc($result_stok_akhir);
	// 								$stok_akhir = $row_stok_akhir['stok_akhir'];

	// 								// Insert data ke tabel analisa_stok
	// 								$query_insert = "
	// 															 INSERT INTO analisa_stok (
	// 																	 tgl, kd_brg, stok_awal, qty_jual, qty_beli, rata_rata_7_hari, 
	// 																	 qty_jual_tertinggi, waktu_kirim_supplier, qty_order, stok_akhir, qty_order_max_jual
	// 															 ) VALUES (
	// 																	 '$tgl_besok', '$kd_brg', '$stok_akhir', 0, 0, '$rata_rata_7_hari', 
	// 																	 '$qty_jual_tertinggi', '$waktu_kirim_supplier', '$qty_order', '$stok_akhir', '$qty_order_max_jual'
	// 															 )
	// 													 ";

	// 								if (mysqli_query($koneksi, $query_insert)) {
	// 									echo "Data berhasil ditambahkan untuk Kode Barang: $kd_brg.<br>";
	// 								} else {
	// 									echo "Gagal menambahkan data untuk Kode Barang: $kd_brg. Error: " . mysqli_error($koneksi) . "<br>";
	// 								}
	// 							} else {
	// 								echo "Stok akhir tidak ditemukan untuk Kode Barang: $kd_brg pada tanggal terbaru: $tgl_terbaru.<br>";
	// 							}
	// 						} else {
	// 							echo "Durasi waktu tidak ditemukan untuk kd_supp: $kd_supp.<br>";
	// 						}
	// 					} else {
	// 						echo "Supplier tidak ditemukan untuk Kode Barang: $kd_brg.<br>";
	// 					}
	// 				} else {
	// 					echo "Data tidak ditemukan untuk Kode Barang: $kd_brg untuk perhitungan rata-rata 7 hari dan qty jual tertinggi.<br>";
	// 				}
	// 			}
	// 		} else {
	// 			echo "Tidak ada kode barang ditemukan.";
	// 		}
	// 	} else {
	// 		echo "Tanggal terbaru tidak ditemukan.";
	// 	}

	// 	// Setelah insert ke analisa_stok, cek apakah stok_awal lebih kecil dari qty_order
	// 	$query_cek_stok = "SELECT stok_awal, qty_order FROM analisa_stok WHERE kd_brg = '$kd_brg' AND tgl = '$tgl_besok'";
	// 	$result_cek_stok = mysqli_query($koneksi, $query_cek_stok);

	// 	if ($result_cek_stok && mysqli_num_rows($result_cek_stok) > 0) {
	// 		$row_cek_stok = mysqli_fetch_assoc($result_cek_stok);
	// 		$stok_awal = $row_cek_stok['stok_awal'];
	// 		$qty_order = $row_cek_stok['qty_order'];

	// 		if ($stok_awal < $qty_order) {
	// 			// Buat kode pembelian baru
	// 			$query_kode_terbesar = mysqli_query($koneksi, "SELECT max(kd_beli) as kodeTerbesar FROM pembelian");
	// 			$data_kode_terbesar = mysqli_fetch_array($query_kode_terbesar);
	// 			$kode_terbesar = $data_kode_terbesar['kodeTerbesar'];
	// 			$urutan = (int) substr($kode_terbesar, 6, 4);
	// 			$urutan++;
	// 			$kd_beli = 'Order-' . sprintf("%04s", $urutan);

	// 			// Insert ke tabel pembelian
	// 			$query_insert_pembelian = "
	//           INSERT INTO pembelian (
	//               kd_beli, tgl_beli, kd_supp, ket_payment, ppn, status_pembelian
	//           ) VALUES (
	//               '$kd_beli', '$tgl_besok', '$kd_supp', '$waktu_kirim_supplier', 0, 0
	//           )
	//       ";

	// 			if (mysqli_query($koneksi, $query_insert_pembelian)) {
	// 				echo "Data berhasil ditambahkan ke tabel pembelian untuk Kode Barang: $kd_brg.<br>";

	// 				// Insert ke tabel pembelian_detail
	// 				$query_insert_pembelian_detail = "
	//               INSERT INTO pembelian_detail (
	//                   kd_beli, kd_brg, jml,price, satuan,jumlah_pcs
	//               ) VALUES (
	//                   '$kd_beli', '$kd_brg', '$qty_order',0,'Pcs', '$qty_order'
	//               )
	//           ";

	// 				if (mysqli_query($koneksi, $query_insert_pembelian_detail)) {
	// 					echo "Data berhasil ditambahkan ke tabel pembelian_detail untuk Kode Barang: $kd_brg.<br>";
	// 				} else {
	// 					echo "Gagal menambahkan data ke tabel pembelian_detail untuk Kode Barang: $kd_brg. Error: " . mysqli_error($koneksi) . "<br>";
	// 				}
	// 			} else {
	// 				echo "Gagal menambahkan data ke tabel pembelian untuk Kode Barang: $kd_brg. Error: " . mysqli_error($koneksi) . "<br>";
	// 			}
	// 		} else {
	// 			echo "Stok awal lebih besar atau sama dengan qty_order, tidak perlu melakukan pembelian untuk Kode Barang: $kd_brg.<br>";
	// 		}
	// 	} else {
	// 		echo "Gagal mengecek stok awal dan qty_order untuk Kode Barang: $kd_brg.<br>";
	// 	}


	// 	// Kode untuk aksi jika query berhasil
	// 	// echo "<script>alert('Data berhasil ditambah.');</script>";
	// 	// echo "<script>history.go(-2)</script>";
	// }

	// Tambah
	// Tambah
	elseif ($route == $tujuan && $act == 'input_analisa_stok') {
		// Query untuk mengambil tanggal terbaru
		$query_tgl_terbaru = "SELECT MAX(tgl) as tgl_terbaru FROM analisa_stok";
		$result_tgl_terbaru = mysqli_query($koneksi, $query_tgl_terbaru);

		if ($result_tgl_terbaru && mysqli_num_rows($result_tgl_terbaru) > 0) {
			$row_tgl_terbaru = mysqli_fetch_assoc($result_tgl_terbaru);
			$tgl_terbaru = $row_tgl_terbaru['tgl_terbaru'];

			// Hitung tanggal H+1
			$tgl_besok = date('Y-m-d', strtotime($tgl_terbaru . ' +1 day'));

			// Query untuk mengambil semua kode barang unik
			$query_kd_brg = "SELECT DISTINCT kd_brg FROM analisa_stok";
			$result_kd_brg = mysqli_query($koneksi, $query_kd_brg);

			if ($result_kd_brg && mysqli_num_rows($result_kd_brg) > 0) {
				while ($row_kd_brg = mysqli_fetch_assoc($result_kd_brg)) {
					$kd_brg = $row_kd_brg['kd_brg'];

					// Query untuk menghitung rata-rata 7 hari qty_jual dan qty_jual_tertinggi berdasarkan kd_brg tertentu
					$query_rata_rata_dan_tertinggi = "
									SELECT 
											AVG(qty_jual) as rata_rata_7_hari,
											MAX(qty_jual) as qty_jual_tertinggi
									FROM analisa_stok
									WHERE kd_brg = '$kd_brg' 
									AND tgl BETWEEN DATE_SUB('$tgl_terbaru', INTERVAL 6 DAY) AND '$tgl_terbaru'
							";

					$result_rata_rata_dan_tertinggi = mysqli_query($koneksi, $query_rata_rata_dan_tertinggi);

					if ($result_rata_rata_dan_tertinggi && mysqli_num_rows($result_rata_rata_dan_tertinggi) > 0) {
						$row_rata_rata_dan_tertinggi = mysqli_fetch_assoc($result_rata_rata_dan_tertinggi);
						$rata_rata_7_hari = $row_rata_rata_dan_tertinggi['rata_rata_7_hari'];
						$qty_jual_tertinggi = $row_rata_rata_dan_tertinggi['qty_jual_tertinggi'];

						// Query untuk mencari kd_supp di tabel supplier_barang berdasarkan kd_brg
						$query_kd_supp = "SELECT kd_supp FROM supplier_barang WHERE kd_brg = '$kd_brg'";
						$result_kd_supp = mysqli_query($koneksi, $query_kd_supp);

						if ($result_kd_supp && mysqli_num_rows($result_kd_supp) > 0) {
							$row_kd_supp = mysqli_fetch_assoc($result_kd_supp);
							$kd_supp = $row_kd_supp['kd_supp'];

							// Query untuk mencari durasi_waktu di tabel supplier berdasarkan kd_supp
							$query_durasi_waktu = "SELECT durasi_waktu FROM supplier WHERE kd_supp = '$kd_supp'";
							$result_durasi_waktu = mysqli_query($koneksi, $query_durasi_waktu);

							if ($result_durasi_waktu && mysqli_num_rows($result_durasi_waktu) > 0) {
								$row_durasi_waktu = mysqli_fetch_assoc($result_durasi_waktu);
								$waktu_kirim_supplier = $row_durasi_waktu['durasi_waktu'];

								// Hitung qty_order dan qty_order_max_jual
								$qty_order = $rata_rata_7_hari * $waktu_kirim_supplier;
								$qty_order_max_jual = $qty_jual_tertinggi * $waktu_kirim_supplier;

								// Ambil stok akhir dari tanggal terbaru
								$query_stok_akhir = "SELECT stok_akhir FROM analisa_stok WHERE kd_brg = '$kd_brg' AND tgl = '$tgl_terbaru'";
								$result_stok_akhir = mysqli_query($koneksi, $query_stok_akhir);

								if ($result_stok_akhir && mysqli_num_rows($result_stok_akhir) > 0) {
									$row_stok_akhir = mysqli_fetch_assoc($result_stok_akhir);
									$stok_akhir = $row_stok_akhir['stok_akhir'];

									// Insert data ke tabel analisa_stok
									$query_insert = "
																	INSERT INTO analisa_stok (
																			tgl, kd_brg, stok_awal, qty_jual, qty_beli, rata_rata_7_hari, 
																			qty_jual_tertinggi, waktu_kirim_supplier, qty_order, stok_akhir, qty_order_max_jual
																	) VALUES (
																			'$tgl_besok', '$kd_brg', '$stok_akhir', 0, 0, '$rata_rata_7_hari', 
																			'$qty_jual_tertinggi', '$waktu_kirim_supplier', '$qty_order', '$stok_akhir', '$qty_order_max_jual'
																	)
															";

									if (mysqli_query($koneksi, $query_insert)) {
										echo "Data berhasil ditambahkan untuk Kode Barang: $kd_brg.<br>";

										// **Proses Pengecekan Stok dan Pembuatan Pembelian Dimulai Di Sini**

										// Cek apakah stok_awal lebih kecil dari qty_order
										$stok_awal = $stok_akhir; // Karena stok_awal diinsert adalah stok_akhir sebelumnya

										if ($stok_awal < $qty_order) {
											echo " <br> masuk sini 1";

											// Menggabungkan pembelian dengan kd_supp yang sama
											$query_gabung_pembelian = "
																					SELECT t1.kd_supp, t1.tgl_beli, SUM(t2.jml) as total_qty_order
																					FROM pembelian t1
																					JOIN pembelian_detail t2 ON t1.kd_beli = t2.kd_beli
																					GROUP BY t1.kd_supp, t1.tgl_beli
																			";
											$result_gabung_pembelian = mysqli_query($koneksi, $query_gabung_pembelian);

											if ($result_gabung_pembelian) {
												while ($row = mysqli_fetch_assoc($result_gabung_pembelian)) {
													$kd_supp = $row['kd_supp'];
													$tgl_beli = $row['tgl_beli'];
													$total_qty_order = $row['total_qty_order'];

													// Cek apakah sudah ada pembelian dengan kd_supp dan tgl_beli
													$query_cek_pembelian = "
																									SELECT kd_beli
																									FROM pembelian
																									WHERE kd_supp = '$kd_supp' AND tgl_beli = '$tgl_beli'
																							";
													$result_cek_pembelian = mysqli_query($koneksi, $query_cek_pembelian);

													if ($result_cek_pembelian && mysqli_num_rows($result_cek_pembelian) > 0) {

														// Jika sudah ada, gunakan kd_beli yang sudah ada
														$row_cek_pembelian = mysqli_fetch_assoc($result_cek_pembelian);
														$kd_beli_baru = $row_cek_pembelian['kd_beli'];

														// Update total_qty_order
														$query_update_pembelian = "
																											UPDATE pembelian
																											SET ket_payment = NULL, 
																													status_pembelian = 0
																											WHERE kd_beli = '$kd_beli_baru'
																									";
														if (mysqli_query($koneksi, $query_update_pembelian)) {
															echo "Pembelian berhasil diupdate untuk Kode Pembelian: $kd_beli_baru.<br>";
														} else {
															echo "Gagal mengupdate pembelian: " . mysqli_error($koneksi) . "<br>";
														}

														// Update detail pembelian
														$query_update_detail = "
																											UPDATE pembelian_detail
																											SET jml = jml + $total_qty_order, jumlah_pcs = jumlah_pcs + $total_qty_order
																											WHERE kd_beli = '$kd_beli_baru'
																													AND kd_brg = '$kd_brg'
																									";
														if (mysqli_query($koneksi, $query_update_detail)) {
															echo "Detail pembelian berhasil diupdate untuk Kode Barang: $kd_brg.<br>";
														} else {
															echo "Gagal mengupdate detail pembelian: " . mysqli_error($koneksi) . "<br>";
														}
													} else {
														echo " <br> masuk sini";
														// Jika belum ada, buat pembelian baru
														$query_kode_terbesar = mysqli_query($koneksi, "SELECT max(kd_beli) as kodeTerbesar FROM pembelian");
														$data_kode_terbesar = mysqli_fetch_array($query_kode_terbesar);
														$kode_terbesar = $data_kode_terbesar['kodeTerbesar'];
														$urutan = (int) substr($kode_terbesar, 6, 4);
														$urutan++;
														$kd_beli_baru = 'Order-' . sprintf("%04s", $urutan);

														// Insert pembelian
														$query_insert_pembelian = "
																											INSERT INTO pembelian (kd_beli, kd_supp, tgl_beli, status_pembelian)
																											VALUES ('$kd_beli_baru', '$kd_supp', NOW(), 1)
																									";
														if (mysqli_query($koneksi, $query_insert_pembelian)) {
															echo "Pembelian berhasil ditambahkan untuk Kode Pembelian: $kd_beli_baru.<br>";
														} else {
															echo "Gagal menambahkan pembelian: " . mysqli_error($koneksi) . "<br>";
														}

														// Insert detail pembelian
														$query_insert_detail = "
																											INSERT INTO pembelian_detail (kd_beli, kd_brg, jml, jumlah_pcs)
																											VALUES ('$kd_beli_baru', '$kd_brg', $total_qty_order, $total_qty_order)
																									";
														if (mysqli_query($koneksi, $query_insert_detail)) {
															echo "Detail pembelian berhasil ditambahkan untuk Kode Barang: $kd_brg.<br>";
														} else {
															echo "Gagal menambahkan detail pembelian: " . mysqli_error($koneksi) . "<br>";
														}
													}
												}
											} else {
												echo "Gagal menggabungkan pembelian: " . mysqli_error($koneksi) . "<br>";
											}
										}
									} else {
										echo "Gagal menambahkan data untuk Kode Barang: $kd_brg.<br>";
									}
								}
							}
						}
					}
				}
			} else {
				echo "Gagal mengambil kode barang unik.";
			}
		} else {
			echo "Gagal mengambil tanggal terbaru.";
		}
	}






	//Tambah 
	elseif ($route == $tujuan and $act == 'input') {
		$tgl = date('ymd');
		$no_pengajuan = 'AJU-' . $_POST['no_pengajuan'];
		// echo $no_pengajuan;

		$kd_acc = $_POST['kd_acc'];
		// echo '<br/> kd acc = '.$kd_acc;

		$cabang_e = $_SESSION['cabang_e'];
		$area_e = $_SESSION['area_e'];

		if ($cabang_e == '0000') {
			$kode_manajer = sprintf("%02s", $area_e);

			$query = mysqli_query($koneksi, "SELECT * from pengaju where manager='$kode_manajer' ");
			$q = mysqli_fetch_array($query);
		} elseif ($area_e == '0') {
			$kode_cabang = sprintf("%04s", $cabang_e);

			$query = mysqli_query($koneksi, "SELECT * from pengaju where unitkerja='$kode_cabang' ");
			$q = mysqli_fetch_array($query);
		}


		$query = mysqli_query($koneksi, "SELECT max(no_pengajuan) as kodeTerbesar FROM pengajuan where left(no_pengajuan,13)='$no_pengajuan' ");
		$data = mysqli_fetch_array($query);
		$kode = $data['kodeTerbesar'];
		// echo '<br/> kode 1 :';
		// echo $kodeBarang;

		$urutan = (int) substr($kode, 21, 4);

		echo '<br/> urutan :' . $urutan;

		// echo '<br/> === :';

		// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
		$urutan++;

		$kode = $no_pengajuan . '-' . $tgl . '-' . sprintf("%04s", $urutan);
		echo '<br/> kode :' . $kode;


		$query2 = mysqli_query($koneksi, "SELECT * FROM account WHERE no_account='$kd_acc' ");
		$q2 = mysqli_fetch_array($query2);

		$pph = $q2['pph'];


		$query = "INSERT INTO $tabel ($f1, $f2, $f3, $f4, $f5, $f6, $f9,$f16,$f17,$f18) 
		VALUES (
			'$kode', 
			'$_POST[$f2]', 
			'$_POST[$f3]',  
			'$_POST[$f4]',  
			'$_POST[$f5]',  
			'$_POST[$f6]',
			'$_POST[$f9]',
			'$kode_cabang',
			'$kode_manajer',
			'$_POST[$f18]'
		)";
		$result = mysqli_query($koneksi, $query);


		$query2 = "INSERT INTO $tabel2 ($ff1, $ff2, $ff3, $ff4, $ff7, $ff8) 
		VALUES (
			'$kode', 
			'$kd_acc', 
			'$_POST[$ff3]',  
			'$_POST[$ff4]',  
			'$_POST[$ff7]',
			'$urut'
		)";
		$result2 = mysqli_query($koneksi, $query2);


		if (!$result) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil ditambah.');</script>";
			echo "<script>history.go(-2)</script>";
		}
	}

	//Tambah Detail
	elseif ($route == $tujuan and $act == 'input-detail') {
		$id = $_GET['id'];

		$jumlahArray = $_POST['jumlah'];
		$kdAccArray = $_POST['kd_acc'];
		$uraianArray = $_POST['uraian'];
		$hargaArray = $_POST['harga'];
		$satuanArray = $_POST['satuan'];
		$jumlahpcsArray = $_POST['jumlah_pcs'];

		foreach ($jumlahArray as $index => $jumlah) {
			$jumlah_angka = str_replace(".", "", $jumlah);
			$kd_acc = $kdAccArray[$index];
			$satuan = $satuanArray[$index];
			$uraian = $uraianArray[$index];
			$jumlahpcs = $jumlahpcsArray[$index];
			$harga_angka = str_replace(".", "", $hargaArray[$index]);

			// echo "Index: $index<br>";
			// echo "Jumlah: $jumlah<br>";
			// echo "Jumlah Angka: $jumlah_angka<br>";
			// echo "Kode Account: $kd_acc<br>";
			// echo "Uraian: $uraian<br>";
			// echo "Harga Angka: $harga_angka<br>";



			$query = mysqli_query($koneksi, "SELECT max(urut) as urut_max FROM $tabel2 WHERE $ff1='$id' ");
			$data = mysqli_fetch_array($query);
			$urut = $data['urut_max'];
			$urut++;

			$query2 = "INSERT INTO $tabel2 ($ff1, $ff2, $ff3, $ff4, $ff7, $ff8, $ff9 , $ff10)  
        VALUES (
            '$id', 
            '$kd_acc', 
            '$jumlah_angka', 
            '$harga_angka', 
            0,  
            '$urut',
						'$satuan',
						'$jumlahpcs'
        )";
			// printf($query2);
			$result2 = mysqli_query($koneksi, $query2);

			if (!$result2) {
				die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
					" - " . mysqli_error($koneksi));
			} else {
				// echo "<script>alert('Data berhasil ditambah.');</script>";
				echo "<script>history.go(-1)</script>";
			}
		}
	} elseif ($route == $tujuan and $act == 'input-detail-supllier-barang') {
		// Mengambil data dari form yang dikirim melalui metode POST
		$kdSupp = $_POST['kd_supp'];
		$kdAccArray = $_POST['kd_acc'];

		// Melakukan iterasi melalui setiap elemen dalam array
		foreach ($kdAccArray as $kd_acc) {
			// Menyiapkan query untuk memasukkan data ke tabel supplier_barang
			$query2 = "INSERT INTO supplier_barang (kd_supp, kd_brg) VALUES ('$kdSupp', '$kd_acc')";

			// Menjalankan query
			$result2 = mysqli_query($koneksi, $query2);

			// Cek jika query berhasil dijalankan
			if (!$result2) {
				die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
			}
		}

		// Redirect atau notifikasi berhasil
		echo "<script>alert('Data berhasil ditambah.');</script>";
		// echo "<script>history.go(-1)</script>";
		echo "<script>history.go(-1); window.location.href = window.location.href + '?refresh=true';</script>";
	}
	//Tambah baru
	elseif ($route == $tujuan and $act == 'input-baru') {


		// $kdAccArray = $_POST['kd_acc'];
		// $kd_supp = $_POST[$f3];
		// $price = $_POST[$ff4];
		// $jml = $_POST['jumlah'];
		// $satuan = $_POST['satuan'];
		// $jumlah_pcs = $_POST['hasil_perkalian'];

		// echo "<br>Ini kode suppliernya: " . htmlspecialchars($kd_supp);
		// echo "<br>Ini kode barangnya: ";
		// print_r($kdAccArray);
		// echo "<br>Ini harga: ";
		// print_r($price);
		// echo "<br>Ini jumlah: ";
		// print_r($jml);
		// echo "<br>Ini satuan: ";
		// print_r($satuan);
		// echo "<br>Ini jumlah pcs: ";
		// print_r($jumlah_pcs);




		$tgl = date('ymd');

		$query = mysqli_query($koneksi, "SELECT max(kd_beli) as kodeTerbesar FROM pembelian  ");
		$data = mysqli_fetch_array($query);
		$kode = $data['kodeTerbesar'];
		$urutan = (int) substr($kode, 6, 4);

		// echo '<br/> urutan :'. $urutan;
		// echo '<br/> === :';

		// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
		$urutan++;

		$kode = 'Order-' . sprintf("%04s", $urutan);
		// echo '<br/> kode :' . $kode;
		// echo '<br>';

		// PENGAJUAN

		$query = "INSERT INTO $tabel ($f1, $f2, $f3, $f4, $f7) 
		VALUES (
			'$kode', 
			'$_POST[$f2]', 
			'$_POST[$f3]',
			'$_POST[$f4]',
			'$_POST[$f7]'
		)";
		// echo '<br> query : ';
		// printf($query);
		$result = mysqli_query($koneksi, $query);

		// DETAIL

		$jumlah_angka = str_replace(".", "", $_POST[$ff4]);
		// echo '<br> kode account : '.$_POST['kode_account'];

		if (isset($_POST['kd_acc'])) {
			// echo "masuk ke kd accnya ada ";
			$kdSuppArray = $_POST[$f3];
			$kdAccArray = $_POST['kd_acc'];
			$jmlArray = $_POST['jumlah'];
			$priceArray = $_POST['price'];
			$satuanArray = $_POST['satuan'];
			$jumlahPcsArray = $_POST['hasil_perkalian'];
			// Melakukan iterasi melalui setiap elemen dalam array
			foreach ($kdAccArray as $kd_acc) {
				// Menyiapkan query untuk memasukkan data ke tabel supplier_barang
				$query2 = "INSERT INTO supplier_barang (kd_supp, kd_brg) VALUES ('$kdSuppArray', '$kd_acc')";

				// Menjalankan query
				$result2 = mysqli_query($koneksi, $query2);

				// Cek jika query berhasil dijalankan
				if (!$result2) {
					die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
				}
			}



			foreach ($kdAccArray as $index => $kdAcc) {
				$jml = $jmlArray[$index];
				$price = $priceArray[$index];
				$satuan = $satuanArray[$index];
				$jumlahPcs = $jumlahPcsArray[$index];



				$query2 = "INSERT INTO $tabel2($ff1, $ff2, $ff3, $ff4, $ff7, $ff8, $ff9, $ff10)
        VALUES(
            '$kode',
            '$kdAcc',
            '$jml',
            '$price',
            0,
            1,
            '$satuan',
            '$jumlahPcs'
        )";

				$result2 = mysqli_query($koneksi, $query2);

				if (!$result2) {
					$error_massage = "query Error" . mysqli_error($koneksi);
					echo "<script>alert('$error_massage')</script>";
					die();
				}
			}
		} else {
			// echo "masuk ke k ";

			$query2 = "INSERT INTO $tabel2 ($ff1, $ff2, $ff3, $ff4, $ff7, $ff8, $ff9, $ff10) 
		VALUES (
			'$kode', 
			'$_POST[$ff2]', 
			'$_POST[$ff3]',  
			'$jumlah_angka', 
            0,  
            1,
			'$_POST[$ff9]' ,
			'$_POST[$ff10]' 
		)";

			// echo '<br> query2 : ';
			// printf($query2);
			$result2 = mysqli_query($koneksi, $query2);


			if (!$result2) {
				die("Query gagal dijalankan: 2" . mysqli_errno($koneksi) .
					" - " . mysqli_error($koneksi));
			}
		}



		if (!$result) {
			die("Query gagal dijalankan: 1" . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil ditambah.');</script>";

			echo "<script>window.location='../../main.php?route=beli_detail&act&id=$kode'</script>";
		}
	}
	//Tambah Langsung
	elseif ($route == $tujuan and $act == 'input-langsung') {
		$tgl = date('ymd');
		$no_pengajuan = 'AJU-' . $_POST['no_pengajuan'];
		// echo $no_pengajuan;

		$kd_acc = $_POST['kd_acc'];
		// echo '<br/> kd acc = '.$kd_acc;


		$query = mysqli_query($koneksi, "SELECT max(no_pengajuan) as kodeTerbesar FROM pengajuan where left(no_pengajuan,12)='$no_pengajuan' ");
		$data = mysqli_fetch_array($query);
		$kode = $data['kodeTerbesar'];
		// echo '<br/> kode 1 :';
		// echo $kodeBarang;

		$urutan = (int) substr($kode, 20, 4);

		// echo '<br/> urutan :'. $urutan;

		// echo '<br/> === :';

		// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
		$urutan++;

		$kode = $no_pengajuan . '-' . $tgl . '-' . sprintf("%04s", $urutan);
		// echo '<br/> kode :'.$kode;


		$query2 = mysqli_query($koneksi, "SELECT * FROM account WHERE no_account='$kd_acc' ");
		$q2 = mysqli_fetch_array($query2);

		$pph = $q2['pph'];


		$query = "INSERT INTO $tabel ($f1, $f2, $f3, $f4, $f5, $f6, $f9) 
		VALUES (
			'$kode', 
			'$_POST[$f2]', 
			'$_POST[$f3]',  
			'$_POST[$f4]',  
			'$_POST[$f5]',  
			'$_POST[$f6]',
			'$_POST[$f9]'
		)";
		$result = mysqli_query($koneksi, $query);

		$query2 = "INSERT INTO $tabel2 ($ff1, $ff2, $ff3, $ff4, $ff7) 
		VALUES (
			'$kode', 
			'$kd_acc', 
			'$_POST[$ff3]',  
			'$_POST[$ff4]',  
			'$_POST[$ff7]'
		)";
		$result2 = mysqli_query($koneksi, $query2);


		if (!$result) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil ditambah.');</script>";
			// echo "<script>history.go(-2)</script>";
		}
	} elseif ($route == $tujuan and $act == 'edit') {

		$query  = "UPDATE $tabel SET 
		$f3 = '$_POST[$f3]',
		$f4 = '$_POST[$f4]',
		$f5 = '$_POST[$f5]', 
		$f6 = '$_POST[$f6]', 
		$f9 = '$_POST[$f9]'
		";
		$query .= "WHERE $f1 = '$_POST[$f1]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	} elseif ($route == $tujuan and $act == 'edit-detail') {

		$query  = "UPDATE $tabel2 SET 
		$ff3 = '$_POST[$ff3]',
		$ff4 = '$_POST[$ff4]'
		";
		$query .= "WHERE $ff1 = '$_GET[id]' AND $ff2 = '$_GET[id2]' AND $ff8='$_GET[id3]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-2)</script>";
		}
	} elseif ($route == $tujuan and $act == 'submit') {

		$query  = "UPDATE $tabel SET 
		submit = 2 ";
		$query .= "WHERE $f1 = '$_GET[id]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	} elseif ($route == $tujuan and $act == 'cancel') {

		$query  = "UPDATE $tabel SET 
		submit = 1 ";
		$query .= "WHERE $f1 = '$_GET[id]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	} elseif ($route == $tujuan and $act == 'pengajuan_ulang') {

		$query  = "UPDATE $tabel SET 
		submit = 0 ";
		$query .= "WHERE $f1 = '$_GET[id]' ";
		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan 1: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			// echo "<script>alert('Data berhasil diubah1.')</script>";
			echo "<script>history.go(-1)</script>";
		}
	}
	//Input Gambar 
	elseif ($route == 'pengajuan' and $act == 'gambar') {
		// echo "<br/>id :".$_GET['id'];
		$gambar_produk = $_FILES['photo']['name'];
		$ket = $_POST['ket'];
		// echo "<br/>ket :".$ket;
		// echo "<br/>nama :".$gambar_produk;

		//cek dulu jika ada gambar produk jalankan coding ini
		if ($gambar_produk != "") {
			$rand = rand();
			$ekstensi_diperbolehkan = array('png', 'jpg', 'bmp', 'jpeg'); //ekstensi file gambar yang bisa diupload 
			$x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
			$ekstensi = strtolower(end($x));
			$file_tmp = $_FILES['photo']['tmp_name'];
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
				$xx = $rand . '_' . $gambar_produk;
				move_uploaded_file($file_tmp, '../../../../images/attach_photo/' . $rand . '_' . $gambar_produk); //memindah file gambar ke folder gambar

				$query = "INSERT INTO $tabel_attachment ($fa1,$fa3,$fa4) values ('$_GET[id]','$_POST[$fa3]','$xx') ";
				$result = mysqli_query($koneksi, $query);

				if (!$result) {
					die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
						" - " . mysqli_error($koneksi));
				} else {
					echo "<script>alert('Data berhasil diUpdate.');</script>";
					echo "<script>history.go(-1)</script>";
				}
			} else {
				echo "<script>alert('Ekstensi gambar yang boleh hanya jpg , bmp , jpeg atau png.');</script>";
				echo "<script>history.go(-1)</script>";
			}
		}
	}
	//Input File 
	elseif ($route == 'pengajuan' and $act == 'file') {
		// echo "<br/>id :".$_GET['id'];
		$gambar_produk = $_FILES['file']['name'];
		$ket = $_POST['ket'];
		// echo "<br/>ket :".$ket;
		// echo "<br/>nama :".$gambar_produk;

		//cek dulu jika ada gambar produk jalankan coding ini
		if ($gambar_produk != "") {
			$rand = rand();
			$ekstensi_diperbolehkan = array('png', 'jpg', 'bmp', 'jpeg'); //ekstensi file gambar yang bisa diupload 
			$x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
			$ekstensi = strtolower(end($x));
			$file_tmp = $_FILES['file']['tmp_name'];
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === false) {
				$xx = $rand . '_' . $gambar_produk;
				move_uploaded_file($file_tmp, '../../../../images/attach_file/' . $rand . '_' . $gambar_produk); //memindah file gambar ke folder gambar

				$query = "INSERT INTO $tabel_attachment ($fa1,$fa2,$fa3,$fa5) values ('$_GET[id]','$tgl_sekarang','$_POST[$fa3]','$xx') ";
				$result = mysqli_query($koneksi, $query);

				if (!$result) {
					die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
						" - " . mysqli_error($koneksi));
				} else {
					echo "<script>alert('Data berhasil diUpdate.');</script>";
					echo "<script>history.go(-1)</script>";
				}
			} else {
				echo "<script>alert('Ekstensi gambar tidak boleh jpg , bmp , jpeg atau png.');</script>";
				echo "<script>history.go(-1)</script>";
			}
		}
	}

	//nete Input 
	elseif ($route == 'pengajuan' and $act == 'nego-input') {
		// echo "<br/>id :".$_GET['id'];
		// echo "<br/>idp :".$_GET['idp'];


		$query = "INSERT INTO $tabel_note ($fn1,$fn2,$fn3,$fn4) values ('$_GET[id]','$_POST[$fn2]','$_POST[$fn3]','$_POST[$fn4]') ";
		$result = mysqli_query($koneksi, $query);

		if (!$result) {
			die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
				" - " . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Data berhasil di Input.');</script>";
			echo "<script>history.go(-2)</script>";
		}
	}
}
