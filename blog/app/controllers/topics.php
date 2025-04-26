<?php
require_once 'C:\Users\Morty\laminasapi\vendor\autoload.php'; 
include_once(ROOT_PATH . "/app/database/db.php");
include_once(ROOT_PATH . "/app/helpers/middleware.php");

use Laminas\Http\Client;
use Laminas\Http\Request;

$table = 'topics';

$errors = array();
$id = '';
$name = '';
$description = '';

// Pobranie tematów przez API zamiast bezpośrednio z bazy
$client = new Client('http://localhost:8080/topics', ['timeout' => 30]);
$client->setMethod(Request::METHOD_GET);
$response = $client->send();

if ($response->isSuccess()) {
    $topics = json_decode($response->getBody(), true);
} else {
    $topics = [];
    // Opcjonalnie: ustaw komunikat błędu lub loguj błąd
}

// Zmieniono warunek na !empty($_GET['id'])
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    // Pobieranie pojedynczego tematu przez API
    $client->setUri('http://localhost:8080/topics/' . $id);
    $client->setMethod(Request::METHOD_GET);
    $response = $client->send();

    if ($response->isSuccess()) {
        $topic = json_decode($response->getBody(), true);
        $id = $topic['id'];
        $name = $topic['name'];
        $description = $topic['description'];
    } else {
        $_SESSION['message'] = 'Nie udało się pobrać kategorii: ' . $response->getStatusCode();
        $id = $name = $description = '';
    }
}

if (isset($_POST['update-topic'])) {
    adminOnly();
    $errors = validateTopic($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        // Wysyłanie żądania PUT do API w celu aktualizacji kategorii
        $client->setUri('http://localhost:8080/topics/' . $id);
        $client->setMethod(Request::METHOD_PUT);
        $client->setEncType('application/json');
        $client->setRawBody(json_encode($_POST));
        $response = $client->send();

        if ($response->isSuccess()) {
            $_SESSION['message'] = 'Kategoria została zaktualizowana';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/admin/topics/index.php');
            exit();
        } else {
            $_SESSION['message'] = 'Błąd podczas aktualizacji kategorii: ' . $response->getStatusCode();
        }
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
}