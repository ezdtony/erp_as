<?php
$getCentrales = $accesos->getAllCentral();
$getTiposCerradura = $accesos->getAllLockTypes();
$getTipoPerimetro = $accesos->getAllPerimeterTypes();
$getEstados = $accesos->getAllStates();
?>

<!-- Static Backdrop modal -->
<div class="modal fade" id="nuevoSitio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="nuevoSitioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="nuevoSitioLabel">Registrar Nuevo Sitio</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <h3>Información General</h3>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="numero_sitio_astelecom" placeholder="Número de sitio (Opcional)" />
                            <label for="numero_sitio_astelecom">Número de sitio (Opcional)</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <!--  <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nombre_sitio" placeholder="Nombre de sitio" />
                            <label for="nombre_sitio">Nombre de sitio</label>
                        </div> -->
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="codigo_sitio" placeholder="Código de sitio" />
                            <label for="codigo_sitio">Código de sitio *</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nombre_sitio" placeholder="Nombre de sitio *" />
                            <label for="nombre_sitio">Nombre de sitio *</label>
                        </div>
                    </div>


                    <!-- Inline-->
                    <h5>Tipo de sitio *</h5>
                    <div class="mt-2">
                        <div class="form-check form-check-inline">
                            <input type="radio" value="1" id="radio_indoor" name="tipo_sitio" class="form-check-input">
                            <label class="form-check-label" for="radio_indoor">Indoor</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" value="2" id="radio_outdoor" name="tipo_sitio" class="form-check-input">
                            <label class="form-check-label" for="radio_outdoor">Outdoor</label>
                        </div>
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-md">
                            <h5>Zona *</h5>
                            <div class="form-floating mb-3">
                                <select class="form-select mb-3" id="id_central">
                                    <option value="" selected disabled>Elija una zona *</option>
                                    <?php foreach ($getCentrales as $centrales) : ?>
                                        <option value="<?= $centrales->id_centrales ?>"><?= ($centrales->nombre_central) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <h5>Central *</h5>
                            <div class="form-floating mb-3">
                                <select class="form-select mb-3" id="id_zona" disabled>
                                    <option value="" selected disabled>Elija una central *</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md">
                            <h5>Tipo de cerradura *</h5>
                            <div class="form-floating mb-3">
                                <select class="form-select mb-3" id="tipo_cerradura">
                                    <option value="" selected disabled>Tipo de cerradura *</option>
                                    <?php foreach ($getTiposCerradura as $cerradura) : ?>
                                        <option value="<?= $cerradura->id_tipos_cerraduras ?>"><?= ($cerradura->descripcion) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <h5>Tipo de perímetro *</h5>
                            <div class="form-floating mb-3">
                                <select class="form-select mb-3" id="tipo_perimetro">
                                    <option value="" selected disabled>Tipo de perímetro *</option>
                                    <?php foreach ($getTipoPerimetro as $perimetro) : ?>
                                        <option value="<?= $perimetro->id_tipo_perimetro ?>"><?= ($perimetro->descripcion) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h3>Dirección del Sitio</h3>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="calle_sitio" placeholder="Calle *" />
                                <label for="calle_sitio">Calle *</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="calle_numero_sitio" placeholder="Número de calle" />
                                <label for="calle_numero_sitio">Número de calle</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="sitio_colonia" placeholder="Colonia *" />
                                <label for="sitio_colonia">Colonia *</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="sitio_zipcode" placeholder="Código Postal *" />
                                <label for="sitio_zipcode">Código Postal *</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md">
                            <h5>Estado *</h5>
                            <div class="form-floating mb-3">
                                <select class="form-control select2" data-toggle="select2" id="estado_sitio">
                                    <option value="" selected disabled>Elija un estado *</option>
                                    <?php foreach ($getEstados as $estados) : ?>
                                        <option value="<?= $estados->id ?>"><?= ($estados->estado) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <h5>Municipio *</h5>
                            <div class="form-floating mb-3">
                                <select class="form-control select2" data-toggle="select2" id="municipio_sitio" disabled>
                                    <option value="" selected disabled>Elija un municipio *</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="latitud_sitio" placeholder="Latitud (Opcional)" />
                                <label for="latitud_sitio">Latitud (Opcional)</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="longitud_sitio" placeholder="Longitud (Opcional)" />
                                <label for="longitud_sitio">Longitud (Opcional)</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Referencias</label>
                        <p class="text-muted font-13">
                            Ingrese algunas referencias acerca del sitio
                        </p>
                        <textarea id="referencias_sitio" data-toggle="maxlength" class="form-control" maxlength="225" rows="3" placeholder="Ingrese algunas referencias acerca del sitio (255 caractéres)."></textarea>
                    </div>

                    <h5>Es un sitio con propietario?</h5>
                    <!-- Success Switch-->
                    <input type="checkbox" id="check_propietario" checked data-switch="success" />
                    <label for="check_propietario" data-on-label="Si" data-off-label="No"></label>
                    <br>



                    <div id="div_info_propietario">
                        <h3>Información de Propietario</h3>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombre_propietario" placeholder="Nombre de propietario" />
                                    <label for="nombre_propietario">Nombre de propietario *</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="apellidos_propietario" placeholder="Apellidos de propietario" />
                                    <label for="apellidos_propietario">Apellidos de propietario *</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="telefono_prop_1" placeholder="Número de teléfono" />
                                    <label for="telefono_prop_1">Número de teléfono *</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="numero_prop_2" placeholder="Otro número de teléfono" />
                                    <label for="numero_prop_2">Otro número de teléfono</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mail_propietario" placeholder="Correo electrónico" />
                                    <label for="mail_propietario">Correo electrónico</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <!--  <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="numero_prop_2" placeholder="Otro número de teléfono" />
                                    <label for="numero_prop_2">Otro número de teléfono</label>
                                </div> -->
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="guardarNuevoSitio" class="btn btn-primary">Guardar Sitio</button>
            </div> <!-- end modal footer -->
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->