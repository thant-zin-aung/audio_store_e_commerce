<?php
    include('connect.php');
    session_start();
    if ( !isset($_SESSION['admin-id'])) {
        echo "<script>window.location='login.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T & T Audio Store Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/admin_panel_styles/app-style.css">
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
            <div class="overview-button active-button">
                <a href="index.php"><i class="fa-solid fa-chart-simple"></i> &nbsp; Overview</a>
            </div>
            <div class="overview-button">
                <a href="store.php"><i class="fa-solid fa-shop"></i> &nbsp; Store</a>
            </div>
            <div class="overview-button">
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

        <div class="sale-detail-wrapper">
            <div class="item">
                <div class="title-wrapper"><i class="fa-brands fa-sellcast"></i> &nbsp; Total sales</div>
                <div class="total-amount-wrapper">$ 2543322.73</div>
                <div class="statistic-wrapper">
                    <span class="up-trend-style"><i class="fa-solid fa-arrow-trend-up"></i> &nbsp; 38.4%</span> &nbsp;&nbsp; +20K this week
                </div>
            </div>
            <div class="item">
                <div class="title-wrapper"><i class="fa-solid fa-users"></i> &nbsp; Total Visitors</div>
                <div class="total-amount-wrapper">238</div>
                <div class="statistic-wrapper">
                    <span class="up-trend-style"><i class="fa-solid fa-arrow-trend-up"></i> &nbsp; 11.8%</span> &nbsp;&nbsp; +10 users this week
                </div>
            </div>
            <div class="item">
                <div class="title-wrapper"><i class="fa-solid fa-cart-arrow-down"></i> &nbsp; Total Orders</div>
                <div class="total-amount-wrapper">1659</div>
                <div class="statistic-wrapper">
                    <span class="up-trend-style"><i class="fa-solid fa-arrow-trend-up"></i> &nbsp; 3.6%</span> &nbsp;&nbsp; +100 orders this week
                </div>
            </div>
            <div class="item">
                <div class="title-wrapper"><i class="fa-solid fa-cart-flatbed"></i> &nbsp; Total Pre-Order</div>
                <div class="total-amount-wrapper">41330</div>
                <div class="statistic-wrapper">
                    <span class="down-trend-style"><i class="fa-solid fa-arrow-trend-down"></i> &nbsp; 1.7%</span> &nbsp;&nbsp; +15 pre-orders this week
                </div>
            </div>
        </div>

        <div class="order-detail-wrapper">
            <table class="order-table">
                <thead>
                    <th>Customer Name</th>
                    <th>Order No</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Delivery Status</th>
                </thead>
                <?php
                $purchaseOrderQuery = "SELECT * FROM purchase_order ORDER BY OrderId DESC LIMIT 5";
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
                            <td class="image-table-data"><img src="<?php echo $customerProfileURL?>"><?php echo $customerName?></td>
                            <td><?php echo $orderId?></td>
                            <td><?php echo $orderDate?></td>
                            <td><?php echo $totalOrderProduct?></td>
                            <td>$ <?php echo $totalPrice?></td>
                            <td><span class="status-style <?php echo strtolower($deliveryStatus)?>-status"><i class="fa-solid fa-hourglass-end"></i> &nbsp; <?php echo $deliveryStatus?></span></td>
                        </tr>
                    <?php
                }
            ?>
            </table>

            <div class="pie-chart-wrapper">
                <div class="title-wrapper">Sales by category</div>

                <div class="pie-chart">
                    <canvas id="pie-chart"></canvas>
                </div>

                <div class="color-label">
                    <div class="label label-1">
                        <i class="fa-solid fa-chart-pie"></i> DAP
                    </div>
                    <div class="label label-2">
                        <i class="fa-solid fa-chart-pie"></i> Amplifier
                    </div>
                    <div class="label label-3">
                        <i class="fa-solid fa-chart-pie"></i> MoonDrop
                    </div>
                </div>
            </div>
        </div>

        <div class="customer-usage-wrapper">
            <!-- <div class="title-wrapper">Top 3 customers for this month</div> -->
            <table class="customer-table">
                <thead>
                    <th>Customer Name</th>
                    <th>ID #</th>
                    <th>Phone no</th>
                    <th>Email</th>
                    <th>Register Date</th>
                    <th>Total Amount Usage</th>
                    <th>Most Ordered Brands</th>
                    <th>Customer Level</th>
                </thead>
                <?php
                $customerUsageQuery = "SELECT u.UserId,u.ProfileImage,u.FirstName,u.LastName,u.Phone,u.Email,u.RegistrationDate,SUM(op.TotalAmount) as TotalAmount,b.BrandName 
                            FROM user as u INNER JOIN purchase_order as po ON u.UserId=po.UserId JOIN order_products as op ON op.OrderId=po.OrderId 
                            JOIN product as p ON op.ProductId=p.ProductId JOIN Brand as b ON b.BrandId=p.BrandId GROUP BY u.UserId ORDER BY TotalAmount DESC LIMIT 3";
                $customerUsageQueryResult = mysqli_query($connect,$customerUsageQuery);
                $totalCustomerUsage = mysqli_num_rows($customerUsageQueryResult);
                for ( $count = 0 ; $count < $totalCustomerUsage ; $count++ ) {
                    $customerUsageData = mysqli_fetch_array($customerUsageQueryResult);
                    $userId = $customerUsageData['UserId'];
                    $customerProfileURL = $imageFolderPath.$customerUsageData['ProfileImage'];
                    $customerName = $customerUsageData['FirstName'].' '.$customerUsageData['LastName'];
                    $userPhone = $customerUsageData['Phone'];
                    $userEmail = $customerUsageData['Email'];
                    $userRegisterDate = $customerUsageData['RegistrationDate'];
                    $totalAmount = $customerUsageData['TotalAmount'];
                    $brandName = $customerUsageData['BrandName'];
                    
                    ?>
                        <tr>
                            <td class="image-table-data"><img src="<?php echo $customerProfileURL?>"><?php echo $customerName?></td>
                            <td><?php echo $userId?></td>
                            <td><?php echo $userPhone?></td>
                            <td><?php echo $userEmail?></td>
                            <td><?php echo $userRegisterDate?></td>
                            <td>$ <?php echo $totalAmount?></td>
                            <td><?php echo $brandName?></td>
                            <td>Diamond</td>
                        </tr>
                    <?php
                }
            ?>
            </table>
        </div>


    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/e2c9faac31.js" crossorigin="anonymous"></script>
    <script src="../scripts/admin_panel_scripts/app-script.js"></script>
</body>
</html>