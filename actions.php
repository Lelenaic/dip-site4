<?php
include 'Database.php';
if (!isset($_POST['action'])) die;


switch ($_POST['action']) {
    case 'add':
        add();
        break;
    case 'delete':
        delete();
        break;
    case 'over':
        over();
        break;
    default:
        die;
}

function over(){
    $id=$_POST['id'];
    Database::exec('update tasks set done=1 where id='.$id);
    header('location: index.php');
    die;
}

function delete(){
    $id=$_POST['id'];
    Database::exec('delete from tasks where id='.$id);
    header('location: index.php');
    die;
}

function add()
{
    $message = htmlentities($_POST['message']);
    $createdAt = time();
    Database::exec('insert into tasks (message, created_at) values (\'' . $message . '\', ' . $createdAt . ')');
    header('location: index.php');
    die;
}