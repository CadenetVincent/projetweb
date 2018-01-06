    <section id="presentation" class="content-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2>Bienvenue sur le site évenementiel du FC Sochaux</h2>
                    <p>Ici vous pouvez vous inscrire au prochains matchs disputés par le FC Sochaux à domicile</p>
                </div>
            </div>
        </div>
    </section>

    <section id="presentation" class="content-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2>Bienvenue sur le site évenementiel du FC Sochaux</h2>
                    <p>Ici vous pouvez vous inscrire au prochains matchs disputés par le FC Sochaux à domicile</p>
                </div>
            </div>
        </div>
    </section>

    <section id="presentation" class="content-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2>Bienvenue sur le site évenementiel du FC Sochaux</h2>
                    <p>Ici vous pouvez vous inscrire au prochains matchs disputés par le FC Sochaux à domicile</p>
                </div>
            </div>
        </div>
    </section>


    <div id="googleMap" style="height:300px;width:100%"></div>

    <script>
        function myMap() {
            var myCenter = new google.maps.LatLng(47.512417, 6.8112);
            var mapProp = {
                center: myCenter,
                zoom: 16,
                scrollwheel: false,
                draggable: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var marker = new google.maps.Marker({position: myCenter});
            marker.setMap(map);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-c-VoqcO--Y64rlYpCddZsTqPvH96GFU&callback=myMap"></script>
    <!--
    To use this code on your website, get a free API key from Google.
    Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
    -->