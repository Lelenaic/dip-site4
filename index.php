<?php
ini_set('date.timezone', 'Europe/Paris');
require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- Fontawesome 5 -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<!-- Add a task form -->
<h1>Ajouter une tâche :</h1>
<form id="addTask">
    <input type="hidden" name="action" value="add">
    <label for="message">Message :</label>
    <input type="text" name="message" id="message" required>
    <button type="submit" id="send"><i class="fas fa-plus"></i> Ajouter</button>
</form>
<!-- ./Add a task form -->
<hr>
<h1>Liste des tâches :</h1>
<div id="tasks">
    <?php
    $tasks = \Site4\Task::all();
    foreach ($tasks as $task) {
        include 'message.php';
    }
    ?>
</div>
<hr>
<script type="module" src="assets/app.js"></script>
</body>
</html>