<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
    /* Reset */
body, html {
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
  height: 100%;
  box-sizing: border-box;
}

/* Background styling */
body {

  background-image: url('stacruz.jpg');
  background-position: center;
  background-size: cover;
}

/* Glassmorphic container */
.center {
  background: linear-gradient(to right, #98d189, #76b894);;
  backdrop-filter: blur(15px);
  border-radius: 15px;
  padding: 40px 30px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
  width: 100%;
  max-width: 400px;
  text-align: center;
  margin: auto; /* Centering container */
}

/* Title styling */
.center h1 {
  font-size: 2rem;
  margin-bottom: 25px; /* Increased margin for better spacing */
  color: #fff;
}

/* Input fields */
.center input[type="text"],
.center input[type="email"],
.center input[type="password"],
.center input[type="file"] {
  width: 100%;
  padding: 12px;
  margin: 12px 0; /* Consistent margin between inputs */
  border: none;
  border-radius: 10px;
  font-size: 1rem;
  background: rgba(255, 255, 255, 0.3);
  color: black;
  outline: none;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Input focus effect */
.center input:focus {
  border: 1px solid #6a11cb;
  background: rgba(255, 255, 255, 0.5);
}

/* Show password toggle */
.show-password {
  display: flex;
  align-items: center;
  justify-content: start;
  font-size: 0.9rem;
  color: black;
  margin-top: -5px; /* Reduced overlap margin */
}

/* Submit button */
.center input[type="submit"] {
  width: 100%;
  padding: 12px;
  margin-top: 20px;
  border: none;
  border-radius: 10px;
  background: linear-gradient(135deg, #6a11cb, #2575fc);
  color: #fff;
  font-size: 1.1rem;
  cursor: pointer;
  transition: background 0.3s ease, transform 0.2s ease;
}

.center input[type="submit"]:hover {
  background: linear-gradient(135deg, #2575fc, #6a11cb);
  transform: translateY(-3px);
}

/* Link to login page */
.center a {
  display: inline-block;
  margin-top: 20px; /* Adjusted for consistent spacing */
  color: #ddd;
  text-decoration: none;
  font-size: 0.9rem;
}

.center a:hover {
  text-decoration: underline;
}

/* Styling for the preview area */
.image-preview {
  margin-top: 20px; /* Adjusted for more spacing after file input */
  text-align: center;
}

.image-preview img {
  max-width: 100%;
  max-height: 200px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-top: 10px; /* Adds space between text and image */
}


  </style>
</head>
<body>
   
    <!-- Container for form -->
    <div class="center">
        <h1>Registration</h1>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" name="username" required/>
            
            <label for="email">Email Address:</label>
            <input type="email" name="email" required/>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required/>

            <!-- Show Password Toggle -->
            <div class="show-password">
                <input type="checkbox" id="show-password-checkbox" onclick="togglePassword()">
                <label for="show-password-checkbox">Show Password</label>
            </div>

            <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const checkbox = document.getElementById('show-password-checkbox');
            if (checkbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
    
            <!-- Profile Picture Upload Section -->
  <label for="profile_pic">Profile Picture:</label>
  <input type="file" name="profile_pic" id="profile_pic" accept="image/*" required />

  <!-- Preview container -->
  <div class="image-preview" id="image-preview">
    <p>No image selected</p>
  </div>

  <script>
    // Function to preview the selected image
    const profilePicInput = document.getElementById('profile_pic');
    const imagePreview = document.getElementById('image-preview');

    profilePicInput.addEventListener('change', function () {
      const file = this.files[0];

      // Check if a file is selected and if it's an image
      if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
          // Clear the preview and add the image
          imagePreview.innerHTML = `<img src="${event.target.result}" alt="Selected Image">`;
        };
        reader.readAsDataURL(file);
      } else {
        // Reset the preview if no file is selected
        imagePreview.innerHTML = `<p>No image selected</p>`;
      }
    });
  </script>
            
            <input type="submit" name="register" value="Register"/>
            <a href="login.php">Login Here</a>
        </form>
    </div>

   

    <?php 
    include 'connection.php';

    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $profilePicName = $_FILES['profile_pic']['name'];
        $profilePicTmpName = $_FILES['profile_pic']['tmp_name'];
        $profilePicSize = $_FILES['profile_pic']['size'];
        $profilePicError = $_FILES['profile_pic']['error'];
        $profilePicType = $_FILES['profile_pic']['type'];

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExt = explode('.', $profilePicName);
        $fileActualExt = strtolower(end($fileExt));

        if (in_array($fileActualExt, $allowed)) {
            if ($profilePicError === 0) {
                if ($profilePicSize < 8000000) { 
                    $profilePicNewName = uniqid('', true) . "." . $fileActualExt;
                    $profilePicDestination = 'uploads/' . $profilePicNewName;
                    move_uploaded_file($profilePicTmpName, $profilePicDestination);

                    $select = "SELECT * FROM tbl_users WHERE email_address = '$email'";
                    $result = mysqli_query($conn, $select);

                    if(mysqli_num_rows($result) > 0) {
                        echo '<script type="text/javascript">';
                        echo 'alert("Email Already Taken!");';
                        echo 'window.location.href = "register.php";';
                        echo '</script>';
                    } else {
                        $register = "INSERT INTO tbl_users (username, email_address, password, profile_pic, status) 
                                     VALUES ('$username', '$email', '$password', '$profilePicNewName', 'pending')";
                        mysqli_query($conn, $register);

                        echo '<script type="text/javascript">';
                        echo 'alert("Your Account Is Now Pending for Approval!");';
                        echo 'window.location.href = "register.php";';
                        echo '</script>';
                    }
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }
    }
    ?>
</body>
</html>
