<?php
// session_start();
$dir = "../../";
include $dir . "config/koneksi.php";
include $dir . "config/library.php";
include $dir . "config/fungsi_combobox.php";
include $dir . "config/class_paging.php";
include $dir . "config/library.php";

$en = $_SESSION['employee_number'];

if ($_GET['route'] == 'home') {
?>
	<!-- <link rel="stylesheet" type="text/css" href="styleglow.css"> -->
	<!-- <link rel="stylesheet" href="styleglow.css"> -->
	<!-- Content Wrapper. Contains page content -->
	<!-- <div class="content-wrapper wow fadeInDown " data-wow-duration=".5s" data-wow-delay=".1s" style="margin-top:1px;"> -->
	<div class="content-wrapper " style="margin-top:1px;">
		<ul class="circles">
			<li style="background-color:lightgray;"></li>
			<li style="background-color:gray;"></li>
			<li style="background-color:lightgray;"></li>
			<li style="background-color:lightgray;"></li>
			<li style="background-color:gray;"></li>
			<li style="background-color:lightgray;"></li>
			<li style="background-color:lightgray;"></li>
			<li style="background-color:gray;"></li>
			<li style="background-color:lightgray;"></li>
			<li style="background-color:lightgray;"></li>
			<li style="background-color:gray;"></li>
		</ul>
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">

			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">


			</div> <!-- Contaner -fluid -->
		</section><!-- /.content -->
		<div id="bg-slideshow" style="position: fixed;top:0">
			<img src="../../images/4873152.jpg" alt="background" style="opacity: .7;" />
			<!-- Gambar yang lain akan dimasukkan kesini dengan bantuan dari jquery -->
		</div>
		<div style="padding: 100px;text-align: center;background-image: '../../4873152.jpg';">
			<img src="../../images/logo2.png" alt="Steak & Shake Logo" class="product-image  animasi" style="opacity: .8;width: 400px;">
		</div>
	</div> <!--content-wrapper"> -->


<?php
}
// modul untuk import barang 
elseif ($_GET['route'] == 'import_barang') {
	include "route/import_barang/index.php";
}
// modul untuk import pembelian 
elseif ($_GET['route'] == 'import_pembelian') {
	include "route/data_import_pembelian/index.php";
}
// modul untuk import pengiriman 
elseif ($_GET['route'] == 'import_pengiriman') {
	include "route/data_import_pengiriman/index.php";
}
// modul untuk import pembelian retur
elseif ($_GET['route'] == 'import_pembelian_retur') {
	include "route/data_import_pembelian_retur/index.php";
}
// modul untuk import_penjualan 
elseif ($_GET['route'] == 'import_penjualan') {
	include "route/data_import_penjualan/index.php";
}
// modul utnuk import stok opname
elseif ($_GET['route'] == 'import_stok_opname') {
	include "route/data_import_stok_opname/index.php";
}

// modul untuk supplier detail
elseif ($_GET['route'] == 'supplier_barang') {
	include "route/data_supplier/supplier_barang.php";
}
// modul untuk sales
elseif ($_GET['route'] == 'sales') {
	include "route/data_sales/sales.php";
}
// modul ganti password
elseif ($_GET['route'] == 'profile') {
	include "route/data_profile/profile.php";
} elseif ($_GET['route'] == 'assembly') {
	include "route/data_build/assembly.php";
} elseif ($_GET['route'] == 'bompenjualan') {
	include "route/lap_build/export_assemblypenjualan.php";
}

// modul staff
elseif ($_GET['route'] == 'staff') {
	include "route/data_staff/staff.php";
}
// modul area
elseif ($_GET['route'] == 'area') {
	include "route/data_area/area.php";
}

// modul alat bayar
elseif ($_GET['route'] == 'alat_bayar') {
	include "route/data_alat_bayar/alat_bayar.php";
}

// modul barang
elseif ($_GET['route'] == 'barang') {
	include "route/data_barang/barang.php";
}

// modul untuk gudang
elseif ($_GET['route'] == 'gudang') {
	include "route/data_gudang/gudang.php";
}
// modul untuk lokasi
elseif ($_GET['route'] == 'lokasi') {
	include "route/data_lokasi/lokasi.php";
}

// modul barangnas
elseif ($_GET['route'] == 'barangnas') {
	include "route/data_barangnas/barangnas.php";
}

