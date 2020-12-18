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
?>

<body id="Continent" usemap="#planetmap">
    <div class="dropdown">
        <button class="dropbtn">Level</button>
        <div class="dropdown-content">
            <a id="izbor1" href="/Maturski/handlers/set-numbers.php?continent=<?php echo ($_GET['continent']); ?>&level=1">Level 1</a>
            <a id="izbor2" href="/Maturski/handlers/set-numbers.php?continent=<?php echo ($_GET['continent']); ?>&level=2">Level 2</a>
            <a id="izbor3" href="/Maturski/handlers/set-numbers.php?continent=<?php echo ($_GET['continent']); ?>&level=3">Level 3</a>
            <a id="izbor4" href="/Maturski/handlers/set-numbers.php?continent=<?php echo ($_GET['continent']); ?>&level=4">Level 4</a>
        </div>
    </div>




    <script>
        var continent = "<?php echo ($_GET['continent']) ?>";
        switch (continent) {
            case "1":
                $.post("/Maturski/handlers/user-level-ord.php", {
                    a: 1
                }, function(data, status) {
                    if (parseInt(data) > 4) {
                        $('#Continent').css("background-image", "url(/Maturski/images/1-0.jpg)");
                    } else
                        $('#Continent').css("background-image", "url(/Maturski/images/1-" + String(data % 4) + ".jpg)");
                    switch (parseInt(data) % 4) {
                        case 1:
                            $('#izbor2').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor2').css("border", "0");
                            $('#izbor3').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor3').css("border", "0");
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor2').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor3').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                            break;
                        case 2:
                            $('#izbor3').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor3').css("border", "0");
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor3').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                        case 3:
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                            break;
                    }
                });
                break;
            case "2":
                $.post("/Maturski/handlers/user-level-ord.php", {
                    a: 1
                }, function(data, status) {
                    if (parseInt(data) > 8) {
                        $('#Continent').css("background-image", "url(/Maturski/images/2-0.jpg)");
                    } else
                        $('#Continent').css("background-image", "url(/Maturski/images/2-" + String(data % 4) + ".jpg)");
                    switch (parseInt(data) % 4) {
                        case 1:
                            $('#izbor2').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor2').css("border", "0");
                            $('#izbor3').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor3').css("border", "0");
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor2').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor3').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                            break;
                        case 2:
                            $('#izbor3').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor3').css("border", "0");
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor3').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                        case 3:
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                            break;
                    }
                });
                break;
            case "3":
                $.post("/Maturski/handlers/user-level-ord.php", {
                    a: 1
                }, function(data, status) {
                    if (parseInt(data) > 12) {
                        $('#Continent').css("background-image", "url(/Maturski/images/3-0.jpg)");
                    } else
                        $('#Continent').css("background-image", "url(/Maturski/images/3-" + String(data % 4) + ".jpg)");
                    switch (parseInt(data) % 4) {
                        case 1:
                            $('#izbor2').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor2').css("border", "0");
                            $('#izbor3').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor3').css("border", "0");
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor2').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor3').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                            break;
                        case 2:
                            $('#izbor3').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor3').css("border", "0");
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor3').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                        case 3:
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                            break;
                    }
                });
                break;
            case "4":
                $.post("/Maturski/handlers/user-level-ord.php", {
                    a: 1
                }, function(data, status) {
                    $('#Continent').css("background-image", "url(/Maturski/images/4-" + String(data % 4) + ".jpg)");
                    switch (parseInt(data) % 4) {
                        case 1:
                            $('#izbor2').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor2').css("border", "0");
                            $('#izbor3').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor3').css("border", "0");
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor2').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor3').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                            break;
                        case 2:
                            $('#izbor3').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor3').css("border", "0");
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor3').on("click", function(e) {
                                e.preventDefault();
                            });
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                        case 3:
                            $('#izbor4').css("background-color", "rgba(172, 181, 174,0.5)");
                            $('#izbor4').css("border", "0");
                            $('#izbor4').on("click", function(e) {
                                e.preventDefault();
                            });
                            break;
                    }
                });
                break;
            default:
                break;
        }
    </script>
</body>