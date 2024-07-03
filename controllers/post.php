<?php
include_once "include/util.php";
include_once "models/post.php";

function viewAction() {
    $id = $_GET['id'] ?? 0;
    $post = getPost($id);
    if (!$post) {
        header('Location: index.php');
        exit;
    }
    require 'views/postview.php';
}

function addAction() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $tags = $_POST['tags'] ?? '';
        
        if (empty($title) || empty($content)) {
            $error = urlencode("Title and content are required.");
            header('Location: index.php?action=add&message=' . $error . '&status=error');
            exit;
        } else {
            addPost($title, $content, $tags);
            header('Location: index.php?message=' . urlencode('Post added successfully!') . '&status=success');
            exit;
        }
    }
    require 'views/postadd.php';
}

function editAction() {
    $id = $_GET['id'] ?? 0;
    $post = getPost($id);
    if (!$post) {
        header('Location: index.php?message=' . urlencode('Post not found.') . '&status=error');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $tags = $_POST['tags'] ?? '';
        
        if (empty($title) || empty($content)) {
            $error = urlencode("Title and content are required.");
            header('Location: index.php?action=edit&id=' . $id . '&message=' . $error . '&status=error');
            exit;
        } else {
            updatePost($id, $title, $content, $tags);
            header('Location: index.php?action=view&id=' . $id . '&message=' . urlencode('Post updated successfully!') . '&status=success');
            exit;
        }
    }
    require 'views/edit.php';
}

function deleteAction() {
    $id = $_GET['id'] ?? 0;
    if ($id) {
        deletePost($id);
        header('Location: index.php?message=' . urlencode('Post deleted successfully!') . '&status=success');
    } else {
        header('Location: index.php?message=' . urlencode('Invalid post ID.') . '&status=error');
    }
    exit;
}
?>
