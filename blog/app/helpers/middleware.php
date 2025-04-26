<?php

function usersOnly($redirect = '/index.php')
{
    if(empty($_SESSION['id'])) {
        $_SESSION['message'] = 'Musisz się zalogować';
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . $redirect);
        exit(0);
    }
}

function adminOnly($redirect = '/index.php')
{
    if (empty($_SESSION['id']) || !isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
        $_SESSION['message'] = 'Nie posiadasz uprawnień administratora';
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . $redirect);
        exit(0);
    }
}

function guestsOnly($redirect = '/index.php') 
{
    if(isset($_SESSION['id'])) { 
        header('location: ' . BASE_URL . $redirect);
        exit(0);
    }
}