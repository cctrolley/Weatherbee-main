<?php
require '..\config\db.php' ;
include '..\classes\user.php';
include '..\classes\post.php';

    $limit = 10; //Number of posts to be loaded per call
    $posts = new post($conn, $_REQUEST['userLoggedIn']);
    $posts->loadPosts($_REQUEST, $limit);
?>