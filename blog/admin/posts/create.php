<?php 
include_once("../../path.php"); 
require_once 'C:\Users\Morty\laminasapi\vendor\autoload.php'; 
include_once(ROOT_PATH . "/app/database/db.php");

use Laminas\Http\Client;
use Laminas\Http\Request;

// Obsługa tworzenia posta – gdy formularz został wysłany
if(isset($_POST['add-post'])) {
    // Przygotuj dane z formularza
    $data = [
        'title'       => $_POST['title'],
        'body'        => $_POST['body'],
        'ingredients' => $_POST['ingredients'],
        'topic_id'    => $_POST['topic_id'],
        'published'   => isset($_POST['published']) ? 1 : 0,
        'user_id'     => $_SESSION['id'] 
    ];
    
    // Obsługa przesyłania plików:
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
    
    // Utwórz klienta i wysyłaj żądanie POST do API
    $clientPost = new Client('http://localhost:8080/posts', ['timeout' => 30]);
    $clientPost->setMethod(Request::METHOD_POST);
    $clientPost->setHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ]);
    $clientPost->setRawBody(json_encode($data));
    
    $response = $clientPost->send();
    if($response->isSuccess()){
        $_SESSION['message'] = 'Post został dodany';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/posts/index.php');
        exit;
    } else {
        $_SESSION['message'] = 'Błąd przy dodawaniu posta: ' . $response->getStatusCode();
        $_SESSION['type'] = 'error';
        // Możesz dodać dodatkowe debugowanie, np. var_dump($response->getBody());
    }
}

// Inicjalizacja pustych zmiennych do formularza (aby uniknąć ostrzeżeń)
$title = '';
$body = '';
$ingredients = '';
$topic_id = '';
$published = 0;

// Pobierz listę kategorii (topics) – aby wypełnić listę rozwijaną
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
   
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/9af4095257.js" crossorigin="anonymous"></script>
   
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Lora&family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/style.css">

    <link rel="stylesheet" href="../../assets/css/admin.css">

    <title>Admin Section - Add Posts</title>
</head>
<body>
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

    <!-- Admin Page Wrapper -->

    <div class="admin-wrapper">

        <!-- Left Sidebar -->
        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
        <!-- // Left Sidebar -->
        

        <!-- Admin Content -->
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Dodaj Post</a>
                <a href="index.php" class="btn btn-big">Zarządzaj Postami</a>
            </div>

            <div class="content">
                <h2 class="page-title">Dodaj Post</h2>

                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                <form action="create.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label>Tytuł</label>
                        <input type="text" value="<?php echo $title ?>" name="title" class="text-input">
                    </div>

                    <div>
                        <label>Treść</label>
                        <textarea name="body" id="body"><?php echo $body ?></textarea>
                    </div>

                    <div>
                        <label>Składniki</label>
                        <textarea id="ingredients" class="text-input" name="ingredients" placeholder="Wpisz składnik i naciśnij Enter"></textarea>
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
                            <?php foreach ($topics as $key => $topic): ?>
                                <?php if(!empty($topic_id) && $topic_id == $topic['id']): ?>
                                    <option selected value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                <?php endif; ?>    
                            <?php endforeach; ?>        
                        </select>
                    </div>

                    <div>
                        <?php if(empty($published)): ?>
                            <label>
                                <input type="checkbox" name="published">
                                Publikuj
                            </label>
                        <?php else: ?>
                            <label>
                                <input type="checkbox" name="published" checked>
                                Publikuj
                            </label>
                        <?php endif; ?>
                        
                    </div>

                    <div>
                        <button type="submit" name="add-post" class="btn btn-big">Dodaj Post</button>
                    </div>

                </form>

            </div>


        </div>
        <!-- // Admin Content -->

    </div>

    <!-- // Admin Page Wrapper -->
         

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- CKeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    <!-- Utworzony skrypt -->
    <script src="../../assets/js/script.js"></script>
</body>
</html>