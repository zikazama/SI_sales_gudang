<script>
$(document).ready(function(e){
    $('#potongan').keyup(function(e){
        let potongan = priceAsFloat($('#potongan').val());
        let totalSetoran = priceAsFloat($('#totalSetoran').val());
        let total = totalSetoran - potongan;
        $('#totalMasuk').val(total);
    });
});
</script>