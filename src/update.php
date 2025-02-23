<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing record
    $stmt = $pdo->prepare("SELECT * FROM items WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Update the record
        $stmt = $pdo->prepare("UPDATE items SET name = :name, description = :description WHERE id = :id");
        $stmt->execute(['name' => $name, 'description' => $description, 'id' => $id]);
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Item</h1>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $item['name']; ?>" required>
        <textarea name="description" required><?php echo $item['description']; ?></textarea>
        <button type="submit">Update Item</button>
    </form>
</body>
</html>