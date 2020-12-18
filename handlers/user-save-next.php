<?php

namespace Handlers;

require_once("../autoload.php");

use Controllers\User;
use Controllers\Level;

if (!isset($_SESSION)) {
    session_start();
}
$level = new Level($_SESSION['level']);
$user = new User($_SESSION['user_id']);

if ($level->id == 16) {
    if ($user->level_id == 16) {
        $next_level = 0;
        $next_continent = 0;

        $level_continent = array(
            "level" => $next_level,
            "continent" => $next_continent,
        );

        die(json_encode($level_continent));
    } else {
        $user->SaveLevel();
        $next_level = 0;
        $next_continent = 0;

        $level_continent = array(
            "level" => $next_level,
            "continent" => $next_continent,
        );

        die(json_encode($level_continent));
    }
} else {

    if ($user->level_id == $level->id) {
        $user->SaveLevel();
        $next_level = $level->GiveNextORD();
        $next_continent = $user->GetContinentORD();
    } else {
        $next_level = $level->GiveNextORD();
        $next_continent = $level->GetNextContinentORD();
    }


    $level_continent = array(
        "level" => $next_level,
        "continent" => $next_continent,
    );

    die(json_encode($level_continent));
}
