<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(dirname(__FILE__)));
}
if (!defined('BASE_URL')) {
    define('BASE_URL', "http://localhost/blog");
}