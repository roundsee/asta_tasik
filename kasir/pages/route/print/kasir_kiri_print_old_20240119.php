<div class="col-lg-5 bg-white" style="height: 85px!important;min-height: 65px!important;">

	<!-- wrapper 1 -->
	<div class="wrapper bg-white">
		<div class="row">

			<div class="col-lg-4">
				<a href="#"><img src="<?php echo $dir; ?>images/steak_outline_shadow_clear.png" style="width: 150px"></a>
			</div>

			<div class="col-lg-2">
				<a href="main.php?route=profile"><img src="<?php echo $dir; ?>images/staff/<?php echo $photo; ?>" style="height: 50px"></a>
			</div>

		</div>
	</div>
	<!-- end wrapper 1-->

	<div class="wrapper box-poly">
		<div class="row" style="padding-right:10px;padding-left: 10px;padding-top: 20px;">

			<div class="col-lg-12">
				<div class="form-group">
					No Faktur :
					<a class="btn box-poly-kotak2 " style="padding: 5 10 15 15;"><input type="text" name="no_faktur" class="form-control" id="search_menu" style="width:190px;border-style:none;height: 20px;" placeholder="Cari disini..."></a>
				</div>
			</div>
		</div>
		<div class="row" style="padding-right:10px;padding-left: 10px;padding-top: 20px;padding-bottom: 20px;">

			<div class="col-lg-6">
				<div class="form-group">
					<button type="button" class="btn-default btn tombol1" id="resetTransaction" onClick="document.location.reload()" style="background-color: red;color: ghostwhite;opacity: .7;"><i class="fa fa-refresh"></i> Reset</button>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="form-group">
					<div class="form-group">
						<button type="button" class="btn btn-success tombol1 pull-right tombol-print" id="tombol-print" style="display:none"><i class="fa fa-print"></i><strong style="color: whitesmoke!important;opacity: .7;"> PRINT</strong></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<button type="button" class="btn-default btn tombol1" onClick="goBack()" style="padding-left: 9px;padding-right: 9px;background-color: red;color: white;;opacity: .7;"><i class="fa fa-toggle-left"></i> BACK</button>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<a href="../../logout.php" class="btn-default btn tombol1 pull-right" style="padding-left: 9px;padding-right: 9px;background-color: red;color: white;opacity: .7;"><i class="fa fa-sign-out"></i> LOG OUT</a>
			</div>
		</div>

	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		$('#tombolBuatTransaksi').attr('disabled', 'disabled');
		// $("#tombolBuatTransaksi").hide();
		$("#tombolPayment").attr('disabled', 'disabled');
		$('#state').on('change', function() {
			var stateID = $(this).val();
			if (stateID) {
				$.ajax({
					type: 'POST',
					url: 'route/data_kasir/ajax2.php',
					data: 'state_id=' + stateID,
					success: function(html) {
						$('#city').html(html);
					}
				});
			} else {
				$('#city').html('<option value="">Select state first</option>');
			}
		});
	});


	$(".tombol-print").click(function() {

		$("#tombol-print").attr('disabled', 'disabled');
		var search_menu = $("#search_menu").val();
		console.log(search_menu);
		var x11 = document.getElementById("print");
		x11.style.display = "block";
		$('#print').load("route/print/cetak.php?id=" + search_menu);
	});
	var searchMenuValue = localStorage.getItem('search_menu_value');
	if (searchMenuValue) {
		document.getElementById('search_menu').value = searchMenuValue;
		$.ajax({
			url: "route/print/ajax_data_print.php",
			method: "POST",
			data: {
				search: searchMenuValue
			},
			success: function(data) {
				$('#tempat_search').html(data);
			}
		});
	}
</script>


<script type="text/javascript">
	function reloadpage() {
		location.reload()
	}

	function clear_form_kanan() {
		var state = document.getElementById('state');
		state.style.display = 'none';
		var tempat_search = document.getElementById('tempat_search');
		tempat_search.style.display = 'none';
	}

	function clear_form_search() {
		var search_menu = document.getElementById('search_menu');
		search_menu.value = '';
	}

	function show_all() {
		console.log("masuk show All");
		clear_form_kanan();
		clear_form_search();

		var state = document.getElementById('state');
		state.style.display = 'block';

	};

	function show_ket() {
		var ket = document.getElementById("form_ket");
		ket.style.display = 'block';
	}

	function hide_ket() {
		var ket = document.getElementById("form_ket");
		ket.style.display = 'none';
	}
</script>

<script>
	function goBack() {
		window.history.back();
	}
</script>

<script type="text/javascript">
	function hide_print() {
		var print_btn = document.getElementById("tombol-print");
		print_btn.style.display = 'none';
	}

	function show_print() {
		var print_btn = document.getElementById("tombol-print");
		print_btn.style.display = 'block';
	}
</script>