<?php 
    // Output data once all code is executed
    ob_start();

    // error handling
    try {
        // connection variable
        $con = new PDO("mysql:dbname=zeebee;host=localhost", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>