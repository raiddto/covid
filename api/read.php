<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../private/config.php';
include_once '../private/database.php';
include_once '../class/personprofile.php';

$database = new Database();
$db = $database->getConnection();
$items = new PersonProfile($db);

$param = isset($_GET['id']) ? $_GET['id'] : $_GET['searchtext'];

$result = null;
if (isset($_GET['id'])){
    $result = $items->getbyid($param);
}else {
    $result = $items->getall($param);
}   


if($result->num_rows > 0){
    $json = array();
    $json["data"] = array();
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


?>