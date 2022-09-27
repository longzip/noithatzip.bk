<?php
 
 

unset($_SESSION['user_name'], $_SESSION['password']);

header('Location:'.SITE_URL);