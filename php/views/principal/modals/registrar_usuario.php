<div id="registrarUsuario" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="images/logo_chuen_dark.png" alt="" height="40"></span>
                        <h3>Registrar Nuevo Usuario</h3>
                    </a>
                </div>

                <form class="ps-3 pe-3" action="#">

                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre (s)</label>
                        <input class="form-control form_registro" type="text" id="nombres" required="" placeholder="Ingrese su nombre">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Apellidos</label>
                        <input class="form-control form_registro" type="apellidos" id="apellidos" required="" placeholder="Ingrese los apellidos">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Título Profesional</label>
                        <select id="id_titulo" class="form-control select2 form_registro" data-toggle="select2">
                            <option value="" disabled>** Seleccione un título</option>

                            <optgroup label="Título">
                                <?php foreach ($getTitulosAc as $titles) : ?>
                                    <option value="<?= $titles->id_titulo ?>"><?= $titles->descripcion ?> </option>
                                <?php endforeach; ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Área asignada</label>
                        <select id="areas_registrar" class="form-control select2 form_registro" data-toggle="select2">
                            <option value="">** Seleccione un área</option>

                            <optgroup label="Áreas">
                                <?php foreach ($getAreas as $areas) : ?>
                                    <option value="<?= $areas->id_area ?>"><?= $areas->description ?> </option>
                                <?php endforeach; ?>
                            </optgroup>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Puesto</label>
                        <select id="areas_puesto" class="form-control select2 form_registro" data-toggle="select2" disabled>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Número telefónico</label>
                        <input class="form-control form_registro" type="text" id="telefono" required="" placeholder="Ingrese un número telefónico">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Calle</label>
                                <input class="form-control form_registro" type="text" id="calle" required="" placeholder="Ingrese la calle">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Número</label>
                                <input class="form-control form_registro" type="number" id="numero_dir" required="" placeholder="Número">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Colonia</label>
                                <input class="form-control form_registro" type="text" id="colonia_dir" required="" placeholder="Ingrese la colonia">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Estado</label>
                                <select id="estado_dir" class="form-control select2 form_registro" data-toggle="select2">
                                    <option value="">** Seleccione un estado</option>
                                    <optgroup label="Estados">
                                        <?php foreach ($getStates as $states) : ?>
                                            <option value="<?= $states->id ?>"><?= $states->estado ?> </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Municipio</label>
                                <select id="municipio_dir" class="form-control select2 form_registro" data-toggle="select2" disabled>
                                    <option value="">** Seleccione un municipio</option>

                                    <optgroup label="Estados">
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Código Postal</label>
                                <input class="form-control form_registro" type="number" id="cp_dir" required="" placeholder="Ingrese su código postal" maxlength="5">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Correo electrónico</label>
                        <input class="form-control form_registro" type="email" id="correo_electronico" required="" placeholder="ejemplo@mail.com">
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
                            <button type="button" id="generate_password" class="btn btn-outline-secondary btn-rounded">Generar</button>
                        </div>
                    </div>



                    <div class="mb-3 text-center">
                        <button class="btn btn-primary btn_registrar_usuario">Registrar</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->