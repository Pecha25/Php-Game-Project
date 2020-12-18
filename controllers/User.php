<?php

declare(strict_types=1);

namespace Controllers;

use DB\Connection;
use Controllers\Level;

final class User
{
    private $dbConnection;

    private $id;
    public $username;
    private $password;
    public $score;
    public $level_id;

    public function __construct(int $id1)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->dbConnection = new Connection();
        $sql1 = "SELECT * FROM users WHERE id ='" . $id1 . "'";
        $user = $this->dbConnection->fetch($sql1, false);

        $this->id = $id1;
        $this->username = $user['username'];
        $this->password = $user['password'];
        $this->score = $user['score'];
        $this->level_id = $user['level_id'];
    }

    public function GetRank(): int
    {
        $level = new Level($this->level_id);
        return $level->GiveRank();
    }

    public function GetLevelOrd(): int
    {
        $level = new Level($this->level_id);
        return intval($level->ordinal_num);
    }

    public function GetLevel(): int
    {
        $level = new Level($this->level_id);
        if (($level->ordinal_num) % 4 == 0)
            return 4;
        else
            return intval($level->ordinal_num) % 4;
    }

    public function GetContinentORD(): int
    {
        $level = new Level($this->level_id);
        return $level->GiveContinentORD();
    }

    public function SaveLevel()
    {
        $level = new Level($_SESSION['level']);
        if ($level->id == 16) {
            $add_score = 300;
            $new_score = $this->score + $add_score;
            $user_id = $this->id;

            $sql11 = "UPDATE users SET score = '" . $new_score . "'  WHERE id = '" . $user_id . "' ";
            $this->dbConnection->fetch($sql11, false);
        } else {
            $difficulty = $level->difficulty_id;
            $sql8 = "SELECT points FROM difficulty WHERE id ='" . $difficulty . "' ";
            $res = $this->dbConnection->fetch($sql8, false);
            $add_score = $res['points'];

            $new_id = $level->GiveNextID();
            $this->level_id = $new_id;
            $new_score = $this->score + $add_score;
            $this->score = $new_score;
            $user_id = $this->id;

            $sql5 = "UPDATE users SET score = '" . $new_score . "', level_id = '" . $new_id . "'  WHERE id = '" . $user_id . "' ";
            $this->dbConnection->fetch($sql5, false);
        }
    }
}