// modul barang grup
elseif ($_GET['route'] == 'barang_grup') {
	include "route/data_barang_grup/barang_grup.php";
}

// modul barang jenis
elseif ($_GET['route'] == 'barang_jenis') {
	include "route/data_barang_jenis/barang_jenis.php";
}

// modul barang kota
elseif ($_GET['route'] == 'barang_kota') {
	include "route/data_barang_kota/barang_kota.php";
}

// modul barang subgrup
elseif ($_GET['route'] == 'barang_subgrup') {
	include "route/data_barang_subgrup/barang_subgrup.php";
}

// modul jenis Promosi
elseif ($_GET['route'] == 'jenis_promosi') {
	include "route/data_jenis_promosi/jenis_promosi.php";
}

// modul jenis Transaksi
elseif ($_GET['route'] == 'jenis_transaksi') {
	include "route/data_jenis_transaksi/jenis_transaksi.php";
}

// modul export pembelian
elseif ($_GET['route'] == 'export_pembelian') {
	include "route/data_export/export_pembelian.php";
} elseif ($_GET['route'] == 'export_pengiriman') {
	include "route/data_export/export_pengiriman.php";
} elseif ($_GET['route'] == 'export_pembelian_retur') {
	include "route/data_export/export_pembelian_retur.php";
}
// modul export Penjualan
elseif ($_GET['route'] == 'export_penjualan') {
	include "route/data_export/export_penjualan.php";
}


// modul mutasi stok
elseif ($_GET['route'] == 'mutasi_stok') {
	include "route/data_mutasi_stok/mutasi_stok.php";
}

// modul kota
elseif ($_GET['route'] == 'kota') {
	include "route/data_kota/kota.php";
}

// modul kota
elseif ($_GET['route'] == 'kotabaru') {
	include "route/data_kotabaru/kotabaru.php";
}

// modul kotanas
elseif ($_GET['route'] == 'kotanas') {
	include "route/data_kotanas/kotanas.php";
}

// modul pelanggan
elseif ($_GET['route'] == 'pelanggan') {
	include "route/data_pelanggan/pelanggan.php";
}

// modul pelanggan Nas
elseif ($_GET['route'] == 'pelangganas') {
	include "route/data_pelangganas/pelangganas.php";
}

// modul subalat_bayar
elseif ($_GET['route'] == 'subalat_bayar') {
	include "route/data_subalat_bayar/subalat_bayar.php";
}
// modul subalat_bayar
elseif ($_GET['route'] == 'subalat_bayar1') {
	include "route/data_subalat_bayar1/subalat_bayar1.php";
}


// modul tarif diskon
elseif ($_GET['route'] == 'tarif_diskon') {
	include "route/data_tarif_diskon/tarif_diskon.php";
}


// modul jual Detil
elseif ($_GET['route'] == 'jualdetil') {
	include "route/data_jualdetil/jualdetil.php";
}

// modul harga menu
elseif ($_GET['route'] == 'harga_menu') {
	include "route/data_harga_menu/index.php";
}
// modul import harga menu
elseif ($_GET['route'] == 'import_harga_menu') {
	include "route/data_import_harga/index.php";
}
// modul harga menu
elseif ($_GET['route'] == 'index_edit_menu') {
	include "route/data_harga_menu/index_edit_menu.php";
}
// modul menu
elseif ($_GET['route'] == 'index_edit_menu_barang') {
	include "route/data_harga_menu/index_edit_menu_barang.php";
}
// modul import edit barang
elseif ($_GET['route'] == 'index_edit_import_barang') {
	include "route/data_import_harga/index_edit_import_barang.php";
}


// modul promosi
elseif ($_GET['route'] == 'promosi') {
	include "route/data_promosi/index.php";
}

// modul promosi
elseif ($_GET['route'] == 'index_edit_promosi') {
	include "route/data_promosi/index_edit_promosi.php";
}
// modul promosi
elseif ($_GET['route'] == 'index_edit_promosi_barang') {
	include "route/data_promosi/index_edit_promosi_barang.php";
}
// modul pocer
elseif ($_GET['route'] == 'pocer') {
	include "route/data_pocer/index.php";
}
// modul pocer_edt
elseif ($_GET['route'] == 'index_edit') {
	include "route/data_pocer/index_edit.php";
}
// modul pocer approve
elseif ($_GET['route'] == 'pocer_approve') {
	include "route/data_pocer/pocer_approve.php";
}

