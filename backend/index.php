<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}
require_once "controller.php";
require_once "validator.php";

$method = $_SERVER["REQUEST_METHOD"];
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = explode("/", trim($path, "/"));

if ($uri[0] !== "players") {
    http_response_code(404);
    echo json_encode(["error" => "Not found"]);
    exit;
}

$id = $uri[1] ?? null;
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {

    case "GET":
        if ($id) {
            $data = getOne($id);
            if (!$data) {
                http_response_code(404);
                echo json_encode(["error" => "Not found"]);
                exit;
            }
            echo json_encode($data);
        } else {
            echo json_encode(getAll());
        }
        break;

    case "POST":
        if (!validate($input)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid data"]);
            exit;
        }

        $data = create($input);
        http_response_code(201);
        echo json_encode($data);
        break;

    case "PUT":
        if (!$id || !validate($input)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid request"]);
            exit;
        }

        $data = update($id, $input);
        echo json_encode($data);
        break;

    case "DELETE":
        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "ID required"]);
            exit;
        }

        remove($id);
        http_response_code(204);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
}