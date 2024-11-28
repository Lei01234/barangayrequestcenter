<?php 
session_start();
include 'connection.php'; // Ensure this file includes your database connection

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Secure login query using prepared statements
    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email_address = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["status"] = $row['status'];
        $_SESSION["user_id"] = $row['id']; // Assuming 'id' is the user ID column

        if ($row['status'] == "approved") {
            header("Location: user.php"); // Redirect to dashboard
            exit();
        } elseif ($row['status'] == "pending") {
            echo '<script>alert("Your account is still pending approval!");</script>';
        } else {
            echo '<script>alert("Your account is not authorized to login.");</script>';
        }
    } else {
        echo '<script>alert("Incorrect email or password!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Login</title>
    
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            background: url('stacruz.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            background: linear-gradient(to right, #a8e298, #76b894);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }

        input[type="email"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }

        .show-password {
            margin: 10px 0;
            font-size: 0.9rem;
            text-align: left;
        }

        .show-password input[type="checkbox"] {
            margin-right: 5px;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            color: #6a11cb;
            text-decoration: none;
            font-size: 0.9rem;
        }

        a:hover {
            text-decoration: underline;
        }

      
      
    </style>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="email">Email Address:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <div class="show-password">
                <input type="checkbox" id="show-password-checkbox" onclick="togglePassword()">
                <label for="show-password-checkbox">Show Password</label>
            </div>

            <input type="submit" name="login" value="Login">
            <a href="register.php">Register Here</a>
        </form>
    </div>
</body>
</html>
