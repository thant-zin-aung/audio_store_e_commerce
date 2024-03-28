<?php
    include('connect.php');
    session_start();
    include('execution-functions.php');

    $productQuery;
    $checkedLabel;
    if ( isset($_GET['checkedLabel']) ) {
        $label = $_GET['checkedLabel'];
        $checkedLabel = $label;
        $type = $_GET['checkedType'];
        $typeId;
        if ( $type=="brand" ) {
            $brandQuery = "SELECT * FROM brand WHERE BrandName='$label'";
            $brandQueryResult = mysqli_query($connect,$brandQuery);
            $totalBrand = mysqli_num_rows($brandQueryResult);
            for ( $count = 0 ; $count < $totalBrand ; $count++ ) {
                $brandData = mysqli_fetch_array($brandQueryResult);
                $typeId = $brandData['BrandId'];
            }
            $productQuery = "SELECT * FROM product WHERE BrandId=$typeId";
        } else if ( $type=="category" ) {
            $categoryQuery = "SELECT * FROM category WHERE CategoryName='$label'";
            $categoryQueryResult = mysqli_query($connect,$categoryQuery);
            $totalCategory = mysqli_num_rows($categoryQueryResult);
            for ( $count = 0 ; $count < $totalCategory ; $count++ ) {
                $categoryData = mysqli_fetch_array($categoryQueryResult);
                $typeId = $categoryData['CategoryId'];
            }
            $productQuery = "SELECT * FROM product WHERE CategoryId=$typeId";
        }
    } else {
        $productQuery = "SELECT * FROM product";
    }
    $productImageFolderPath="images/product_images/";
    
    $productQueryResult = mysqli_query($connect,$productQuery);
    $totalProduct = mysqli_num_rows($productQueryResult);
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
        <link rel="stylesheet" href="styles/shop-style.css">
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


    <div class="product-filter-list-wrapper">
            <div class="filter-wrapper">
                <div class="filter-title">Filters</div>
                <form action="#" method="post">
                    <div class="search-wrapper brand-wrapper">
                        <div class="search-title">Brand</div>
                        <?php
                            $brandQuery = "SELECT * FROM brand";
                            $brandQueryResult = mysqli_query($connect,$brandQuery);
                            $totalBrand = mysqli_num_rows($brandQueryResult);
                            for ( $count = 0 ; $count < $totalBrand ; $count++ ) {
                                $brandData = mysqli_fetch_array($brandQueryResult);
                                $brandName = $brandData['BrandName'];
                                ?>
                                <input type="checkbox" label="<?php echo $brandName?>" checktype="brand" <?php if(isset($checkedLabel)) echo ($checkedLabel===$brandName)?"checked":"" ?>> &nbsp;
                                <label><?php echo $brandName?></label>
                                <br>
                            <?php
                            }
                        ?>
                    </div>
                    <hr>
                    <div class="search-wrapper category-wrapper">
                        <div class="search-title">Category</div>
                        <?php
                            $categoryQuery = "SELECT * FROM category";
                            $categoryQueryResult = mysqli_query($connect,$categoryQuery);
                            $totalCategory = mysqli_num_rows($categoryQueryResult);
                            for ( $count = 0 ; $count < $totalCategory ; $count++ ) {
                                $categoryData = mysqli_fetch_array($categoryQueryResult);
                                $categoryName = $categoryData['CategoryName'];
                                ?>
                                <input type="checkbox" label="<?php echo $categoryName?>" checktype="category" <?php if(isset($checkedLabel)) echo ($checkedLabel===$categoryName)?"checked":"" ?>> &nbsp;
                                <label><?php echo $categoryName?></label>
                                <br>
                            <?php
                            }
                        ?>
                    </div>
                    <hr>
                    <div class="search-wrapper price-range-wrapper">
                        <div class="search-title">Price Range</div>
                        <div class="range-wrapper">
                            <input type="number" name="min" value="0">
                            <div class="gap-dash">---</div>
                            <input type="number" name="max" value="10000">
                        </div>
                    </div>

                    <input type="submit" value="Apply">
                </form>
            </div>

            <div class="product-list-wrapper">
                <div class="title">List Of <?php if(isset($checkedLabel)) echo $checkedLabel; else echo "Products"; ?></div>
                <div class="item-wrapper">
                    <?php
                        if ( $totalProduct==0 ) echo "No product found!";
                        for ( $count = 0 ; $count < $totalProduct ; $count++ ) {
                            $productData = mysqli_fetch_array($productQueryResult);
                            $productId = $productData['ProductId'];
                            $productName = $productData['ProductName'];
                            $productQuantity = $productData['Quantity'];
                            $productPrice = $productData['Price'];
                            $productColor = $productData['Color'];
                            $productDescription = $productData['Description'];
                            $productImage = $productImageFolderPath.$productData['ProductImage'];
                            $productAdditionalImage1 = $productImageFolderPath.$productData['AdditionalImage1'];
                            $productAdditionalImage2 = $productImageFolderPath.$productData['AdditionalImage2'];
                            $productAdditionalImage3 = $productImageFolderPath.$productData['AdditionalImage3'];
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
                                <div class="item">
                                <div class="product-image" style="background-image: url('<?php echo $productImage?>');"></div>
                                <div class="product-detail">
                                    <div class="name"><?php echo $productName?>
                                        <div class="short-intro"><?php echo $productCategoryName?></div>
                                    </div>
                                    <div class="price-review-wrapper">
                                        <div class="price">$ <?php echo $productPrice?> <span></span></div>
                                        <div class="reviews">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <span class="total-reviewers">(135)</span>
                                        </div>
                                    </div>
                                    <!-- <form action="#" method="POST" class="button-wrapper">                
                                    </form> -->
                                    <button type="submit" class="add-to-cart" productId="<?php echo $productId?>"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                                    </div>
                                </div>

                            <?php
                        }

                    ?>
                </div>
            </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="scripts/splide-4.1.3/dist/js/splide.min.js"></script>
    <!-- <script src="scripts/app-script.js"></script> -->
    <!-- <script src="scripts/animation-script.js"></script> -->
    <script src="scripts/store-script.js"></script>
    </body>
</html>