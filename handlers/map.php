<?php

require_once("../autoload.php");

use \Controllers\Map;

$map = new Map();

if (isset($_GET['world']) && isset($_GET['level'])) {
    if (!isset($_SESSION)) {
        session_start();       
    }
    $matrix = $map->loadSource($_GET['world'], $_GET['level']);    
    die(json_encode($matrix));
}

if (isset($_GET['action']) && $_GET['action'] == "get-robot-path" && isset($_GET['x']) && isset($_GET['y']))
{
    if (!isset($_SESSION)) {
        session_start();
    }    
    $data = $map->calculateDirections($_GET['x'], $_GET['y']);
    $arr = array();
    foreach($data as $item) {
        array_push($arr, $item);
    }
    $speed = $map->getSpeed();
    $data = array("directions" => $arr, "speed" => $speed);
    die(json_encode($data));
}


