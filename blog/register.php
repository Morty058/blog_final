<?php 
require 'C:\Users\Morty\laminasapi\vendor\autoload.php';

include("path.php");
include(ROOT_PATH . "/app/controllers/users.php"); 
guestsOnly();
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

    <title>Register</title>
</head>
<body>
    
    <?php include(ROOT_PATH . "/app/includes/registerHeader.php"); ?>

    <div class="auth-content">
        <form action="register.php" method="post">
            <h2 class="form-title">Zarejestruj się</h2>

            <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

            <div>
                <label>Nazwa Użytkownika</label>
                <input type="text" name="username" value="<?php echo $username; ?>" id="" class="text-input">
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>" id="" class="text-input">
            </div>

            <div>
                <label>Hasło</label>
                <input type="password" name="password" value="<?php echo $password; ?>" id="" class="text-input">
            </div>

            <div>
                <label>Potwierdź Hasło</label>
                <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" id="" class="text-input">
            </div>

            <div>
                <button type="submit" name="register-btn" class="btn btn-big">Zarejestruj się</button>
            </div>

            <p>lub <a href="<?php echo BASE_URL . '/login.php' ?>">Zaloguj się</a></p>

        </form>
    </div>
    

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Utworzony skrypt -->
    <script src="assets/js/script.js"></script>
</body>
</html>