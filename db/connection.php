<?php

declare(strict_types=1);

namespace DB;

final class Connection
{

    private $ime_hosta = 'localhost';
    private $korisnik = 'root';
    private $sifra = '';
    private $ime_baze = "maturski";

    private $pdo;

    public function __construct()
    {
        $konekcioni_string = "mysql:host=" . $this->ime_hosta . ";dbname=" . $this->ime_baze;
        $this->pdo = new \PDO($konekcioni_string, $this->korisnik, $this->sifra);
        
    }

    public function fetch(string $sqlQuery, bool $returnAll = true)
    {
        $stmt = $this->pdo->query($sqlQuery);
            if ($returnAll) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            }
    }
}