// modul staff
elseif ($_GET['route'] == 'staff') {
	include "route/data_staff/staff.php";
}

// modul member
elseif ($_GET['route'] == 'member') {
	include "route/data_member/member.php";
}

// modul supplier
elseif ($_GET['route'] == 'supplier') {
	include "route/data_supplier/supplier.php";
}

// modul beli
elseif ($_GET['route'] == 'beli') {
	include "route/data_beli/beli.php";
}

// modul beli detail
elseif ($_GET['route'] == 'beli_detail') {
	include "route/data_beli/beli_detail.php";
}

// modul dispenda
elseif ($_GET['route'] == 'dispenda') {
	include "route/data_dispenda/dispenda.php";
}

// modul barang_tambah
elseif ($_GET['route'] == 'barang_tambah') {
	include "route/data_barang/barang_tambah.php";
}

// modul stok opname
elseif ($_GET['route'] == 'lap_stok_opname') {
	include "route/lap_stok_opname/lap_stok_opname.php";
}
// modul pembelian
elseif ($_GET['route'] == 'lap_barang_beli') {
	include "route/lap_beli/lap_pembelian.php";
}
// modul pembelian invoice
elseif ($_GET['route'] == 'lap_pembelian_invoice') {
	include "route/lap_pembelian_invoice/lap_pembelian_invoice.php";
}

// modul laporan transfer barang
elseif ($_GET['route'] == 'lap_transfer_barang') {
	include "route/lap_transfer_barang/lap_transfer_barang.php";
}
// modul laporan payment lunas
elseif ($_GET['route'] == 'lap_payment_lunas') {
	include "route/lap_payment/lap_payment_lunas.php";
}
// modul pb1
elseif ($_GET['route'] == 'pb1') {
	include "route/lap_pb1/pb1.php";
} elseif ($_GET['route'] == 'pb1_detil') {
	include "route/lap_pb1_detil/pb1.php";
} elseif ($_GET['route'] == 'lap_pb1_detil_view') {
	include "route/lap_pb1/lap_pb1_detil_view.php";
} elseif ($_GET['route'] == 'lap_void_detil_view') {
	include "route/lap_void/lap_void_detil_view.php";
} elseif ($_GET['route'] == 'pb1_barang_diskon') {
	include "route/lap_pb_transaksi_diskon/pb1.php";
}
// modul pb1 
elseif ($_GET['route'] == 'pb1_model2') {
	include "route/lap_pb1/pb1_model2.php";
}

// modul omset
elseif ($_GET['route'] == 'omzet') {
	include "route/lap_omzet/omzet.php";
}

// modul omset sebelumnya
elseif ($_GET['route'] == 'daftar_omzet_sebelumnya') {
	include "route/lap_omzet2/omzet2.php";
}
// modul daftar harga
elseif ($_GET['route'] == 'daftar_harga_model2') {
	include "route/lap_daftar_harga/daftar_harga_model2.php";
}
// modul rekap_penjualan
elseif ($_GET['route'] == 'rekap_penjualan2') {
	include "route/lap_rekap/rekap_penjualan_model2.php";
}

// modul rekap_penjualan
elseif ($_GET['route'] == 'rekap_penjualan') {
	include "route/lap_penjualan/rekap_penjualan.php";
}

// modul rekap_penjualan_per_outlet
elseif ($_GET['route'] == 'rekap_penjualan_per_outlet') {
	include "route/lap_per_outlet/rekap_penjualan.php";
}
// modul rekap_penjualan_sage
elseif ($_GET['route'] == 'rekap_penjualan_sage') {
	include "route/lap_penjualan/rekap_penjualan_sage.php";
}

// modul rekap_penjualan_sage
elseif ($_GET['route'] == 'rekap_penjualan_alatbayar') {
	include "route/lap_penjualan/rekap_penjualan_alatbayar.php";
}

// modul rekap_penjualan lama
elseif ($_GET['route'] == 'rekap_penjualan_menu2') {
	include "route/lap_rekap/rekap_penjualan_menu_model2.php";
}

// modul rekap_penjualan
elseif ($_GET['route'] == 'rekap_penjualan_menu') {
	include "route/lap_per_menu/rekap_penjualan_menu.php";
}

