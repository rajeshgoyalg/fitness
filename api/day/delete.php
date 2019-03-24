<?php

require '../../bootstrap.php';

use Api\HttpCode;

header("Content-Type: application/json; charset=UTF-8");

$input = json_decode(file_get_contents("php://input"));

if (!empty($input->id)) {

    // @todo - field validation (data type, length etc.)

    $database = new Api\Config\Connection($config);
    $dbHandle = $database->openConnection();

    $workoutDay = new Api\Models\WorkoutDay($dbHandle);
    
    $workoutDay->id = $input->id;

    if ($workoutDay->deleteDay()) {
        http_response_code(HttpCode::HTTP_OK);
        echo json_encode(['message' => 'Workout day deleted.']);
    } else {
        http_response_code(HttpCode::HTTP_INTERNAL_SERVER_ERROR);
        echo json_encode(['message' => 'Unable to delete workout day.']);
    }
} else {
    http_response_code(HttpCode::HTTP_BAD_REQUEST);
    echo json_encode(['message' => 'Incomplete data.']);
}