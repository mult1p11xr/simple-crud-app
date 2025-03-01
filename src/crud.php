<?php


function create($conn, $task, $descript)
{
    try {
        $sql = "INSERT INTO to_do_list(task, descript) VALUES ('$task', '$descript')";

        $conn->exec($sql);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        $conn = null;
        return false;
    }

    $conn = null;
    return true;
}

function read($conn)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM to_do_list");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        echo "<ul>";
        foreach ($stmt->fetchAll() as $row) {
            echo "<li>";
            print($row["id"] . " " . $row["task"] . " " . $row["descript"]);
            echo "</li>";
        }
        echo "</ul>";
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
        $conn = null;
        return false;
    }

    $conn = null;

    return true;
}



function update($conn, $id, $data)
{
    try {

        $sql = "UPDATE to_do_list SET descript='$data[descript]', task='$data[task]', accomplishedTask='$data[accomplishedTask]' WHERE id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // echo $stmt->rowCount() . " Historik uppdaterad";

    } catch (PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
        $conn = null;
        return false;
    }

    $conn = null;

    return true;
}


function delete($conn, $id)
{
    try {
        $sql = "DELETE FROM to_do_list WHERE id=$id";
        $conn->exec($sql);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        $conn = null;
        return false;
    }

    $conn = null;

    return true;
}
