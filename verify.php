<?php
// DB connection
$conn = new mysqli('localhost', 'root', '', 'user_verification');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_GET['user_id'];

// Get user and verification status
$result = $conn->query("SELECT u.full_name, v.id_image, v.status FROM users u JOIN verification v ON u.id = v.user_id WHERE u.id = $user_id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    
    // Update verification status
    $stmt = $conn->prepare("UPDATE verification SET status = ? WHERE user_id = ?");
    $stmt->bind_param("si", $status, $user_id);
    
    if ($stmt->execute() && $status == 'verified') {
        // Mark user as verified
        $conn->query("UPDATE users SET verified = 1 WHERE id = $user_id");
        header("Location: login.php");
    } else {
        echo "Verification failed.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify User</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h2>Verify User: <?php echo $user['full_name']; ?></h2>
    <img src="<?php echo $user['id_image']; ?>" alt="ID Image" width="300"><br>
    
    <form method="POST">
        <label>Status:</label>
        <select name="status">
            <option value="verified">Verified</option>
            <option value="rejected">Rejected</option>
        </select><br>
        
        <button type="submit">Verify</button>
    </form>
</body>
</html>
