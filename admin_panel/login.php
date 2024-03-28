<?php
    include("connect.php");
    session_start();
    $imageFolder = "../images/profile_images/";
    if ( isset($_POST['login-button']) ) {
        $emailOrUsername = $_POST['emailOrUsername'];
        $password = $_POST['password'];
        $userInfoQuery = "SELECT * FROM adminstaff WHERE (AdminUsername='$emailOrUsername' AND AdminUserPassword='$password') OR (AdminEmail='$emailOrUsername' AND AdminUserPassword='$password')";
        $userInfoQueryResult = mysqli_query($connect,$userInfoQuery);
        $totalUserInfo = mysqli_num_rows($userInfoQueryResult);
        if ( $totalUserInfo == 0 ) {
            echo "<script>alert('Username or password is not correct!')</script>";
            echo "<script>window.location='login.php'</script>";
        } else {
            for ( $count = 0 ; $count < $totalUserInfo ; $count++ ) {
                $userinfoData = mysqli_fetch_array($userInfoQueryResult);
                $firstName = $userinfoData['AdminFirstName'];
                $lastName = $userinfoData['AdminLastName'];
                $email = $userinfoData['AdminEmail'];
                $adminId = $userinfoData['AdminId'];
                $_SESSION['admin-firstname'] = $firstName;
                $_SESSION['admin-fullname'] = $firstName.' '.$lastName;
                $_SESSION['admin-id'] = $adminId;
                $_SESSION['admin-email'] = $email;
                $_SESSION['admin-profile-link'] = $imageFolder.$userinfoData['ProfileImage'];
            }
            echo "<script>window.location='index.php'</script>";
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
    <link rel="stylesheet" href="../styles/admin_panel_styles/login-style.css">
</head>
<body>
    <div class="login-guest-wrapper">
        <div class="login-wrapper">
            <div class="title">Log In</div>
            <form action="login.php" method="POST">
                <label for="emailOrUsername">E-mail or Username</label><br>
                <input type="text" name="emailOrUsername" id="emailOrUsername" spellcheck="false" required><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" spellcheck="false" required>
                <a href="register.php">New admin? Register</a>
                <input type="submit" value="LOGIN" name="login-button">
            </form>
        </div>
    </div>
</body>
</html>