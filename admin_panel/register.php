<?php
    include("connect.php");

    if ( isset($_POST['register-button']) ) {
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $profilImage = $_FILES['profile-image'];
        $profilImageName = $firstName.' '.$lastName;
        $profilImageType = strtolower(pathinfo($_FILES['profile-image']['name'],PATHINFO_EXTENSION));
        $profilImageFullname = $profilImageName.'.'.$profilImageType;
        $imageFolder = "../images/profile_images/";
        $copyProfileImage = copy($_FILES['profile-image']['tmp_name'],$imageFolder.$profilImageFullname );

        if ( $copyProfileImage ) {
            // echo "'$username','$password','$firstName','$lastName','$dateOfBirth','$email',','$phoneNumber','$registrationDate','$profilImage'";

            $insertAdminQuery = "INSERT INTO adminstaff(AdminUsername,AdminUserPassword,AdminFirstName,AdminLastName,AdminEmail,ProfileImage) VALUES(
                '$username','$password','$firstName','$lastName','$email','$profilImageFullname'
            )";

            $insertAdminQueryResult = mysqli_query($connect,$insertAdminQuery);
            if ( $insertAdminQueryResult ) {
                echo "<script>alert('Admin registration has been successful.')</script>";
                echo "<script>window.location='login.php'</script>";
            } else {
                echo "<script>alert('Failed to register new admin.')</script>";
            }
        } else {
            echo "<script>alert('Error on copying profile image')</script>";
            echo "<script>window.location='register.php'</script>";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/admin_panel_styles/app-style.css">
    <link rel="stylesheet" href="../styles/admin_panel_styles/register-style.css">
</head>
<body>
    
    <div class="main-wrapper">
        <div class="title">Create An Account</div>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <div class="divider">
                <div>
                    <label for="profile-image" class="profile-label">Upload profile image</label><br>
                    <input type="file" id="profile-image" name="profile-image">
                </div>
            </div>
            <div class="divider">
                <div>
                    <label for="">First Name</label><br>
                    <input type="text" name="first-name" required>
                </div>
                <div>
                    <label for="">Last Name</label><br>
                    <input type="text" name="last-name" required>
                </div>
            </div>
            <div class="divider">
                <div>
                    <label for="">Username</label><br>
                    <input type="text" name="username" required>
                </div>
                <div>
                    <label for="">Email</label><br>
                    <input type="email" name="email" required>
                </div>
            </div>
            <div class="divider">
                <div>
                    <label for="">Enter password</label><br>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <label for="">Confirm password</label><br>
                    <input type="password" required>
                </div>
            </div>
            <div class="divider final-divider">
                <div class="register-wrapper">
                    <input type="submit" value="Register" name="register-button">
                </div>
            </div>
        </form>
    </div>

    <script src="../scripts/admin_panel_scripts/register-script.js"></script>
</body>
</html>