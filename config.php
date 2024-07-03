<?php
$db = new mysqli('localhost', 'root', '', 'blog');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Create posts table if it doesn't exist
$db->query('CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATETIME,
    title TEXT,
    content TEXT,
    tags TEXT
)');