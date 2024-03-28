<?php
    include('connect.php');
    session_start();
    include('execution-functions.php');
    if ( !isUserLoggedIn() ) {
        echo "<script>window.location='login.php'</script>";
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
    <link rel="stylesheet" href="styles/shop-style.css">
    <link rel="stylesheet" href="styles/order-history-style.css">
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
        <div class="title">Order History</div>
        <table class="order-history-table" border="1px">
            <tr>
                <th>Order Id</th>
                <th>Order Items</th>
                <th>Order Date</th>
                <th>Payment Type</th>
                <th>Total Price</th>
                <th>Delivery Status</th>
            </tr>
            <?php

                $userId = $_SESSION['user-id'];
                $purchaseOrderQuery = "SELECT * FROM purchase_order WHERE UserId=$userId ORDER BY OrderId DESC";
                $purchaseOrderQueryResult = mysqli_query($connect,$purchaseOrderQuery);
                $totalPurchaseOrder = mysqli_num_rows($purchaseOrderQueryResult);
                for ( $count = 0 ; $count < $totalPurchaseOrder ; $count++ ) {
                    $purchaseOrderData = mysqli_fetch_array($purchaseOrderQueryResult);
                    $orderId = $purchaseOrderData['OrderId'];
                    $orderDate = $purchaseOrderData['OrderDate'];
                    $paymentType = $purchaseOrderData['PaymentType'];
                    $deliveryStatus = $purchaseOrderData['DeliveryStatus'];
                    $orderItems="";
                    $totalPrice=0;

                    $orderProductQuery = "SELECT * FROM order_products WHERE OrderId=$orderId";
                    $orderProductQueryResult = mysqli_query($connect,$orderProductQuery);
                    $totalOrderProduct = mysqli_num_rows($orderProductQueryResult);
                    for ( $opCount = 0 ; $opCount < $totalOrderProduct ; $opCount++ ) {
                        $orderProductData = mysqli_fetch_array($orderProductQueryResult);
                        $productId = $orderProductData['ProductId'];
                        $totalQuantity = $orderProductData['TotalQuantity'];
                        // $totalAmount = $orderProductData['TotalAmount'];

                        $productQuery = "SELECT * FROM product WHERE ProductId='$productId'";
                        $productQueryResult = mysqli_query($connect,$productQuery);
                        for ( $pCount = 0 ; $pCount < 1 ; $pCount++ ) {
                            $productData = mysqli_fetch_array($productQueryResult);
                            $productName = $productData['ProductName'];
                            $productPrice = $productData['Price'];
                            
                            $orderItems = $orderItems.$productName.', ';
                            $totalPrice += $productPrice;
                        }
                    }
                    ?>
                        <tr>
                            <td><?php echo $orderId?></td>
                            <td class="item-data"><?php echo $orderItems?></td>
                            <td><?php echo $orderDate?></td>
                            <td>Cash On Delivery</td>
                            <td class="price">$ <?php echo $totalPrice?></td>
                            <td class="delivery-status"><?php echo $deliveryStatus?></td>
                        </tr>
                    <?php
                }
            ?>
            <!-- <tr>
                <td>1</td>
                <td class="item-data">Moondrop drong , Fiio IEM Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi nobis, ducimus voluptates eum illum veniam ad sapiente cum? Eius obcaecati repellat nobis sit deserunt a expedita ipsum, quos maiores nulla?</td>
                <td>2023/22/17</td>
                <td>Cash On Delivery</td>
                <td class="price">$435</td>
                <td class="delivery-status">Pending</td>
            </tr> -->
        </table>
    </div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="scripts/splide-4.1.3/dist/js/splide.min.js"></script>
    <script src="scripts/app-script.js"></script>
    <script src="scripts/order-history-script.js"></script>
</body>
</html>