<?php

include_once('db_conn.php');
include_once('crud.php');

$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = htmlspecialchars(trim($_POST['task']));
    $descript = htmlspecialchars(trim($_POST['descript']));

    if (!empty($task) && !empty($descript)) {
        // Call the create function
        $createResult = create($conn, $task, $descript);
        $success = $createResult ? "Everything OK" : "Something went wrong";
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
    <title>Create task</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Add task</h1>
    <form method="POST" action="create.php">
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
        <br>
        <button type="submit">Add task</button>
    </form>

    <?= $success ?>
</body>

</html>