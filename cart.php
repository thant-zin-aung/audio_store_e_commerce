<?php
    include('connect.php');
    session_start();
    include('execution-functions.php');

    if ( !isUserLoggedIn() ) {
        echo "<script>window.location='login.php'</script>";
    }

    if (isset($_POST['remove-button'])) {
        $productId=$_POST['productId'];
        $productIndex = array_search($productId,$_SESSION['cart-items-array']);
        array_splice($_SESSION['cart-items-array'],$productIndex,1);
    }
    if (isset($_POST['save-address-button'])) {
        $address=$_POST['address'];
        $userId = $_SESSION['user-id'];
        $addressQuery = "INSERT INTO shippingaddress(ShippingAddress,UserId) VALUES(
            '$address',$userId
        )";
        $addressQueryResult = mysqli_query($connect,$addressQuery);
        if ( $addressQueryResult ) {
            echo "<script>alert('Shipping address was saved successfully.')</script>";
        } else {
            echo "<script>alert('Failed to save shipping address!')</script>";
        }
    }

    $subTotalPrice = 0;
    $cartItemArray = $_SESSION['cart-items-array'];
    $totalCartItem = count($cartItemArray);

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
        <link rel="stylesheet" href="styles/cart-style.css">
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

    <div class="main-title">Shopping Cart</div>
    <hr class="first-hr">
    <div class="main-wrapper">
        
        <div class="left-wrapper">
            <table border="1px">
                <tr class="header">
                    <th>Product</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Warranty</th>
                    <th>Price</th>
                </tr>

                <?php
                    for ( $cartCount = 0 ; $cartCount < $totalCartItem ; $cartCount++ ) {
                        $currentProductId = $cartItemArray[$cartCount];
                        $productQuery = "SELECT * FROM product WHERE ProductId='$currentProductId'";
                        $productQueryResult = mysqli_query($connect,$productQuery);
                        $totalProduct = mysqli_num_rows($productQueryResult);
                        $productImageFolderPath="images/product_images/";
                        for ( $count = 0 ; $count < $totalProduct ; $count++ ) {
                            $productData = mysqli_fetch_array($productQueryResult);
                            $productId = $productData['ProductId'];
                            $productName = $productData['ProductName'];
                            $productQuantity = $productData['Quantity'];
                            $productPrice = $productData['Price'];
                            $productWarrantyMonth = $productData['WarrantyMonth'];
                            $productColor = $productData['Color'];
                            $productDescription = $productData['Description'];
                            $productImage = $productImageFolderPath.$productData['ProductImage'];
                            $productBrandId = $productData['BrandId'];
                            $productBrandName;
                            $productBrandQuery = "SELECT * FROM brand WHERE BrandId='$productBrandId'";
                            $productBrandQueryResult = mysqli_query($connect,$productBrandQuery);
                            $totalProductBrand = mysqli_num_rows($productBrandQueryResult);
                            for ( $cCount = 0 ; $cCount < $totalProductBrand ; $cCount++ ) {
                                $productBrandData = mysqli_fetch_array($productBrandQueryResult);
                                $productBrandName = $productBrandData['BrandName'];
                            }
                            $productCategoryId = $productData['CategoryId'];
                            $productCategoryName;
                            $productCategoryQuery = "SELECT * FROM category WHERE CategoryId='$productCategoryId'";
                            $productCategoryQueryResult = mysqli_query($connect,$productCategoryQuery);
                            $totalProductCategory = mysqli_num_rows($productCategoryQueryResult);
                            for ( $cCount = 0 ; $cCount < $totalProductCategory ; $cCount++ ) {
                                $productCategoryData = mysqli_fetch_array($productCategoryQueryResult);
                                $productCategoryName = $productCategoryData['CategoryName'];
                            }

                            $subTotalPrice+=$productPrice;
                            $_SESSION['subtotal-price']=$subTotalPrice;
                            ?>

                            <tr>
                                <td class="product-wrapper">
                                    <div class="image-wrapper">
                                        <img src="<?php echo $productImage?>">
                                    </div>
                                    <div class="product-details">
                                        <div class="brand-name"><?php echo $productBrandName?></div>
                                        <div class="product-name"><?php echo $productName?></div>
                                        <div class="category-name"><?php echo $productCategoryName?></div>
                                    </div>
                                </td>
                                <td class="color-wrapper">
                                    <?php echo $productColor?>
                                </td>
                                <td class="quantity-wrapper">
                                    <div>1</div>
                                    <form action="cart.php" method="post">
                                        <input type="hidden" name="productId" value="<?php echo $productId?>">
                                        <input type="submit" value="remove" name="remove-button">
                                    </form>
                                </td>
                                <td class="warranty-wrapper">
                                    <?php echo $productWarrantyMonth?> months
                                </td>
                                <td class="price-wrapper">
                                    $ <?php echo $productPrice?>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                ?>

                <!-- <tr>
                    <td class="product-wrapper">
                        <div class="image-wrapper">
                            <img src="https://www.theaudiostore.in/cdn/shop/products/KZAcousticsEDAWiredIEMWithMic01_180x.webp?v=1655026994">
                        </div>
                        <div class="product-details">
                            <div class="brand-name">KZ Acoustics</div>
                            <div class="product-name">KZ Acoustics EDA Wired IEM With Mic</div>
                            <div class="category-name">Wired Earphones</div>
                        </div>
                    </td>
                    <td class="color-wrapper">
                        White
                    </td>
                    <td class="quantity-wrapper">
                        1
                    </td>
                    <td class="warranty-wrapper">
                        12 months
                    </td>
                    <td class="price-wrapper">
                        $ 1200
                    </td>
                </tr> -->
            </table>
        </div>

        <div class="right-wrapper">
            <div class="order-summary-wrapper">
                <div class="title">Order Summary</div>
                <div class="subtotal-wrapper">
                    <div class="text">Subtotal</div>
                    <div class="price">$<?php echo $subTotalPrice?></div>
                </div>
                <div class="shipping-wrapper">
                    <div class="text">Shipping</div>
                    <div class="price">FREE!</div>
                </div>
                <hr>
                <div class="total-wrapper">
                    <div class="text">Total</div>
                    <div class="price">$<?php echo $subTotalPrice?></div>
                </div>
                <button class="checkout-button">CHECKOUT</button>
            </div>

            <div class="shipping-address-wrapper">
                <div class="title">Shipping Address</div>

                <?php
                    $userId = $_SESSION['user-id'];
                    $addressQuery = "SELECT * FROM shippingaddress WHERE UserId=$userId";
                    $addressQueryResult = mysqli_query($connect,$addressQuery);
                    $totalAddress = mysqli_num_rows($addressQueryResult);
                    for ( $count = 0 ; $count<$totalAddress ; $count++ ) {
                        $addressData = mysqli_fetch_array($addressQueryResult);
                        $addressId=$addressData['ShippingId'];
                        $shippingAddress = $addressData['ShippingAddress'];
                        ?>
                            <div class="address-wrapper">
                                <div class="label">Address <?php echo $count+1?></div>
                                <div class="address" addressId="<?php echo $addressId?>">
                                    <?php echo $shippingAddress?>
                                </div>
                            </div>
                        <?php
                    }
                ?>
                <!-- <div class="address-wrapper">
                    <div class="label">Address 1</div>
                    <div class="address">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi voluptas repellat tenetur, pariatur unde velit adipisci a quod ea animi libero tempore odit exercitationem sed rem nam officia quis ipsa?
                    </div>
                </div> -->
                <form action="cart.php" method="post">
                    <textarea name="address" placeholder="Enter your shipping address" spellcheck="false"></textarea><br>
                    <input type="submit" value="SAVE ADDRESS" name="save-address-button">
                </form>
            </div>

        </div>
    </div>


    <footer id="website-detail">
        <div class="top-wrapper">
            <div class="left-wrapper">
                <div class="item">
                    <div class="title">Solutions</div>
                    <div class="detail-text">Control</div>
                    <div class="detail-text">Scalibility & Flexibility</div>
                    <div class="detail-text">Supported by experts</div>
                    <div class="detail-text">Performance & Security</div>
                </div>
                <div class="item">
                    <div class="title">Solutions</div>
                    <div class="detail-text">Control</div>
                    <div class="detail-text">Scalibility & Flexibility</div>
                    <div class="detail-text">Supported by experts</div>
                    <div class="detail-text">Performance & Security</div>
                </div>
                <div class="item">
                    <div class="title">Solutions</div>
                    <div class="detail-text">Control</div>
                    <div class="detail-text">Scalibility & Flexibility</div>
                    <div class="detail-text">Supported by experts</div>
                    <div class="detail-text">Performance & Security</div>
                </div>
                <div class="item">
                    <div class="title">Solutions</div>
                    <div class="detail-text">Control</div>
                    <div class="detail-text">Scalibility & Flexibility</div>
                    <div class="detail-text">Supported by experts</div>
                    <div class="detail-text">Performance & Security</div>
                </div>
            </div>
            <div class="right-wrapper">
                <div class="title">News Letter</div>
                <div class="input-field">
                    <input type="text" placeholder="Enter your email address" spellcheck="false">
                    <button>Subscribe</button>
                </div>
                <div class="description">Subscribe your email address to not miss our latest special offers, cupons, vouchers and discounts. Just enter your email address and press subscribe button. </div>
                <div class="social-wrapper">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                    <i class="fa-brands fa-weixin"></i>
                </div>
            </div>
        </div>
        <div class="bottom-wrapper">
            <h5 class="store-title">T & T Audio Store Myanmar</h5>
            <div class="address">No.1013, Baya KyawThu 17 st, 7 ward, South Okkalapa Township, Yangon</div>
            <div class="copyright">&copy; 2023 - All rights reserved by T & T Audio Store</div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="scripts/splide-4.1.3/dist/js/splide.min.js"></script>
    <script src="scripts/app-script.js"></script>
    <script src="scripts/cart-script.js"></script>
</body>
</html>