<?php

$success = "";

include_once('db_conn.php');
include_once('crud.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars(trim($_POST['id']));

    if (!empty($id)) {
        // Call the create function
        $deleteResult = delete($conn, $id);
        $success = $deleteResult ? "Allt OK" : "Något gick fel";
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
    <title>Delete Book</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Ta bort bok</h1>
    <form method="POST" action="delete.php">
        <div class="d-flex">
            <label class="form-label">Id:</label>
            <input id="id" name="id" type="number" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Ta bort</button>
    </form>

    <?= $success ?>
</body>

</html>