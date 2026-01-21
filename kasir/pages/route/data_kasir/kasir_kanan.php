<div class="col-lg-5 bg-white background_wib1" style="padding-right: 10px;padding-left: 1px;">
	<div class=" box-poly" style="padding:15 10 15 15; height: 860px;" id="showMenu">

		<div id="showMenu" style="height: inherit;">

			<div class="card-body" id="label_header_kanan" style="font-size:30pt;font-weight:600 ;text-align:center;border-top-left-radius: 10px;border-top-right-radius: 10px;">
			</div>
			<br>

			<!-- <div class="card card-primary"> -->

			<div class="card-body" style="border-top-left-radius: 10px;border-top-right-radius: 10px;">
				<?php if ($kategori_kasir_harga == 0) { ?>
					<a id="btn_menu_all" class="btn tombol3" onclick="Retail()" data-filter="1" style="width: 57px;">Retail</a>
					<a id="btn_menu_makanan" class="btn tombol3" onclick="Grosir()" data-filter="1" style="width: 57px;">Grosir</a>
					<a id="btn_menu_minuman" class="btn tombol3" onclick="Online()" data-filter="1" style="width: 59px;">Online</a>
					<a id="btn_menu_paket" class="btn tombol3 disabled" onclick="MS()" data-filter="1" style="width: 40px;">MS</a>
					<a id="btn_menu_tambahan" class="btn tombol3 disabled" onclick="MG()" data-filter="1" style="width: 40px;">MG</a>
					<a id="btn_menu_tambahan" class="btn tombol3 disabled" onclick="MP()" data-filter="1" style="width: 40px;">MP</a>

					<a class="btn box-poly-kotak2 pull-right" style="padding: 5 10 10 10;"><input type="text" class="form-control" id="search_menu" name="search_menu" style="width:100px;border-style:none;height: 20px;" placeholder="Cari disini..."></a>
					<a class="btn box-poly-kotak2 pull-right" style="padding: 5 10 10 10;"><input type="text" class="form-control" id="cari_kode" placeholder="Barcode..." style="width:100px;border-style:none;height: 20px;"></a>
				<?php } else { ?>
					<a class="btn box-poly-kotak2 pull-right" style="padding: 5 10 10 10;"><input type="text" class="form-control" id="search_menu" name="search_menu" style="width:250px;border-style:none;height: 20px;" placeholder="Cari disini..."></a>
					<a class="btn box-poly-kotak2 pull-right" style="padding: 5 10 10 10;"><input type="text" class="form-control" id="cari_kode" placeholder="Barcode..." style="width:250px;border-style:none;height: 20px;"></a>
				<?php } ?>


				<div id="state" style="display:none;padding-left:10px;padding-top:20px;"></div>
				<div id="tempat_search" style="display:none;padding-left:10px;padding-top:20px;"></div>

			</div>


			<!-- </div> -->
			<!-- buffer var -->
			<input type="hidden" class="form-control" id="tambahkan_id">
			<input type="hidden" class="form-control" id="tambahkan_kode">
			<input type="hidden" class="form-control" id="tambahkan_nama">
			<input type="hidden" class="form-control" id="tambahkan_jumlah">
			<input type="hidden" class="form-control" id="tambahkan_harga">
			<input type="hidden" class="form-control" id="tambahkan_diskon">
			<input type="hidden" class="form-control" id="tambahkan_total">
			<input type="hidden" class="form-control" id="tambahkan_ket">
			<input type="hidden" class="form-control" id="tambahkan_kd_promo">
			<input type="hidden" class="form-control" id="tambahkan_harga_dasar">

			<input type="hidden" class="form-control" id="tambahkan_noseri">
			<input type="hidden" class="form-control" id="tambahkan_nilai">
			<input type="hidden" class="form-control" id="tambahkan_terbit">
			<input type="hidden" class="form-control" id="tambahkan_daluarsa">

		</div>

	</div>

</div>