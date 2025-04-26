<?php 
include_once("../../path.php"); 
require_once(ROOT_PATH . "/admin/users/adminUsersController.php");
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

    <title>Admin Section - Manage Users</title>
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
                <h2 class="page-title">Zarządzanie Użytkownikami</h2>
                
                <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                <table>
                    <thead>
                        <th>N</th>
                        <th>Użytkownik</th>
                        <th>Email</th>
                        <th>Rola</th>
                        <th colspan="2">Zdarzenie</th>
                    </thead>
                    <tbody>
                        <!-- Wyświetlanie administratorów -->
                        <?php foreach ($admins as $key => $admin_users): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $admin_users['username']; ?></td>
                                <td><?php echo $admin_users['email']; ?></td>
                                <td><?php echo 'Administrator'; ?></td>
                                <td><a href="edit.php?id=<?php echo $admin_users['id']; ?>" class="edit">Edytuj</a></td>
                                <td><a href="index.php?delete_id=<?php echo $admin_users['id']; ?>" class="delete">Usuń</a></td>
                            </tr>
                        <?php endforeach; ?>

                        <!-- Wyświetlanie zwykłych użytkowników -->
                        <?php foreach ($regular_users as $key => $user): ?>
                            <tr>
                                <td><?php echo count($admins) + $key + 1; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo 'Użytkownik'; ?></td>
                                <td><a href="edit.php?id=<?php echo $user['id']; ?>"  class="edit">Edytuj</a></td>
                                <td><a href="index.php?delete_id=<?php echo $user['id']; ?>" class="delete">Usuń</a></td>
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