<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Read the existing users from the JSON file
    $users = json_decode(file_get_contents('users.json'), true);

    // Check if the username already exists
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            echo "Username already exists.";
            exit;
        }
    }

    // Add the new user to the users array
    $users[] = ['username' => $username, 'password' => $hashedPassword];

    // Save the updated user data back to the JSON file
    file_put_contents('users.json', json_encode($users));

    echo "Registration successful!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700">Register</h2>
        <form action="register.php" method="post" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-md focus:border-green-500 focus:ring-2 focus:ring-green-300">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-md focus:border-green-500 focus:ring-2 focus:ring-green-300">
            </div>
            <button type="submit"
                class="w-full px-4 py-2 font-semibold text-white bg-green-600 rounded-md hover:bg-green-700 focus:ring-2 focus:ring-green-300">
                Register
            </button>
        </form>
        <p class="text-sm text-center text-gray-600">Already have an account? <a href="login.php" class="text-green-600 hover:underline">Login</a></p>
    </div>
</body>
</html>
