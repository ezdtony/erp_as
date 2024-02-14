<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex">
                    <!-- <a href="javascript: void(0);" class="btn btn-primary ms-2">
                             <i class="mdi mdi-autorenew"></i>
                         </a> -->
                    <!--   <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#createSolicitud" data-bs-placement="top" title="Nueva solicitud">
                        <i class="mdi mdi-note-plus"></i>
                    </button> -->
                </form>
            </div>
            <h4 class="page-title">Gráficas</h4>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="col" id="">
                    <h5 class="card-title">Selecionar un proyecto</h5>
                    <select id="id_proyecto" class="form-select form-select-lg mb-3">
                        <option value="" disabled selected>Eliga un proyecto</option>
                        <?php foreach ($getProyects as $proyect) : ?>
                            <option value="<?= $proyect->id_proyectos ?>"><?= $proyect->nombre_largo ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- end card body-->
        </div>
        <!-- end card -->
    </div>
    <div class="col-xl-4" id=""  width="50%"></div>
    <div class="col-xl-4" id="div_grafica_cont" style="display:none" width="50%">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4">
                        <div class="col" id="grafica_dona">
                            <h5 class="card-title">Gastos por Obra</h5>
                            <canvas id="barra_depositos"></canvas>
                        </div>
                    </div>
                    <div class="col-xs-4"></div>
                </div>

            </div>
            <!-- end card body-->
        </div>
        <!-- end card -->
    </div>
    <div class="col-xl-4" id="" width="50%"></div>
    <!-- end col-->
</div>
</div>
<script src="js/functions/grafica_dona.js"></script>