<?php
session_start();
define('SECURE_CHECK', TRUE);

include 'config.php';

unset($_SESSION['user_name'], $_SESSION['password']);

header('Location:'.SITE_URL);