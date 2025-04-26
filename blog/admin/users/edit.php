<?php 
include_once("../../path.php"); 
require_once 'C:\Users\Morty\laminasapi\vendor\autoload.php'; 
include_once(ROOT_PATH . "/app/database/db.php");

use Laminas\Http\Client;
use Laminas\Http\Request;

$errors = [];
$username = '';
$email = '';
$password = '';
$passwordConf = '';
$admin = 0;
$id = '';

// --- Obsługa aktualizacji użytkownika ---
if (isset($_POST['update-user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    // Walidacja
    if (empty($username)) {
        $errors[] = "Nazwa użytkownika jest wymagana";
    }
    if (empty($email)) {
        $errors[] = "Email jest wymagany";
    }
    if (!empty($password) || !empty($passwordConf)) {
        if ($password !== $passwordConf) {
            $errors[] = "Hasła nie są identyczne";
        }
    }
    
    if (count($errors) === 0) {
        // Dane do aktualizacji
        $data = [
            'username' => $username,
            'email' => $email,
            'admin' => $admin,
        ];
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // PUT do API
        $client = new Client('http://localhost:8080/users/' . $id, ['timeout' => 30]);
        $client->setMethod(Request::METHOD_PUT);
        $client->setEncType('application/json');
        $client->setHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);
        $client->setRawBody(json_encode($data));
        $response = $client->send();

        if ($response->isSuccess()) {
            $_SESSION['message'] = "Dane użytkownika zostały zaktualizowane";
            $_SESSION['type'] = "success";
            header('location: ' . BASE_URL . '/admin/users/index.php');
            exit();
        } else {
            $responseBody = $response->getBody();
            $errors[] = "Błąd podczas aktualizacji użytkownika: " . $response->getStatusCode() . " - " . $responseBody;
        }
    }

} elseif (isset($_GET['id'])) {
    // --- Pobieranie danych użytkownika do formularza edycji ---
    $userId = $_GET['id'];
    $client = new Client('http://localhost:8080/users/' . $userId, ['timeout' => 30]);
    $client->setMethod(Request::METHOD_GET);
    $client->setHeaders(['Accept' => 'application/json']);
    $response = $client->send();
    
    if ($response->isSuccess()) {
        $user = json_decode($response->getBody(), true);
        $id = $user['id'];
        $username = $user['username'];
        $email = $user['email'];
        $admin = $user['admin'];
        $password = '';
        $passwordConf = '';
    } else {
        $_SESSION['message'] = "Nie udało się pobrać użytkownika: " . $response->getStatusCode();
        $_SESSION['type'] = "error";
        header('location: ' . BASE_URL . '/admin/users/index.php');
        exit();
    }
} else {
    $_SESSION['message'] = "Nie znaleziono użytkownika do edycji.";
    $_SESSION['type'] = "error";
    header('location: ' . BASE_URL . '/admin/users/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/9af4095257.js" crossorigin="anonymous"></script>
    
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Lora&family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">

    <title>Admin Section - Edit User</title>
</head>
<body>
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>
    <div class="admin-wrapper">
        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Dodaj Użytkownika</a>
                <a href="index.php" class="btn btn-big">Zarządzaj Użytkownikami</a>
            </div>
            <div class="content">
                <h2 class="page-title">Edytuj Użytkownika</h2>
                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
                <form action="edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div>
                        <label>Nazwa Użytkownika</label>
                        <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
                    </div>
                    <div>
                        <label>Hasło</label>
                        <input type="password" name="password" class="text-input">
                    </div>
                    <div>
                        <label>Potwierdź Hasło</label>
                        <input type="password" name="passwordConf" class="text-input">
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="admin" <?php echo $admin ? 'checked' : ''; ?>>
                            Admin
                        </label>
                    </div>
                    <div>
                        <button type="submit" name="update-user" class="btn btn-big">Zaktualizuj Użytkownika</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script src="../../assets/js/script.js"></script>
</body>
</html>
