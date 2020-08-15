<!-- Javascripts -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap/popper.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/blockui/jquery.blockUI.js"></script>
<script src="<?= base_url() ?>assets/plugins/flot/jquery.flot.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/flot/jquery.flot.symbol.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/DataTables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/connect.min.js"></script>
<script src="<?= base_url() ?>assets/js/pages/dashboard.js"></script>

<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url() ?>assets/js/pages/select2.js"></script>
<script src="<?= base_url() ?>assets/js/pages/datatables.js"></script>
<script>
	function formatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, "").toString(),
			split = number_string.split(","),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? "." : "";
			rupiah += separator + ribuan.join(".");
		}

		rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
		return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
	}

	var priceAsFloat = function(price) {
		return parseFloat(price.replace(/\./g, '').replace(/,/g, '.').replace(/[^\d\.]/g, ''));
	}

	function rupiah(e) {
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		e.value = formatRupiah(e.value, "");
	};

	$('#zero-conf').DataTable({
		"lengthChange": false,
		"order": [
			[0, "desc"]
		]
	});
	$('#zero-conf2').DataTable({
		"lengthChange": false,
		"order": [
			[0, "desc"]
		]
	});
</script>