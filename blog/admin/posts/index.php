<?php 
include_once("../../path.php"); 
require_once 'C:\Users\Morty\laminasapi\vendor\autoload.php'; 
include_once(ROOT_PATH . "/app/database/db.php");

use Laminas\Http\Client;
use Laminas\Http\Request;

// Obsługa usuwania posta – jeśli w URL przekazano delete_id
if(isset($_GET['delete_id'])) {
    $postId = $_GET['delete_id'];
    $clientDelete = new Client('http://localhost:8080/posts/' . $postId, ['timeout' => 30]);
    $clientDelete->setMethod(Request::METHOD_DELETE);
    $responseDelete = $clientDelete->send();
    
    if($responseDelete->isSuccess()){
        $_SESSION['message'] = 'Post został usunięty';
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = 'Błąd przy usuwaniu posta: ' . $responseDelete->getStatusCode();
        $_SESSION['type'] = 'error';
    }
    header('location: ' . BASE_URL . '/admin/posts/index.php');
    exit;
}

// Poniżej wczytaj kontroler postów, aby wyświetlić listę
include(ROOT_PATH . "/admin/posts/adminPostsController.php");
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

    <title>Admin Section - Manage Posts</title>
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
                <h2 class="page-title">Zarządzanie Postami</h2>

                <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                <table>
                    <thead>
                        <th>N</th>
                        <th>Tytuł</th>
                        <th>Autor</th>
                        <th colspan="3">Zdarzenie</th>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $key => $post): ?>
                            <tr>
                                <td><?php echo ((int)$key) + 1; ?></td>
                                <td><?php echo $post['title'] ?></td>
                                <td>Admin</td>
                                <td><a href="edit.php?id=<?php echo $post['id']; ?>" class="edit">Edytuj</a></td>
                                <td><a href="index.php?delete_id=<?php echo $post['id']; ?>" class="delete">Usuń</a></td>
                                
                                <?php if($post['published']): ?>
                                    <td><a href="edit.php?published=0&p_id=<?php echo $post['id'] ?>" class="unpublish">Anuluj publikację</a></td>
                                <?php else: ?>
                                    <td><a href="edit.php?published=1&p_id=<?php echo $post['id'] ?>" class="publish">Publikuj</a></td>
                                <?php endif; ?>  
                            </tr>
                        <?php endforeach; ?>        
                    
                    </tbody>
                </table>

            </div>


        </div>
        <!-- // Admin Content -->

    </div>

    <!-- // Admin Page Wrapper -->
         

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Utworzony skrypt -->
    <script src="../../assets/js/script.js"></script>
</body>
</html>