<?php
// adminPostsController.php
include("../../path.php");

require_once 'C:\Users\Morty\laminasapi\vendor\autoload.php';

include_once(ROOT_PATH . "/app/database/db.php");

use Laminas\Http\Client;
use Laminas\Http\Request;

$clientPosts = new Client('http://localhost:8080/posts', ['timeout' => 30]);
$clientPosts->setMethod(Request::METHOD_GET);
$clientPosts->setHeaders([
    'Accept' => 'application/json'
]);
$responsePosts = $clientPosts->send();

if ($responsePosts->isSuccess()) {
    $data = json_decode($responsePosts->getBody(), true);
    $posts = isset($data['_embedded']['posts']) ? $data['_embedded']['posts'] : [];
} else {
    $posts = [];
}
?>