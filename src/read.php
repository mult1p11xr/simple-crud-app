<?php

include_once("db_conn.php");
include_once("crud.php");
$result = read($conn);

echo $result;


try {
    $stmt = $conn->prepare("SELECT id, title, author, genre, worththeread FROM to_do_list");
   $stmt->execute();

   $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo "<ul>";
    foreach ($stmt->fetchAll() as $row) {
        echo "<li>";
        print($row["id"] . " " . $row["title"] . " " . $row["author"] . " - " . $row["genre"]);
        echo "</li>";
    }
   echo "</ul>";
}   catch (PDOException $e){
    echo "Error " . $e . getMessage();
}

$conn = null;