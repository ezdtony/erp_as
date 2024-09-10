<?php
include_once dirname(__DIR__ . '', 3) . "/models/petitions.php";

session_start();
date_default_timezone_set('America/Mexico_City');

if (!empty($_POST['mod'])) {
    $function = $_POST['mod'];
    $function();
}


function assignVacationDayColab()
{
    $id_user = $_POST['id_user'];
    $id_vacation_type = $_POST['id_vacation_type'];
    $vacation_day = $_POST['vacation_day'];
    $vacation_day_arr = explode('/', $vacation_day);
    $taken_day = $vacation_day_arr[2] . "-" . $vacation_day_arr[1] . "-" . $vacation_day_arr[0];

    $queries = new Queries;

    $stmt = "INSERT INTO asteleco_personal.vacations_taken (
        id_personal,
        id_vacation_type,
        day_authorized,
        day_registered,
        id_personal_auth,
        id_personal_registered,
        authortized
    )VALUES(
        $id_user,
        $id_vacation_type,
        '$taken_day',
        NOW(),
        $_SESSION[id_user],
        $_SESSION[id_user],
        1
    )";



    if ($queries->InsertData($stmt)) {


        //--- --- ---//
        $data = array(
            'response' => true,
            'message'                => 'Se ha registrado el día'
        );
        //--- --- ---//
    } else {
        //--- --- ---//
        $data = array(
            'response' => false,
            'message'                => ''
        );
        //--- --- ---//
    }

    echo json_encode($data);
}
function getVacationDayColabDet()
{
    $id_user = $_POST['id_user'];
    $queries = new Queries;

    $stmt = "SELECT vt.*, type_description
    FROM asteleco_personal.vacations_taken AS vt
    INNER JOIN asteleco_personal.vacation_types AS vty ON vty.id_vacation_type = vt.id_vacation_type
    WHERE id_personal = $id_user";
    $daysTaken = $queries->getData($stmt);
    $html = "";
    $day_nm = 0;
    if (!empty($daysTaken)) {

        foreach ($daysTaken as $day) {
            $day_nm++;
            $html .= " <tr>
            <td scope='row'>$day_nm</td>
            <td>$day->day_authorized</td>
            <td>$day->type_description</td>
        </tr>";
        }
    } else {
        $html .= " <tr>
            <th colpsan='100' scope='row'>NO SE HAN TOMADO DÍAS DE VACACIONES</th>
        </tr>";
    }
    $data = array(
        'response' => true,
        'html'                => $html
    );

    echo json_encode($data);
}

function getBonusPays()
{
    $id_user = $_POST['id_user'];
    $queries = new Queries;

    $stmt = "SELECT *
    FROM asteleco_rh.vacation_bonus AS vb
    WHERE id_colab = $id_user
    ORDER BY date_paid DESC
    ";
    $bonus_payed = $queries->getData($stmt);
    $html = "";
    $day_nm = 0;
    if (!empty($bonus_payed)) {

        foreach ($bonus_payed as $day) {
            $day_nm++;
            $html .= " <tr>
            <td scope='row'>$day_nm</td>
            <td>$day->date_paid</td>
            <td>$ $day->amount</td>
            <td><a class='btn btn-danger' target='_blank' href='$day->url_document'><i class='fa-solid fa-file'></i></a></td>
        </tr>";
        }
    } else {
        $html .= " <tr>
            <th colpsan='100' scope='row'>NO SE HAN TOMADO DÍAS DE VACACIONES</th>
        </tr>";
    }
    $data = array(
        'response' => true,
        'html'                => $html
    );

    echo json_encode($data);
}

function updateBaseGrossSalary()
{
    $id_colab = $_POST['id_colab'];
    $ammount = $_POST['ammount'];
    $mensual_gross = round(bcmul($ammount, 30, 10), 2);
    $diary_gross = round($ammount, 2);
    $queries = new Queries;

    $stmt = "SELECT * FROM asteleco_rh.colab_salaries WHERE id_colab = $id_colab";
    $getUserSalary = $queries->getData($stmt);
    $html = "";
    $day_nm = 0;
    if (!empty($getUserSalary)) {
        $stmt = "UPDATE asteleco_rh.colab_salaries SET gross_salary = '$ammount' WHERE id_colab = $id_colab";

        if ($queries->InsertData($stmt)) {
            $data = array(
                'response' => true,
                'message'                => "Se actualizó el salario",
                'mensual_gross' => $mensual_gross,
                'diary_gross' => $diary_gross
            );
        } else {
            $data = array(
                'response' => false,
                'message'                => "Ocurrió un error al actualizar el salario"
            );
        }
    } else {
        $stmt = "INSERT INTO asteleco_rh.colab_salaries (id_colab, gross_salary) VALUES($id_colab, '$ammount')";
        if ($queries->InsertData($stmt)) {
            $data = array(
                'response' => true,
                'message'                => "Se actualizó el salario",
                'mensual_gross' => $mensual_gross,
                'diary_gross' => $diary_gross
            );
        } else {
            $data = array(
                'response' => false,
                'message'                => "Ocurrió un error al actualizar el salario"
            );
        }
    }


    echo json_encode($data);
}
