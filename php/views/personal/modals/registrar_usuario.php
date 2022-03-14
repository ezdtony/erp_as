<!-- Scrollable modal -->
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#registrarUsuario">Scrollable Modal</button>
<div class="modal fade" id="registrarUsuario" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalTitle">Registrar nuevo colaborador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h3>Información General</h3>
                <h5>Ingrese todos los datos requeridos (marcados con asterísco (*) )</h5>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <label for="example-email" class="form-label">Seleccione el área a laborar *</label>
                        <select class="form-control select2" id="id_area" data-toggle="select2">
                            <option value="" selected disabled>Seleccione un área *</option>
                            <optgroup label="Áreas">
                                <?php foreach ($getAllAreas as $area) { ?>
                                    <option value="<?= $area->id_areas ?>"><?= $area->descripcion_area ?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="example-email" class="form-label">Seleccione el puesto *</label>
                        <select disabled class="form-control select2" id="id_area_level" data-toggle="select2">
                            <option value="" selected disabled>Seleccione un puesto *</option>
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <label for="example-email" class="form-label">Seleccione el nivel académico *</label>
                        <select class="form-control select2" id="id_academic_level" data-toggle="select2">
                            <option value="" selected disabled>Seleccione un nivel académico *</option>
                            <optgroup label="Nivel Académico">
                                <?php foreach ($getAcademicLevels as $nivel) { ?>
                                    <option value="<?= $nivel->id_niveles_academicos ?>"><?= $nivel->descripcion_nivel ?></option>
                                <?php } ?>
                            </optgroup>
                        </select>
                    </div>
                    <br>
                    <div class="col-md">
                        <label for="example-email" class="form-label">Género *</label>
                        <select class="form-control select2" id="id_genero" data-toggle="select2">
                            <option value="" selected disabled>Seleccione un género *</option>
                            <optgroup label="Género">
                                <option value="1">Hombre</option>
                                <option value="2">Mujer</option>
                                <option value="3">No binario</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre (s) *" />
                    <label for="nombre">Nombre (s) *</label>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="ap_paterno" placeholder="Apellido Paterno *" />
                            <label for="ap_paterno">Apellido Paterno *</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="ap_materno" placeholder="Apellido Materno *" />
                            <label for="floatingInput">Apellido Materno *</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="curp" placeholder="CURP *" />
                            <label for="ap_paterno">CURP *</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nss" placeholder="Número de seguro social" />
                            <label for="floatingInput">Número de seguro social</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="mb-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="text" class="form-control date" id="fecha_nacimiento" data-toggle="date-picker" data-single-date-picker="true">
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="rfc" placeholder="Número de seguro social" />
                            <label for="floatingInput">RFC</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <label for="example-email" class="form-label">Estado civil *</label>
                        <select class="form-control select2" id="id_estado_civil" data-toggle="select2">
                            <option value="" selected disabled>Estado civil *</option>
                            <optgroup label="Género">
                                <option value="1">Casado</option>
                                <option value="2">Soltero</option>
                                <option value="3">Unión Libre</option>
                        </select>
                    </div>
                    <div class="col-md">

                    </div>
                </div>
                <br>
                <h3>Información Adicional</h3>
                <h5>Ingrese todos los datos requeridos (marcados con asterísco (*) )</h5>
                <br>
                <br>

                <h4>Domicilio</h4>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="calle" placeholder="Calle *" />
                            <label for="calle">Calle *</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="numero" placeholder="Número *" />
                            <label for="numero">Número *</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="colonia" placeholder="Colonia *" />
                            <label for="colonia">Colonia *</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="cp" placeholder="Código Postal *" />
                            <label for="cp">Código Postal *</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">

                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <label for="id_estado" class="form-label">Seleccione un Estado</label>
                            <select class="form-control select2" id="id_estado" data-toggle="select2">
                                <option value="" selected disabled>Eliga un estado *</option>
                                <optgroup label="Estados">
                                    <?php foreach ($getStates as $estados) { ?>
                                        <option value="<?= $estados->id ?>"><?= $estados->estado ?></option>
                                    <?php } ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <label for="id_estado" class="form-label">Seleccione un Municipio</label>
                            <select disabled class="form-control select2" id="id_municipio" data-toggle="select2">
                                <option value="" selected disabled>Eliga un municipio *</option>
                            </select>
                        </div>
                    </div>
                </div>

                <h4>Información de Contacto</h4>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="telefono_pricnipal" placeholder="Teléfono 1 *" />
                            <label for="calle">Teléfono 1 *</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="telefono_secundario" placeholder="Teléfono 2 " />
                            <label for="calle">Teléfono 2 </label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="correo_personal" placeholder="correo@domino.com" />
                            <label for="floatingInput">Correo Personal</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="telefono_familiar_pricnipal" placeholder="Teléfono 1 *" />
                            <label for="calle">Teléfono Famiiar 1 *</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="telefono_familiar_secundario" placeholder="Teléfono 2 " />
                            <label for="calle">Teléfono Famiiar 2 </label>
                        </div>
                    </div>
                </div>

                <h4>Inicio de sesión</h4>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email_login" placeholder="correo@domino.com" />
                            <label for="floatingInput">Correo asignado</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input class="form-control form_registro" type="text" required="" id="password" placeholder="Ingrese su contraseña">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Generar contraseña</label>
                        <button type="button" id="generate_password" class="btn btn-outline-info btn-rounded">Generar</button>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarUsuario">Guardar usuario</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->