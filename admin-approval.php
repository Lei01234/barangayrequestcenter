<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approval</title>
    <link rel="stylesheet" href="approval.css">
</head>
<body>
    <div class="center">
        <h1>User Approval</h1>
        <table id="user">
            <tr>
               
                <th>Username</th>
                <th>Email Address</th>
                <th>Profile Picture</th>
                <th>Action</th>
            </tr>

            <?php
            $query = "SELECT * FROM tbl_users WHERE status = 'pending' ORDER BY id ASC";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email_address']; ?></td>
                    <td><img src="uploads/<?php echo $row['profile_pic']; ?>" width="100" height="100"></td>
                    <td>
                        <form action="admin-approval.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                            <input type="submit" name="approve" value="Approve"/>
                            <input type="submit" name="deny" value="Deny"/>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <?php
    if (isset($_POST['approve'])) {
        $id = $_POST['id'];
        $approveQuery = "UPDATE tbl_users SET status = 'approved' WHERE id = '$id'";
        if (mysqli_query($conn, $approveQuery)) {
            echo '<script>alert("User Approved!"); window.location.href = "admin-approval.php";</script>';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    if (isset($_POST['deny'])) {
        $id = $_POST['id'];
        $deleteQuery = "DELETE FROM tbl_users WHERE id = '$id'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("User Denied!"); window.location.href = "admin-approval.php";</script>';
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
