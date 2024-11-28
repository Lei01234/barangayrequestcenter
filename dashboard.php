<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        h1, p {
            margin: 0;
        }

        /* Header Styles */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        header h1 {
            font-size: 20px;
        }

        /* Burger Menu Styles */
        .burger-menu {
            display: flex;
            cursor: pointer;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 20px;
        }

        .burger-menu div {
            background-color: whitesmoke;
            height: 4px;
            width: 100%;
            border-radius: 2px;
        }

        /* Side Menu Styles */
        .side-menu {
            width: 200px;
            background-color: #333;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            transform: translateX(-220px);
            transition: transform 0.3s ease-in-out;
            z-index: 999;
        }

        .side-menu.active {
            transform: translateX(0);
        }

        .side-menu h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .side-menu ul {
            list-style: none;
            padding: 0;
        }

        .side-menu ul li {
            padding: 10px;
            text-align: center;
        }

        .side-menu ul li a {
            color: white;
            text-decoration: none;
        }

        /* Main Content Styles */
        .main-content {
            margin-top: 60px; /* Header height */
            padding: 20px;
            margin-left: 220px;
            transition: margin-left 0.3s ease-in-out;
        }

        .side-menu.active ~ .main-content {
            margin-left: 0;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .burger-menu {
                display: flex;
            }

            .side-menu {
                transform: translateX(-220px);
            }

            .side-menu.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="burger-menu" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h1>Admin Dashboard</h1>
    </header>

    <!-- Side Menu -->
    <div class="side-menu" id="sideMenu">
        <h3>Welcome, <?php echo $_SESSION['username']; ?></h3>
        <ul>
            <li><a href="">Dashboard</a></li>
            <li><a href="admin-approval.php">approval</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Admin Dashboard</h1>
        <p>Welcome to your admin panel. Manage your application here.</p>
    </div>

    <!-- JavaScript for Toggling Menu -->
    <script>
        function toggleMenu() {
            const sideMenu = document.getElementById('sideMenu');
            sideMenu.classList.toggle('active');
        }
    </script>
</body>
</html>
