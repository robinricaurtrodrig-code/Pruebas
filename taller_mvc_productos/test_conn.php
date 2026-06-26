<?php
require_once __DIR__ . '/config/database.php';
try {
    $db = Database::getConnection();
    echo "Conexion OK a MySQL\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
