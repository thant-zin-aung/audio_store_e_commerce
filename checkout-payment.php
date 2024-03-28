<?php
    include('connect.php');
    session_start();
    include('execution-functions.php');
    $shippingAddress;
    if (isset($_GET['addressId'])) {
        $shippingId = $_GET['addressId'];
        $addressQuery = "SELECT * FROM shippingaddress WHERE ShippingId=$shippingId";
        $addressQueryResult = mysqli_query($connect,$addressQuery);
        $totalAddress = mysqli_num_rows($addressQueryResult);
        for ( $count = 0 ; $count < $totalAddress ; $count++ ) {
            $addressData = mysqli_fetch_array($addressQueryResult);
            $shippingAddress = $addressData['ShippingAddress'];
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
    <link rel="stylesheet" href="styles/shop-style.css">
    <link rel="stylesheet" href="styles/checkout-payment-style.css">
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

    <div class="checkout-main-wrapper">
        <div class="left-wrapper">
            <div class="main-title">Choose your payment method</div>
            <div class="payment-wrapper">
                <form action="checkout-payment.php" method="POST">
                    <div class="card-wrapper payment-sub-wrapper">
                        <div class="card-left-wrapper">
                            <div>
                                <input type="radio" name="card" payment-method="card" for="credit-card">
                                <label for="credit-card">Credit Cards</label><br>
                            </div>
                            <div class="card-logo-wrapper">
                                <img src="images/card-logos/visa.jpg">
                                <img src="images/card-logos/master-card.png">
                                <img src="images/card-logos/payoneer.jpg">
                            </div>
                            <div class="card-form-wrapper">
                                <input type="number" placeholder="Card Number *"><br>
                                <div class="card-form-sub-wrapper">
                                    <input type="number" placeholder="Month *">
                                    <div>/</div>
                                    <input type="number" placeholder="Year *">
                                    <input type="number" placeholder="CVV *">
                                </div>
                            </div>
                            <p>T & T Audio Store website was protected by Google reCAPTCHA and all the credentials are stored securely.</p>
                        </div>

                        <div class="card-right-wrapper">
                            <div class="title">Billing Address</div>
                            <div class="info">
                                <div class="name"><?php echo $_SESSION['user-fullname']?></div>
                                <div class="phone"><?php echo $_SESSION['user-phone']?></div>
                                <div class="email"><?php echo $_SESSION['user-email']?></div>
                                <div class="address"><?php echo $shippingAddress?></div>
                            </div>
                        </div>
                    </div>
                    <div class="pay-wrapper payment-sub-wrapper">
                        <input type="radio" name="card" payment-method="aya-pay" for="credit-card">
                        <label for="credit-card">&nbsp;<img src="images/card-logos/aya-pay.jpg"> &nbsp; AYA Pay</label>
                    </div>
                    <div class="pay-wrapper payment-sub-wrapper">
                        <input type="radio" name="card" payment-method="cb-pay" for="credit-card">
                        <label for="credit-card">&nbsp;<img src="images/card-logos/cbpay.png"> &nbsp; CB Pay</label>
                    </div>
                    <div class="pay-wrapper payment-sub-wrapper">
                        <input type="radio" name="card" payment-method="kbz-pay" for="credit-card">
                        <label for="credit-card">&nbsp;<img src="images/card-logos/kbzpay.png"> &nbsp; KBZ Pay</label>
                    </div>
                    <div class="pay-wrapper payment-sub-wrapper">
                        <input type="radio" name="card" payment-method="cod" for="credit-card">
                        <label for="credit-card">&nbsp;<img src="images/card-logos/cod.jpg"> &nbsp; Cash On Delivery</label>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="right-wrapper">
            <div class="order-summary-wrapper">
                <div class="title">Order Summary</div>
                <div class="subtotal-wrapper">
                    <div class="text">Subtotal</div>
                    <div class="price">$<?php echo $_SESSION['subtotal-price']?></div>
                </div>
                <div class="shipping-wrapper">
                    <div class="text">Shipping</div>
                    <div class="price">FREE!</div>
                </div>
                <hr>
                <div class="total-wrapper">
                    <div class="text">Total</div>
                    <div class="price">$<?php echo $_SESSION['subtotal-price']?></div>
                </div>
                <button class="checkout-button place-order-button">PLACE ORDER</button>
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
    <!-- <script src="scripts/cart-script.js"></script> -->
    <script src="scripts/checkout-payment-script.js"></script>
</body>
</html>