<!-- Standard modal -->
<div id="nuevoAcceso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="nuevoAccesoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nuevoAccesoLabel">Registrar Acceso</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" id="bodyNuevoAcceso">
                <!-- Single Select -->
                <div class="accordion" id="accordionExample">
                    <div class="card mb-0">
                        <div class="card-header" style="background-color:#313a46;" id="headingOne">
                            <h5 class="m-0">
                                <a style="color:#fff;" class="custom-accordion-title d-block pt-2 pb-2" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Información de Acceso
                                </a>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Central <span class="badge badge-danger-lighten">Obligatorio</span></label>
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
                                    <label class="form-label">Zona <span class="badge badge-danger-lighten">Obligatorio</span></label>
                                    <div class="input-group">
                                        <select id="na_zona" disabled class="form-control select2" data-toggle="select2">
                                            <option selected disabled value="">Seleccione una opción</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sitio <span class="badge badge-danger-lighten">Obligatorio</span></label>
                                    <div class="input-group">
                                        <select id="na_sitio" disabled class="form-control select2" data-toggle="select2">
                                            <option selected disabled value="">Seleccione una opción</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="empresa" placeholder="Empresa" />
                                    <label for="empresa">Empresa <span class="badge badge-danger-lighten">Obligatorio</span></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="actividad" class="form-control" id="actividad" placeholder="Actividad" />
                                    <label for="actividad">Actividad <span class="badge badge-danger-lighten">Obligatorio</span></label>
                                </div>
                                <div class="form-floating row">
                                    <div class="col-md-6">
                                        <label for="example-time" class="form-label">Hora de Ingreso <span class="badge badge-danger-lighten">Obligatorio</span></label>
                                        <input class="form-control" id="hora_ingreso" type="time" name="time" value="<?= date('h:i') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="example-time" class="form-label">Hora de Salida </label>
                                        <input class="form-control" id="hora_salida" type="time" name="time">
                                    </div>
                                </div>
                                <br>
                                <div class="form-floating mb-3">
                                    <input type="proveedor" class="form-control" id="proveedor" placeholder="proveedor" />
                                    <label for="proveedor">Nombre del proveedor <span class="badge badge-danger-lighten">Obligatorio</span></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="ayudantes" class="form-control" id="ayudantes" placeholder="ayudantes" />
                                    <label for="ayudantes">Acompañantes del proveedor <span class="badge badge-danger-lighten">Obligatorio</span></label>
                                </div>
                                <div>
                                    <label class="form-label">Comentarios</label>
                                    <p class="text-muted font-13"></p>
                                    <textarea id="comentarios" name="comentarios" data-toggle="maxlength" class="form-control" maxlength="550" rows="4" placeholder="Dispone de un total de 550 caracteres."></textarea>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-0">
                        <div class="card-header" style="background-color:#313a46;" id="headingTwo">
                            <h5 class="m-0">
                                <a style="color:#fff;" class="custom-accordion-title collapsed d-block pt-2 pb-2" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Información del Sitio
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="card-body">
                                <!-- Single Select -->
                                <div class="mb-3" id="div_info_sitio" style="display:none">
                                    <label class="form-label">Información del Sitio</label>
                                    <div class="col-md-12">
                                        <div class="card" style="background-color: rgba(117, 170, 255, 0.2);">
                                            <div class="card-header" style="background-color: rgba(117, 170, 255, 0.6); color:white;">
                                                Gabinetes
                                                <button disabled title="Agregar Gabinete" type="button" class="btn btn-success btn-sm btnAddGabinete" data-bs-toggle="modal" data-bs-target="#newGabinete"><i class="mdi mdi-tray-plus"></i></button>
                                            </div>
                                            <div class="card-body">
                                                <blockquote class="card-bodyquote">
                                                    <div class="row" id="div_gabinetes">

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
                                                    <div class="row">
                                                        <?php foreach ($getPuertasDeAcceso as $puertas_acceso) : ?>
                                                            <div class="mt-3">
                                                                <label class="form-label"><?= $puertas_acceso->descripcion ?></label>
                                                                <?php foreach ($getTiposCerraduraPA as $lock_types) : ?>
                                                                    <div class="form-check">
                                                                        <input type="radio" data-id-puertas-acceso="<?= $puertas_acceso->id_puertas_de_acceso ?>" id="acc<?= $lock_types->id_tipos_cerraduras ?>_group<?= $puertas_acceso->id_puertas_de_acceso ?>" name="acceso<?= $puertas_acceso->id_puertas_de_acceso ?>" value="<?= $lock_types->id_tipos_cerraduras ?>" class="form-check-input">
                                                                        <label class="form-check-label" for="acc<?= $lock_types->id_tipos_cerraduras ?>_group<?= $puertas_acceso->id_puertas_de_acceso ?>"><?= $lock_types->descripcion ?></label>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endforeach; ?>
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
                                                                <input class="breaker_principal" type="checkbox" id="chk_breaker_principal" checked data-switch="bool" />
                                                                <label for="chk_breaker_principal" data-on-label="Si" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <label class="form-label">¿Cuenta con planta de emergencia?</label>
                                                            <div class="form-check">
                                                                <input class="planta_emergencia" type="checkbox" id="chk_planta_emergencia" checked data-switch="bool" />
                                                                <label for="chk_planta_emergencia" data-on-label="Si" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <label class="form-label">Atterizajes</label>
                                                            <div class="form-check">
                                                                <h5>Torre</h5>
                                                                <input class="at_torre" type="checkbox" id="chk_att_torre" checked data-switch="warning" />
                                                                <label for="chk_att_torre" data-on-label="Si" data-off-label="No"></label>
                                                            </div>
                                                            <div class="form-check">
                                                                <h5>Centro de Carga</h5>
                                                                <input class="at_centro_carga" type="checkbox" id="chk_at_centro_carga" checked data-switch="warning" />
                                                                <label for="chk_at_centro_carga" data-on-label="Si" data-off-label="No"></label>
                                                            </div>
                                                            <div class="form-check">
                                                                <h5>Escalerilla</h5>
                                                                <input class="at_escalerilla" type="checkbox" id="chk_escalerilla" checked data-switch="warning" />
                                                                <label for="chk_escalerilla" data-on-label="Si" data-off-label="No"></label>
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
                                    <!-- <div class="col-md-12">
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
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="card" style="background-color: rgba(255, 64, 64, 0.2);">
                                            <div class="card-header" style="background-color: rgba(255, 64, 64, 0.6); color:white;">
                                                Vandalismo
                                            </div>
                                            <div class="card-body">
                                                <blockquote class="card-bodyquote">
                                                    <div class="row" id="div_gabinetes">
                                                        <div class="mt-3">
                                                            <label class="form-label">¿El sitio está vandalizado? </label>
                                                            <div class="form-check">
                                                                <input class="vandalismo" type="checkbox" id="chk_vandalismo" checked data-switch="danger" />
                                                                <label for="chk_vandalismo" data-on-label="Si" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </blockquote>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card" style="background-color: rgba(179, 109, 71, 0.2);">
                                            <div class="card-header" style="background-color: rgba(179, 109, 71, 0.6); color:white;">
                                                Estructura y Limpieza
                                            </div>
                                            <div class="card-body">
                                                <blockquote class="card-bodyquote">
                                                    <div class="row" id="div_gabinetes">
                                                        <div class="mt-3">
                                                            <label class="form-label">Limpieza del sitio </label>
                                                            <p id="txt_limpieza"></p>
                                                            <div class="form-check">
                                                                <select id="na_limpieza" class="form-control select2" data-toggle="select2">
                                                                    <option selected disabled value="">Seleccione una opción</option>
                                                                    <?php foreach ($getStatusLimpieza as $statusLimpieza) : ?>
                                                                        <option value="<?= $statusLimpieza->id_tipos_limpieza ?>"><?= $statusLimpieza->descripcion ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <label class="form-label">Perímetro del sitio </label>
                                                            <p id="txt_perimetro"></p>
                                                            <div class="form-check">
                                                                <select id="na_perimetro" class="form-control select2" data-toggle="select2">
                                                                    <option selected disabled value="">Seleccione una opción</option>
                                                                    <?php foreach ($getPerimetros as $perimetro) : ?>
                                                                        <option value="<?= $perimetro->id_tipo_perimetro ?>"><?= $perimetro->descripcion ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </blockquote>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card mb-0">
                        <div class="card-header" style="background-color:#313a46;" id="headingThree">
                            <h5 class="m-0">
                                <a style="color:#fff;" class="custom-accordion-title collapsed d-block pt-2 pb-2" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Información Adicional del Proveedor
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <label class="form-label file_label">Fotografía / Identificación del proveedor  <span class="badge badge-danger-lighten">Obligatorio</span></label>
                                    <input class="form-control" type="file" id="fotografia_proveedor">
                                </div>
                                <br>
                                <div class="col-sm-12">
                                    <label class="form-label">Firma del proveedor  <span class="badge badge-danger-lighten">Obligatorio</span></label>
                                    <?php include 'firmaCanvas.php'; ?>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary bntGuardarAcceso">Guardar Acceso</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->