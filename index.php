<?php
    include('connect.php');
    session_start();
    include('execution-functions.php');
    if ( !isset($_SESSION['cart-items-array']) ) {
        $_SESSION['cart-items-array'] = array();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

        <section class="splide" id="slide-show" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                  <ul class="splide__list">
                        <li class="splide__slide item jbl" style="background-image: url(images/main_page_images/jbl-speaker.jpg);">
                            <div class="slide-show-detail">
                                <div class="title">JBL: Extreme 2</div>
                                <div class="description">Wirelessly connect up to 3 smartphones or tablets to the speaker and take turns playing earth-shaking, powerful stereo sound.Built-in rechargeable Li-ion battery supports up to 15 hours of playtime and charges devices via dual USB ports. Take crystal clear calls from your speaker with the touch of a button thanks to the noise and echo cancelling speakerphone.</div>
                                <form action="" class="explore-button-form">
                                    <button type="submit" class="explore-button">Explore more detail &gt;&gt;&gt;</button>
                                </form>
                            </div>
                            <div class="slide-show-overlay"></div>
                        </li>
                        <li class="splide__slide item" style="background-image: url(images/main_page_images/marshall-speaker.jpg);">
                            <div class="slide-show-detail">
                                <div class="title">Marshall: STANMORE III</div>
                                <div class="description">Taking the middle, and centre stage of our home line-up, Stanmore III has an even wider soundstage than its predecessor and brings expansive Marshall sound to home audio. This Bluetooth speaker has been re-engineered for a more immersive experience and works as a powerful home speaker sound system.</div>
                                <form action="" class="explore-button-form">
                                    <button type="submit" class="explore-button">Explore more detail &gt;&gt;&gt;</button>
                                </form>
                            </div>
                            <div class="slide-show-overlay"></div>
                        </li>
                        <li class="splide__slide item" style="background-image: url(images/main_page_images/moondrop-earphone.jpg);">
                            <div class="slide-show-detail">
                                <div class="title">Moondrop: IEM</div>
                                <div class="description">Wirelessly connect up to 3 smartphones or tablets to the speaker and take turns playing earth-shaking, powerful stereo sound.Built-in rechargeable Li-ion battery supports up to 15 hours of playtime and charges devices via dual USB ports. Take crystal clear calls from your speaker with the touch of a button thanks to the noise and echo cancelling speakerphone.</div>
                                <form action="" class="explore-button-form">
                                    <button type="submit" class="explore-button">Explore more detail &gt;&gt;&gt;</button>
                                </form>
                            </div>
                            <div class="slide-show-overlay"></div>
                        </li>
                        <li class="splide__slide item" style="background-image: url(images/main_page_images/logitech-g33.jpg);">
                            <div class="slide-show-detail">
                                <div class="title">Logitech: G33 Lightspeed</div>
                                <div class="description">Wireless gaming headset designed for performance and comfort. Outfitted with all the surround sound, voice filters, and advanced lighting you need to look, sound, and play with more style than ever. G733 is wireless and designed for comfort. And it’s outfitted with all the surround sound, voice filters, and advanced lighting you need to look, sound, and play with more style than ever.</div>
                                <form action="" class="explore-button-form">
                                    <button type="submit" class="explore-button">Explore more detail &gt;&gt;&gt;</button>
                                </form>
                            </div>
                            <div class="slide-show-overlay"></div>
                        </li>
                  </ul>
            </div>
            <div class="splide__progress">
                <div class="splide__progress__bar">
                </div>
            </div>

            <div class="brand-logo-wrapper">
                <div class="item"><img src="images/logos/Marshall-Logo.png"></div>
                <div class="item"><img src="images/logos/JBL-logo.png"></div>
                <div class="item"><img src="images/logos/Bose-Logo.png"></div>
                <div class="item"><img src="images/logos/Logitech-Logo.png"></div>
                <div class="item"><img src="images/logos/Sony-Logo.png"></div>
            </div>
        </section>
        
        <section id="route-intro">
            <div class="left-wrapper">
                <div class="top-wrapper">
                    <div class="left sizable-div">
                        <div class="overlay"></div>
                        <div class="detail-wrapper">
                            <div class="sub-title">Feel the beauty of sound</div>
                            <div class="title">Collection Of Headphones</div>
                            <form action="#" method="post">
                                <button type="submit" name="headphone-button">SHOP NOW</button>
                            </form>
                        </div>
                    </div>
                    <div class="right sizable-div">
                        <div class="overlay"></div>
                        <div class="detail-wrapper">
                            <div class="sub-title">Hear the truth</div>
                            <div class="title">Collection Of Earphones</div>
                            <form action="#" method="post">
                                <button type="submit" name="headphone-button">SHOP NOW</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bottom-wrapper sizable-div-5px">
                    <div class="overlay"></div>
                    <div class="detail-wrapper">
                        <div class="sub-title">Innovative audio solutions</div>
                        <div class="title">Collection Of Sound Bars</div>
                        <form action="#" method="post">
                            <button type="submit" name="headphone-button">SHOP NOW</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="right-wrapper sizable-div">
                <div class="overlay"></div>
                <div class="detail-wrapper">
                    <div class="sub-title">Hear more. Love more</div>
                    <div class="title">Collection Of Speakers</div>
                    <form action="#" method="post">
                        <button type="submit" name="headphone-button">SHOP NOW</button>
                    </form>
                </div>
            </div>
        </section>

        <section class="splide most-order-products" id="most-order-products" aria-label="Splide Basic HTML Example">
            <div class="title">
                <div class="side-bar"></div> Most Ordered Products <div class="side-bar sub-side-bar"></div> <span>Highest rating products with 100% guarantee.</span>
            </div>
            <div class="splide__track top-wrapper">
                  <ul class="splide__list">
                      <!-- <li class="splide__slide item">
                        <div class="product-image" style="background-image: url('https://cdn.shopify.com/s/files/1/0421/5432/8214/products/KZAcousticsEDXProWiredIEMWithMicclear_632b565b-9ee1-470d-a5a3-104f60d96d81.jpg?v=1671105655&width=1000');"></div>
                        <div class="product-detail">
                            <div class="name">JBL: Extreme 3
                                <div class="short-intro">Portable Bluetooth Speaker</div>
                            </div>
                            <div class="price-review-wrapper">
                                <div class="price">$2,234.00 <span>$2,300.00</span></div>
                                <div class="reviews">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <span class="total-reviewers">(135)</span>
                                </div>
                            </div>
                            <form action="#" method="POST" class="button-wrapper">
                                <button type="submit" class="add-to-cart"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                            </form>
                        </div>
                      </li> -->

                      <?php
                        $productQuery = "SELECT * FROM product LIMIT 10";
                        $productQueryResult = mysqli_query($connect,$productQuery);
                        $productImageFolderPath="images/product_images/";
                        for ( $count = 0 ; $count < 10 ; $count++ ) {
                            $productData = mysqli_fetch_array($productQueryResult);
                            $productId = $productData['ProductId'];
                            $productName = $productData['ProductName'];
                            $productQuantity = $productData['Quantity'];
                            $productPrice = $productData['Price'];
                            $productColor = $productData['Color'];
                            $productDescription = $productData['Description'];
                            $productImage = $productImageFolderPath.$productData['ProductImage'];
                            $productBrandId = $productData['BrandId'];
                            $productCategoryId = $productData['CategoryId'];
                            $productCategoryName;
                            $productCategoryQuery = "SELECT * FROM category WHERE CategoryId='$productCategoryId'";
                            $productCategoryQueryResult = mysqli_query($connect,$productCategoryQuery);
                            $totalProductCategory = mysqli_num_rows($productCategoryQueryResult);
                            for ( $cCount = 0 ; $cCount < $totalProductCategory ; $cCount++ ) {
                                $productCategoryData = mysqli_fetch_array($productCategoryQueryResult);
                                $productCategoryName = $productCategoryData['CategoryName'];
                            }

                            ?>
                                <li class="splide__slide item">
                                <div class="product-image" style="background-image: url('<?php echo $productImage?>');"></div>
                                <div class="product-detail">
                                    <div class="name"><?php echo $productName?>
                                        <div class="short-intro"><?php echo $productCategoryName?></div>
                                    </div>
                                    <div class="price-review-wrapper">
                                        <div class="price">$<?php echo $productPrice?> <span></span></div>
                                        <div class="reviews">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <span class="total-reviewers">(135)</span>
                                        </div>
                                    </div>
                                    <button type="submit" class="add-to-cart" productId="<?php echo $productId?>"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                                    <!-- <form action="#" method="POST" class="button-wrapper">
                                    </form> -->
                                </div>
                            </li>

                            <?php
                        }
                      
                      ?>
                  </ul>
            </div>
        </section>

        <section id="discount">
            <div class="discount-wrapper">
                <div class="left-wrapper">
                    <div class="title-1-wrapper">Special</div>
                    <div class="title-2-wrapper">Discount</div>
                    <div class="detail-wrapper">
                        Get 20% discount on Moondrop earphone product in period within 24 August 2023 to 27 August 2023.
                    </div>
                </div>
                <div class="right-wrapper">
                    <div class="top-wrapper">
                        <div class="discount-percent">20%</div>
                        <div class="discount-detail-wrapper">
                            <ul>
                                <li class="detail">Claimable Item: <b>Moondrop earphone</b></li>
                                <li class="detail">Start Date: 24 August 2023</li>
                                <li class="detail">End Date: 28 August 2023</li>
                                <li class="detail">Period: 5 days</li>
                            </ul>
                        </div>
                    </div>
                    <div class="bottom-wrapper">
                        <button>Grab special offer in time &nbsp; <i class="fa-solid fa-arrow-right-long"></i></button>
                    </div>
                </div>
            </div>
        </section>
        

        <section id="our-service">
            <div class="title-wrapper">
                <h3 class="title">OUR SERVICES</h3>
                <h6 class="sub-title">T & T Audio Store Myanmar offers variety of services</h6>
            </div>
            <div class="service-wrapper">
                <div class="service-detail">
                    <div class="icon"><i class="fa-regular fa-comment-dots"></i></div>
                    <div class="title">Instant Reply</div>
                    <div class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio consectetur explicabo dolor dolorem, a dolores quis deleniti at suscipit. ctetur explicabo dolor dolorem, reprehenderit a dignissimos recusandae dolores quis deleniti at suscipit.</div>
                    <div class="button">More Info</div>
                </div>
                <div class="service-detail">
                    <div class="icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                    <div class="title">Money Back Guarantee</div>
                    <div class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio consectetur explicabo dolor dolorem, a dolores quis deleniti at suscipit. ctetur explicabo dolor dolorem, reprehenderit a dignissimos recusandae dolores quis deleniti at suscipit.</div>
                    <div class="button">More Info</div>
                </div>
                <div class="service-detail">
                    <div class="icon"><i class="fa-solid fa-truck-fast"></i></div>
                    <div class="title">Faster Delivery</div>
                    <div class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio consectetur explicabo dolor dolorem, a dolores quis deleniti at suscipit. ctetur explicabo dolor dolorem, reprehenderit a dignissimos recusandae dolores quis deleniti at suscipit.</div>
                    <div class="button">More Info</div>
                </div>
            </div>
        </section>


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
        <script src="scripts/animation-script.js"></script>
    </body>
</html>