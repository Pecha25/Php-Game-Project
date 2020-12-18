var Map = {

    Init: function (continent, level) {
        window['GetData'] = this.GetData;
        window['moveRobot'] = this.MoveRobot;

        $(".end-level").hide();

        var fieldDimension;

        switch (continent) {
            case 1:
                limit = 8;
                fieldDimension = 80;
                break;
            case 2:
                limit = 10;
                fieldDimension = 70;
                break;
            case 3:
                limit = 12;
                fieldDimension = 55;
                break;
            case 4:
                limit = 14;
                fieldDimension = 50;
                break;
        }

        var dimension = limit * fieldDimension + 'px';
        $("#game-map").height(dimension);
        $("#game-map").width(dimension);
        for (var i = 0; i < limit; i++) {
            for (var j = 0; j < limit; j++) {
                var div = "<div class='field' id='" + i + "-" + j + "' ></div>";
                $("#game-map").append(div);
            }
        }
        $(".field").height(fieldDimension + 'px');
        $(".field").width(fieldDimension + 'px');

        window.GetData(continent, level);
    },

    GetData: function (continent, level) {
        $.ajax({
            url: "/Maturski/handlers/map.php?world=" + continent + "&level=" + level,
            type: "GET",
            // data: postData,
            success: function (data) {

                switch (continent) {
                    case 1:
                        limit = 8;
                        break;
                    case 2:
                        limit = 10;
                        break;
                    case 3:
                        limit = 12;
                        break;
                    case 4:
                        limit = 14;
                        break;
                }

                var fields = JSON.parse(data);

                var matrix = [];
                for (var i = 0; i < limit; i++) {
                    matrix[i] = [];
                    for (var j = 0; j < limit; j++) {
                        matrix[i][j] = undefined;
                    }
                }
                var col = 0;
                var row = 0;

                for (i = 0; i < fields.length; i++) {
                    if (col == limit) {
                        col = 0;
                        row++;
                    }
                    matrix[row][col] = +fields[i];
                    col++;
                }

                for (i = 0; i < limit; i++) {
                    for (j = 0; j < limit; j++) {
                        switch (matrix[i][j]) {
                            case 1:
                                var identifier = "#" + i + "-" + j;
                                $(identifier).addClass("blocked");
                                break;
                            case 2:
                                var robotDiv = "<div id='robot-div'></div>";
                                var startDiv = "#" + i + "-" + j;
                                $(startDiv).append(robotDiv);
                                break;
                            case 3:
                                var playerDiv = "<div id='player-div'></div>";
                                $("#" + i + "-" + j).append(playerDiv);
                                break;
                            case 4:
                                $("#" + i + "-" + j).addClass("exit");
                                break;
                        }
                    }
                }
                window.moveRobot();
            },
            error: function (data) { }
        });
    },

    MoveRobot: function () {

        var x = $("#robot-div").parent().attr('id').split("-")[0];
        var y = $("#robot-div").parent().attr('id').split("-")[1];
        var req = "/Maturski/handlers/map.php?action=get-robot-path&x=" + x + "&y=" + y;
        $.ajax({
            url: req,
            type: "GET",
            success: function (data) {
                var data = JSON.parse(data);
                var path = data.directions;
                var counter = 0;
                var looper = setInterval(function () {
                    if (counter == path.length - 1) {
                        clearInterval(looper);
                    }
                    switch (path[counter]) {
                        case "DESNO":
                            var x = +$("#robot-div").parent().attr('id').split("-")[0];
                            var y = +$("#robot-div").parent().attr('id').split("-")[1];
                            var yy = y + 1;
                            var newDiv = "#" + x + "-" + yy;
                            var oldDiv = "#" + x + "-" + y;
                            var robot = $(oldDiv).find("#robot-div");
                            /*if ($(newDiv).find("#player-div").length > 0) {
                                counter--;
                                break;
                            }*/
                            if ($(newDiv).find("#player-div").length > 0) {
                                $("#player-div").hide("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                                $(oldDiv).html();
                                $(newDiv).append(robot);
                                setTimeout(() => {
                                    $("#game-map").hide("slow");
                                    $(".end-btn").text("Try again");
                                    $(".end-btn").click(function () {
                                        location.reload();
                                    });
                                    $(".end-message").text("Robot ate you!");
                                    $(".end-level").show("slow");
                                }, 500);
                                break;
                            }
                            if ($(newDiv).hasClass('exit')) {
                                $(oldDiv).html();
                                $(newDiv).append(robot);
                                document.querySelector('#player-div').removeAttribute('id');
                                setTimeout(() => {
                                    $("#game-map").hide("slow");
                                    $(".end-btn").text("Try again");
                                    $(".end-btn").click(function () {
                                        location.reload();
                                    });
                                    $(".end-message").text("Robot won!");
                                    $(".end-level").show("slow");
                                }, 500);

                                break;
                            }
                            $(oldDiv).html();
                            $(newDiv).append(robot);
                            break;
                        case "DOLE":
                            var x = +$("#robot-div").parent().attr('id').split("-")[0];
                            var y = +$("#robot-div").parent().attr('id').split("-")[1];
                            var xx = x + 1;
                            var newDiv = "#" + xx + "-" + y;
                            var oldDiv = "#" + x + "-" + y;
                            var robot = $(oldDiv).find("#robot-div");
                            /*if ($(newDiv).find("#player-div").length > 0) {
                                counter--;
                                break;
                            }*/
                            if ($(newDiv).find("#player-div").length > 0) {
                                $("#player-div").hide("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                                $(oldDiv).html();
                                $(newDiv).append(robot);
                                setTimeout(() => {
                                    $("#game-map").hide("slow");
                                    $(".end-btn").text("Try again");
                                    $(".end-btn").click(function () {
                                        location.reload();
                                    });
                                    $(".end-message").text("Robot ate you!");
                                    $(".end-level").show("slow");
                                }, 500);
                                break;
                            }
                            if ($(newDiv).hasClass('exit')) {
                                $(oldDiv).html();
                                $(newDiv).append(robot);
                                document.querySelector('#player-div').removeAttribute('id');
                                setTimeout(() => {
                                    $("#game-map").hide("slow");
                                    $(".end-btn").text("Try again");
                                    $(".end-btn").click(function () {
                                        location.reload();
                                    });
                                    $(".end-message").text("Robot won!");
                                    $(".end-level").show("slow");
                                }, 500);

                                break;
                            }
                            $(oldDiv).html();
                            $(newDiv).append(robot);
                            break;
                        case "LEVO":
                            var x = +$("#robot-div").parent().attr('id').split("-")[0];
                            var y = +$("#robot-div").parent().attr('id').split("-")[1];
                            var yy = y - 1;
                            var newDiv = "#" + x + "-" + yy;
                            var oldDiv = "#" + x + "-" + y;
                            var robot = $(oldDiv).find("#robot-div");
                            /*if ($(newDiv).find("#player-div").length > 0) {
                                counter--;
                                break;
                            }*/
                            if ($(newDiv).find("#player-div").length > 0) {
                                $("#player-div").hide("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                                $(oldDiv).html();
                                $(newDiv).append(robot);
                                setTimeout(() => {
                                    $("#game-map").hide("slow");
                                    $(".end-btn").text("Try again");
                                    $(".end-btn").click(function () {
                                        location.reload();
                                    });
                                    $(".end-message").text("Robot ate you!");
                                    $(".end-level").show("slow");
                                }, 500);
                                break;
                            }
                            if ($(newDiv).hasClass('exit')) {
                                $(oldDiv).html();
                                $(newDiv).append(robot);
                                document.querySelector('#player-div').removeAttribute('id');
                                setTimeout(() => {
                                    $("#game-map").hide("slow");
                                    $(".end-btn").text("Try again");
                                    $(".end-btn").click(function () {
                                        location.reload();
                                    });
                                    $(".end-message").text("Robot won!");
                                    $(".end-level").show("slow");
                                }, 500);

                                break;
                            }
                            $(oldDiv).html();
                            $(newDiv).append(robot);
                            break;
                        case "GORE":
                            var x = +$("#robot-div").parent().attr('id').split("-")[0];
                            var y = +$("#robot-div").parent().attr('id').split("-")[1];
                            var xx = x - 1;
                            var newDiv = "#" + xx + "-" + y;
                            var oldDiv = "#" + x + "-" + y;
                            var robot = $(oldDiv).find("#robot-div");
                            /*if ($(newDiv).find("#player-div").length > 0) {
                                counter--;
                                break;
                            }*/
                            if ($(newDiv).find("#player-div").length > 0) {
                                $("#player-div").hide("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                                $(oldDiv).html();
                                $(newDiv).append(robot);
                                setTimeout(() => {
                                    $("#game-map").hide("slow");
                                    $(".end-btn").text("Try again");
                                    $(".end-btn").click(function () {
                                        location.reload();
                                    });
                                    $(".end-message").text("Robot ate you!");
                                    $(".end-level").show("slow");
                                }, 500);
                                break;
                            }
                            if ($(newDiv).hasClass('exit')) {
                                $(oldDiv).html();
                                $(newDiv).append(robot);
                                document.querySelector('#player-div').removeAttribute('id');
                                setTimeout(() => {
                                    $("#game-map").hide("slow");
                                    $(".end-btn").text("Try again");
                                    $(".end-btn").click(function () {
                                        location.reload();
                                    });
                                    $(".end-message").text("Robot won!");
                                    $(".end-level").show("slow");
                                }, 500);

                                break;
                            }
                            $(oldDiv).html();
                            $(newDiv).append(robot);
                            break;
                        default:
                            break;
                    }
                    counter++;
                }, data.speed);
            },
            error: function (data) {
                alert("ERROR");
            }
        });
    },

    MovePlayer: function (keyCode) {
        switch (keyCode) {
            case 37:
                var x = +$("#player-div").parent().attr('id').split("-")[0];
                var y = +$("#player-div").parent().attr('id').split("-")[1];
                var yy = y - 1;
                var newDiv = "#" + x + "-" + yy;
                var oldDiv = "#" + x + "-" + y;
                if ($(newDiv).hasClass('blocked')) {
                    setTimeout(() => {
                        $(".field").removeClass("exit");
                        $("#game-map").hide("slow");
                        $(".end-btn").text("Try again");
                        $(".end-btn").click(function () {
                            location.reload();
                        });
                        $(".end-message").text("You're dead!");
                        $(".end-level").show("slow");
                    }, 200);
                }
                if ($(newDiv).find("#robot-div").length > 0) {
                    break;
                }
                if ($(newDiv).hasClass('exit')) {
                    var player = $(oldDiv).find("#player-div");
                    //$(oldDiv).html();
                    $(newDiv).append(player);
                    $.ajax({
                        url: "/Maturski/handlers/user-save-next.php",
                        type: "GET",
                        // data: postData,
                        success: function (data) {
                            var data = JSON.parse(data);
                            var level = data.level;
                            var continent = data.continent;
                            if ((level == 0) && (continent == 0)) {
                                $("#game-map").hide("slow");
                                $(".next-btn").attr('href', '/Maturski/pages/world.php');
                                $(".next-btn").text("Go back");
                                $(".next-message").css("margin-top","10px");
                                $(".next-btn").css("margin-top","20px");
                                $(".next-message").text("YOU DID IT SOLIDER, THANKS FOR PLAYING!");
                                $(".next-level").show("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                            }
                            else {
                                $("#game-map").hide("slow");
                                $(".next-btn").attr('href', '/Maturski/pages/game.php?level=' + level + '&continent=' + continent);
                                $(".next-level").show("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                            }
                        },
                        error: function (data) { }
                    });

                    break;
                }
                var player = $(oldDiv).find("#player-div");
                //$(oldDiv).html();
                $(newDiv).append(player);
                break;

            case 39:
                var x = +$("#player-div").parent().attr('id').split("-")[0];
                var y = +$("#player-div").parent().attr('id').split("-")[1];
                var yy = y + 1;
                var newDiv = "#" + x + "-" + yy;
                var oldDiv = "#" + x + "-" + y;
                if ($(newDiv).hasClass('blocked')) {
                    $(".field").removeClass("exit");
                    setTimeout(() => {
                        $("#game-map").hide("slow");
                        $(".end-btn").text("Try again");
                        $(".end-btn").click(function () {
                            location.reload();
                        });
                        $(".end-message").text("You're dead!");
                        $(".end-level").show("slow");
                    }, 200);
                }
                if ($(newDiv).find("#robot-div").length > 0) {
                    break;
                }
                if ($(newDiv).hasClass('exit')) {
                    var player = $(oldDiv).find("#player-div");
                    //$(oldDiv).html();
                    $(newDiv).append(player);
                    $.ajax({
                        url: "/Maturski/handlers/user-save-next.php",
                        type: "GET",
                        // data: postData,
                        success: function (data) {
                            var data = JSON.parse(data);
                            var level = data.level;
                            var continent = data.continent;
                            if ((level == 0) && (continent == 0)) {
                                $("#game-map").hide("slow");
                                $(".next-btn").attr('href', '/Maturski/pages/world.php');
                                $(".next-btn").text("Go back");
                                $(".next-message").css("margin-top","10px");
                                $(".next-btn").css("margin-top","20px");
                                $(".next-message").text("YOU DID IT SOLIDER, THANKS FOR PLAYING!");
                                $(".next-level").show("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                            }
                            else {
                                $("#game-map").hide("slow");
                                $(".next-btn").attr('href', '/Maturski/pages/game.php?level=' + level + '&continent=' + continent);
                                $(".next-level").show("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                            }
                        },
                        error: function (data) { }
                    });

                    break;
                }
                var player = $(oldDiv).find("#player-div");
                //$(oldDiv).html();
                $(newDiv).append(player);
                break;

            case 38:
                var x = +$("#player-div").parent().attr('id').split("-")[0];
                var y = +$("#player-div").parent().attr('id').split("-")[1];
                var xx = x - 1;
                var newDiv = "#" + xx + "-" + y;
                var oldDiv = "#" + x + "-" + y;
                if ($(newDiv).hasClass('blocked')) {
                    $(".field").removeClass("exit");
                    setTimeout(() => {
                        $("#game-map").hide("slow");
                        $(".end-btn").text("Try again");
                        $(".end-btn").click(function () {
                            location.reload();
                        });
                        $(".end-message").text("You're dead!");
                        $(".end-level").show("slow");
                    }, 200);
                }
                if ($(newDiv).find("#robot-div").length > 0) {
                    break;
                }
                if ($(newDiv).hasClass('exit')) {
                    var player = $(oldDiv).find("#player-div");
                    //$(oldDiv).html();
                    $(newDiv).append(player);
                    $.ajax({
                        url: "/Maturski/handlers/user-save-next.php",
                        type: "GET",
                        // data: postData,
                        success: function (data) {
                            var data = JSON.parse(data);
                            var level = data.level;
                            var continent = data.continent;
                            if ((level == 0) && (continent == 0)) {
                                $("#game-map").hide("slow");
                                $(".next-btn").attr('href', '/Maturski/pages/world.php');
                                $(".next-btn").text("Go back");
                                $(".next-message").css("margin-top","10px");
                                $(".next-btn").css("margin-top","20px");
                                $(".next-message").text("YOU DID IT SOLIDER, THANKS FOR PLAYING!");
                                $(".next-level").show("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                            }
                            else {
                                $("#game-map").hide("slow");
                                $(".next-btn").attr('href', '/Maturski/pages/game.php?level=' + level + '&continent=' + continent);
                                $(".next-level").show("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                            }
                        },
                        error: function (data) { }
                    });

                    break;
                }
                var player = $(oldDiv).find("#player-div");
                //$(oldDiv).html();
                $(newDiv).append(player);
                break;

            case 40:
                var x = +$("#player-div").parent().attr('id').split("-")[0];
                var y = +$("#player-div").parent().attr('id').split("-")[1];
                var xx = x + 1;
                var newDiv = "#" + xx + "-" + y;
                var oldDiv = "#" + x + "-" + y;
                if ($(newDiv).hasClass('blocked')) {
                    $(".field").removeClass("exit");
                    setTimeout(() => {
                        $("#game-map").hide("slow");
                        $(".end-btn").text("Try again");
                        $(".end-btn").click(function () {
                            location.reload();
                        });
                        $(".end-message").text("You're dead!");
                        $(".end-level").show("slow");
                    }, 200);
                }
                if ($(newDiv).find("#robot-div").length > 0) {
                    break;
                }
                if ($(newDiv).hasClass('exit')) {
                    var player = $(oldDiv).find("#player-div");
                    //$(oldDiv).html();
                    $(newDiv).append(player);
                    $.ajax({
                        url: "/Maturski/handlers/user-save-next.php",
                        type: "GET",
                        // data: postData,
                        success: function (data) {
                            var data = JSON.parse(data);
                            var level = data.level;
                            var continent = data.continent;
                            if ((level == 0) && (continent == 0)) {
                                $("#game-map").hide("slow");
                                $(".next-btn").attr('href', '/Maturski/pages/world.php');
                                $(".next-btn").text("Go back");
                                $(".next-message").css("margin-top","10px");
                                $(".next-btn").css("margin-top","20px");
                                $(".next-message").text("YOU DID IT SOLIDER, THANKS FOR PLAYING!");
                                $(".next-level").show("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                            }
                            else {
                                $("#game-map").hide("slow");
                                $(".next-btn").attr('href', '/Maturski/pages/game.php?level=' + level + '&continent=' + continent);
                                $(".next-level").show("slow");
                                $(".field").removeClass("exit");
                                document.querySelector('#player-div').removeAttribute('id');
                            }
                        },
                        error: function (data) { }
                    });
                }
                var player = $(oldDiv).find("#player-div");
                //$(oldDiv).html();
                $(newDiv).append(player);
                break;
            default:
                break;
        }
    }
}