// modul rekap_penjualan
elseif ($_GET['route'] == 'rekap_penjualan_menu_outlet') {
	include "route/lap_penjualan/rekap_penjualan_menu_outlet.php";
}

// modul daftar_diskon lama
elseif ($_GET['route'] == 'daftar_diskon_lama') {
	include "route/lap_rekap/daftar_diskon_model2.php";
}
// modul daftar_diskon
elseif ($_GET['route'] == 'daftar_diskon') {
	include "route/lap_daftar_diskon/daftar_diskon.php";
}
// modul daftar_voucher
elseif ($_GET['route'] == 'daftar_voucher') {
	include "route/lap_voucher/daftar_voucher_model2.php";
}

// modul alat bayar
elseif ($_GET['route'] == 'daftar_alat_bayar_model2') {
	include "route/lap_daftar_alat_bayar/daftar_alat_bayar_model2.php";
}



// modul lap beban adm
elseif ($_GET['route'] == 'menu_lap_beban_adm') {
	include "route/lap_beban_adm/menu_lap_beban_adm.php";
}

// modul rekap beban adm
elseif ($_GET['route'] == 'menu_rekap_beban_adm') {
	include "route/lap_beban_adm/menu_rekap_beban_adm.php";
}

// modul lap beban fee
elseif ($_GET['route'] == 'lap_beban_fee') {
	include "route/lap_beban_fee/lap_beban_fee.php";
}

// modul rekap beban adm
elseif ($_GET['route'] == 'rekap_beban_fee') {
	include "route/lap_beban_fee/rekap_beban_fee.php";
}

// modul rekap_sales_report
elseif ($_GET['route'] == 'rekap_sales_report') {
	include "route/lap_sales/rekap_sales_report.php";
}


// modul rekap_sales_report sage
elseif ($_GET['route'] == 'rekap_sales_report_sage') {
	include "route/lap_sales/rekap_sales_report_sage.php";
}
// modul payment pos 1
elseif ($_GET['route'] == 'payment_pos1') {
	include "route/lap_pos/payment_pos1.php";
}

// modul payment pos 2
elseif ($_GET['route'] == 'payment_pos2') {
	include "route/lap_pos/payment_pos2.php";
}

// modul payment pos 2
elseif ($_GET['route'] == 'payment_pos2b') {
	include "route/lap_pos/payment_pos2b.php";
}

// modul refund pos 1
elseif ($_GET['route'] == 'refund_pos1') {
	include "route/lap_refund/refund_pos1.php";
}
// modul untuk account
elseif ($_GET['route'] == 'account') {
	include "route/data_account/account.php";
}
// modul untuk data jenis transaksi
elseif ($_GET['route'] == 'jenis_transaksi') {
	include "route/data_jenis_transaksi/jenis_transaksi.php";
}
// modul refund pos 2
elseif ($_GET['route'] == 'refund_pos2') {
	include "route/lap_refund/refund_pos2.php";
}

// modul refund pos 1
elseif ($_GET['route'] == 'void_pos1') {
	include "route/lap_void/void_pos1.php";
}

// modul refund pos 2
elseif ($_GET['route'] == 'void_pos2') {
	include "route/lap_void/void_pos2.php";
}

// modul test Penjualan
elseif ($_GET['route'] == 'test_penjualan') {
	include "route/test_penjualan/rekap_penjualan_model2.php";
}

