<?php
$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo");
$meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$monthNumber = date("n");
$dayNumber = date("d");
$dia_semana = date("w");
$yearFecha = date("Y");
$fecha_formato = $dias[$dia_semana] . " " . $dayNumber . ' de ' . $meses[$monthNumber] . ' de ' . $yearFecha;
?>

<div class="modal fade" id="modalVacationDay" tabindex="-1" role="dialog" aria-labelledby="modalVacationDayLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalVacationDayLabel">Asignar vacaciones</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h5>Asignar día de vacaciones a: </h5>
                <h1 id="colabVactDay"></h1>
                <br>
                <h2>Seleccione el día a asignar: </h2>
                <input type="text" class="form-1control datePicker" id="colabVacationDay">
                <br>
                <br>
                <div class="mb-3">
                    <label class="form-label" for="exampleFormControlSelect1">Motivo <span class="form-label-secondary"></span></label>
                    <select id="colabVacationType" class="form-control">
                        <option selected disabled>Seleccione una opción</option>
                        <?php foreach($getVacationsTypes as $type):?>
                        <option value="<?=$type->id_vacation_type?>"><?=$type->type_description?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <br>
                <br>
                <button type="button" class="btn btn-info btn-lg rounded-pill assignVacationDate">Asingar</button>
            </div>
        </div>
    </div>
</div>