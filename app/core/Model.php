<?php

// Corriger le chemin vers le fichier database.php
require_once dirname(__DIR__, 2) . '/config/database.php';

class Model
{
    protected $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
}
