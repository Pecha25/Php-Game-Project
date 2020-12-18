<?php

declare(strict_types=1);

namespace Controllers;

use DB\Connection;

final class Login
{
    private $dbConnection;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->dbConnection = new Connection();
    }
    /**
     * Login metoda sa username-om i lozinkom
     * 
     * @param string $username
     * @param string $password
     *
     */
    public function LoginUser(string $username, string $password): void
    {

        $sql1 = "SELECT id FROM users WHERE username ='" . $username . "' AND password = '" . $password . "'";

        $user = $this->dbConnection->fetch($sql1, false);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login_error'] = null;
        } else {
            $_SESSION['login_error'] = "Pogresni kredencijali!";
        }

        $_SESSION["style"] = 0;

        $this->redirectUser();
    }

    public function redirectUser()
    {
        if (!isset($_SESSION) || !isset($_SESSION['user_id'])) {
            include $_SERVER['DOCUMENT_ROOT'] . '/Maturski/pages/login-page.php';
        } else {
            header("Location: /Maturski/pages/world.php");
        }
    }

    public function LogOutUser(): void
    {
        session_destroy();
        header("Location: /Maturski");
    }
}
