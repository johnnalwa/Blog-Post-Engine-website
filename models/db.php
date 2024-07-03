<?php
require_once 'include/config.php';

function getDb() {
    static $db = null;
    if ($db === null) {
        $fileName = CONFIG['databaseFile'] . ".db3";
        if (!file_exists($fileName)) {
            errorPage(404, "Database file <code>$fileName</code> does not exist. Did you create it?");
        }
        try {
            $db = new PDO('sqlite:' . $fileName);
            if (!$db) {
                errorPage(500, print_r($db->errorInfo(), true));
            }
            adHocQuery("PRAGMA foreign_keys=ON;");
        } catch (PDOException $e) {
            errorPage(500, "Could not open database. " . $e->getMessage() . $e->getTraceAsString());
        }
    }
    return $db;
}

function adHocQuery($q) {
    $db = getDb();
    $st = $db->prepare($q);
    $st->execute();
    return $st->fetchAll(PDO::FETCH_ASSOC);
}

function initializeDatabase() {
    $db = getDb();
    $db->exec("CREATE TABLE IF NOT EXISTS posts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        date DATETIME,
        title TEXT,
        content TEXT,
        tags TEXT
    )");
}

// Initialize the database (ensure the table exists)
initializeDatabase();
?>
