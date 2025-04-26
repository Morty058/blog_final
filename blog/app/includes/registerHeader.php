<header>

        <div class="logo">
            <a href="<?php echo BASE_URL . '/index.php' ?>"><h1 class="logo-text"><span>Podróż</span>Smaków</h1></a>
        </div>
        
        <i class="fa fa-bars menu-toggle"></i>
        
        <ul class="nav">
            <li><a href="<?php echo BASE_URL . '/index.php' ?>">Strona główna</a></li>
            
            <?php if(isset($_SESSION['id'])): ?>

            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <?php if($_SESSION['admin']): ?>
                    <li><a href="<?php echo BASE_URL . '/admin/dashboard.php' ?>">Panel administratora</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Wyloguj się &nbsp;<i class="fas fa-sign-out"></i></a></li>
                </ul>
            </li>
            
            <?php else: ?>
                <li><a href="<?php echo BASE_URL . '/register.php' ?>">Załóż konto</a></li>
                <li><a href="<?php echo BASE_URL . '/login.php' ?>">Zaloguj się</a></li>
            <?php endif; ?>

        </ul>
    </header>


    