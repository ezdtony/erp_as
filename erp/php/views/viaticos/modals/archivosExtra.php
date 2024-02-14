<div class="modal fade" id="archivosExtra" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalTitle">Archivos adicionales del gasto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-centered mb-0" id="tablaArchivosExtra">
                        <thead>
                            <tr>
                                <th>Descripción de archivo</th>
                                <th>Fecha de registro</th>
                                <th>Ver archivo</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="descripcion_archivo_extra" placeholder="Ingrese una descripción del archivo" />
                    <label for="descripcion_archivo_extra">Ingrese una descripción del archivo</label>
                </div>
                <div class="col-sm-12">
                    <label class="form-label">Añadir archivo</label>
                    <input class="form-control" type="file" id="inputArchivoExtra">
                    <button type="button" class="btn btn-success btnAddArchivoExtra">Agregar</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary closeExtraArchive" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>