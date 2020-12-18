<?php

require_once("../autoload.php");

use Controllers\Login;

session_destroy();

$login = new Login();
$login->LogOutUser();