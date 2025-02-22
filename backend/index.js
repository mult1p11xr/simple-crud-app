const express = require("express");
const mysql = require("mysql2");

const app = express();
const port = 5000;

// Middleware to parse JSON
app.use(express.json());

// Set up MySQL connection
const db = mysql.createConnection({
  host: "db", // The name of the service defined in docker-compose.yml
  user: "user",
  password: "password",
  database: "crudapp"
});

db.connect((err) => {
  if (err) {
    console.error("Error connecting to database:", err.stack);
  } else {
    console.log("Connected to database!");
  }
});

// Create - Add new data
app.post("/api/items", (req, res) => {
  const { name, description } = req.body;
  const query = "INSERT INTO items (name, description) VALUES (?, ?)";
  
  db.query(query, [name, description], (err, result) => {
    if (err) {
      res.status(500).send("Error adding item");
    } else {
      res.status(200).send("Item added successfully");
    }
  });
});

// Read - Get all items
app.get("/api/items", (req, res) => {
  const query = "SELECT * FROM items";
  
  db.query(query, (err, results) => {
    if (err) {
      res.status(500).send("Error fetching items");
    } else {
      res.json(results);
    }
  });
});

// Update - Modify an item
app.put("/api/items/:id", (req, res) => {
  const { id } = req.params;
  const { name, description } = req.body;
  const query = "UPDATE items SET name = ?, description = ? WHERE id = ?";
  
  db.query(query, [name, description, id], (err, result) => {
    if (err) {
      res.status(500).send("Error updating item");
    } else {
      res.status(200).send("Item updated successfully");
    }
  });
});

// Delete - Remove an item
app.delete("/api/items/:id", (req, res) => {
  const { id } = req.params;
  const query = "DELETE FROM items WHERE id = ?";
  
  db.query(query, [id], (err, result) => {
    if (err) {
      res.status(500).send("Error deleting item");
    } else {
      res.status(200).send("Item deleted successfully");
    }
  });
});

// Start the server
app.listen(port, () => {
  console.log(`Backend running on port ${port}`);
});
