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
<div class="row">
    <div class="col-lg-4 offset-lg-4 col-sm-12 text-center card">
        <div class="card-header">
            <h1>Ajouter une tâche</h1>
        </div>
        <div class="card-body">
            <!-- Add a task form -->
            <form id="addTask">
                <div class="form-group">
                    <label for="message"><b>Message :</b></label>
                    <input type="text" name="message" id="message" class="form-control" required>
                </div>
                <input type="hidden" name="action" value="add">
                <button type="submit" id="send" class="btn btn-success btn-block"><i class="fas fa-plus"></i> Ajouter
                </button>
            </form>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-4 offset-lg-4 col-sm-12 text-center card">
        <!-- ./Add a task form -->
        <h3>Liste des tâches :</h3>
    </div>
</div>
<div id="tasks">
    <?php
    $tasks = \Site4\Task::all();
    foreach ($tasks as $task) {
        include 'message.php';
    }
    ?>
</div>
<script src="dist/bundle.js"></script>
</body>
</html>