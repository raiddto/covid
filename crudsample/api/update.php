<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../private/config.php';
include_once '../private/database.php';
include_once '../class/personprofile.php';

$database = new Database();
$db = $database->getConnection();
$item = new PersonProfile($db);

$item->profileid = $_POST['profileid'];
$item->firstname = $_POST['firstname'];
$item->lastname = $_POST['lastname'];
$item->middlename = $_POST['middlename'];
$item->gender = $_POST['gender'];
$item->address = $_POST['address'];

if($item->update()){
    http_response_code(201);
    echo json_encode("Record updated successfully.");
} else{
    http_response_code(304);
    echo json_encode("Record could not be updated.");
}





?>