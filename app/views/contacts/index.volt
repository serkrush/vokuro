<div align="center">

    <div align="left">
        <h2>Golden Team</h2>
    </div>

    <div id="map" style="width: 100%;height: 500px;"></div>
    <script>
        function initMap() {
            var uluru = {lat: 47.85173462, lng: 35.1117238};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBf_q-uNsXGiHw118de34FojS_GQ25AZ5o&callback=initMap">
    </script>

</div>