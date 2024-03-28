<?php
    include('connect.php');
    session_start();
    include('execution-functions.php');

    if ( isset($_POST['login-button']) ) {
        $emailOrUsername = $_POST['emailOrUsername'];
        $password = $_POST['password'];
        $userInfoQuery = "SELECT * FROM user WHERE (Username='$emailOrUsername' AND UserPassword='$password') OR (Email='$emailOrUsername' AND UserPassword='$password')";
        $userInfoQueryResult = mysqli_query($connect,$userInfoQuery);
        $totalUserInfo = mysqli_num_rows($userInfoQueryResult);
        if ( $totalUserInfo == 0 ) {
            echo "<script>alert('Username or password is not correct!')</script>";
            echo "<script>window.location='login.php'</script>";
        } else {
            for ( $count = 0 ; $count < $totalUserInfo ; $count++ ) {
                $userinfoData = mysqli_fetch_array($userInfoQueryResult);
                $firstName = $userinfoData['FirstName'];
                $lastName = $userinfoData['LastName'];
                $phone = $userinfoData['Phone'];
                $email = $userinfoData['Email'];
                $userId = $userinfoData['UserId'];
                $_SESSION['user-fullname'] = $firstName.' '.$lastName;
                $_SESSION['user-id'] = $userId;
                $_SESSION['user-phone'] = $phone;
                $_SESSION['user-email'] = $email;
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
    <title>T & T Audio Store</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/e2c9faac31.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <link rel="stylesheet" href="styles/animation-styles.css">

        <!-- Splide Js cdn -->
        <link rel="stylesheet" href="scripts/splide-4.1.3/dist/css/splide.min.css">
        <link rel="stylesheet" href="styles/app-style.css">
        <link rel="stylesheet" href="styles/login-style.css">
</head>
<body>
    <div class="nav-bar-wrapper">
            <nav class="nav-bar">
                <div class="left-wrapper">
                    <div class="top-wrapper"><i class="fa-solid fa-headphones fa-2xl"></i> T & T</div>
                    <div class="bottom-wrapper">audio store myanmar</div>
                </div>
                <div class="middle-wrapper">
                    <a href="index.php">Home</a>
                    <a href="shop.php">Shop</a>
                    <a href="about.php">About</a>
                    <a href="order-history.php">Order History</a>
                </div>
                <div class="right-wrapper">
                    <div class="search-box-wrapper">
                        <input type="text" placeholder="Search products..." spellcheck="false">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <?php
                        if ( isUserLoggedIn() ) {
                            ?>
                            <div class="account-wrapper" isUserLoggedIn="true"><?php echo $_SESSION['user-fullname']?></div>
                            <?php
                        } else {
                            ?>
                            <div class="account-wrapper" isUserLoggedIn="false"><a href="login.php"><i class="fa-regular fa-user"></i> Account</a></div>
                            <?php
                        }
                    ?>
                    
                    <div class="cart-wrapper">
                        <i class="fa-solid fa-cart-plus"></i>
                        <div class="badge"><?php echo count($_SESSION['cart-items-array'])?></div>
                    </div>
                </div>
            </nav>
            <div class="nav-bar-overlay"></div>
    </div>

    <div class="login-guest-wrapper">
        <div class="login-wrapper">
            <div class="title">Log In</div>
            <form action="login.php" method="POST">
                <label for="emailOrUsername">E-mail or Username</label><br>
                <input type="text" name="emailOrUsername" id="emailOrUsername" spellcheck="false" required><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" spellcheck="false" required>
                <a href="register.php">New to T & T Audio Store? Register</a> | <a href="#">Forgot your password?</a>
                <input type="submit" value="LOGIN" name="login-button">
            </form>
        </div>
        <div class="guest-wrapper">
            <div class="title">Purchase As A Guest</div>
            <p>You can continue to browse the products without logging in. But if you want to purchase any products, you must have to login with you credentials such as user or email and password.</p>
            <a href="index.php"><button>Continue As A Guest</button></a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="scripts/splide-4.1.3/dist/js/splide.min.js"></script>
    <script src="scripts/app-script.js"></script>
    <script src="scripts/animation-script.js"></script>
</body>
</html>