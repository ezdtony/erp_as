<?php
$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo");
$meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$monthNumber = date("n");
$dayNumber = date("d");
$dia_semana = date("w");
$yearFecha = date("Y");
$fecha_formato = $dias[$dia_semana] . " " . $dayNumber . ' de ' . $meses[$monthNumber] . ' de ' . $yearFecha;
?>

<div class="modal fade" id="modalSendMails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Enviar correos de viáticos</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">

                <!-- <h1>Cuerpo del correo</h1>
                <div>
                    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
                    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

                    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
                    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

                    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
                    <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>

                    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

                    <div id="editor">
                        <h3>Estimado *Nombre del colaborador*. </h3>
                        <p>Te recordamos que tienes hasta el día <strong>25 de <?= $meses[$monthNumber] ?> de <?= $yearFecha ?></strong> para finalizar la comprobación de gastos pendientes.</p>
                        <p><br></p>
                    </div>

                    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

                    <script>
                        var quill = new Quill('#editor', {
                            theme: 'snow'
                        });
                    </script>

                </div>
                --><br>
                <br>
                <button type="button" class="btn btn-info rounded-pill sendMailsViatics">Envío masivo de correos</button>
                <div class="table-responsive">

                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>N° Empleado</th>
                                <th>Nombre</th>
                                <th>Saldo</th>
                                <th>Pendiente por comprobar</th>
                                <th>Correo personal</th>
                                <th>Envío masivo</th>
                                <th>Enviar correo</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            include_once('php/models/user_information_table.php');
                            $user_information_table = new UserArchives();
                            foreach ($getAllUsersSendMails as $user) {
                                $status = '';
                                if ($user->status == 1) {
                                    $status = 'checked';
                                }


                                $moneyInfo = $user_information_table->getMoneyInfo($user->id_lista_personal);
                                /* var_dump($moneyInfo); */
                                $pendiente = $moneyInfo['pendiente'];
                            ?>
                                <tr>
                                    <td><?= $user->id_lista_personal ?></td>
                                    <td><?= ($user->nombres) . " " . $user->apellido_paterno . " " . $user->apellido_materno ?></td>
                                    <td><?= (number_format($user->saldo, 2)) ?></td>
                                    <td><?= ($pendiente) ?></td>
                                    <td><?= ($user->correo_sesion) ?></td>
                                    <td>
                                        <div>
                                            <?php
                                            $getInfoTableSendMail = $user_information_table->getInfoTableSendMail($user->id_lista_personal);
                                            $statusSendMail = '';
                                            if (!empty($getInfoTableSendMail)) {
                                                if ($getInfoTableSendMail[0]->enviar == 1) {
                                                    $statusSendMail = 'checked';
                                                }
                                            }
                                            ?>
                                            <input class="send_viatics_mail" type="checkbox" data-id-user="<?= $user->id_lista_personal ?>" id="sndmail<?= $user->id_lista_personal ?>" data-switch="success" <?= $statusSendMail ?> />
                                            <label for="sndmail<?= $user->id_lista_personal ?>" data-on-label="Si" data-off-label="No" class="mb-0 d-block"></label>
                                        </div>
                                    </td>

                                    <td class="table-action">
                                        <a class="action-icon sendEmail" id-personal="<?= $user->id_lista_personal ?>" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Enviar correo"> <i class="mdi mdi-email"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>