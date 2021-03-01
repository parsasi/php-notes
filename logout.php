<?php
    session_start();
    require_once('helpers/auth.php');
    $auth = new Auth();
    $auth->logout();