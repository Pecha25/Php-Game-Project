<?php
include "../utilities/header.php";
?>

<head>
    <link type="text/css" rel="stylesheet" href="/Maturski/assets/css/styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Pangolin&display=swap" rel="stylesheet">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

</head>

<?php


require_once("../autoload.php");

use \Controllers\User;

if (!isset($_SESSION)) {
    session_start();
}
$user = new User($_SESSION['user_id']);

$_SESSION['user_rank'] = $user->GetRank();
?>


<body id="World">

    <button type="button" id="Akilian-button" class="world-button" onclick="location.href='/Maturski/pages/continent.php?continent=1'">Survive</button>
    <button type="button" id="Escaron-button" class="world-button" onclick="location.href='/Maturski/pages/continent.php?continent=2'">Survive</button>
    <button type="button" id="Wamba-button" class="world-button" onclick="location.href='/Maturski/pages/continent.php?continent=3'">Survive</button>
    <button type="button" id="Xzion-button" class="world-button" onclick="location.href='/Maturski/pages/continent.php?continent=4'">Survive</button>
    <script>
        $.post("/Maturski/handlers/user-rank.php", {
            a: 1
        }, function(data, status) {
            switch (data) {
                case "1":
                    $('#World').css("background-image", "url(/Maturski/images/1.jpg)");
                    document.getElementById("Escaron-button").style.display = "none";
                    document.getElementById("Wamba-button").style.display = "none";
                    document.getElementById("Xzion-button").style.display = "none";
                    break;
                case "2":
                    $('#World').css("background-image", "url(/Maturski/images/2.jpg)");
                    document.getElementById("Wamba-button").style.display = "none";
                    document.getElementById("Xzion-button").style.display = "none";
                    break;
                case "3":
                    $('#World').css("background-image", "url(/Maturski/images/3.jpg)");
                    document.getElementById("Xzion-button").style.display = "none";
                    break;
                case "4":
                    $('#World').css("background-image", "url(/Maturski/images/4.jpg)");
                    break;
                default:
                    break;
            }
        });
    </script>
</body>