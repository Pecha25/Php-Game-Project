<?php

namespace Handlers;


require_once("../autoload.php");

use Controllers\Login;

$login = new Login();
$login->LoginUser($_POST['username'], $_POST['password']);
