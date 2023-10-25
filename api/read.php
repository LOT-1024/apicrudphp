<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../database.php';
include_once '../employees.php';
$database = new Database();
$db = $database->getConnection();
$items = new Employee($db);
$records = $items->getEmployees();
$itemCount = $records->num_rows;

if ($itemCount > 0) {
    $employeeArr = array();
    $employeeArr["body"] = array();

    while ($row = $records->fetch_assoc()) {
        $employeeArr["body"][] = $row;
    }

    // Create a response array
    $response = array(
        "status" => "success",
        "message" => "Data retrieved successfully",
        "data" => $employeeArr
    );

    // Set the HTTP response code to 200 (OK)
    http_response_code(200);

    // Send the response as JSON
    echo json_encode($response);
} else {
    // If no records were found, set the HTTP response code to 404 (Not Found)
    http_response_code(404);

    // Create a response array
    $response = array(
        "status" => "error",
        "message" => "No records found",
        "data" => null
    );

    // Send the response as JSON
    echo json_encode($response);
}
