<script>
    $(document).ready(function() {
        $('#getLocation').click(function(e) {
            e.preventDefault();
            function setPosition(position){
                $('#latitude').val(position.coords.latitude);
                $('#longitude').val(position.coords.longitude);
            }
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(setPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        });
    });
</script>