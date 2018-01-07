<?php


use Site4\Database;

require 'vendor/autoload.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        add();
        break;
    case 'PUT':
        over();
        break;
    case 'DELETE':
        delete();
    default:
        die;
}

/**
 * Mark a task as finished
 */
function over()
{
    $id = $_GET['id'];
    $task = \Site4\Task::find($id);
    if ($task->getId() == 0) {
        throw new \Exception('Unknown task!');
    }
    $task->setDone(true);
    echo $task->save();
}

/**
 * Delete a task
 */
function delete()
{
    $id = $_GET['id'];
    $task = \Site4\Task::find($id);
    if ($task->getId() == 0) {
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
    $task = new \Site4\Task();
    $task->setMessage($message);
    $task->setCreatedAt($createdAt);
    $task->save();
    echo $task->getId();
}