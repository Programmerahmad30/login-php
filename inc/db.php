<?php

    try
    {
        $dsn = "mysql:host=localhost;dbname=login";
        $pdo = new PDO($dsn, "root", "");
    }
    catch (PDOException $e)
    {
        echo "Error " . $e->getMessage();
        die();
    }