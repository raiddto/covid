<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET");

include_once '../private/config.php';
include_once '../private/database.php';
include_once '../class/personprofile.php';

$database = new Database();
$db = $database->getConnection();
$items = new PersonProfile($db);

$result = null;
if (isset($_GET['id'])) {
    $result = $items->getbyid($_GET['id']);
} else {
    $param = (object)[];
    $param->start = isset($_POST['start']) ? $_POST['start'] : 0;
    $param->length = isset($_POST['length']) ? $_POST['length'] : 5;
    $param->search = isset($_POST['search']['value']) ? "%" . $_POST['search']['value'] . "%" : "%";
    $result = $items->getall($param);
}


if ($result->num_rows > 0) {
    $json = array();
    $json["data"] = array();
    if (!isset($_GET['id'])) {
        $json["draw"] = isset($_POST['draw']) ? $_POST['draw'] : 0;
        $json["recordsTotal"] = $result->recordsTotal;
        $json["recordsFiltered"] = $result->recordsTotal;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $row = array_map('utf8_encode', $row);
        array_push($json["data"], $row);
    }

    header('content-type: application/json; charset=utf-8');
    echo json_encode($json);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No records found.")
    );
}
