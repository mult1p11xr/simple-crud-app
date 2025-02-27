<?php

include_once('db_conn.php');
include_once('crud.php');

$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $author = htmlspecialchars(trim($_POST['author']));
    $genre = htmlspecialchars(trim($_POST['genre']));

    if (!empty($title) && !empty($author) && !empty($genre)) {
        // Call the create function
        $createResult = create($conn, $title, $author, $genre);
        $success = $createResult ? "Allt OK" : "Något gick fel";
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
    <title>Create Book</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Lägg till ny bok</h1>
    <form method="POST" action="create.php">
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
        <br>
        <button type="submit">Lägg till bok</button>
    </form>

    <?= $success ?>
</body>

</html>