// modul test Penjualan detil
elseif ($_GET['route'] == 'test_penjualan_detil') {
	include "route/test_penjualan/rekap_penjualan_detil_model2.php";
}
// modul untuk approve purchase request
elseif ($_GET['route'] == 'po') {
	include "route/data_purchase_order/purchase_order.php";
}
// modul untuk approve purchase request
elseif ($_GET['route'] == 'purchase_order_gudang') {
	include "route/data_purchase_order/purchase_order_gudang.php";
}
// modul untuk approve purchase request
elseif ($_GET['route'] == 'purchase_order_keuangan') {
	include "route/data_purchase_order/purchase_order_keuangan.php";
}
// modul untuk purchase order keuangan detail
elseif ($_GET['route'] == 'purchase_order_keuangan_detail') {
	include "route/data_purchase_order/purchase_order_keuangan_detail.php";
}
// modul untuk purchase order keuangan detail
elseif ($_GET['route'] == 'purchase_order_detail') {
	include "route/data_purchase_order/purchase_order_detail.php";
}
// modul untuk data invoice tambah
elseif ($_GET['route'] == 'invoice_tambah') {
	include "route/lap_invoice_pembelian/invoice_tambah.php";
}
// modul untuk penerimaan barang
elseif ($_GET['route'] == 'good_receiving') {
	include "route/data_penerimaan_barang/penerimaan_barang.php";
}
// modul untuk penerimaaan barang detail
elseif ($_GET['route'] == 'good_receiving_detail') {
	include "route/data_penerimaan_barang/detail_penerimaan_barang.php";
}
// modul untuk kategori
elseif ($_GET['route'] == 'kategori') {
	include "route/data_kategori/kategori.php";
}
// modul untuk invoice pembelian
elseif ($_GET['route'] == 'invoice_pembelian') {
	include "route/lap_invoice_pembelian/invoice.php";
} elseif ($_GET['route'] == 'pembelian_retur') {
	include "route/data_pembelian_retur/pembelian_retur.php";
} elseif ($_GET['route'] == 'kategori_satuan') {
	include "route/data_kategori_satuan/kategori_satuan.php";
} elseif ($_GET['route'] == 'kategori_buffer') {
	include "route/data_kategori_buffer/kategori_buffer.php";
} elseif ($_GET['route'] == 'pembelian_retur_tambah') {
	include "route/data_pembelian_retur/pembelian_retur_tambah.php";
	// modul untuk penjualan 
}
// modul untuk penjualan return
elseif ($_GET['route'] == 'penjualan_retur') {
	include "route/data_penjualan_retur/penjualan_retur.php";
}
// modul untuk penjualan retur tambah 
elseif ($_GET['route'] == 'penjualan_retur_tambah') {
	include "route/data_penjualan_retur/penjualan_retur_tambah.php";
}
// modul untuk penjualan retur detail
elseif ($_GET['route'] == 'penjualan_retur_detail') {
	include "route/data_penjualan_retur/penjualan_retur_detail.php";
}
// modul untuk penjualan retur view
elseif ($_GET['route'] == 'penjualan_retur_view') {
	include "route/data_penjualan_retur/penjualan_retur_view.php";
}
// modul untuk laporan penjualan retur detail
elseif ($_GET['route'] == 'lap_retur_penjualan') {
	include "route/lap_penjualan_retur/lap_penjualan_retur_model2.php";
} elseif ($_GET['route'] == 'lap_retur_pembelian') {
	include "route/lap_retur_pembelian/lap_pembelian_retur_model2.php";
}
// modul untuk laporan penjualan retur summary 
elseif ($_GET['route'] == 'lap_retur_penjualan_summary') {
	include "route/lap_retur_penjualan_summary/lap_penjualan_retur_summary.php";
} elseif ($_GET['route'] == 'biaya') {
	include "route/data_biaya/biaya.php";
} elseif ($_GET['route'] == 'biaya_tambah') {
	include "route/data_biaya/biaya_tambah.php";
} elseif ($_GET['route'] == 'lap_biaya') {
	include "route/lap_biaya/lap_biaya.php";
}

// modul untuk pembelian return
elseif ($_GET['route'] == 'pembelian_retur_nota') {
	include "route/data_pembelian_retur_nota/pembelian_retur.php";
}
// modul untuk pembelian retur tambah 
elseif ($_GET['route'] == 'pembelian_retur_tambah_nota') {
	include "route/data_pembelian_retur_nota/pembelian_retur_tambah.php";
}
// modul untuk pembelian retur detail
elseif ($_GET['route'] == 'pembelian_retur_detail') {
	include "route/data_pembelian_retur_nota/pembelian_retur_detail.php";
}
// modul untuk pembelian retur view
elseif ($_GET['route'] == 'pembelian_retur_view') {
	include "route/data_pembelian_retur_nota/pembelian_retur_view.php";
}
// modul untuk laporan pembelian retur detail
elseif ($_GET['route'] == 'lap_retur_pembelian') {
	include "route/lap_pembelian_retur/lap_pembelian_retur_model2.php";
}
// modul untuk laporan pembelian retur summary 
elseif ($_GET['route'] == 'lap_retur_pembelian_summary') {
	include "route/lap_retur_penjualan_summary/lap_pembelian_retur_summary.php";
}


