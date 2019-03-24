<?php

require '../../bootstrap.php';

use Api\HttpCode;

header("Content-Type: application/json; charset=UTF-8");

$input = json_decode(file_get_contents("php://input"));

if (!empty($input->name) && !empty($input->days)) {

    // @todo - field validation (data type, length etc.)

    $database = new Api\Config\Connection($config);
    $dbHandle = $database->openConnection();

    $workoutPlan = new Api\Models\WorkoutPlan($dbHandle);

    $workoutPlan->name = $input->name;
    $workoutPlan->days = $input->days;

    if ($workoutPlan->create()) {
        http_response_code(HttpCode::HTTP_CREATED);
        echo json_encode(['message' => 'Workout plan created.']);
    } else {
        http_response_code(HttpCode::HTTP_INTERNAL_SERVER_ERROR);
        echo json_encode(['message' => 'Unable to create workout plan.']);
    }
} else {
    http_response_code(HttpCode::HTTP_BAD_REQUEST);
    echo json_encode(['message' => 'Incomplete data.']);
}