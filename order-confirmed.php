<?php
    include('connect.php');
    session_start();
    include('execution-functions.php');
    
    $orderDate = date("Y/m/d");
    $userId = $_SESSION['user-id'];
    $currency = "USD";
    $paymentType = "cod";
    $deliveryStatus = "pending";
    $totalQuantity = 1;
    $lastOrderId;
    // $_SESSION['cart-items-array'] = array();

    $purchaseOrderQuery = "INSERT INTO purchase_order(OrderDate,UserId,Currency,PaymentType,DeliveryStatus) VALUES (
        '$orderDate','$userId','$currency','$paymentType','$deliveryStatus'
    )";
    $purchaseOrderQueryResult = mysqli_query($connect,$purchaseOrderQuery);
    if ( $purchaseOrderQueryResult ) {
        $lastOrderQuery = "SELECT * FROM purchase_order ORDER BY OrderId DESC LIMIT 1";
        $lastOrderQueryResult = mysqli_query($connect,$lastOrderQuery);
        $totalLastOrder = mysqli_num_rows($lastOrderQueryResult);
        for ( $lCount = 0 ; $lCount < $totalLastOrder ; $lCount++ ) {
            $lastOrderData = mysqli_fetch_array($lastOrderQueryResult);
            $lastOrderId = $lastOrderData['OrderId'];
        }

    } else {
        echo "<script>alert('Failed to record your order...')</script>";
        echo "<script>window.location='checkout-payment.php'</script>";
    }

    $cartItemArray = $_SESSION['cart-items-array'];
    for ( $count = 0 ; $count < count($cartItemArray) ; $count++ ) {
        $productPrice;
        $productQuery = "SELECT * FROM product WHERE ProductId='$cartItemArray[$count]'";
        $productQueryResult = mysqli_query($connect,$productQuery);
        $totalProduct = mysqli_num_rows($productQueryResult);
        for ( $pCount = 0 ; $pCount < $totalProduct ; $pCount++ ) {
            $productData = mysqli_fetch_array($productQueryResult);
            $productId = $productData['ProductId'];
            $productPrice = $productData['Price'];
        }

        $orderProductQuery = "INSERT INTO order_products VALUES(
            $lastOrderId,'$cartItemArray[$count]','$totalQuantity',$productPrice
        )";

        $orderProductQueryResult = mysqli_query($connect,$orderProductQuery);
        if ( !$orderProductQueryResult ) {
            echo "<script>alert('Failed to record your order...')</script>";
            echo "<script>window.location='checkout-payment.php'</script>";
        }
    }

    // Emptying session cart
    $_SESSION['cart-items-array']=array();
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
    <script src="https://kit.fontawesome.com/e2c9faac31.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/animation-styles.css">
    <!-- Splide Js cdn -->
    <link rel="stylesheet" href="scripts/splide-4.1.3/dist/css/splide.min.css">
    <!-- <link rel="stylesheet" href="styles/app-style.css">
    <link rel="stylesheet" href="styles/shop-style.css">
    <link rel="stylesheet" href="styles/checkout-payment-style.css"> -->
    <link rel="stylesheet" href="styles/app-style.css">
    <link rel="stylesheet" href="styles/order-confirmed-style.css">
</head>
<body>
    <!-- <div class="nav-bar-wrapper">
        <nav class="nav-bar">
            <div class="left-wrapper">
                <div class="top-wrapper"><i class="fa-solid fa-headphones fa-2xl"></i> T & T</div>
                <div class="bottom-wrapper">audio store myanmar</div>
            </div>
            <div class="middle-wrapper">
                <a href="index.php">Home</a>
                <a href="shop.php">Shop</a>
                <a href="#">About</a>
                <a href="#">Contact Us</a>
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
    </div> -->

    <div class="main-wrapper">
        <div class="confirm-logo-wrapper">
            <div class="overlay"></div>
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="order-confirm">Order Confirmation<br><span>Thanks for your order.</span></div>
        <div class="info-msg">
            Your order has been confirmed and the items will be deliver to you within 2-4 business days. Please be note that, if you have been selected cash on delivery payment method, you cannot cancel you order.
        </div>
        <a href="index.php" class="back-to-home-button"><button>BACK TO HOME</button></a>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="scripts/splide-4.1.3/dist/js/splide.min.js"></script>
    <script src="scripts/app-script.js"></script>
</body>
</html>