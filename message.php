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
<div<?= $striked ?> id="task<?= $task->getId() ?>">
    <hr>
    <h4>Tâche n°<?= $task->getId() ?> :</h4>
    <ul>
        <li>Message : <?= $task->getMessage() ?></li>
        <li>Créée le : <?= $task->getHRTimestamp() ?></li>
        <li>
            <!-- Delete button -->
            <form id="deleteTask">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" id="taskId" value="<?= $task->getId() ?>">
                <button type="submit"><i class="fas fa-trash"></i> Supprimer</button>
            </form>
            <!-- ./Delete button -->
            <?php
            if (!$task->isDone()):
                ?>
                <!-- Over button -->
                <form action="actions.php" method="POST">
                    <input type="hidden" name="action" value="over">
                    <input type="hidden" name="id" value="<?= $task->getId() ?>">
                    <button type="submit"><i class="fas fa-check"></i> Terminé</button>
                </form>
                <!-- ./Over button -->
            <?php
            endif;
            ?>
        </li>
    </ul>
</div>