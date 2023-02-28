<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '../config/database.php';
include_once '../models/city.php';

$database = new Database();
$db = $database->getConnection();

$city = new City($db);

$city->name = $_POST['name'];
$city->id = $_POST['id'];

if ($city->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "City has been updated."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Could't update city."));
}