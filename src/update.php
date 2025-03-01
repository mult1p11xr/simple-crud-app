<?php

include_once('db_conn.php');
include_once('crud.php');

$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars(trim($_POST['id']));
    $task = htmlspecialchars(trim($_POST['task']));
    $descript = htmlspecialchars(trim($_POST['descript']));
    $accomplishedTask = 'off';
    if (isset($_POST['accomplishedTask'])) {
        $accomplishedTask = $_POST['accomplishedTask'];
    }

    if (!empty($task) && !empty($descript) && !empty($id) && !empty($accomplishedTask)) {
        $updateResult = update($conn, $id, ["task" => $task, "descript" => $descript, "accomplishedTask" => $accomplishedTask=== 'on' ? 1 : 0]);
        $success = $updateResult ? "Everything OK" : "Something went wrong";
    } else {
        echo "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update task</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Update task</h1>
    <form method="POST" action="update.php">
        <label>
            Id:
            <input id="id" name="id" type="number" required>
        </label>
        <label>
            Task:
            <input id="task" name="task" type="text" required>
        </label>
        <br>
        <label>
            Description:
            <input id="descript" name="descript" type="text" required>
        </label>
        <br>
        <label>
            Accomplished task?
            <input id="accomplishedTask" name="accomplishedTask" type="checkbox">
        </label>
        <br>
        <button type="submit">Update task</button>
    </form>

    <?= $success ?>

</body>

</html>