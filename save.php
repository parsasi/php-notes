<?php
    session_start();
    require_once('helpers/auth.php');
    $auth = new Auth();
    $currentUser = $auth->authenticate($_SESSION);

    var_dump($_FILES);