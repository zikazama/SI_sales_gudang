<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- <script src="
https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script> -->

<script>
    $(document).ready(function() {
        $('#zero-conf3').DataTable({
            "lengthChange": false,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },],
            "order": [[ 0, "desc" ]]
        });

        $('#periode').change(function(){
            let periode = $(this).val();
            window.location.replace('<?= base_url() ?>'+'admin/laporan_penjualan/'+periode);
        });
    });
</script>