<?php

require '../../bootstrap.php';

use Api\HttpCode;

header("Content-Type: application/json; charset=UTF-8");

$input = $_GET['id'];

if (!empty($input)) {

    // @todo - field validation (data type, length etc.)
    
    $database = new Api\Config\Connection($config);
    $dbHandle = $database->openConnection();

    $workoutPlan = new Api\Models\WorkoutPlan($dbHandle);

    $workoutPlan->id = $input;
    $records = $workoutPlan->getPlanDetails()->format();

    if ($records) {
        foreach ($records['days'] as &$dayExercies) {
            $workoutDay     = new Api\Models\WorkoutDay($dbHandle);
            $workoutDay->id = $dayExercies['day_id'];
            $dayExercies['day_exercises'] = $workoutDay->getDayExercises();
        }
        http_response_code(HttpCode::HTTP_OK);
        echo json_encode($records);
    } else {
        http_response_code(HttpCode::HTTP_NOT_FOUND);
        echo json_encode(['message' => 'No record found.']);
    }
} else {
    http_response_code(HttpCode::HTTP_BAD_REQUEST);
    echo json_encode(['message' => 'Incomplete data.']);
}