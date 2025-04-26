<?php
include_once(ROOT_PATH . "/app/database/db.php");
include_once(ROOT_PATH . "/app/helpers/middleware.php");
require 'C:\Users\Morty\laminasapi\vendor\autoload.php';

use Laminas\Http\Client;
use Laminas\Http\Request;

$table = 'users';

$clientUsers = new Client('http://localhost:8080/users', ['timeout' => 30]);
$clientUsers->setMethod(Request::METHOD_GET);
$responseUsers = $clientUsers->send();
$all_users = $responseUsers->isSuccess() ? json_decode($responseUsers->getBody(), true) : [];

$admins = $regular_users = [];
foreach ($all_users as $user) {
    ($user['admin'] == 1) ? $admins[] = $user : $regular_users[] = $user;
}

$errors = [];
$id = $username = $email = $password = $passwordConf = '';
$admin = 0;

function loginUser($user) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'Zostałeś poprawnie zalogowany';
    $_SESSION['type'] = 'success';
    header('location:' . BASE_URL . ($_SESSION['admin'] ? '/admin/dashboard.php' : '/index.php'));
    exit();
}

// REJESTRACJA / DODAWANIE ADMINA
if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
    $isAdminCreating = isset($_POST['create-admin']);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    if ($password !== $passwordConf) {
        $errors[] = "Wpisane hasła nie są identyczne";
    }

    if (empty($username)) $errors[] = "Nazwa użytkownika jest wymagana";
    if (empty($email)) $errors[] = "Email jest wymagany";
    if (empty($password)) $errors[] = "Hasło jest wymagane";

    if (empty($errors)) {
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'admin' => $admin
        ];

        $client = new Client('http://localhost:8080/users', ['timeout' => 30]);
        $client->setMethod(Request::METHOD_POST);
        $client->setHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json']);
        $client->setEncType('application/json');
        $client->setRawBody(json_encode($data));
        $response = $client->send();

        if ($response->isSuccess()) {
            $result = json_decode($response->getBody(), true);
            $userId = $result['id'] ?? null;

            if ($userId) {
                $clientGet = new Client("http://localhost:8080/users/{$userId}", ['timeout' => 30]);
                $clientGet->setMethod(Request::METHOD_GET);
                $clientGet->setHeaders(['Accept' => 'application/json']);
                $responseGet = $clientGet->send();
                $user = $responseGet->isSuccess() ? json_decode($responseGet->getBody(), true) : null;

                if ($isAdminCreating) {
                    $_SESSION['message'] = "Użytkownik został utworzony";
                    $_SESSION['type'] = "success";
                    header('location: ' . BASE_URL . '/admin/users/index.php');
                    exit();
                } else {
                    loginUser($user);
                }
            }
        } else {
            $errors[] = "Błąd podczas rejestracji: " . $response->getStatusCode();
        }
    }
}

// LOGOWANIE
if (isset($_POST['login-btn'])) {
    $client = new Client('http://localhost:8080/users', ['timeout' => 30]);
    $client->setMethod(Request::METHOD_GET);
    $client->setHeaders(['Accept' => 'application/json']);
    $response = $client->send();

    if ($response->isSuccess()) {
        $data = json_decode($response->getBody(), true);
        $users = $data['_embedded']['users'] ?? [];

        foreach ($users as $u) {
            if (trim($u['username']) === trim($_POST['username'])) {
                if (password_verify($_POST['password'], $u['password'])) {
                    loginUser($u);
                }
                break;
            }
        }
        $errors[] = "Błędna Nazwa Użytkownika lub Hasło";
    } else {
        $errors[] = "Błąd logowania: " . $response->getStatusCode();
    }
}
