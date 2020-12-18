<?php

if (isset($_GET["style"])) {
    
    if (!isset($_SESSION)) {
        session_start();       
    }

    $style = $_GET["style"];
    $_SESSION["style"] = $style;
}

