<?php

namespace Handlers;

require_once("../autoload.php");

use Controllers\User;
if(!isset($_SESSION))
{
    session_start();
}
$user = new User($_SESSION['user_id']);
$ord = $user->GetLevelOrd();
echo ($ord);