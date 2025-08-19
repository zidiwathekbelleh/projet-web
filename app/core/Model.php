<?php
// app/core/Model.php

require_once dirname(__DIR__, 2) . '/config/database.php';

class Model
{
    protected PDO $db;

    public function __construct()
    {
        // 🔹 Ici on récupère bien l'objet PDO
        $this->db = Database::getInstance()->getConnection();
    }
}
