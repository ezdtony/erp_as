<?php
$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo");
$meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$monthNumber = date("n");
$dayNumber = date("d");
$dia_semana = date("w");
$yearFecha = date("Y");
$fecha_formato = $dias[$dia_semana] . " " . $dayNumber . ' de ' . $meses[$monthNumber] . ' de ' . $yearFecha;
?>

<div class="modal fade" id="modalRegVacationBonus" tabindex="-1" role="dialog" aria-labelledby="RegVacationBonusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="RegVacationBonusLabel">Registrar pago prima vacacional</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h5>Registrar pago para: </h5>
                <h1 id="colabPayVactBonusDay"></h1>
                <br>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="date-pay" class="form-label">Fecha de pago</label>
                        <input type="date" class="form-control" id="date-pay">
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustomUsername" class="form-label">Cantidad pagada</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">$</span>
                            <input type="number" class="form-control" id="ammountBonus" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="formFile" class="form-label">Comprobante</label>
                        <input class="form-control" type="file" id="docBonusPay">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" id="regPayBonus">Registrar pago</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>