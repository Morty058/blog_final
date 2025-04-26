<?php
require_once 'C:\Users\Morty\laminasapi\vendor\autoload.php';
include_once(ROOT_PATH . "/app/database/db.php");
include_once(ROOT_PATH . "/app/helpers/middleware.php");

use Laminas\Http\Client;
use Laminas\Http\Request;

$name = '';
$description = '';
$id = '';

// Pobranie danych kategorii do edycji
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $client = new Client("http://localhost:8080/topics/$id", ['timeout' => 30]);
    $client->setMethod(Request::METHOD_GET);
    $client->setHeaders(['Accept' => 'application/json']);

    $response = $client->send();
    if ($response->isSuccess()) {
        $data = json_decode($response->getBody(), true);
        $name = $data['name'];
        $description = $data['description'];
    } else {
        $_SESSION['message'] = "Błąd pobierania kategorii";
        $_SESSION['type'] = "error";
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit;
    }
}

// Obsługa aktualizacji kategorii (PUT)
if (isset($_POST['update-topic'])) {
    $id = $_POST['id'];
    $data = [
        'name' => $_POST['name'],
        'description' => $_POST['description']
    ];

    $client = new Client("http://localhost:8080/topics/$id", ['timeout' => 30]);
    $client->setMethod(Request::METHOD_PUT);
    $client->setHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ]);
    $client->setRawBody(json_encode($data));

    $response = $client->send();
    if ($response->isSuccess()) {
        $_SESSION['message'] = "Kategoria została zaktualizowana";
        $_SESSION['type'] = "success";
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit;
    } else {
        $_SESSION['message'] = "Błąd aktualizacji kategorii: " . $response->getStatusCode();
        $_SESSION['type'] = "error";
        header('location: ' . BASE_URL . '/admin/topics/edit.php?id=' . $id);
        exit;
    }
}

// Obsługa tworzenia kategorii (POST)
if (isset($_POST['add-topic'])) {
    $data = [
        'name' => $_POST['name'],
        'description' => $_POST['description']
    ];

    $client = new Client('http://localhost:8080/topics', ['timeout' => 30]);
    $client->setMethod(Request::METHOD_POST);
    $client->setHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ]);
    $client->setRawBody(json_encode($data));

    $response = $client->send();
    if ($response->isSuccess()) {
        $_SESSION['message'] = "Kategoria została dodana";
        $_SESSION['type'] = "success";
        header('location: ' . BASE_URL . '/admin/topics/index.php');
        exit;
    } else {
        $_SESSION['message'] = "Błąd podczas dodawania kategorii: " . $response->getStatusCode();
        $_SESSION['type'] = "error";
    }
}

// Obsługa usuwania kategorii (DELETE)
if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];

    $client = new Client("http://localhost:8080/topics/$id", ['timeout' => 30]);
    $client->setMethod(Request::METHOD_DELETE);
    $client->setHeaders(['Accept' => 'application/json']);

    $response = $client->send();
    if ($response->isSuccess()) {
        $_SESSION['message'] = "Kategoria została usunięta";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['message'] = "Błąd podczas usuwania kategorii: " . $response->getStatusCode();
        $_SESSION['type'] = "error";
    }
    header('location: ' . BASE_URL . '/admin/topics/index.php');
    exit;
}

// Pobieranie listy kategorii (GET)
$clientTopics = new Client('http://localhost:8080/topics', ['timeout' => 30]);
$clientTopics->setMethod(Request::METHOD_GET);
$clientTopics->setHeaders(['Accept' => 'application/json']);
$responseTopics = $clientTopics->send();
if ($responseTopics->isSuccess()) {
    $data = json_decode($responseTopics->getBody(), true);
    $topics = isset($data['_embedded']['topics']) ? $data['_embedded']['topics'] : $data;
} else {
    $topics = [];
}
?>