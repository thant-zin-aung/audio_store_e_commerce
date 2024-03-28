<?php
    include('connect.php');
    session_start();
    if ( isset($_POST['update-button']) ) {
        $orderId = $_POST['order-id'];
        $changedDeliveryStatus = $_POST['delivery-status'];
        $updateOrderQuery = "UPDATE purchase_order SET DeliveryStatus='$changedDeliveryStatus' WHERE OrderId=$orderId";
        $updateOrderQueryResult = mysqli_query($connect,$updateOrderQuery);
        if ( !$updateOrderQueryResult ) {
            echo "<script>alert('Failed to update delivery status.')</script>";
        } else {
            echo "<script>alert('Delivery status updated successfully.')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T & T Audio Store Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/admin_panel_styles/app-style.css">
    <link rel="stylesheet" href="../styles/admin_panel_styles/order-style.css">
</head>
<body>

    <nav class="nav-bar">
        <!-- App Icon wrapper section-->
        <div class="app-icon-wrapper">
            <div class="top-wrapper">
                <i class="fa-solid fa-headphones app-logo"></i>
                <div>T & T</div>
            </div>
            <div class="bottom-wrapper">Audio Store</div>
        </div>

        <div class="nav-button-wrapper">
            <div class="overview-button">
                <a href="index.php"><i class="fa-solid fa-chart-simple"></i> &nbsp; Overview</a>
            </div>
            <div class="overview-button">
                <a href="store.php"><i class="fa-solid fa-shop"></i> &nbsp; Store</a>
            </div>
            <div class="overview-button active-button">
                <a href="order.php"><i class="fa-solid fa-cart-arrow-down"></i> &nbsp; Orders</a>
            </div>
            <div class="overview-button">
                <i class="fa-solid fa-cart-flatbed"></i> &nbsp; Pre-Orders
            </div>
            <div class="overview-button">
                <i class="fa-solid fa-clock-rotate-left"></i> &nbsp; Login History
            </div>
            <div class="overview-button">
                <i class="fa-regular fa-floppy-disk"></i> &nbsp; Changes History
            </div>
        </div>

        <div class="contact-wrapper">
            <div>Help</div>
            <div>Contact Us</div>
            <div class="logout-button"><i class="fa-solid fa-arrow-right-from-bracket"></i> &nbsp; Log Out</div>
        </div>
    </nav>

    <section id="right-content-section">
        <div class="top-bar-wrapper">
            <div class="welcome-text">Welcome back, <?php echo $_SESSION['admin-firstname']?></div>
            <div class="welcome-item-wrapper">

                <div class="noti-icon-wrapper"><i class="fa-regular fa-bell"></i></div>
                <div class="profile-image-wrapper" style="background-image: url('<?php echo $_SESSION['admin-profile-link']?>')"></div>
                <div class="admin-username-wrapper"><?php echo $_SESSION['admin-fullname']?></div>
            </div>
        </div>
        <div class="welcome-sub-text">Here's what's happening with your store today.</div>

        <div class="order-table-title">Customer order history list</div>
        <table class="order-table" border="1px">
            <tr>
                <th>Order Id</th>
                <th>Order Items</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Total Price</th>
                <th>Delivery Status</th>
            </tr>

            <?php

                // $userId = $_SESSION['user-id'];
                $purchaseOrderQuery = "SELECT * FROM purchase_order ORDER BY OrderId DESC";
                $purchaseOrderQueryResult = mysqli_query($connect,$purchaseOrderQuery);
                $totalPurchaseOrder = mysqli_num_rows($purchaseOrderQueryResult);
                for ( $count = 0 ; $count < $totalPurchaseOrder ; $count++ ) {
                    $purchaseOrderData = mysqli_fetch_array($purchaseOrderQueryResult);
                    $orderId = $purchaseOrderData['OrderId'];
                    $userId = $purchaseOrderData['UserId'];
                    $orderDate = $purchaseOrderData['OrderDate'];
                    $deliveryStatus = $purchaseOrderData['DeliveryStatus'];
                    $orderItems="";
                    $totalPrice=0;
                    $customerName="";
                    $customerProfileURL="";
                    $imageFolderPath = "../images/profile_images/";
                    
                    $userQuery = "SELECT * FROM user WHERE UserId=$userId";
                    $userQueryResult = mysqli_query($connect,$userQuery);
                    for ( $uCount = 0 ; $uCount < 1 ; $uCount++ ) {
                        $userData = mysqli_fetch_array($userQueryResult);
                        $customerName = $userData['FirstName'].' '.$userData['LastName'];
                        $customerProfileURL = $imageFolderPath.$userData['ProfileImage'];
                    }

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
                            <td><img class="profile-image" src="<?php echo $customerProfileURL?>"> &nbsp; <?php echo $customerName?></td>
                            <td><?php echo $orderDate?></td>
                            <td class="price">$ <?php echo $totalPrice?></td>
                            <td class="delivery-status">
                                <form action="order.php" method="POST">
                                    <input type="hidden" name="order-id" value="<?php echo $orderId?>">
                                    <select name="delivery-status">
                                        <option value="<?php echo strtolower($deliveryStatus);?>"><?php echo $deliveryStatus?></option>
                                        <option value="delivered">Delivered</option>
                                        <option value="processing">Processing</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                    <input type="submit" value="Update" name="update-button">
                                </form>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/e2c9faac31.js" crossorigin="anonymous"></script>
    <script src="../scripts/admin_panel_scripts/app-script.js"></script>
    <script src="../scripts/admin_panel_scripts/order-script.js"></script>
</body>
</html>