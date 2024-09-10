<?php
$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo");
$meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$monthNumber = date("n");
$dayNumber = date("d");
$dia_semana = date("w");
$yearFecha = date("Y");
$fecha_formato = $dias[$dia_semana] . " " . $dayNumber . ' de ' . $meses[$monthNumber] . ' de ' . $yearFecha;
?>

<div class="modal fade" id="modalVacationDetail" tabindex="-1" role="dialog" aria-labelledby="VacationDetailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="VacationDetailLabel">Asignar vacaciones</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <h5>Días de vacaciones tomados por: </h5>
                <h1 id="colabVactDayDet"></h1>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="tableVacationsDetail">
                        <thead>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Fecha</th>
                                <th scope='col'>Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>