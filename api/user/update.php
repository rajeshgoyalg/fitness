<?php

require '../../bootstrap.php';

use Api\HttpCode;

header("Content-Type: application/json; charset=UTF-8");

$input = json_decode(file_get_contents("php://input"));

if (!empty($input->id) && !empty($input->first_name) && !empty($input->last_name) && !empty($input->email) && !empty($input->plan_id)) {

    // @todo - field validation (data type, length etc.)

    $database = new Api\Config\Connection($config);
    $dbHandle = $database->openConnection();

    $user = new Api\Models\User($dbHandle);    

    $user->id         = $input->id;
    $user->first_name = $input->first_name;
    $user->last_name  = $input->last_name;
    $user->email      = $input->email;
    $user->plan_id    = $input->plan_id;

    if ($user->updateUser()) {
        http_response_code(HttpCode::HTTP_OK);
        echo json_encode(['message' => 'User updated.']);
    } else {
        http_response_code(HttpCode::HTTP_INTERNAL_SERVER_ERROR);    
        echo json_encode(['message' => 'Unable to update user.']);
    }
} else {
    http_response_code(HttpCode::HTTP_BAD_REQUEST);
    echo json_encode(['message' => 'Incomplete data.']);
}