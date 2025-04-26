<?php
require_once 'C:\Users\Morty\laminasapi\vendor\autoload.php';
include_once(ROOT_PATH . "/app/database/db.php");
include_once(ROOT_PATH . "/app/helpers/middleware.php");

use Laminas\Http\Client;
use Laminas\Http\Request;

// Obsługa usuwania użytkownika
if (isset($_GET['delete_id'])) {
    adminOnly();
    $userId = $_GET['delete_id'];
    $clientDelete = new Client('http://localhost:8080/users/' . $userId, ['timeout' => 30]);
    $clientDelete->setMethod(Request::METHOD_DELETE);
    $responseDelete = $clientDelete->send();
    
    if ($responseDelete->isSuccess()) {
        $_SESSION['message'] = "Użytkownik został usunięty";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['message'] = "Błąd przy usuwaniu użytkownika: " . $responseDelete->getStatusCode();
        $_SESSION['type'] = "error";
    }
    header('location: ' . BASE_URL . '/admin/users/index.php');
    exit();
}

$clientUsers = new Client('http://localhost:8080/users', ['timeout' => 30]);
$clientUsers->setMethod(Request::METHOD_GET);
$clientUsers->setHeaders(['Accept' => 'application/json']);
$responseUsers = $clientUsers->send();

if ($responseUsers->isSuccess()) {
    $data = json_decode($responseUsers->getBody(), true);
    // Jeśli dane są opakowane w _embedded['users'], pobierz je; w przeciwnym razie użyj danych bez zmian
    $all_users = isset($data['_embedded']['users']) ? $data['_embedded']['users'] : $data;
} else {
    $all_users = [];
}

// Podział na administratorów i zwykłych użytkowników:
$admins = [];
$regular_users = [];
foreach ($all_users as $user) {
    if (isset($user['admin']) && $user['admin'] == 1) {
        $admins[] = $user;
    } else {
        $regular_users[] = $user;
    }
}
?>