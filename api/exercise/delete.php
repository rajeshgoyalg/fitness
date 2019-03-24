<?php

require '../../bootstrap.php';

use Api\HttpCode;

header("Content-Type: application/json; charset=UTF-8");

$input = json_decode(file_get_contents("php://input"));

if (!empty($input->id)) {

    // @todo - field validation (data type, length etc.)

    $database = new Api\Config\Connection($config);
    $dbHandle = $database->openConnection();

    $workoutExercise = new Api\Models\WorkoutExercise($dbHandle);
    
    $workoutExercise->id = $input->id;

    if ($workoutExercise->deleteExercise()) {
        http_response_code(HttpCode::HTTP_OK);
        echo json_encode(['message' => 'Workout exercise deleted.']);
    } else {
        http_response_code(HttpCode::HTTP_INTERNAL_SERVER_ERROR);
        echo json_encode(['message' => 'Unable to delete workout exercise.']);
    }
} else {
    http_response_code(HttpCode::HTTP_BAD_REQUEST);
    echo json_encode(['message' => 'Incomplete data.']);
}