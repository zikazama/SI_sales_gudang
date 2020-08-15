<script>
    $(document).ready(function(){
        // $('#pembayaran').keyup(function(e){
        //     e.preventDefault();
        //     let pembayaran = $(this).val();
        //     let harus_dibayar = parseInt($('#harus_dibayar').attr('data-nilai'));
        //     if(pembayaran > harus_dibayar){
        //         alert('Jumlah pembayaran melebihi jumlah yang harus dibayar');
        //         $(this).val(0);
        //     }
        // });
        $('#pembayaran').keyup(function(e){
        e.preventDefault();
        let pembayaran = priceAsFloat($(this).val());
        let harus_dibayar = priceAsFloat($('#harus_dibayar').attr('data-nilai'));
        //console.log(pembayaran > harus_dibayar);
        if(pembayaran > harus_dibayar){
            alert('Pembayaran Melebihi Total yang harus dibayar');
            $(this).val(0);
        }
    });
    });
</script>