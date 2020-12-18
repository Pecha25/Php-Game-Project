<?php
if (!isset($_SESSION)) {
    session_start();
}
echo ($_SESSION['style']);
