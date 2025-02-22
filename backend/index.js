const express = require('express');
const mysql = require('mysql2');
const app = express();
app.use(express.json());

// Connect to the database
const pool = mysql.createPool({
  host: 'localhost', // Replace with your Docker DB host
  user: 'user',      // Replace with your DB user
  password: 'user_password', // Replace with your DB password
  database: 'crudapp', // Replace with your database name
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
