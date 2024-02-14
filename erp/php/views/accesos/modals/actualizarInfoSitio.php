<!-- Standard modal -->
<div id="informacionSitio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="informacionSitioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="informacionSitioLabel">Registrar Acceso</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" id="bodyinformacionSitio">
                <!-- Single Select -->
                <div class="mb-3">
                    <label class="form-label">Central</label>
                    <div class="input-group">
                        <select id="na_central" class="form-control select2" data-toggle="select2">
                            <option selected disabled value="">Seleccione una opción</option>
                            <?php foreach ($allCentrales as $central) : ?>
                                <option value="<?= $central->id_centrales ?>"><?= $central->nombre_central ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Zona</label>
                    <div class="input-group">
                        <select id="na_zona" disabled class="form-control select2" data-toggle="select2">
                            <option selected disabled value="">Seleccione una opción</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sitio</label>
                    <div class="input-group">
                        <select id="na_sitio" disabled class="form-control select2" data-toggle="select2">
                            <option selected disabled value="">Seleccione una opción</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Información del Sitio</label>
                    <div class="col-md-12">
                        <div class="card" style="background-color: rgba(117, 170, 255, 0.2);">
                            <div class="card-header" style="background-color: rgba(117, 170, 255, 0.6); color:white;">
                                Gabinetes
                                <button title="Agregar Gabinete" type="button" class="btn btn-success btn-sm"><i class="mdi mdi-tray-plus"></i></button>
                            </div>
                            <div class="card-body">
                                <blockquote class="card-bodyquote">
                                    <div class="row" id="div_gabinetes">
                                        <!-- 
                                            <div class="col-md-6">
                                            <div class="card border-primary border">
                                                <div class="card-body">
                                                    <h5 class="card-title text-primary">Special title treatment</h5>
                                                    <p class="card-text">With supporting text below as a natural lead-in to
                                                        additional content.</p>
                                                    <a href="javascript: void(0);" class="btn btn-primary btn-sm">Button</a>
                                                </div>
                                            </div>
                                        </div>
                                     -->
                                    </div>
                                </blockquote>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                    <div class="col-md-12">
                        <div class="card" style="background-color: rgba(94, 179, 87, 0.2);">
                            <div class="card-header" style="background-color: rgba(94, 179, 87, 0.6); color:white;">
                                Seguridad
                            </div>
                            <div class="card-body">
                                <blockquote class="card-bodyquote">
                                    <div class="row" id="div_gabinetes">
                                        <div class="mt-3">
                                            <label class="form-label">Acceso Principal</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Acceso Vehícular</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Centro de Carga</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Contenedor</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                    </div>
                                </blockquote>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                    <div class="col-md-12">
                        <div class="card" style="background-color: rgba(255, 252, 105, 0.2);">
                            <div class="card-header" style="background-color: rgba(255, 252, 105, 0.6); color:black;">
                                Electricidad
                            </div>
                            <div class="card-body">
                                <blockquote class="card-bodyquote">
                                    <div class="row" id="div_gabinetes">
                                        <div class="mt-3">
                                            <label class="form-label">Breaker Principal</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Atterizajes</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="mt-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="breakers_existentes" placeholder="Breakers existentes" />
                                                <label for="breakers_existentes">Breakers existentes</label>
                                            </div>
                                        </div>
                                    </div>
                                </blockquote>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                    <div class="col-md-12">
                        <div class="card" style="background-color: rgba(240, 146, 58, 0.2);">
                            <div class="card-header" style="background-color: rgba(240, 146, 58, 0.6); color:white;">
                                Información Estructural
                            </div>
                            <div class="card-body">
                                <blockquote class="card-bodyquote">
                                    <div class="row" id="div_gabinetes">
                                        <div class="mt-3">
                                            <label class="form-label">Breaker Principal</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Atterizajes</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="mt-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="breakers_existentes" placeholder="Breakers existentes" />
                                                <label for="breakers_existentes">Breakers existentes</label>
                                            </div>
                                        </div>
                                    </div>
                                </blockquote>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                    <div class="col-md-12">
                        <div class="card" style="background-color: rgba(156, 103, 76, 0.2);">
                            <div class="card-header" style="background-color: rgba(156, 103, 76, 0.6); color:white;">
                                Información Estructural
                            </div>
                            <div class="card-body">
                                <blockquote class="card-bodyquote">
                                    <div class="row" id="div_gabinetes">
                                        <div class="mt-3">
                                            <label class="form-label">Breaker Principal</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Atterizajes</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="mt-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="breakers_existentes" placeholder="Breakers existentes" />
                                                <label for="breakers_existentes">Breakers existentes</label>
                                            </div>
                                        </div>
                                    </div>
                                </blockquote>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                    <div class="col-md-12">
                        <div class="card" style="background-color: rgba(255, 120, 199, 0.2);">
                            <div class="card-header" style="background-color: rgba(255, 120, 199, 0.6); color:white;">
                                Información Estructural
                            </div>
                            <div class="card-body">
                                <blockquote class="card-bodyquote">
                                    <div class="row" id="div_gabinetes">
                                        <div class="mt-3">
                                            <label class="form-label">Breaker Principal</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Atterizajes</label>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio1">Candado</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Tarjeta electrónica</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio3">Llave</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                <label class="form-check-label" for="customRadio2">Candado ATC</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="mt-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="breakers_existentes" placeholder="Breakers existentes" />
                                                <label for="breakers_existentes">Breakers existentes</label>
                                            </div>
                                        </div>
                                    </div>
                                </blockquote>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Información</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->