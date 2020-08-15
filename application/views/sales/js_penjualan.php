<script>
	// $(document).on('change','#namaBarang', function () {
	// 	let idBarang = $('#namaBarang').val();
	// 	alert(idBarang);
	// });
    function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function getBarang(){
        // $.post('<?= base_url('ajax/get_cart') ?>',function(data){
        //     let isi = $.parseJSON(data);
        //     console.log(isi);
        // });
    }

	$('#namaBarang').on('select2:select', function (e) {
		var data = e.params.data;
		$.post('<?= base_url('ajax/get_barang') ?>',{id_barang:data.id},function(data){
            let isi = $.parseJSON(data);
            $('#harga').val(formatRupiah(isi[0].harga, ''));
            $('#kuantitas').prop("readonly", false);
            $('#kuantitas').val(0);
            $('#subtotal').val('Rp. 0');
            $('#diskon').val('Rp. 0');
            $('#total').val('Rp. 0');
        });
	});
    $('#kuantitas').keyup(function(){
        let idBarang = $('#namaBarang').val();
        let harga = priceAsFloat($('#harga').val());
        let kuantitas = $(this).val();
        var diskon;
        $.post('<?= base_url('ajax/get_barang') ?>',{id_barang:idBarang},function(data){
            let isi = $.parseJSON(data);
            console.log(parseInt(isi[0].minimal_kuantitas_diskon));
            if(parseInt(kuantitas) >= parseInt(isi[0].minimal_kuantitas_diskon)){
                if(parseInt(isi[0].minimal_kuantitas_diskon) != 0) {
                var strata = parseInt(kuantitas) / parseInt(isi[0].minimal_kuantitas_diskon);
                } else {
                var strata = 0;
                } 
                let diskonInput = isi[0].diskon * strata; 
                $('#diskon').val(formatRupiah(diskonInput.toString(),''));
                diskon = isi[0].diskon;
            } else {
                $('#diskon').val(formatRupiah('0',''));
                diskon = 0;
            }
            $('#subtotal').val(formatRupiah((harga*kuantitas).toString(),''));
            $('#total').val(formatRupiah(((harga*kuantitas)-diskon).toString(),''));
        });
    });
	$('#tambahBarang').click(function (e) {
		e.preventDefault();
        let idBarang = $('#namaBarang').val();
        let kuantitas = priceAsFloat($('#kuantitas').val());
        let harga = priceAsFloat($('#harga').val());
        let nama = $( "#namaBarang option:selected" ).text();
        $.post('<?= base_url('ajax/tambah_barang') ?>',{
            idBarang : idBarang,
            kuantitas : kuantitas,
            harga : harga,
            nama : nama
        },function(data){
            //console.log(data);
            location.reload();
        });
	});

    $('.hapus').click(function(e){
        e.preventDefault();
        let rowid = $(this).attr('data-id');
        $.post('<?= base_url('ajax/remove_cart/') ?>'+rowid,function(data){
            
            location.reload();
        });
    });

    $('#pembayaran').keyup(function(e){
        e.preventDefault();
        let pembayaran = priceAsFloat($(this).val());
        let harus_dibayar = priceAsFloat($('#harus_dibayar').val());
        //console.log(pembayaran > harus_dibayar);
        if(pembayaran > harus_dibayar){
            alert('Pembayaran Melebihi Total yang harus dibayar');
            $(this).val(0);
        }
    });


</script>