// modul untuk invoice pembelian view
elseif ($_GET['route'] == 'invoice_pembelian_view') {
	include "route/lap_invoice_pembelian/invoice_pembelian_view.php";
}
// modul untuk payment invoice
elseif ($_GET['route'] == 'payment_invoice') {
	include "route/lap_payment_invoice/payment_invoice.php";
}
// modul untuk payment invoice
elseif ($_GET['route'] == 'payment_tambah') {
	include "route/lap_payment_invoice/payment_tambah.php";
}
// modul untuk payment view 
elseif ($_GET['route'] == 'payment_view_detail') {
	include "route/lap_payment_invoice/payment_view_detail.php";
}
// modul untuk payment Lunas
elseif ($_GET['route'] == 'payment_lunas') {
	include "route/lap_payment_invoice/payment_lunas.php";
}
// modul untuk payment Belum Lunas
elseif ($_GET['route'] == 'payment_belum_lunas') {
	include "route/lap_payment_invoice/payment_belum_lunas.php";
}
// modul untuk payment
elseif ($_GET['route'] == 'payment') {
	include "route/data_payment/payment.php";
} elseif ($_GET['route'] == 'paylater') {
	include "route/data_paylater/paylater.php";
} elseif ($_GET['route'] == 'paylater_view') {
	include "route/data_paylater/paylater_view.php";
} elseif ($_GET['route'] == 'paylater_add') {
	include "route/data_paylater/paylater_tambah.php";
} elseif ($_GET['route'] == 'paylaterreport') {
	include "route/lap_paylater/export_paylater.php";
}
// modul untuk payment view
elseif ($_GET['route'] == 'payment_view') {
	include "route/data_payment/payment_view.php";
}
// modul untuk payment view
elseif ($_GET['route'] == 'beli_view') {
	include "route/data_beli/beli_view.php";
}
// modul untuk payment view
elseif ($_GET['route'] == 'po_view') {
	include "route/data_purchase_order/po_view.php";
}
// modul untuk payment
elseif ($_GET['route'] == 'payment_add') {
	include "route/data_payment/payment_tambah.php";
} elseif ($_GET['route'] == 'payment_success') {
	include "route/data_payment/payment_success.php";
}
// Modul untuk payment based on supplier
elseif ($_GET['route'] == 'payment_based_supplier') {
	include "route/data_payment/payment_based_supplier.php";
}
// modul untuk generate stok
elseif ($_GET['route'] == 'generate_stok') {
	include "route/data_generate_stok/generate_stok.php";
}
// modul untuk generate stok
elseif ($_GET['route'] == 'generate_stok_supplier') {
	include "route/data_generate_stok_supplier/stok_by_supplier.php";
}
// modul untuk purchase order view 
elseif ($_GET['route'] == 'purchase_order_view') {
	include "route/data_purchase_order/purchase_order_view.php";
}
// modul untuk purchase order view 
elseif ($_GET['route'] == 'invoice_tambah_po') {
	include "route/data_purchase_order/invoice_tambah_po.php";
}
// modul untuk purchase order view 
elseif ($_GET['route'] == 'invoice_bayar') {
	include "route/lap_invoice_pembelian/invoice_bayar.php";
} elseif ($_GET['route'] == 'outstanding_utang') {
	include "route/lap_outstanding_utang/outstanding_utang.php";
} elseif ($_GET['route'] == 'outstanding_utang_detail') {
	include "route/lap_outstanding_utang/outstanding_utang_detail.php";
} elseif ($_GET['route'] == 'payment_detail_outstanding_utang') {
	include "route/lap_outstanding_utang/payment_detail_outstanding_utang.php";
} elseif ($_GET['route'] == 'purchase_order_detail_invoice') {
	include "route/lap_pembelian_invoice/purchase_order_detail_invoice.php";
}



// Lap untuk stok
elseif ($_GET['route'] == 'lap_stok') {
	include "route/lap_stok/lap_stok.php";
} elseif ($_GET['route'] == 'lap_stok_summary') {
	include "route/lap_stok/lap_stok_summary.php";
}

