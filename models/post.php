<?php
require_once 'db.php';

function getPosts($limit = 5) {
    $db = getDb();
    $stmt = $db->prepare("SELECT * FROM posts ORDER BY date DESC LIMIT :limit");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPost($id) {
    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addPost($title, $content, $tags) {
    $db = getDb();
    $stmt = $db->prepare('INSERT INTO posts (date, title, content, tags) VALUES (datetime("now"), :title, :content, :tags)');
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':tags', $tags, PDO::PARAM_STR);
    return $stmt->execute();
}

function updatePost($id, $title, $content, $tags) {
    $db = getDb();
    $stmt = $db->prepare('UPDATE posts SET title = :title, content = :content, tags = :tags WHERE id = :id');
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':tags', $tags, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

function deletePost($id) {
    $db = getDb();
    $stmt = $db->prepare('DELETE FROM posts WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
?>
