<head>
    <link type="text/css" rel="stylesheet" href="/Maturski/assets/css/styles.css" />
</head>

<h1 class="welcome">Log in, solider!</h1>

<form class="login-form" method="POST" action="/Maturski/handlers/login.php">
    <div>
        <input class="login-form-item" type="text" name="username" autocomplete="off" placeholder="Enter your nick!" />
    </div>
    <div>
        <input class="login-form-item" type="password" name="password" autocomplete="off" placeholder="Password?" /></div>
    <div>
        <input class="login-form-button" type="submit" value="Login">
    </div>
</form>