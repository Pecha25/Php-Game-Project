<?php

declare(strict_types=1);

namespace Controllers;


use DB\Connection;

final class Level
{
    private $dbConnection;

    public $id;
    public $ordinal_num;
    public $difficulty_id;

    public function __construct($new_id)
    {
        $this->dbConnection = new Connection();
        $sql1_2 = "SELECT * FROM level l WHERE l.id ='" . $new_id . "'";
        $level = $this->dbConnection->fetch($sql1_2, false);

        $this->id = $new_id;
        $this->ordinal_num = $level['ordinal_num'];
        $this->difficulty_id = $level['difficulty_id'];
    }

    public function GiveRank(): int
    {
        if ($this->ordinal_num < 5) {
            $rank = 1;
        } else {
            if ($this->ordinal_num < 9) {
                $rank = 2;
            } else {
                if ($this->ordinal_num < 13) {
                    $rank = 3;
                } else
                    $rank = 4;
            }
        }

        return $rank;
    }

    public function GiveNextID(): int
    {
        $ord = $this->ordinal_num;
        $orrd = $ord + 1;
        $sql2_2 = "SELECT l.id FROM level l WHERE l.ordinal_num ='" . $orrd . "'";
        $res = $this->dbConnection->fetch($sql2_2, false);
        $next_id = $res['id'];
        return intval($next_id);
    }

    public function GiveNextORD(): int
    {
        $ord = $this->ordinal_num + 1;

        $realOrd = $ord % 4 == 0 ? 4 : $ord % 4;

        return $realOrd;
    }

    public function GiveContinentORD(): int
    {
        $sql7 = "SELECT l.continent_id FROM level l WHERE l.id = '" . $this->id . "'";
        $conId = $this->dbConnection->fetch($sql7, false);
        $continent_id = $conId['continent_id'];

        $sql8 = "SELECT c.position FROM continents c WHERE c.id = '" . $continent_id . "'";
        $conOrd = $this->dbConnection->fetch($sql8, false);
        $continent_ord = $conOrd['position'];
        return intval($continent_ord);
    }

    public function GetNextContinentORD(): int
    {
        $id = $this->GiveNextID();
        $sql9 = "SELECT l.continent_id FROM level l WHERE l.id ='" . $id . "'";
        $conId = $this->dbConnection->fetch($sql9, false);
        $continent_id = $conId['continent_id'];

        $sql10 = "SELECT c.position FROM continents c WHERE c.id = '" . $continent_id . "'";
        $conOrd = $this->dbConnection->fetch($sql10, false);
        $continent_ord = $conOrd['position'];
        return intval($continent_ord);
    }
}
