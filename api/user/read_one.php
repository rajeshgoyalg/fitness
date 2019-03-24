<?php

require '../../bootstrap.php';

use Api\HttpCode;

header("Content-Type: application/json; charset=UTF-8");

$input = $_GET['id'];

if (!empty($input)) {

    // @todo - field validation (data type, length etc.)
    
    $database = new Api\Config\Connection($config);
    $dbHandle = $database->openConnection();

    $user     = new Api\Models\User($dbHandle);
    $user->id = $input;
    $records  = $user->getUserDetails()->format();

    if ($records) {
        $workoutPlan = new Api\Models\WorkoutPlan($dbHandle);
        $workoutPlan->id = $records['plan_id'];
        $records['plan'] = $workoutPlan->getPlanDetails()->format();
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