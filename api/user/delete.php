<?php

require '../../bootstrap.php';

use Api\HttpCode;

header("Content-Type: application/json; charset=UTF-8");

$input = json_decode(file_get_contents("php://input"));

if (!empty($input->id)) {

    // @todo - field validation (data type, length etc.)
    
    $database = new Api\Config\Connection($config);
    $dbHandle = $database->openConnection();

    $user = new Api\Models\User($dbHandle);
    $user->id = $input->id;

    if ($user->deleteUser()) {
        http_response_code(HttpCode::HTTP_OK);
        echo json_encode(['message' => 'User deleted.']);
    } else {
        http_response_code(HttpCode::HTTP_INTERNAL_SERVER_ERROR);
        echo json_encode(['message' => 'Unable to delete user.']);
    }
} else {
    http_response_code(HttpCode::HTTP_BAD_REQUEST);
    echo json_encode(['message' => 'Incomplete data.']);
}