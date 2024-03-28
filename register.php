<?php
    include('connect.php');
    session_start();
    include('execution-functions.php');

    if ( isset($_POST['register-button']) ) {
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone-number'];
        $dateOfBirth = $_POST['date-of-birth'];
        $password = $_POST['password'];
        $registrationDate = date("Y/m/d");

        $profilImage = $_FILES['profile-image'];
        $profilImageName = $firstName.' '.$lastName;
        $profilImageType = strtolower(pathinfo($_FILES['profile-image']['name'],PATHINFO_EXTENSION));
        $profilImageFullname = $profilImageName.'.'.$profilImageType;
        $imageFolder = "images/profile_images/";
        $copyProfileImage = copy($_FILES['profile-image']['tmp_name'],$imageFolder.$profilImageFullname );

        if ( $copyProfileImage ) {
            // echo "'$username','$password','$firstName','$lastName','$dateOfBirth','$email',','$phoneNumber','$registrationDate','$profilImage'";

            $insertUserQuery = "INSERT INTO user(Username,UserPassword,FirstName,LastName,DateOfBirth,Email,Phone,RegistrationDate,ProfileImage) VALUES(
                '$username','$password','$firstName','$lastName','$dateOfBirth','$email','$phoneNumber','$registrationDate','$profilImageFullname'
            )";

            $insertUserQueryResult = mysqli_query($connect,$insertUserQuery);
            if ( $insertUserQueryResult ) {
                echo "<script>alert('User registration has been successful.')</script>";
                echo "<script>window.location='login.php'</script>";
            } else {
                echo "<script>alert('Failed to register new user.')</script>";
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
        <link rel="stylesheet" href="styles/register-style.css">
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
                    <label for="">Phone Number</label><br>
                    <input type="text" name="phone-number" required>
                </div>
                <div>
                    <label for="">Date Of Birth</label><br>
                    <input type="date" name="date-of-birth" required>
                </div>
            </div>
            <div class="divider">
                <div>
                    <label for="">Enter password</label><br>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <label for="">Confirm password</label><br>
                    <input type="password">
                </div>
            </div>
            <div class="divider final-divider">
                <div class="register-wrapper">
                    <input type="submit" value="Register" name="register-button">
                </div>
            </div>
        </form>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="scripts/splide-4.1.3/dist/js/splide.min.js"></script>
    <script src="scripts/app-script.js"></script>
    <script src="scripts/animation-script.js"></script>
    <script src="scripts/register-script.js"></script>
</body>
</html>