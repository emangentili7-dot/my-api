<?php
header("Content-Type: application/json");

// Accept POST only
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Only POST allowed",
        "method" => $_SERVER['REQUEST_METHOD']
    ]);
    exit;
}

// Read JSON input
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// If empty or invalid, return error
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid or empty JSON"
    ]);
    exit;
}

// Optional: save to file
file_put_contents("data.txt", date("Y-m-d H:i:s") . " " . print_r($data, true) . "\n", FILE_APPEND);

// Return response
echo json_encode([
    "status" => "success",
    "received" => $data
]);
