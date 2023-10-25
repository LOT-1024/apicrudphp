<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../database.php';
include_once '../employees.php';

$database = new Database();
$db = $database->getConnection();
$item = new Employee($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->name = $_GET['name'];
$item->email = $_GET['email'];
$item->designation = $_GET['designation'];
$item->created = date('Y-m-d H:i:s');

if ($item->updateEmployee()) {
    // Create a response array for success
    $response = array(
        "status" => "success",
        "message" => "Employee data updated"
    );

    // Set the HTTP response code to 200 (OK)
    http_response_code(200);

    // Send the response as JSON
    echo json_encode($response);
} else {
    // Create a response array for error
    $response = array(
        "status" => "error",
        "message" => "Data could not be updated"
    );

    // Set the HTTP response code to 400 (Bad Request) or another appropriate error code
    http_response_code(400);

    // Send the response as JSON
    echo json_encode($response);
}
