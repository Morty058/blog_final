<?php
require 'C:\Users\Morty\laminasapi\vendor\autoload.php';
include("path.php"); 
include_once(ROOT_PATH . "/app/database/db.php"); 

if (isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]); 
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

    <link rel="stylesheet" href="assets/css/style.css">

    <title><?php echo $post['title']; ?> | PodróżSmaków</title>
</head>
<body>
    
        <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

        <!-- Content -->
        <div class="content clearfix">

            <!-- Main Contnet -->
            <div class="main-content-wrapper">
                <div class="main-content single">
                <h2 class="post-title"><?php echo $post['title']; ?></h2>
                    <hr>

                    <div class="post-content">
                        <h3>PRZYGOTOWANIE</h3>

                        <?php echo html_entity_decode($post['body']); ?>
                    
                    </div>  
                
                    <div class="imgplace">
                        <img src="<?php echo BASE_URL . '/assets/images/' . $post['image_p']; ?>" class="image-single">
                    </div>

                </div>
            </div>
            
            <!-- //Main Content -->
            <div class="sidebar">

                <div class="section ingredients">
                    <h3 class="section-title">SKŁADNIKI</h3>
                    
                    <ul>
                        <?php
                       $ingredientsArray = !empty($post['ingredients']) ? explode("\n", $post['ingredients']) : [];
                        
                        foreach ($ingredientsArray as $ingredient):
                            // Sprawdź, czy linia składnika jest pusta
                            if (!empty(trim($ingredient))):
                        ?>
                                <li><?php echo trim($ingredient); ?></li>
                        <?php
                            else:
                                // Jeśli linia składnika jest pusta, dodaj pustą przerwę w liście HTML
                        ?>
                                <br>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </ul>
                </div>

            </div>
    
        </div>
        <!-- //Content -->

    <!-- Footer -->
    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
    <!-- //Footer -->

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Utworzony skrypt -->
    <script src="assets/js/script.js"></script>
</body>
</html>