<div id="registrarProveedor" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="images/logo_chuen_dark.png" alt="" height="40"></span>
                        <h3>Registrar Nuevo Proveedor</h3>
                    </a>
                </div>

                <form class="ps-3 pe-3" action="#">

                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre completo de contacto</label>
                        <input class="form-control form_registro" type="text" id="nombre_prov" required="" placeholder="Ingrese el nombre">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Empresa o Razón Social</label>
                        <input class="form-control form_registro" type="apellidos" id="empresa_prov" required="" placeholder="Ingrese nombre de la empresa">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Número telefónico</label>
                        <input class="form-control form_registro" type="text" id="telefono_prov" required="" placeholder="Ingrese un número telefónico">
                    </div>
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Correo electrónico</label>
                        <input class="form-control form_registro" type="email" id="correo_electronico_prov" required="" placeholder="ejemplo@mail.com">
                    </div>

                        <div class="mb-3 text-center">
                            <button class="btn btn-primary btn_registrar_proveedor">Registrar</button>
                        </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->