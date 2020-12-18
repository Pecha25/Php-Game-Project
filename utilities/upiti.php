<?php

$ime_hosta = 'localhost';
$korisnik = 'root';
$sifra = '';
$ime_baze = "maturski";

$konekcioni_string = "mysql:host=" . $ime_hosta . ";dbname=" . $ime_baze;
$dbh = new PDO($konekcioni_string, $korisnik, $sifra);


/*$sqlQuery = "SELECT * FROM users WHERE name='" . $username . "' AND password = '" . $password . "'";*/
/*$sql = "UPDATE users SET name = ?, password = ?, role_id = ? WHERE id = ?";*/

$sql1 = "SELECT * FROM users u WHERE u.username ='" . $username . "' AND u.password = '" . $password . "'"; //LOGIN
$sql1_2 = "SELECT * FROM levels l WHERE l.id ='" . $new_id . "'"; //LEVEL
$sql2 = "INSERT INTO users (username, password, score, level_id) VALUES ('" . $username . "', '" . $password . "', 0, 1); ";//REGISTER
$sql2_2 = "SELECT l.id FROM levels l WHERE l.ordinal_num ='" . $new_id . "'";
$sql3 = "SELECT continents.position FROM  users u LEFT JOIN levels l ON u.level_id = l.id LEFT JOIN continents c ON l.continent_id = c.id";//TVRDJAVA DO KOJE JE STIGAO
$sql4 = "SELECT u.username, u.score, c.position, l.ordinal_num FROM users u LEFT JOIN levels l ON u.level_id = l.id LEFT JOIN continents c ON l.continent_id = c.id";//HEADER(user, skror, dostignuca-pehari i zvezdice)
$sql4_2 = "SELECT u.score FROM users u WHERE u.id = '" . $user_id . "'";
$sql5 = "UPDATE users SET score = '" . $dostignutiSkor . "', level_id = '" . $levelId . "'  WHERE id = '". $userId . "' ";//SAVE
$sql6 = "SELECT l.ordinal_num FROM users u LEFT JOIN levels l ON u.level_id = l.id"; //NIVO U TVRDJAVI KOJI JE POSLEDNJI DOSTUPAN
$sql7 = "SELECT l.continent_id FROM levels l WHERE l.id = '" . $level_id . "'";
$sql8 = "SELECT c.position FROM continents c WHERE c.id = '" . $continent_id . "'";
$sql9 = "SELECT points FROM difficulty WHERE id ='" . $difficulty . "' ";
$sql10 = "SELECT l.continent_id FROM level l WHERE l.id ='" . $id . "'";
$sql11 = "UPDATE users SET score = '" . $new_score . "'  WHERE id = '" . $user_id . "' ";