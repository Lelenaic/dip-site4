<?php
ini_set('date.timezone', 'Europe/Paris');
include 'Database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Add a task form -->
<h1>Ajouter une tâche :</h1>
<form action="actions.php" method="POST">
    <input type="hidden" name="action" value="add">
    <label for="message">Message :</label>
    <input type="text" name="message" id="message" required>
    <button type="submit"><i class="fa fa-plus"></i> Ajouter</button>
</form>
<!-- ./Add a task form -->
<hr>
<h1>Liste des tâches :</h1>
<?php
$tasks = Database::query("select id,message,created_at,done from tasks");
foreach ($tasks as $task):
    $striked=$task['done'] ? ' class="strike-text"':'';
    ?>
    <hr>
    <div<?= $striked ?>>
        <h4>Tâche n°<?= $task['id'] ?> :</h4>
        <ul>
            <li>Message : <?= $task['message'] ?></li>
            <li>Créée le : <?= date('d/m/Y - H:i', $task['created_at']) ?></li>
            <li>
                <!-- Delete button -->
                <form action="actions.php" method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <button type="submit"><i class="fa fa-trash"></i> Supprimer</button>
                </form>
                <!-- ./Delete button -->
                <?php
                if (!$task['done']):
                    ?>
                    <!-- Over button -->
                    <form action="actions.php" method="POST">
                        <input type="hidden" name="action" value="over">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <button type="submit"><i class="fa fa-check"></i> Terminé</button>
                    </form>
                    <!-- ./Over button -->
                    <?php
                endif;
                ?>
            </li>
        </ul>
    </div>
<?php endforeach; ?>
<hr>
</body>
</html>