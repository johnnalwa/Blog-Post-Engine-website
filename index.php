<?php
require_once 'models/post.php';
require_once 'controllers/post.php';
require_once 'controllers/index.php';

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        indexAction();
        break;
    case 'view':
        viewAction();
        break;
    case 'add':
        addAction();
        break;
    case 'edit':
        editAction();
        break;
    case 'delete':
        deleteAction();
        break;
    default:
        indexAction();
}