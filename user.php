<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

/* Body Styling */
body {
   background-image: url('stacruz.jpg');
   background-size: cover;
   background-position: center;
    color: #333;
    font-size: 16px;
    line-height: 1.6;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Navigation Bar */
nav {
  background: linear-gradient(to right, #98d189, #76b894);
    padding: 10px 20px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

nav ul {
    display: flex;
    list-style-type: none;
    justify-content: space-between;
    align-items: center;
}

nav ul li {
    margin: 0 10px;
}

nav ul li a {
    text-decoration: none;
    color: #ffffff;
    font-weight: bold;
    padding: 8px 15px;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

nav ul li a:hover {
    background: #0056b3;
}

/* Welcome Section */
.bg-section {
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(to right, #98d189, #76b894);
    color: #fff;
    border-radius: 10px;
    margin: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.bg-section h2 {
    margin-bottom: 20px;
    font-size: 2.5em;
    font-weight: bolder;
}

/* Buttons */
.btn-custom {
    display: block;
    background: #ffffff;
    color: #007bff;
    text-decoration: none;
    font-size: 1.2em;
    font-weight: bold;
    padding: 15px 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    margin: 15px auto;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-custom:hover {
    transform: scale(1.05);
    box-shadow: 0 7px 15px rgba(0, 0, 0, 0.3);
    background: #76b894;
    color: #ffffff;
}

/* Container Styling */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Row and Column Layout */
.row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.col-md-4 {
    flex: 0 0 calc(33.333% - 20px);
    max-width: calc(33.333% - 20px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .col-md-4 {
        flex: 0 0 calc(50% - 20px);
        max-width: calc(50% - 20px);
    }
}

@media (max-width: 480px) {
    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

    </style>
</head>
<body>
    <nav>
        <ul>
            
            <li><a href="user.php">Home</a></li>
            <li><a href="login.php">Logout</a></li>
        </ul>
    </nav>

    <div class="bg-section">
        <div class="container">
            <h2>Welcome to Barangay Services</h2>
            <div class="row">
                <div class="col-md-4">
                    <a href="indigency.php" class="btn-custom">Indigency</a>
                </div>
                <div class="col-md-4">
                    <a href="BrgyID.php" class="btn-custom">Barangay ID</a>
                </div>
                <div class="col-md-4">
                    <a href="certificate.php" class="btn-custom">Certification</a>
                </div>
                <div class="col-md-4">
                    <a href="barangay-permit.html" class="btn-custom">Barangay Permit</a>
                </div>
                <div class="col-md-4">
                    <a href="payments.html" class="btn-custom">Payments</a>
                </div>
                <div class="col-md-4">
                    <a href="feedback.html" class="btn-custom">Feedback</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
