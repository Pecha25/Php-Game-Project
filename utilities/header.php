<?php


require_once("../autoload.php");

use \Controllers\User;

if (!isset($_SESSION)) {
    session_start();
}
$user = new User($_SESSION['user_id']);
?>

<head>
    <script src="/Maturski/assets/js/map.js"></script>
    <link type="text/css" rel="stylesheet" href="/Maturski/assets/css/styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Pangolin&display=swap" rel="stylesheet">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>


<script>
    function ChangeCSS() {
        $.post("/Maturski/handlers/style-give.php", {
                a: 1
            },
            function(data, status) {

                if (parseInt(data) == 0) {
                    $.ajax({
                        url: "/Maturski/handlers/style-get.php?style=1",
                        type: "GET",
                        success: function(data) {
                            $(".field").css("background-image", "url(/Maturski/images/grass.gif)");
                            $("#robot-div").css("background-image", "url(/Maturski/images/tobor.gif)");
                            $("#player-div").css("background-image", "url(/Maturski/images/avatar.jpg)");
                            $(".exit").css("background-image", "url(/Maturski/images/exit.gif)");
                            $(".blocked").css("background-image", "url(/Maturski/images/fire.gif)");
                        },
                        error: function(data) {}
                    });
                } else {
                    $.ajax({
                        url: "/Maturski/handlers/style-get.php?style=0",
                        type: "GET",
                        success: function(data) {
                            $(".field").css("background-image", "url(/Maturski/images/field.jpg)");
                            $("#robot-div").css("background-image", "url(/Maturski/images/robot.png)");
                            $("#player-div").css("background-image", "url(/Maturski/images/player.png)");
                            $(".exit").css("background-image", "url(/Maturski/images/exit.jpg)");
                            $(".blocked").css("background-image", "url(/Maturski/images/blocked.jpg)");
                        },
                        error: function(data) {}
                    });
                }
            });

    }
</script>


<header id="heder-ceo">
    <a class="header-element header-image" href="/Maturski/pages/world.php">
        &nbsp;
    </a>

    <div class="header-element" id="target">
        User: <?php echo (ucfirst($user->username)); ?>
    </div>

    <div class="header-element">
        Score so far: <?php echo ($user->score); ?>
    </div>

    <div class="header-element">
        Current rank: <?php echo ($user->GetRank()); ?>
    </div>

    <div class="header-element">
        <a href="../handlers/logout.php">Log out</a>
    </div>

    <div class="header-element" id="extra" onclick="ChangeCSS()">
        OG
    </div>
</header>


<script>
    $("#extra").hide();

    $.post("/Maturski/handlers/user-level-id.php", {
        a: 1
    }, function(data, status) {
        if (parseInt(data) == 16) {
            $('#extra').show();
        }
    });
</script>