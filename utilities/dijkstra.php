<?php

$starttime = microtime(true); //Početno vreme

/**
 * 
 *  Demo: http://www.you4be.com/dijkstra_algorithm.php
 *
 *  Source: https://github.com/zairwolf/Algorithms/blob/master/dijkstra_algorithm.php
 *
 *
 */

//Matrica
$_distArr = array();    
$_distArr[1][2] = 7;
$_distArr[1][3] = 9;
$_distArr[1][6] = 14;
$_distArr[2][1] = 7;
$_distArr[2][3] = 10;
$_distArr[2][4] = 15;
$_distArr[3][1] = 9;
$_distArr[3][2] = 10;
$_distArr[3][4] = 11;
$_distArr[3][6] = 2;
$_distArr[4][2] = 15;
$_distArr[4][3] = 11;
$_distArr[4][5] = 6;
$_distArr[5][4] = 6;
$_distArr[5][6] = 9;
$_distArr[6][1] = 14;
$_distArr[6][3] = 2;
$_distArr[6][5] = 9;

//the start and the end
$start = 1;
$end = 5;

//initialize the array for storing
$S = array();//the nearest path with its parent and weight
$Q = array();//the left nodes without the nearest path
foreach(array_keys($_distArr) as $val) $Q[$val] = 99999;
$Q[$start] = 0;

//start calculating
while(!empty($Q)){
    $min = array_search(min($Q), $Q);//the most min weight
    if($min == $end) break;
    foreach($_distArr[$min] as $key=>$val) if(!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
        $Q[$key] = $Q[$min] + $val;
        $S[$key] = array($min, $Q[$key]);
    }
    unset($Q[$min]);
}

//list the path
$path = array();
$pos = $end;
while($pos != $start){
    $path[] = $pos;
    $pos = $S[$pos][0];
}
$path[] = $start;
$path = array_reverse($path);

//print result
echo "<br />From $start to $end";
echo "<br />The length is ".$S[$end][1];
echo "<br />Path is ".implode('->', $path);

$endtime = microtime(true);
$timediff = $endtime - $starttime;

echo "<br />$timediff";

/*
1.5020370483398E-5
1.5020370483398E-5
1.5020370483398E-5
1.5020370483398E-5
1.3828277587891E-5
1.5020370483398E-5
1.4066696166992E-5
1.4066696166992E-5
1.4781951904297E-5
*/