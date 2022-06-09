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
                <div id="div_info"></div>
                <div>
                    <div class="accordion custom-accordion" id="custom-accordion-one">
                        <div class="card mb-0">
                            <div class="card-header" id="headingFour">
                                <h5 class="m-0">
                                    <a class="custom-accordion-title d-block py-1" data-bs-toggle="collapse" href="#accordionGabinetes" aria-expanded="false" aria-controls="accordionGabinetes">
                                        Gabinetes <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                    </a>
                                </h5>
                            </div>

                            <div id="accordionGabinetes" class="collapse show" aria-labelledby="headingFour" data-bs-parent="#custom-accordion-one">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="mb-4">Gabinetes del Sitio</h4>

                                        </div> <!-- end col -->
                                        <div class="col-4">
                                            <button type="button" class="btn btn-success"><i class="dripicons-plus"></i> </button>
                                        </div>
                                    </div>
                                    <div class="row" id="div_gabinetes">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-0">
                            <div class="card-header" id="headingFive">
                                <h5 class="m-0">
                                    <a class="custom-accordion-title collapsed d-block py-1" data-bs-toggle="collapse" href="#accordionInfoPropietario" aria-expanded="false" aria-controls="accordionInfoPropietario">
                                        Información de Contacto (Propietario) <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                    </a>
                                </h5>
                            </div>
                            <div id="accordionInfoPropietario" class="collapse" aria-labelledby="headingFive" data-bs-parent="#custom-accordion-one">
                                <div class="card-body">
                                    <div class="col-xxl-3 col-xl-6 order-xl-1 order-xxl-2">
                                        <div class="card">
                                            <div class="card-body" id="div_contacto_propietario">
                                                <!--  <div class="dropdown float-end">
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        
                                                        <a href="javascript:void(0);" class="dropdown-item">View full</a>
                                                        
                                                        <a href="javascript:void(0);" class="dropdown-item">Edit Contact Info</a>
                                                        
                                                        <a href="javascript:void(0);" class="dropdown-item">Remove</a>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="mt-3 text-center">
                                                    <img src="assets/images/users/avatar-5.jpg" alt="shreyu" class="img-thumbnail avatar-lg rounded-circle">
                                                    <h4>Shreyu N</h4>
                                                    <button class="btn btn-primary btn-sm mt-1"><i class="uil uil-envelope-add me-1"></i>Send Email</button>
                                                    <p class="text-muted mt-2 font-14">Last Interacted: <strong>Few hours back</strong></p>
                                                </div> -->

                                               
                                            </div> <!-- end card-body -->
                                        </div> <!-- end card-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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