<?php


use Site4\Database;

require 'vendor/autoload.php';
if (!isset($_POST['action'])) {
    if ($_SERVER['REQUEST_METHOD']=='DELETE') {
        delete();
        die;
    }else{
        die;
    }
}


switch ($_POST['action']) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            add();
        }
        break;
    case 'over':
        if ($_SERVER['REQUEST_METHOD']=='PUT') {
            over();
        }
        break;
    default:
        die;
}

/**
 * Mark a task as finished
 */
function over(){
    $id=$_POST['id'];
    Database::exec('update tasks set done=1 where id=?', $id);
    header('location: index.php');
    die;
}

/**
 * Delete a task
 */
function delete(){
    $id=$_GET['id'];
    $task=\Site4\Task::find($id);
    if ($task->getId()==0){
        throw new \Exception('Unknown task!');
    }
    echo $task->delete();
}

/**
 * Add a task
 */
function add()
{
    $message = htmlspecialchars($_POST['message']);
    $createdAt = time();
    $task=new \Site4\Task();
    $task->setMessage($message);
    $task->setCreatedAt($createdAt);
    $task->save();
    echo $task->getId();
}