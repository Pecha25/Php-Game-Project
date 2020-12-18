<?php

declare(strict_types=1);

namespace Controllers;

require_once("../autoload.php");

use \DB\Connection;

final class Map
{
    const MAX = 999;
    const RIGHT = "DESNO";
    const DOWN = "DOLE";
    const UP = "GORE";
    const LEFT = "LEVO";

    private $dbConnnection;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->dbConnnection = new Connection();
    }

    public function loadSource(string $world, string $level): array
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $realLevel = ($world - 1) * 4 + $level;
        $getSql = "SELECT id FROM level WHERE ordinal_num = " . $realLevel;

        $id = $this->dbConnnection->fetch($getSql, false);

        $_SESSION['world'] = $world;
        $_SESSION['level'] = $id['id'];

        return explode(";", trim(preg_replace('/\s\s+/', '', file_get_contents("../source/" . $world . "-" . $level . ".csv"))));
    }

    public function generateNumericMatrix(): array
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $getSql = "SELECT ordinal_num FROM level WHERE id = " . $_SESSION['level'];
        $levelOrd = $this->dbConnnection->fetch($getSql, false);
        $ord = $levelOrd['ordinal_num'] % 4 == 0 ? '4' : '' . $levelOrd['ordinal_num'] % 4;

        $fields = $this->loadSource($_SESSION['world'], $ord);
        $row = 0;
        $col = 0;
        $continent = $_SESSION['world'];
        switch ($continent) {
            case 1:
                $limit = 8;
                break;
            case 2:
                $limit = 10;
                break;
            case 3:
                $limit = 12;
                break;
            case 4:
                $limit = 14;
                break;
        }

        $matrix = array();
        for ($i = 0; $i < count($fields); $i += 1) {
            if ($col == $limit) {
                $col = 0;
                $row += 1;
            }
            $matrix[$row][$col] = intval($fields[$i]);
            $col += 1;
        }
        return $matrix;
    }

    public function generateAdjacencyMatrix(): array
    {
        $matrix = $this->generateNumericMatrix();
        $graph_rep = array();

        $continent = $_SESSION['world'];
        switch ($continent) {
            case 1:
                $limit = 8;
                break;
            case 2:
                $limit = 10;
                break;
            case 3:
                $limit = 12;
                break;
            case 4:
                $limit = 14;
                break;
        }

        $ord = 0;

        for ($i = 0; $i < ($limit * $limit); $i += 1) {
            for ($j = 0; $j < ($limit * $limit); $j += 1) {
                $graph_rep[$i][$j] = self::MAX;
            }
        }

        for ($i = 0; $i < $limit; $i += 1) {
            for ($j = 0; $j < $limit; $j += 1) {

                if ($matrix[$i][$j] == 4) {
                    $_SESSION['END_X'] = $i;
                    $_SESSION['END_Y'] = $j;
                }

                if ($matrix[$i][$j] == 2) {
                    $_SESSION['START_X'] = $i;
                    $_SESSION['START_Y'] = $j;
                }


                if ($matrix[$i][$j] != 1) {
                    //DESNI
                    if ($j < ($limit - 1)) {
                        if (($matrix[$i][$j + 1] == 0) || ($matrix[$i][$j + 1] == 2) || ($matrix[$i][$j + 1] == 3) || ($matrix[$i][$j + 1] == 4)) {
                            $graph_rep[$ord][$ord + 1] = 1;
                            $graph_rep[$ord + 1][$ord] = 1;
                        }
                    }

                    //DONJI
                    if ($i < ($limit - 1)) {
                        if (($matrix[$i + 1][$j] == 0) || ($matrix[$i + 1][$j] == 2) || ($matrix[$i + 1][$j] == 3) || ($matrix[$i + 1][$j] == 4)) {
                            $graph_rep[$ord][$ord + $limit] = 1;
                            $graph_rep[$ord + $limit][$ord] = 1;
                        }
                    }
                }


                $ord++;
            }
        }
        return $graph_rep;
    }

    public function getSpeed(): float
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $continent = $_SESSION['world'];


        return round(1000 / $continent);
    }

    public function calculateDirections($robotStartX, $robotStartY): array
    {
        $graph_rep = $this->generateAdjacencyMatrix();
        $continent = $_SESSION['world'];
        $robotStartX = $_SESSION['START_X'];
        $robotStartY = $_SESSION['START_Y'];

        $endX = $_SESSION['END_X'];
        $endY = $_SESSION['END_Y'];

        switch ($continent) {
            case 1:
                $limit = 8;
                break;
            case 2:
                $limit = 10;
                break;
            case 3:
                $limit = 12;
                break;
            case 4:
                $limit = 14;
                break;
        }
        $start = $robotStartX * $limit + $robotStartY;
        $end = $endX * $limit + $endY;

        $S = array();
        $Q = array();
        foreach (array_keys($graph_rep) as $val) $Q[$val] = self::MAX;
        $Q[$start] = 0;

        while (!empty($Q)) {
            $min = array_search(min($Q), $Q);
            if ($min == $end) break;
            foreach ($graph_rep[$min] as $key => $val) if (!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
                $Q[$key] = $Q[$min] + $val;
                $S[$key] = array($min, $Q[$key]);
            }
            unset($Q[$min]);
        }

        $path = array();
        $pos = $end;
        while ($pos != $start) {
            $path[] = $pos;
            $pos = $S[$pos][0];
        }
        $path[] = $start;
        $path = array_reverse($path);

        $directions = array();

        $previousNode = $path[0];

        for ($i = 1; $i < count($path); $i++) {

            if ($previousNode == ($path[$i] - 1)) {
                $directions[$i] = self::RIGHT;
            }
            if ($previousNode == ($path[$i] - $limit)) {
                $directions[$i] = self::DOWN;
            }
            if ($previousNode == ($path[$i] + $limit)) {
                $directions[$i] = self::UP;
            }
            if ($previousNode == ($path[$i] + 1)) {
                $directions[$i] = self::LEFT;
            }

            $previousNode = $path[$i];
        }

        return $directions;
    }
}
