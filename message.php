<?php
ini_set('date.timezone', 'Europe/Paris');
require 'vendor/autoload.php';
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $task = \Site4\Task::find($taskId);
} elseif (!isset($task)) {
    die;
}

$striked = $task->isDone() ? ' class="strike-text"' : '';
?>
<div<?= $striked ?> id="task<?= $task->getId() ?>" class="row">
    <div class="col-lg-4 offset-lg-4 col-sm-12 text-center card">
        <div class="card-header">
            <h4>Tâche n°<?= $task->getId() ?> :</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info" role="alert">
                <i class="far fa-comment"></i> <?= $task->getMessage() ?><br>
                <i class="far fa-calendar-alt"></i> <?= $task->getHRTimestamp() ?>
            </div>
            <?php
            if (!$task->isDone()):
                ?>
                <!-- Over button -->
                <form id="overTask">
                    <input type="hidden" id="taskId" value="<?= $task->getId() ?>">
                    <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Terminé</button>
                </form>
                <!-- ./Over button -->
            <?php
            endif;
            ?>
            <br>
            <!-- Delete button -->
            <form id="deleteTask">
                <input type="hidden" id="taskId" value="<?= $task->getId() ?>">
                <button type="submit" class="btn btn-danger btn-block ignore-strike"><i class="fas fa-trash"></i> Supprimer</button>
            </form>
            <!-- ./Delete button -->
        </div>
    </div>
</div>