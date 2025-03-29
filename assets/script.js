


document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('error-message');

    // Replace this with your authentication logic
    if (username === 'admin' && password === 'password') {
        // Redirect to dashboard or main application page
        window.location.href = 'dashboard.html'; // Change to your actual dashboard page
    } else {
        errorMessage.textContent = 'Invalid username or password.';
    }
});

