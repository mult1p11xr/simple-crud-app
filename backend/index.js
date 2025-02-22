const express = require('express');
const mysql = require('mysql2');
const app = express();
app.use(express.json());

// Connect to the database
const pool = mysql.createPool({
  host: 'db',  // Use 'db' instead of 'localhost' (this is the service name defined in Docker Compose)
  user: 'user', 
  password: 'user_password', 
  database: 'crudapp', 
  port: 3306
});

// Test database connection
pool.getConnection((err, connection) => {
  if (err) {
    console.error('Database connection failed:', err.stack);
    return;
  }
  console.log('Connected to the database.');
  connection.release();
});

// Define a simple route
app.get('/', (req, res) => {
  res.send('Hello, Node.js server!');
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});

// Create a new user
app.post('/users', (req, res) => {
  const { name, email } = req.body;
  pool.query('INSERT INTO users (name, email) VALUES (?, ?)', [name, email], (err, result) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.status(201).json({ id: result.insertId, name, email });
  });
});

// Get all users
app.get('/users', (req, res) => {
  pool.query('SELECT * FROM users', (err, rows) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.json(rows);
  });
});

// Get a user by ID
app.get('/users/:id', (req, res) => {
  const userId = req.params.id;
  pool.query('SELECT * FROM users WHERE id = ?', [userId], (err, rows) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    if (rows.length === 0) {
      return res.status(404).json({ message: 'User not found' });
    }
    res.json(rows[0]);
  });
});

// Update a user
app.put('/users/:id', (req, res) => {
  const userId = req.params.id;
  const { name, email } = req.body;
  pool.query('UPDATE users SET name = ?, email = ? WHERE id = ?', [name, email, userId], (err, result) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    if (result.affectedRows === 0) {
      return res.status(404).json({ message: 'User not found' });
    }
    res.json({ message: 'User updated successfully' });
  });
});

// Delete a user
app.delete('/users/:id', (req, res) => {
  const userId = req.params.id;
  pool.query('DELETE FROM users WHERE id = ?', [userId], (err, result) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    if (result.affectedRows === 0) {
      return res.status(404).json({ message: 'User not found' });
    }
    res.json({ message: 'User deleted successfully' });
  });
});
