<?php
$pdo=new PDO('mysql:dbname=dip_site2;host=localhost', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous"/>
</head>
<body>
<h1>Liste des tâches :</h1>
<?php
$students=$pdo->query("select id,message,created_at from tasks");
foreach ($tasks as $task):
?>
<hr>
<h4>Tâche n°<?= $student['id'] ?> :</h4>
<ul>
    <li>Nom : <?= $student['firstname'] ?></li>
    <li>Prénom : <?= $student['lastname'] ?></li>
    <li>Mail : <?= $student['email'] ?></li>
    <li>
        <form action="actions.php">
            <input type="hidden" name="action" value="delete">
            <button type="submit"><i class="fa fa-trash"></i></button>
        </form>
    </li>
</ul>
<?php endforeach; ?>
<hr>
</body>
</html>