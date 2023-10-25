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
$item->getSingleEmployee();

if ($item->name != null) {
    // Create an array for the employee details
    $emp_arr = array(
        "id" => $item->id,
        "name" => $item->name,
        "email" => $item->email,
        "designation" => $item->designation,
        "created" => $item->created
    );

    // Create a response array
    $response = array(
        "status" => "success",
        "message" => "Employee retrieved successfully",
        "data" => $emp_arr
    );

    // Set the HTTP response code to 200 (OK)
    http_response_code(200);

    // Send the response as JSON
    echo json_encode($response);
} else {
    // If the employee is not found, set the HTTP response code to 404 (Not Found)
    http_response_code(404);

    // Create a response array for the error
    $response = array(
        "status" => "error",
        "message" => "Employee not found",
        "data" => null
    );

    // Send the response as JSON
    echo json_encode($response);
}
