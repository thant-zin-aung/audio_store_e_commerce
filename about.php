<?php
    include('connect.php');
    session_start();
    include('execution-functions.php');
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
        <link rel="stylesheet" href="styles/about-style.css">
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

    <div class="title title-1">We are a Myanmar based</div>
    <div class="title title-2">audio devices distributor</div>
    <div class="line"></div>

    <div class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, labore? Laboriosam aliquid odio voluptates, dolorem, eveniet culpa ut, est eos corrupti ad eius voluptatum sunt odit porro eum libero. Beatae? Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, aspernatur? Mollitia eligendi sequi quod rerum minima aspernatur temporibus veniam dolor corporis aperiam cumque distinctio et tempora laudantium, corrupti cupiditate id. Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur quod laboriosam eos maxime, inventore dolorem deleniti esse consequuntur neque fuga! Ex quod placeat, neque voluptates tempore nesciunt quia optio quidem!</div>
    <div class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, labore? Laboriosam aliquid odio voluptates, dolorem, eveniet culpa ut, est eos corrupti ad eius voluptatum sunt odit porro eum libero. Beatae? Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, aspernatur? Mollitia eligendi sequi quod rerum minima aspernatur temporibus veniam dolor corporis aperiam cumque distinctio et tempora laudantium, corrupti cupiditate id. Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur quod laboriosam eos maxime, inventore dolorem deleniti esse consequuntur neque fuga! Ex quod placeat, neque voluptates tempore nesciunt quia optio quidem!</div>
    <div class="paragraph image-wrapper"><img src="images/audio_store/store1.jpg" alt=""></div>
    <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4395.84560003858!2d96.17915220908849!3d16.849872402172743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1933cc7a6f121%3A0x15d793efb0b0f791!2sT%20%26%20T%20Audio%20Store%20-%20Myanmar!5e0!3m2!1sen!2smm!4v1691215172416!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
    </div>
    <div class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, labore? Laboriosam aliquid odio voluptates, dolorem, eveniet culpa ut, est eos corrupti ad eius voluptatum sunt odit porro eum libero. Beatae? Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, aspernatur? Mollitia eligendi sequi quod rerum minima aspernatur temporibus veniam dolor corporis aperiam cumque distinctio et tempora laudantium, corrupti cupiditate id. Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur quod laboriosam eos maxime, inventore dolorem deleniti esse consequuntur neque fuga! Ex quod placeat, neque voluptates tempore nesciunt quia optio quidem!</div>
    <div class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, labore? Laboriosam aliquid odio voluptates, dolorem, eveniet culpa ut, est eos corrupti ad eius voluptatum sunt odit porro eum libero. Beatae? Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, aspernatur? Mollitia eligendi sequi quod rerum minima aspernatur temporibus veniam dolor corporis aperiam cumque distinctio et tempora laudantium, corrupti cupiditate id. Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur quod laboriosam eos maxime, inventore dolorem deleniti esse consequuntur neque fuga! Ex quod placeat, neque voluptates tempore nesciunt quia optio quidem!</div>


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
</body>
</html>