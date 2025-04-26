<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
adminOnly();
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

    <title>Admin Section - Add Users</title>
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
                <a href="create.php" class="btn btn-big">Dodaj Użytkownika</a>
                <a href="index.php" class="btn btn-big">Zarządzaj Użytkownikami</a>
            </div>

            <div class="content">
                <h2 class="page-title">Dodaj Użytkownika</h2>

                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                <form action="create.php" method="post">

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
                        <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
                    </div>
               
                    <div>
                        <label>Potwierdź Hasło</label>
                        <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text-input">
                    </div>

                    <div>
                        <?php if(isset($admin) && $admin == 1): ?>
                            <label>
                                <input type="checkbox" name="admin" checked>
                                Admin
                            </label>
                        <?php else: ?>
                            <label>
                                <input type="checkbox" name="admin">
                                Admin
                            </label>
                        <?php endif; ?>
                    </div>

                    <div>
                        <button type="submit" name="create-admin" class="btn btn-big">Dodaj Użytkownika</button>
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