//  MODUL UNTUK STOK OPNAME
elseif ($_GET['route'] == 'stok_opname') {
	include "route/data_stok_opname/stok_opname.php";
} elseif ($_GET['route'] == 'stok_opname_tambah') {
	include "route/data_stok_opname/stok_opname_tambah.php";
} elseif ($_GET['route'] == 'stok_opname_view') {
	include "route/data_stok_opname/stok_opname_view.php";
} elseif ($_GET['route'] == 'stok_opname_detail') {
	include "route/data_stok_opname/stok_opname_detail.php";
}


// SEMUA MENU INVENTORY

elseif ($_GET['route'] == 'transfer_inventory') {
	include "route/data_transfer_inventory/transfer_inventory.php";
} elseif ($_GET['route'] == 'transfer_inventory_tambah') {
	include "route/data_transfer_inventory/transfer_inventory_tambah.php";
} elseif ($_GET['route'] == 'transfer_inventory_view') {
	include "route/data_transfer_inventory/transfer_inventory_view.php";
} elseif ($_GET['route'] == 'transfer_inventory_detail') {
	include "route/data_transfer_inventory/transfer_inventory_detail.php";
} elseif ($_GET['route'] == 'permintaan_barang') {
	include "route/data_permintaan_barang/permintaan_barang.php";
} elseif ($_GET['route'] == 'permintaan_barang_tambah') {
	include "route/data_permintaan_barang/permintaan_barang_tambah.php";
} elseif ($_GET['route'] == 'permintaan_barang_view') {
	include "route/data_permintaan_barang/permintaan_barang_view.php";
} elseif ($_GET['route'] == 'permintaan_barang_detail') {
	include "route/data_permintaan_barang/permintaan_barang_detail.php";
} elseif ($_GET['route'] == 'mutasi_bs') {
	include "route/data_mutasi_bs/mutasi_bs.php";
} elseif ($_GET['route'] == 'mutasi_bs_tambah') {
	include "route/data_mutasi_bs/mutasi_bs_tambah.php";
} elseif ($_GET['route'] == 'mutasi_bs_view') {
	include "route/data_mutasi_bs/mutasi_bs_view.php";
}elseif ($_GET['route'] == 'mutasi_bs_detail') {
	include "route/data_mutasi_bs/mutasi_bs_detail.php";
}




// Modul untuk pengiriman barang
elseif ($_GET['route'] == 'pengiriman_barang') {
	include "route/data_pengiriman_barang/pengiriman_barang.php";
} elseif ($_GET['route'] == 'pengiriman_barang_view') {
	include "route/data_pengiriman_barang/pengiriman_barang_view.php";
} elseif ($_GET['route'] == 'permintaan_barang_view_detail') {
	include "route/data_pengiriman_barang/permintaan_barang_view_detail.php";
}

// Modul untuk permintaan barang selesai
elseif ($_GET['route'] == 'permintaan_barang_selesai') {
	include "route/data_permintaan_barang_selesai/permintaan_barang_selesai.php";
}
// modul untuk permintaan barang selesai view
elseif ($_GET['route'] == 'permintaan_barang_selesai_view') {
	include "route/data_permintaan_barang_selesai/permintaan_barang_selesai_view.php";
}

// Modul untuk penerimaan barang internal
elseif ($_GET['route'] == 'penerimaan_barang_internal') {
	include "route/data_penerimaan_barang_internal/penerimaan_barang_internal.php";
} elseif ($_GET['route'] == 'penerimaan_barang_internal_view') {
	include "route/data_penerimaan_barang_internal/penerimaan_barang_internal_view.php";
} elseif ($_GET['route'] == 'penerimaan_barang_internal_view_detail_terima') {
	include "route/data_penerimaan_barang_internal/permintaan_barang_view_detail.php";
}
// modul untk penerimaan barang selesai




// Modul untuk penerimaan barang internal selesai

elseif ($_GET['route'] == 'stok_opname') {
	include "route/data_stok_opname/stok_opname.php";
} elseif ($_GET['route'] == 'bom') {
	include "route/data_bom/bom.php";
} elseif ($_GET['route'] == 'bom_tambah') {
	include "route/data_bom/bom_tambah.php";
} elseif ($_GET['route'] == 'assembly') {
	include "route/data_assembly/assembly.php";
}



// MENU INVENTORY SELESAI

// MODUL LAPORAN MUTASI
// modul Lap mutasi stok per outlet
elseif ($_GET['route'] == 'lap_mutasi_stok_per_outlet') {
	include "route/lap_mutasi/lap_mutasi_stok_per_outlet.php";
}

