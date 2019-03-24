<?php

require '../../bootstrap.php';

use Api\HttpCode;

header("Content-Type: application/json; charset=UTF-8");

$database = new Api\Config\Connection($config);
$dbHandle = $database->openConnection();

$workoutPlan = new Api\Models\WorkoutPlan($dbHandle);
$records = $workoutPlan->getAllPlans();

if ($records) {
    http_response_code(HttpCode::HTTP_OK);
    echo json_encode($records);
} else {
    http_response_code(HttpCode::HTTP_NOT_FOUND);
    echo json_encode(['message' => 'No record found.']);
}