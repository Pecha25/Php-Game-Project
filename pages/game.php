<?php
include "../utilities/header.php";

$level = $_GET['level'];
$continent = $_GET['continent'];
?>

<script>
    document.addEventListener('keyup', logKey);

    function logKey(e) {
        Map.MovePlayer(e.keyCode);
    }

    function loadPage() {
        $(".next-level").hide();
        Map.Init(<?php echo $continent . "," . $level ?>);
        Map.MovePlayer();
    }
</script>

<body onload="loadPage()">
    <div id="game-map">
    </div>

    <div class="end-level">
        <div class="end-message">
        </div>
        <div class="end-btn">
        </div>
    </div>

    <div class="next-level">
        <div class="next-message">
            Congratulations, you won!
        </div>
        <a class="next-btn" href="">
            Next level
        </a>
    </div>