<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="module" src="./index.js"></script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwMuHhEQa2WFjFFEeABIY13-77iSJPvZc&callback=initMap"></script>
<style>
    #map {
        height: 100%;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>

<div id="infoSitio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="infoSitioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="infoSitioLabel">Información del Sitio</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h2 id="siteName"></h2>
                <div id="div_info">
                    <h4>DIRECCION</h4>
                    <br>
                    <button class="btn btn-primary ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#divMapa" aria-expanded="false" aria-controls="divMapa">
                        Ver mapa...
                    </button>

                    <div class="collapse" id="disvMapa">
                        <div class="card card-body mb-0">
                            <div id="map"></div>
                        </div>
                    </div>
                    <br>
                    <h5>Central: Ecatepec</h5>
                    <h6>Zona: Malinche</h6>


                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    const mapDiv = document.getElementById('map');
    let map;

    function initMap() {
        map = new google.maps.Map(mapDiv, {
            center: {
                lat: 19.30194535320762,
                lng: -99.15102021443198
            },
            zoom: 15
        });
         
    }
</script>