<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Read the users from the JSON file
    $users = json_decode(file_get_contents('users.json'), true);

    // Check if the username exists
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                // header('Location: dashboard.php');
                header('location: https://fiberfault.onrender.com/');
                exit;
            } else {
                echo "Invalid password.";
                exit;
            }
        }
    }

    echo "Username not found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>
        <form action="login.php" method="post" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-md focus:border-blue-500 focus:ring-2 focus:ring-blue-300">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-md focus:border-blue-500 focus:ring-2 focus:ring-blue-300">
            </div>
            <button type="submit"
                class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-300">
                Login
            </button>
        </form>
        <p class="text-sm text-center text-gray-600">Don't have an account? <a href="register.php" class="text-blue-600 hover:underline">Register</a></p>
    </div>
</body>
</html>

