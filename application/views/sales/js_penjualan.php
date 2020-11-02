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
            $('#harga_perbox').val(formatRupiah(isi[0].harga_perbox, ''));
            $('#kuantitas').prop("readonly", false);
            $('#kuantitas').val(0);
            $('#kuantitas_perbox').prop("readonly", false);
            $('#kuantitas_perbox').val(0);
            $('#subtotal').val('Rp. 0');
            $('#diskon').val('Rp. 0');
            $('#total').val('Rp. 0');
        });
	});
    $('#kuantitas').keyup(function(){
        let idBarang = $('#namaBarang').val();
        let harga = priceAsFloat($('#harga').val());
        let harga_perbox = priceAsFloat($('#harga_perbox').val());
        let kuantitas = $(this).val();
        let kuantitas_perbox = $('#kuantitas_perbox').val();
        var diskon;
        var diskon_perbox;
        $.post('<?= base_url('ajax/get_barang') ?>',{id_barang:idBarang},function(data){
            let isi = $.parseJSON(data);
            //console.log(parseInt(isi[0].minimal_kuantitas_diskon));
            if(parseInt(kuantitas) >= parseInt(isi[0].minimal_kuantitas_diskon)){
                if(parseInt(isi[0].minimal_kuantitas_diskon) != 0) {
                var strata = parseInt(kuantitas);
                } else {
                var strata = 0;
                }
                //strata = Math.floor(strata); 
                let diskonInput = isi[0].diskon * strata; 
                $('#diskon').val(formatRupiah(diskonInput.toString(),''));
                diskon = isi[0].diskon;
            } else {
                $('#diskon').val(formatRupiah('0',''));
                diskon = 0;
            }
            if(parseInt(kuantitas_perbox) >= parseInt(isi[0].minimal_kuantitas_diskon_perbox)){
                if(parseInt(isi[0].minimal_kuantitas_diskon_perbox) != 0) {
                var strata_perbox = parseInt(kuantitas_perbox);
                } else {
                var strata_perbox = 0;
                } 
                //strata_perbox = Math.floor(strata_perbox);
                console.log(strata_perbox);
                let diskonInput_perbox = isi[0].diskon_perbox * strata_perbox; 
                $('#diskon_perbox').val(formatRupiah(diskonInput_perbox.toString(),''));
                diskon_perbox = isi[0].diskon_perbox;
            } else {
                $('#diskon_perbox').val(formatRupiah('0',''));
                diskon_perbox = 0;
            }
            $('#subtotal').val(formatRupiah(((harga*kuantitas)+(harga_perbox*kuantitas_perbox)).toString(),''));
            $('#total').val(formatRupiah((((harga*kuantitas)-diskon*kuantitas)+((harga_perbox*kuantitas_perbox)-diskon_perbox*kuantitas_perbox)).toString(),''));
        });
    });
    $('#kuantitas_perbox').keyup(function(){
        let idBarang = $('#namaBarang').val();
        let harga = priceAsFloat($('#harga').val());
        let harga_perbox = priceAsFloat($('#harga_perbox').val());
        let kuantitas = $('#kuantitas').val();
        let kuantitas_perbox = $(this).val();
        var diskon;
        var diskon_perbox;
        $.post('<?= base_url('ajax/get_barang') ?>',{id_barang:idBarang},function(data){
            let isi = $.parseJSON(data);
            //console.log(parseInt(isi[0].minimal_kuantitas_diskon));
            if(parseInt(kuantitas) >= parseInt(isi[0].minimal_kuantitas_diskon)){
                if(parseInt(isi[0].minimal_kuantitas_diskon) != 0) {
                var strata = parseInt(kuantitas);
                } else {
                var strata = 0;
                }
                //strata = Math.floor(strata); 
                let diskonInput = isi[0].diskon * strata; 
                $('#diskon').val(formatRupiah(diskonInput.toString(),''));
                diskon = isi[0].diskon;
            } else {
                $('#diskon').val(formatRupiah('0',''));
                diskon = 0;
            }
            if(parseInt(kuantitas_perbox) >= parseInt(isi[0].minimal_kuantitas_diskon_perbox)){
                if(parseInt(isi[0].minimal_kuantitas_diskon_perbox) != 0) {
                var strata_perbox = parseInt(kuantitas_perbox);
                } else {
                var strata_perbox = 0;
                } 
                //strata_perbox = Math.floor(strata_perbox);
                console.log(strata_perbox);
                let diskonInput_perbox = isi[0].diskon_perbox * strata_perbox; 
                $('#diskon_perbox').val(formatRupiah(diskonInput_perbox.toString(),''));
                diskon_perbox = isi[0].diskon_perbox;
            } else {
                $('#diskon_perbox').val(formatRupiah('0',''));
                diskon_perbox = 0;
            }
            $('#subtotal').val(formatRupiah(((harga*kuantitas)+(harga_perbox*kuantitas_perbox)).toString(),''));
            $('#total').val(formatRupiah((((harga*kuantitas)-diskon*kuantitas)+((harga_perbox*kuantitas_perbox)-diskon_perbox*kuantitas_perbox)).toString(),''));
        });
    });
	$('#tambahBarang').click(function (e) {
		e.preventDefault();
        let idBarang = $('#namaBarang').val();
        let kuantitas = priceAsFloat($('#kuantitas').val());
        let kuantitas_perbox = priceAsFloat($('#kuantitas_perbox').val());
        let harga = priceAsFloat($('#harga').val());
        let harga_perbox = priceAsFloat($('#harga_perbox').val());
        let nama = $( "#namaBarang option:selected" ).text();
        $.post('<?= base_url('ajax/tambah_barang') ?>',{
            idBarang : idBarang,
            kuantitas : kuantitas,
            kuantitas_perbox : kuantitas_perbox,
            harga : harga,
            harga_perbox : harga_perbox,
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
