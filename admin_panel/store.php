<?php
    include('connect.php');
    session_start();
    
    if ( isset($_POST['add-category-button']) ) {
        $lastCategoryQuery = "SELECT * FROM category ORDER BY CategoryId DESC LIMIT 1";
        $lastCategoryQueryResult = mysqli_query($connect,$lastCategoryQuery);
        $totalCategory = mysqli_num_rows($lastCategoryQueryResult);
        if ( $totalCategory == 0 ) {
            $categoryId = str_pad(1, 5, '0', STR_PAD_LEFT);
            $categoryName = $_POST['category-name'];
        } else {
            for ( $count = 0 ; $count < $totalCategory ; $count++ ) {
                $lastCategoryData = mysqli_fetch_array($lastCategoryQueryResult);
                $lastCategoryId = intval($lastCategoryData['CategoryId']);
                $categoryId = str_pad(++$lastCategoryId, 5, '0', STR_PAD_LEFT);
                $categoryName = $_POST['category-name'];
            }
        }
        $categoryInsertQuery = "INSERT INTO category(CategoryId,CategoryName) VALUES(
            '$categoryId','$categoryName'
        )";
        $categoryInsertQueryResult = mysqli_query($connect,$categoryInsertQuery);
        if ( $categoryInsertQueryResult ) {
            echo "<script>location.href='store.php'</script>";
        } else {
            echo "<script>alert('Failed to add category')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Add brand button handler
    else if ( isset($_POST['add-brand-button']) ) {
        $lastBrandQuery = "SELECT * FROM brand ORDER BY BrandId DESC LIMIT 1";
        $lastBrandQueryResult = mysqli_query($connect,$lastBrandQuery);
        $totalBrand = mysqli_num_rows($lastBrandQueryResult);
        if ( $totalBrand == 0 ) {
            $brandId = str_pad(1, 5, '0', STR_PAD_LEFT);
            $brandName = $_POST['brand-name'];
        } else {
            for ( $count = 0 ; $count < $totalBrand ; $count++ ) {
                $lastBrandData = mysqli_fetch_array($lastBrandQueryResult);
                $lastBrandId = intval($lastBrandData['BrandId']);
                $brandId = str_pad(++$lastBrandId, 5, '0', STR_PAD_LEFT);
                $brandName = $_POST['brand-name'];
            }
        }
        $brandInsertQuery = "INSERT INTO brand(BrandId,BrandName) VALUES(
            '$brandId','$brandName'
        )";
        $brandInsertQueryResult = mysqli_query($connect,$brandInsertQuery);
        if ( $brandInsertQueryResult ) {
            echo "<script>location.href='store.php'</script>";
        } else {
            echo "<script>alert('Failed to add brand')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Add Product button handler
    else if ( isset($_POST['add-product-button']) ) {
        $lastProductQuery = "SELECT * FROM product ORDER BY ProductId DESC LIMIT 1";
        $lastProductQueryResult = mysqli_query($connect,$lastProductQuery);
        $totalProduct = mysqli_num_rows($lastProductQueryResult);
        $productId;
        if ( $totalProduct == 0 ) {
            $productId = str_pad(1, 5, '0', STR_PAD_LEFT);
        } else {
            for ( $count = 0 ; $count < $totalProduct ; $count++ ) {
                $lastProductData = mysqli_fetch_array($lastProductQueryResult);
                $lastProductId = intval($lastProductData['ProductId']);
                $productId = str_pad(++$lastProductId, 5, '0', STR_PAD_LEFT);
            }
        }
        $productName = $_POST['product-name'];
        $productQuantity = $_POST['product-quantity'];
        $productPrice = $_POST['product-price'];
        $productWarrantyMonth = $_POST['product-warranty-month'];
        $productColor = $_POST['product-color'];
        $productDescription = $_POST['product-description'];
        // $productImageFileName = $_FILES['product-image']['name'];
        // $productAdditionalImage1FileName = $_FILES['product-additional-image-1']['name'];
        // $productAdditionalImage2FileName = $_FILES['product-additional-image-2']['name'];
        // $productAdditionalImage3FileName = $_FILES['product-additional-image-3']['name'];
        $imageFileType = strtolower(pathinfo($_FILES['product-image']['name'],PATHINFO_EXTENSION));
        $additionalImage1FileType = strtolower(pathinfo($_FILES['product-additional-image-1']['name'],PATHINFO_EXTENSION));
        $additionalImage2FileType = strtolower(pathinfo($_FILES['product-additional-image-2']['name'],PATHINFO_EXTENSION));
        $additionalImage3FileType = strtolower(pathinfo($_FILES['product-additional-image-3']['name'],PATHINFO_EXTENSION));

        $productImageFileName = $productName.'_image'.'.'.$imageFileType;
        $productAdditionalImage1FileName = $productName.'_additional_image_1'.'.'.$additionalImage1FileType;
        $productAdditionalImage2FileName = $productName.'_additional_image_2'.'.'.$additionalImage2FileType;
        $productAdditionalImage3FileName = $productName.'_additional_image_3'.'.'.$additionalImage3FileType;
        $imageFolder = "../images/product_images/";
        
        $copiedImage=copy($_FILES['product-image']['tmp_name'],$imageFolder.$productImageFileName );
        $copiedAdditionalImage1=copy($_FILES['product-additional-image-1']['tmp_name'],$imageFolder.$productAdditionalImage1FileName);
        $copiedAdditionalImage2=copy($_FILES['product-additional-image-2']['tmp_name'],$imageFolder.$productAdditionalImage2FileName);
        $copiedAdditionalImage3=copy($_FILES['product-additional-image-3']['tmp_name'],$imageFolder.$productAdditionalImage3FileName);

        if ( !$copiedImage || !$copiedAdditionalImage1 || !$copiedAdditionalImage2 || !$copiedAdditionalImage3 ) {
            echo "<script>alert('Cannot upload product images')</script>";
            exit();
        }
        $productBrandId = $_POST['product-brand-id'];
        $productCategoryId = $_POST['product-category-id'];

        $productInsertQuery = "INSERT INTO product(ProductId,ProductName,Quantity,Price,WarrantyMonth,Color,Description,ProductImage,AdditionalImage1,AdditionalImage2,AdditionalImage3,BrandId,CategoryId) VALUES(
            '$productId', '$productName', $productQuantity, $productPrice, $productWarrantyMonth, '$productColor', '$productDescription', '$productImageFileName', '$productAdditionalImage1FileName', 
            '$productAdditionalImage2FileName', '$productAdditionalImage3FileName', '$productBrandId', '$productCategoryId'
        )";
        $productInsertQueryResult = mysqli_query($connect,$productInsertQuery);
        if ( $productInsertQueryResult ) {
            echo "<script>location.href='store.php'</script>";
        } else {
            echo "<script>alert('Failed to add product')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Add discount button handler
    else if ( isset($_POST['add-discount-button']) ) {
        $lastDiscountQuery = "SELECT * FROM discount ORDER BY DiscountId DESC LIMIT 1";
        $lastDiscountQueryResult = mysqli_query($connect,$lastDiscountQuery);
        $totalDiscount = mysqli_num_rows($lastDiscountQueryResult);
        $discountId;
        if ( $totalDiscount == 0 ) {
            $discountId = str_pad(1, 5, '0', STR_PAD_LEFT);
        } else {
            for ( $count = 0 ; $count < $totalDiscount ; $count++ ) {
                $lastDiscountData = mysqli_fetch_array($lastDiscountQueryResult);
                $lastDiscountId = intval($lastDiscountData['DiscountId']);
                $discountId = str_pad(++$lastDiscountId, 5, '0', STR_PAD_LEFT);
            }
        }
        $discountDescription = $_POST['discount-description'];
        $discountPercent = $_POST['discount-percent'];
        $discountStartDate = $_POST['discount-start-date'];
        $discountEndDate = $_POST['discount-end-date'];
        $discountProductId = $_POST['discount-product-id'];
        $discountInsertQuery = "INSERT INTO discount VALUES(
            '$discountId','$discountDescription',$discountPercent,'$discountStartDate','$discountEndDate','$discountProductId'
        )";
        $discountInsertQueryResult = mysqli_query($connect,$discountInsertQuery);
        if ( $discountInsertQueryResult ) {
            echo "<script>location.href='store.php'</script>";
        } else {
            echo "<script>alert('Failed to add discount')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Update category button handler
    else if ( isset($_POST['update-category-button']) ) {
        $categoryId = $_POST['category-update-id'];
        $categoryName = $_POST['category-update-name'];
        $updateCategoryQuery = "UPDATE category SET CategoryName='$categoryName' WHERE CategoryId='$categoryId'";
        $updateResult = mysqli_query($connect,$updateCategoryQuery);
        if ( $updateResult ) {
            echo "<script>location.href='store.php'</script>";
        } else {
            echo "<script>alert('Failed to update category')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Update brand button handler
    else if ( isset($_POST['update-brand-button']) ) {
        $brandId = $_POST['brand-update-id'];
        $brandName = $_POST['brand-update-name'];
        $updateBrandQuery = "UPDATE brand SET BrandName='$brandName' WHERE BrandId='$brandId'";
        $updateResult = mysqli_query($connect,$updateBrandQuery);
        if ( $updateResult ) {
            echo "<script>location.href='store.php'</script>";
        } else {
            echo "<script>alert('Failed to update brand')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Update product button handler
    else if ( isset($_POST['update-product-button']) ) {
        $productId = $_POST['product-update-id'];
        $productName = $_POST['product-update-name'];
        $productPrice = $_POST['product-update-price'];
        $productQuantity = $_POST['product-update-quantity'];
        $updateProductQuery = "UPDATE product SET ProductName='$productName',Price='$productPrice',Quantity='$productQuantity' WHERE ProductId='$productId'";
        $updateResult = mysqli_query($connect,$updateProductQuery);
        if ( $updateResult ) {
            echo "<script>location.href='store.php'</script>";
        } else {
            echo "<script>alert('Failed to update product')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Update discount button handler
    else if ( isset($_POST['update-discount-button']) ) {
        $discountId = $_POST['discount-update-id'];
        $discountDesc = $_POST['discount-update-description'];
        $discountPercent = $_POST['discount-update-percent'];
        $discountStartDate = $_POST['discount-update-start-date'];
        $discountEndDate = $_POST['discount-update-end-date'];
        
        $updateDiscountQuery = "UPDATE discount SET DiscountDescription='$discountDesc',DiscountPercent='$discountPercent',StartDate='$discountStartDate',EndDate='$discountEndDate' WHERE DiscountId='$discountId'";
        $updateResult = mysqli_query($connect,$updateDiscountQuery);
        if ( $updateResult ) {
            echo "<script>location.href='store.php'</script>";
        } else {
            echo "<script>alert('Failed to update discount')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Delete category button handler
    else if ( isset($_POST['category-delete-button']) ) {
        $categoryId = $_POST['category-id'];
        $categoryDeleteQuery = "DELETE FROM category WHERE CategoryId='$categoryId'";
        $categoryDeleteQueryResult = mysqli_query($connect,$categoryDeleteQuery);
        if ( !$categoryDeleteQueryResult ) {
            echo "<script>alert('Failed to delete category! There might be relationship with brand.')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Delete brand button handler
    else if ( isset($_POST['brand-delete-button']) ) {
        $brandId = $_POST['brand-id'];
        $brandDeleteQuery = "DELETE FROM brand WHERE BrandId='$brandId'";
        $brandDeleteQueryResult = mysqli_query($connect,$brandDeleteQuery);
        if ( !$brandDeleteQueryResult ) {
            echo "<script>alert('Failed to delete brand! There might be relationship with category.')</script>";
            echo "<script>location.href='store.php'</script>";
        }
    }
    // Delete brand button handler
    else if ( isset($_POST['product-delete-button']) ) {
        $productId = $_POST['product-id'];
        $productDeleteQuery = "DELETE FROM product WHERE ProductId='$productId'";
        $productDeleteQueryResult = mysqli_query($connect,$productDeleteQuery);
        if ( !$productDeleteQueryResult ) {
            echo "<script>alert('Failed to delete product! There might be relationship with products')</script>";
            echo "<script>location.href='store.php'</script>";
        }
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
    <link rel="stylesheet" href="../styles/admin_panel_styles/store-style.css">
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
            <div class="overview-button active-button">
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

        <div class="top-layer-wrapper">
            <div class="category-wrapper">
                <div class="category-info info">
                    <?php
                        $categoryQuery = "SELECT * FROM category ORDER BY CategoryId DESC";
                        $categoryQueryResult = mysqli_query($connect,$categoryQuery);
                        $totalCategory = mysqli_num_rows($categoryQueryResult);
                    ?>
                    <div class="title-wrapper">List Of Category</div>
                    <div class="total-category-wrapper total-amount"><?php echo $totalCategory?></div>
                    <!-- <div class="sub-text-wrapper">Click here to see the list of category table</div> -->
                    <div class="add-button category-add-button">
                        <div class="text-wrapper">Add Category</div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="logo category-logo"></div>
                    <i class="fa-solid fa-angles-down fa-bounce down-arrow"></i>
                </div>
                <table class="category-table">
                    <thead>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th style="width: 300px">Option Buttons</th>
                    </thead>
                    <?php
                        for ( $count = 0 ; $count < $totalCategory ; $count++ ) {
                            $categoryData = mysqli_fetch_array($categoryQueryResult);
                            $cId = $categoryData['CategoryId'];
                            $cName = $categoryData['CategoryName'];
                    ?>
                    
                    <tr>
                        <td><?php echo $cId?></td>
                        <td><?php echo $cName?></td>
                        <td>
                            <button class="update-button category-update-button">Update</button>
                            <form action="store.php" method="POST" class="delete-form">
                                <input type="hidden" name="category-id" value="<?php echo $cId?>">
                                <button class="delete-button category-delete-button" name="category-delete-button">Delete</button>
                            </form>
                            
                        </td>
                    </tr>   

                    <?php
                        }
                    ?>
                    <!-- <tr>
                        <td>C-00001</td>
                        <td>Electronics Devices</td>
                        <td>
                            <button class="update-button">Update</button>
                            <button class="delete-button">Delete</button>
                        </td>
                    </tr> -->
                </table>
            </div>

            <div class="brand-wrapper">
                <div class="brand-info info">
                    <?php
                        $brandQuery = "SELECT * FROM brand ORDER BY BrandId DESC";
                        $brandQueryResult = mysqli_query($connect,$brandQuery);
                        $totalBrand = mysqli_num_rows($brandQueryResult);
                    ?>
                    <div class="title-wrapper">List Of Brand</div>
                    <div class="total-brand-wrapper total-amount"><?php echo $totalBrand?></div>
                    <!-- <div class="sub-text-wrapper">Click here to see the list of brand table</div> -->
                    <div class="add-button brand-add-button">
                        <div class="text-wrapper">Add Brand</div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="logo brand-logo"></div>
                    <i class="fa-solid fa-angles-down fa-bounce down-arrow"></i>
                </div>
                <table class="category-table">
                    <thead>
                        <th>Brand ID</th>
                        <th>Brand Name</th>
                        <th style="width: 300px">Option Buttons</th>
                    </thead>
                    <?php
                        for ( $count = 0 ; $count < $totalBrand ; $count++ ) {
                            $brandData = mysqli_fetch_array($brandQueryResult);
                            $bId = $brandData['BrandId'];
                            $bName = $brandData['BrandName'];
                    ?>
                    
                    <tr>
                        <td><?php echo $bId?></td>
                        <td><?php echo $bName?></td>
                        <td>
                            <button class="update-button brand-update-button">Update</button>
                            <form action="store.php" method="POST" class="delete-form">
                                <input type="hidden" name="brand-id" value="<?php echo $bId?>">
                                <button class="delete-button brand-delete-button" name="brand-delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>   

                    <?php
                        }
                    ?>
                    <!-- <tr>
                        <td>C-00001</td>
                        <td>Electronics Devices</td>
                        <td>
                            <button class="update-button">Update</button>
                            <button class="delete-button">Delete</button>
                        </td>
                    </tr> -->
                </table>
            </div>
        </div>
        <div class="middle-layer-wrapper top-layer-wrapper">
            <div class="product-wrapper">
                <div class="product-info info">
                    <?php
                        $productQuery = "SELECT * FROM product ORDER BY ProductId DESC";
                        $productQueryResult = mysqli_query($connect,$productQuery);
                        $totalProduct = mysqli_num_rows($productQueryResult);
                    ?>
                    <div class="title-wrapper">List Of Product</div>
                    <div class="total-product-wrapper total-amount"><?php echo $totalProduct?></div>
                    <!-- <div class="sub-text-wrapper">Click here to see the list of product table</div> -->
                    <div class="add-button product-add-button">
                        <div class="text-wrapper">Add Product</div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="logo product-logo"></div>
                    <i class="fa-solid fa-angles-down fa-bounce down-arrow"></i>
                </div>
                <table class="product-table">
                    <thead>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock Qty</th>
                        <th>Image</th>
                        <th style="width: 350px">Option Buttons</th>
                    </thead>
                    <?php
                        for ( $count = 0 ; $count < $totalProduct ; $count++ ) {
                            $productData = mysqli_fetch_array($productQueryResult);
                            $pId = $productData['ProductId'];
                            $pName = $productData['ProductName'];
                            $pBrandId = $productData['BrandId'];
                            $pCategoryId = $productData['CategoryId'];
                            $pBrandName;
                            $pCategoryName;
                            $brandQuery = "SELECT * FROM brand WHERE BrandId='$pBrandId'";
                            $brandQueryResult = mysqli_query($connect,$brandQuery);
                            $totalBrand = mysqli_num_rows($brandQueryResult);
                            for ( $bCount = 0 ; $bCount < $totalBrand ; $bCount++ ) {
                                $brandData = mysqli_fetch_array($brandQueryResult);
                                $bId = $brandData['BrandId'];
                                $bName = $brandData['BrandName'];
                                $pBrandName = $bName;
                            }
                            $categoryQuery = "SELECT * FROM category WHERE CategoryId='$pCategoryId'";
                            $categoryQueryResult = mysqli_query($connect,$categoryQuery);
                            $totalCategory = mysqli_num_rows($categoryQueryResult);
                            for ( $pCount = 0 ; $pCount < $totalCategory ; $pCount++ ) {
                                $categoryData = mysqli_fetch_array($categoryQueryResult);
                                $cId = $categoryData['CategoryId'];
                                $cName = $categoryData['CategoryName'];
                                $pCategoryName = $cName;
                            }
                            
                            $pPrice = $productData['Price'];
                            $pQuantity = $productData['Quantity'];
                            $pImage = '../images/product_images/'.$productData['ProductImage'];
                    ?>
                    
                    <tr>
                        <td><?php echo $pId?></td>
                        <td><?php echo $pName?></td>
                        <td><?php echo $pBrandName?></td>
                        <td><?php echo $pCategoryName?></td>
                        <td><?php echo $pPrice?></td>
                        <td><?php echo $pQuantity?></td>
                        <td><img src="<?php echo $pImage?>" alt="<?php echo $pName?>"></td>
                        <td>
                            <button class="update-button product-update-button">Update</button>
                            <form action="store.php" method="POST" class="delete-form">
                                <input type="hidden" name="product-id" value="<?php echo $pId?>">
                                <button class="delete-button product-delete-button" name="product-delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>   

                    <?php
                        }
                    ?>
                    <!-- <tr>
                        <td>P-00001</td>
                        <td>Glazer</td>
                        <td>Moondrop</td>
                        <td>I.E.M</td>
                        <td>$23</td>
                        <td>29</td>
                        <td><img src="https://images.unsplash.com/photo-1578319439584-104c94d37305?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80" alt="moondrop photo"></td>
                        <td>
                            <button class="update-button">Update</button>
                            <button class="delete-button">Delete</button>
                        </td>
                    </tr> -->
                    
                    
                </table>
            </div>

            <div class="discount-wrapper">
                <div class="discount-info info">
                    <?php
                        $discountQuery = "SELECT * FROM discount ORDER BY DiscountId DESC";
                        $discountQueryResult = mysqli_query($connect,$discountQuery);
                        $totalDiscount = mysqli_num_rows($discountQueryResult);
                    ?>
                    <div class="title-wrapper">List Of Discount</div>
                    <div class="total-discount-wrapper total-amount"><?php echo $totalDiscount?></div>
                    <!-- <div class="sub-text-wrapper">Click here to see the list of product table</div> -->
                    <div class="add-button discount-add-button">
                        <div class="text-wrapper">Add Discount</div>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="logo discount-logo"></div>
                    <i class="fa-solid fa-angles-down fa-bounce down-arrow"></i>
                </div>
                <table class="product-table">
                    <thead>
                        <th>Discount ID</th>
                        <th>Discount Description</th>
                        <th>Percent</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Claimable Product</th>
                        <th style="width: 350px">Option Buttons</th>
                    </thead>

                    <?php
                        for ( $count = 0 ; $count < $totalDiscount ; $count++ ) {
                            $discountData = mysqli_fetch_array($discountQueryResult);
                            $dId = $discountData['DiscountId'];
                            $dDescription = $discountData['DiscountDescription'];
                            $dPercent = $discountData['DiscountPercent'];
                            $dStartDate = $discountData['StartDate'];
                            $pEndDate = $discountData['EndDate'];
                            $dProductId = $discountData['ProductId'];
                            $dProductName;
                            $productQuery = "SELECT * FROM product WHERE ProductId='$dProductId'";
                            $productQueryResult = mysqli_query($connect,$productQuery);
                            $totalProduct = mysqli_num_rows($productQueryResult);
                            for ( $count = 0 ; $count < $totalProduct ; $count++ ) {
                                $productData = mysqli_fetch_array($productQueryResult);
                                $dProductName = $productData['ProductName'];
                            }
                    ?>

                    <tr>
                        <td><?php echo $dId?></td>
                        <td><?php echo $dDescription?></td>
                        <td><?php echo $dPercent?>%</td>
                        <td><?php echo $dStartDate?></td>
                        <td><?php echo $pEndDate?></td>
                        <td><?php echo $dProductName?></td>
                        <td>
                            <button class="update-button discount-update-button">Update</button>
                            <form action="store.php" method="POST" class="delete-form">
                                <input type="hidden" name="discount-id" value="<?php echo $cId?>">
                                <button class="delete-button discount-delete-button" name="discount-delete-button">Delete</button>
                            </form>
                            
                        </td>
                    </tr>  

                    <?php
                        }
                    ?>
                    <!-- <tr>
                        <td>D-00001</td>
                        <td>Get 20% discount on every every moondrop product purchasing</td>
                        <td>20%</td>
                        <td>2023-04-06</td>
                        <td>2023-05-06</td>
                        <td>Moondrop</td>
                        <td>
                            <button class="update-button">Update</button>
                            <button class="delete-button">Delete</button>
                        </td>
                    </tr> -->
                </table>
            </div>
        </div>


    </section>


    <div class="overlay-wrapper">
        <div class="form-overlay"> 
        </div>

        <div class="form-wrapper">
            <!-- Add forms -->
            <form class="form-design category-form-design" action="store.php" method="POST">
                <div class="title">Category Form</div>
                <input type="text" name="category-name" placeholder="Category Name" spellcheck="false" required>
                <input type="submit" name="add-category-button" value="Add Category" class="add-button button">
                <input type="button" value="CANCEL" class="cancel-button button">
            </form>
            <form class="form-design brand-form-design" action="store.php" method="POST">
                <div class="title">Brand Form</div>
                <input type="text" name="brand-name" placeholder="Brand Name" spellcheck="false" required>
                <input type="submit" name="add-brand-button" value="Add Brand" class="add-button button">
                <input type="button" value="CANCEL" class="cancel-button button">
            </form>
            <form class="form-design product-form-design" action="store.php" method="POST" enctype="multipart/form-data">
                <div class="title">Product Form</div>
                <input type="text" name="product-name" placeholder="Product Name" spellcheck="false" required>
                <input type="number" name="product-quantity" placeholder="Product Quantity" spellcheck="false" required>
                <input type="number" name="product-price" placeholder="Product Price" spellcheck="false" required>
                <input type="number" name="product-warranty-month" placeholder="Product Warranty Month" spellcheck="false" required>
                <input type="text" name="product-color" placeholder="Product Color" spellcheck="false" required>
                <input type="text" name="product-description" placeholder="Product Description" spellcheck="false" required>
                <input type="file" name="product-image" placeholder="Product Image" spellcheck="false" required>
                <input type="file" name="product-additional-image-1" placeholder="Product Additional Image 1" spellcheck="false" required>
                <input type="file" name="product-additional-image-2" placeholder="Product Additional Image 2" spellcheck="false" required>
                <input type="file" name="product-additional-image-3" placeholder="Product Additional Image 3" spellcheck="false" required>
                <select name="product-brand-id">
                    <option value="">--Choose Brand name--</option>
                    <?php
                        $brandQuery="SELECT * FROM brand";
                        $queryResult = mysqli_query($connect,$brandQuery);
                        $totalBrand = mysqli_num_rows($queryResult);
                        for ( $count = 0 ; $count < $totalBrand ; $count++ ) {
                            $brandData = mysqli_fetch_array($queryResult);
                            $brandId = $brandData['BrandId'];
                            $brandName = $brandData['BrandName'];
                    ?>
                    <option value="<?php echo $brandId?>"><?php echo $brandName?></option>
                    <?php
                        }
                    ?>
                </select>
                <select name="product-category-id">
                <option value="">--Choose Category name--</option>
                <?php
                        $categoryQuery="SELECT * FROM category";
                        $queryResult = mysqli_query($connect,$categoryQuery);
                        $totalCategory = mysqli_num_rows($queryResult);
                        for ( $count = 0 ; $count < $totalCategory ; $count++ ) {
                            $categoryData = mysqli_fetch_array($queryResult);
                            $categoryId = $categoryData['CategoryId'];
                            $categoryName = $categoryData['CategoryName'];
                    ?>
                    <option value="<?php echo $categoryId?>"><?php echo $categoryName?></option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" name="add-product-button" value="Add Product" class="add-button button">
                <input type="button" value="CANCEL" class="cancel-button button">
            </form>
            <form class="form-design discount-form-design" action="store.php" method="POST">
                <div class="title">Discount Form</div>
                <input type="text" name="discount-description" placeholder="Discount Description" spellcheck="false" required>
                <input type="number" min="1" max="100" name="discount-percent" placeholder="Discount Percent" spellcheck="false" required>
                <input type="date" name="discount-start-date" placeholder="Discount Start Date" spellcheck="false" required>
                <input type="date" name="discount-end-date" placeholder="Discount End Date" spellcheck="false" required>
                <select name="discount-product-id">
                    <option value="">--Choose Product name--</option>
                    <?php
                        $productQuery="SELECT * FROM product";
                        $queryResult = mysqli_query($connect,$productQuery);
                        $totalProduct = mysqli_num_rows($queryResult);
                        for ( $count = 0 ; $count < $totalProduct ; $count++ ) {
                            $productData = mysqli_fetch_array($queryResult);
                            $productId = $productData['ProductId'];
                            $productName = $productData['ProductName'];
                    ?>
                    <option value="<?php echo $productId?>"><?php echo $productName?></option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" name="add-discount-button" value="Add Discount" class="add-button button">
                <input type="button" value="CANCEL" class="cancel-button button">
            </form>



            <!-- Update forms -->
            <form class="form-design update-form-design category-update-form-design" action="store.php" method="post">
                <div class="title">Category Update Form</div>
                <input type="text" name="category-update-id" placeholder="Category ID" spellcheck="false" readonly>
                <input type="text" name="category-update-name" placeholder="Category Name" spellcheck="false" required>
                <input type="submit" name="update-category-button" value="Update Category" class="add-button button">
                <input type="button" value="CANCEL" class="cancel-button button">
            </form>
            <form class="form-design update-form-design brand-update-form-design" action="store.php" method="post">
                <div class="title">Brand Update Form</div>
                <input type="text" name="brand-update-id" placeholder="Brand ID" spellcheck="false" readonly>
                <input type="text" name="brand-update-name" placeholder="Brand Name" spellcheck="false" required>
                <input type="submit" name="update-brand-button" value="Update Brand" class="add-button button">
                <input type="button" value="CANCEL" class="cancel-button button">
            </form>
            <form class="form-design update-form-design product-update-form-design" action="store.php" method="post">
                <div class="title">Product Update Form</div>
                <input type="text" name="product-update-id" placeholder="Product ID" spellcheck="false" readonly>
                <input type="text" name="product-update-name" placeholder="Product Name" spellcheck="false" required>
                <input type="number" name="product-update-price" placeholder="Product Price" spellcheck="false" required>
                <input type="number" name="product-update-quantity" placeholder="Product Quantity" spellcheck="false" required>
                <input type="submit" name="update-product-button" value="Update Product" class="add-button button">
                <input type="button" value="CANCEL" class="cancel-button button">
            </form>
            <form class="form-design update-form-design discount-update-form-design" action="store.php" method="post">
                <div class="title">Discount Update Form</div>
                <input type="text" name="discount-update-id" placeholder="Product ID" spellcheck="false" readonly>
                <input type="text" name="discount-update-description" placeholder="Discount Description" spellcheck="false" required>
                <input type="number" name="discount-update-percent" placeholder="Discount Percent" spellcheck="false" required>
                <input type="date" name="discount-update-start-date" placeholder="Discount Start Date" spellcheck="false" required>
                <input type="date" name="discount-update-end-date" placeholder="Discount End Date" spellcheck="false" required>
                <input type="submit" name="update-discount-button" value="Update Discount" class="add-button button">
                <input type="button" value="CANCEL" class="cancel-button button">
            </form>
        </div>
        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/e2c9faac31.js" crossorigin="anonymous"></script>
    <script src="../scripts/admin_panel_scripts/app-script.js"></script>
    <script src="../scripts/admin_panel_scripts/store-script.js"></script>
</body>
</html>