// modul Lap mutasi per barang
elseif ($_GET['route'] == 'lap_mutasi_per_barang') {
	include "route/lap_mutasi/lap_mutasi_per_barang.php";
} elseif ($_GET['route'] == 'lap_mutasi_per_barang2') {
	include "route/lap_mutasi/lap_mutasi_per_barang2.php";
} elseif ($_GET['route'] == 'lap_mutasi_per_barang_detail') {
	include "route/lap_mutasi/lap_mutasi_per_barang_detail.php";
} elseif ($_GET['route'] == 'opname_stock_mutasi') {
	include "route/lap_mutasi/opname_stock_mutasi.php";
} elseif ($_GET['route'] == 'lap_opname_stock_mutasi') {
	include "route/lap_mutasi/lap_opname_stock_mutasi.php";
}

// modul Lap Baru
elseif ($_GET['route'] == 'vendor_aged') {
	include "route/lap_baru/vendor_aged.php";
} elseif ($_GET['route'] == 'vendor_purchases') {
	include "route/lap_baru/vendor_purchases.php";
} elseif ($_GET['route'] == 'vendor_pending_purchases_vendor') {
	include "route/lap_baru/vendor_pending_purchases_vendor.php";
} elseif ($_GET['route'] == 'vendor_pending_purchases_items') {
	include "route/lap_baru/vendor_pending_purchases_items.php";
} elseif ($_GET['route'] == 'customer_aged') {
	include "route/lap_baru/customer_aged.php";
} elseif ($_GET['route'] == 'customer_sales') {
	include "route/lap_baru/customer_sales.php";
} elseif ($_GET['route'] == 'customer_category_sales') {
	include "route/lap_baru/customer_category_sales.php";
} elseif ($_GET['route'] == 'inventory_summary') {
	include "route/lap_baru/inventory_summary.php";
} elseif ($_GET['route'] == 'inventory_sales') {
	include "route/lap_baru/inventory_sales.php";
} elseif ($_GET['route'] == 'inventory_transaksi') {
	include "route/lap_baru/inventory_transaksi.php";
}

// modul Lap mutasi laba penjualan
elseif ($_GET['route'] == 'lap_mutasi_laba_penjualan') {
	include "route/lap_mutasi/lap_mutasi_laba_penjualan.php";
} elseif ($_GET['route'] == 'lap_mutasi_laba_penjualan_retail') {
	include "route/lap_mutasi/lap_mutasi_laba_penjualan_retail.php";
} elseif ($_GET['route'] == 'lap_mutasi_laba_penjualan_grosir') {
	include "route/lap_mutasi/lap_mutasi_laba_penjualan_grosir.php";
} elseif ($_GET['route'] == 'lap_member_laba_penjualan') {
	include "route/lap_member/lap_member_laba_penjualan.php";
}
// modul Lap mutasi laba penjualan
elseif ($_GET['route'] == 'lap_rekap_penjualan') {
	include "route/lap_mutasi/lap_rekap_penjualan.php";
}

// modul delete semua
elseif ($_GET["route"] == 'delete_mutasi') {
	include "route/data_hapus_mutasi/delete.php";
}



// modul untuk piutang
elseif ($_GET['route'] == 'piutang') {
	include "route/data_piutang/piutang.php";
} elseif ($_GET['route'] == 'import_sage') {
	include "route/sage/import_sage.php";
} elseif ($_GET['route'] == 'import_sage2') {
	include "route/sage/import_sage2.php";
} elseif ($_GET['route'] == 'import_sage_build') {
	include "route/sage/import_sage_build.php";
} elseif ($_GET['route'] == 'import_sage_pembelian') {
	include "route/sage/import_sage_pembelian.php";
} elseif ($_GET['route'] == 'import_sage_retur_jual') {
	include "route/sage/import_sage_retur_jual.php";
} elseif ($_GET['route'] == 'import_sage_retur_beli') {
	include "route/sage/import_sage_retur_beli.php";
}

// modul setup
elseif ($_GET['route'] == 'setup') {
	include "route/data_setup/setup.php";
} else {
	echo "<script>alert('Modul Tidak Ditemukann !');</script>";
	echo "<script>window.location='main.php?route=home'</script>";
}

?>


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>