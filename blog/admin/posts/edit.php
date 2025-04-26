<?php 
include_once("../../path.php"); 
require_once 'C:\Users\Morty\laminasapi\vendor\autoload.php'; 
include_once(ROOT_PATH . "/app/database/db.php");

use Laminas\Http\Client;
use Laminas\Http\Request;

// ------------------------------------------
// 1. Obsługa zmiany statusu publikacji (toggle)
// ------------------------------------------
if(isset($_GET['published']) && isset($_GET['p_id'])) {
    $postId = $_GET['p_id'];
    $newPublished = (int) $_GET['published']; // 0 lub 1

    $toggleData = [
        'published' => $newPublished
    ];

    $clientToggle = new Client('http://localhost:8080/posts/' . $postId, ['timeout' => 30]);
    $clientToggle->setMethod('PATCH');
    $clientToggle->setHeaders([
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json'
    ]);
    $clientToggle->setRawBody(json_encode($toggleData));
    $responseToggle = $clientToggle->send();

    if($responseToggle->isSuccess()){
        $_SESSION['message'] = ($newPublished === 1) ? 'Post został opublikowany' : 'Post został wycofany z publikacji';
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = 'Błąd zmiany statusu publikacji: ' . $responseToggle->getStatusCode();
        $_SESSION['type'] = 'error';
    }
    header('location: ' . BASE_URL . '/admin/posts/index.php');
    exit;
}

// ------------------------------------------
// 2. Obsługa aktualizacji posta (PATCH)
// ------------------------------------------
if(isset($_POST['update-post'])) {
    $data = [
        'title'       => $_POST['title'],
        'body'        => $_POST['body'],
        'ingredients' => $_POST['ingredients'],
        'topic_id'    => $_POST['topic_id'],
        'published'   => isset($_POST['published']) ? 1 : 0
    ];
    
    // Obsługa przesyłania plików dla zdjęcia na stronie głównej
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $uploadFileDir = '../../assets/images/';
        $dest_path = $uploadFileDir . $fileName;
        if(move_uploaded_file($fileTmpPath, $dest_path)){
            $data['image'] = $fileName;
        } else {
            $_SESSION['message'] = 'Błąd przy przesyłaniu zdjęcia na stronie głównej.';
        }
    }
    
    // Obsługa przesyłania plików dla zdjęcia w poście
    if(isset($_FILES['image_p']) && $_FILES['image_p']['error'] === UPLOAD_ERR_OK){
        $fileTmpPath = $_FILES['image_p']['tmp_name'];
        $fileName = $_FILES['image_p']['name'];
        $uploadFileDir = '../../assets/images/';
        $dest_path = $uploadFileDir . $fileName;
        if(move_uploaded_file($fileTmpPath, $dest_path)){
            $data['image_p'] = $fileName;
        } else {
            $_SESSION['message'] = 'Błąd przy przesyłaniu zdjęcia w poście.';
        }
    }
    
    $postId = $_POST['id'];
    
    $clientPatch = new Client('http://localhost:8080/posts/' . $postId, ['timeout' => 30]);
    $clientPatch->setMethod('PATCH');
    $clientPatch->setHeaders([
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json'
    ]);
    $clientPatch->setRawBody(json_encode($data));
    
    $responsePatch = $clientPatch->send();
    if($responsePatch->isSuccess()){
        $_SESSION['message'] = 'Post został zaktualizowany';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/posts/index.php');
        exit;
    } else {
        $_SESSION['message'] = 'Błąd aktualizacji: ' . $responsePatch->getStatusCode();
        $_SESSION['type'] = 'error';
        // Jeśli wystąpił błąd, ustaw identyfikator posta w $_GET, aby poniższy blok pobrał dane
        $_GET['id'] = $postId;
    }
}

// ------------------------------------------
// 3. Pobieranie danych posta (dla formularza edycji)
// ------------------------------------------
if(isset($_GET['id']) || isset($_POST['id'])) {
    $postId = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
    
    $client = new Client('http://localhost:8080/posts/' . $postId, ['timeout' => 30]);
    $client->setMethod(Request::METHOD_GET);
    $client->setHeaders(['Accept' => 'application/json']);
    $response = $client->send();
    
    if($response->isSuccess()){
        $post = json_decode($response->getBody(), true);
        $id          = $post['id'];
        $title       = $post['title'];
        $body        = $post['body'];
        $ingredients = $post['ingredients'];
        $topic_id    = $post['topic_id'];
        $published   = $post['published'];
    } else {
        $_SESSION['message'] = "Błąd podczas pobierania danych posta: " . $response->getStatusCode();
        $_SESSION['type'] = "error";
        header('location: ' . BASE_URL . '/admin/posts/index.php');
        exit;
    }
} else {
    $_SESSION['message'] = "Nie znaleziono posta do edycji.";
    $_SESSION['type'] = "error";
    header('location: ' . BASE_URL . '/admin/posts/index.php');
    exit;
}

// ------------------------------------------
// 4. Pobranie listy kategorii (topics)
// ------------------------------------------
$clientTopics = new Client('http://localhost:8080/topics', ['timeout' => 30]);
$clientTopics->setMethod(Request::METHOD_GET);
$clientTopics->setHeaders(['Accept' => 'application/json']);
$responseTopics = $clientTopics->send();
if ($responseTopics->isSuccess()) {
    $topicsData = json_decode($responseTopics->getBody(), true);
    $topics = $topicsData['_embedded']['topics'] ?? [];
} else {
    $topics = [];
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font awesome, Google fonts, CSS -->
    <script src="https://kit.fontawesome.com/9af4095257.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Lora&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Admin Section - Edit Post</title>
</head>
<body>
    
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>
    <div class="admin-wrapper">
        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Dodaj Post</a>
                <a href="index.php" class="btn btn-big">Zarządzaj Postami</a>
            </div>
            <div class="content">
                <h2 class="page-title">Edytuj Post</h2>
                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div>
                        <label>Tytuł</label>
                        <input type="text" name="title" class="text-input" value="<?php echo $title ?>">
                    </div>
                    <div>
                        <label>Treść</label>
                        <textarea name="body" id="body"><?php echo $body ?></textarea>
                    </div>
                    <div>
                        <label>Składniki</label>
                        <textarea name="ingredients" id="ingredients" class="text-input" placeholder="Wpisz składnik i naciśnij Enter"><?php echo $ingredients ?></textarea>
                    </div>
                    <div>
                        <label>Zdjęcie na stronie głównej</label>
                        <input type="file" name="image" class="text-input">
                    </div>
                    <div>
                        <label>Zdjęcie w poście</label>
                        <input type="file" name="image_p" class="text-input">
                    </div>
                    <div>
                        <label>Kategorie</label>
                        <select name="topic_id" class="text-input">
                            <option value=""></option>
                            <?php foreach ($topics as $topic): ?>
                                <option value="<?php echo $topic['id']; ?>" <?php echo (isset($topic_id) && $topic_id == $topic['id']) ? 'selected' : ''; ?>>
                                    <?php echo $topic['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="published" <?php echo (isset($published) && $published == 1) ? 'checked' : ''; ?>>
                            Publikuj
                        </label>
                    </div>
                    <div>
                        <button type="submit" name="update-post" class="btn btn-big">Zaktualizuj Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- JQuery, CKEditor, skrypty -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script src="../../assets/js/script.js"></script>
</body>
</html>