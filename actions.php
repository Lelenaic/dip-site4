<?php
include 'Database.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        add();
        break;
    case 'DELETE':
        delete();
        break;
    default:
        header('HTTP/1.1 400 Bad Request');
        die;
}

/**
 * Delete a task
 */
function delete(){
    $id=$_GET['id'] ?? die;
    Database::exec('delete from tasks where id='.$id);
}

/**
 * Add a task
 */
function add()
{
    $message = htmlspecialchars($_POST['message']);
    $createdAt = time();
    Database::exec('insert into tasks (message, created_at) values ("' . $message . '", ' . $createdAt . ')');
    echo 'ok';
}