<?php

require_once("../autoload.php");

use \Controllers\Level;

if (!isset($_SESSION)) {
    session_start();
}

$level = new Level($_GET['level']);

$_SESSION['world'] = $_GET['continent'];
$_SESSION['level'] = $level->id;

header("Location: /Maturski/pages/game.php?continent=" . $_SESSION['world']. "&level=".$_SESSION['level']);
