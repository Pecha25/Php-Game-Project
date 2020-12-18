<html>

<head>
    <title> Dobrodošao! </title>
    <link rel="shortcut icon" href="/Maturski/images/hopa.ico">
</head>

<body>
<?php
    session_start();
    require_once("autoload.php");
    use Controllers\Login;

    $login = new Login();
    $login->redirectUser();
    if (isset($_SESSION['login_error'])){
        $message = $_SESSION['login_error'];
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
?>
    

</body>

</html>