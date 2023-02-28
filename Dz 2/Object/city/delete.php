<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '../config/database.php';
include_once '../models/city.php';

$database = new Database();
$db = $database->getConnection();

$city = new City($db);
$city->id = $_POST['id'];
$city->name = $_POST['name'];

if ($city->delete()) {
    http_response_code(204);
    echo json_encode(array("message" => "City successfully deleted."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Could't delete city."));
}