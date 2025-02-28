<?php

include_once("db_conn.php");
include_once("crud.php");
$result = read($conn);

echo $result;

//id, title, author, genre, worththeread -> id, task, description,  x genre, accomplishedTask


try {
    $stmt = $conn->prepare("SELECT id, task, descript, accomplishedTask  FROM to_do_list");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo "<ul>";
    foreach ($stmt->fetchAll() as $row) {
        echo "<li>";
        print($row["id"] . " " . $row["task"] . " " . $row["description"]);
        echo "</li>";
    }
   echo "</ul>";
}   catch (PDOException $e){
    echo "Error " . $e . getMessage();
}

$conn = null;