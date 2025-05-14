<?php
require_once(__DIR__ . '../../repository/common/dbc_repository.php');
require_once(__DIR__ . '../../repository/guitarwars/guitarwars_repository_select.php');
require_once(__DIR__ . '../../repository/guitarwars/guitarwars_repository_update.php');

function guitarwars_service_aprove_score()
{
    $result = [
        'result_approve' => false,
        'result_select_by_id' => null,
        'message' => ''
    ];

    $id = null;

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = (int) $_GET['id'];
    } else {
        $id = (int) $_POST['id'];
    }

    if ($id == null) {

        $result['message'] = 'Id is mandatory';

        return $result;
    }

    $dbc = dbc_repository_get_connection();

    $result['result_select_by_id'] = guitarwars_repository_select($dbc, $id, false, 1, null, null);


    if (isset($_POST['submit']) && $_POST['confirm'] == 'yes') {

        $row = $result['result_select_by_id'][0];

        guitarwars_repository_update($dbc, $id, $row['date'], $row['name'], $row['score'], $row['screenshot'], 1);

        $result['result_approve'] = true;
    }

    dbc_repository_close_connection($dbc);

    return $result;
}
