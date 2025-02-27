<?php

include_once('db_conn.php');
include_once('crud.php');

$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars(trim($_POST['id']));
    $title = htmlspecialchars(trim($_POST['title']));
    $author = htmlspecialchars(trim($_POST['author']));
    $genre = htmlspecialchars(trim($_POST['genre']));
    $worthTheRead = 'off';
    if (isset($_POST['worthTheRead'])) {
        $worthTheRead = $_POST['worthTheRead'];
    }

    if (!empty($title) && !empty($author) && !empty($genre) && !empty($id) && !empty($worthTheRead)) {
        // Call the create function
        $updateResult = update($conn, $id, ["title" => $title, "author" => $author, "genre" => $genre, "worththeread" => $worthTheRead === 'on' ? 1 : 0]);
        $success = $updateResult ? "Allt OK" : "Nåt gick fel";
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
    <title>Update Book</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Uppdatera bok</h1>
    <form method="POST" action="update.php">
        <label>
            Id:
            <input id="id" name="id" type="number" required>
        </label>
        <label>
            Title:
            <input id="title" name="title" type="text" required>
        </label>
        <br>
        <label>
            Author:
            <input id="author" name="author" type="text" required>
        </label>
        <br>
        <label>
            Genre:
            <input id="genre" name="genre" type="text" required>
        </label>
        <label>
            Worth the read?:
            <input id="worthTheRead" name="worthTheRead" type="checkbox">
        </label>
        <br>
        <button type="submit">Uppdatera till bok</button>
    </form>

    <?= $success ?>

</body>

</html>