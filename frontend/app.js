const apiUrl = 'http://localhost:3000/users'; // API endpoint

// DOM elements
const form = document.getElementById('form');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const submitButton = document.getElementById('submit-btn');
const usersTableBody = document.querySelector('#users-table tbody');

// Fetch all users and display them
async function fetchUsers() {
    try {
        const response = await fetch(apiUrl);
        const users = await response.json();

        // Clear the table before updating
        usersTableBody.innerHTML = '';

        // Populate the table with user data
        users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>
                    <button class="edit-btn" onclick="editUser(${user.id}, '${user.name}', '${user.email}')">Edit</button>
                    <button class="delete-btn" onclick="deleteUser(${user.id})">Delete</button>
                </td>
            `;
            usersTableBody.appendChild(row);
        });
    } catch (error) {
        console.error('Error fetching users:', error);
    }
}

// Add or update a user
async function handleSubmit(event) {
    event.preventDefault();

    const name = nameInput.value;
    const email = emailInput.value;

    const method = submitButton.textContent === 'Add User' ? 'POST' : 'PUT';
    const url = submitButton.textContent === 'Add User' ? apiUrl : `${apiUrl}/${form.dataset.userId}`;

    try {
        const response = await fetch(url, {
            method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, email })
        });

        if (!response.ok) {
            throw new Error('Error adding or updating user');
        }

        // Reset form and fetch updated users
        resetForm();
        fetchUsers();
    } catch (error) {
        console.error(error);
    }
}

// Edit a user (pre-fill form with user data)
function editUser(id, name, email) {
    nameInput.value = name;
    emailInput.value = email;
    submitButton.textContent = 'Update User';
    form.dataset.userId = id; // Store user ID in the form dataset
}

// Delete a user
async function deleteUser(id) {
    try {
        const response = await fetch(`${apiUrl}/${id}`, { method: 'DELETE' });

        if (response.ok) {
            fetchUsers(); // Re-fetch users after deletion
        } else {
            throw new Error('Error deleting user');
        }
    } catch (error) {
        console.error(error);
    }
}

// Reset form
function resetForm() {
    nameInput.value = '';
    emailInput.value = '';
    submitButton.textContent = 'Add User';
    delete form.dataset.userId;
}

// Initialize the app
form.addEventListener('submit', handleSubmit);
fetchUsers(); // Fetch and display users when the page loads
