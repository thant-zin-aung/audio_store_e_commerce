<?php
    include('connect.php');

    // $adminCreateQuery = "CREATE TABLE adminStaff(
    //     AdminId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //     AdminUsername VARCHAR(50) NOT NULL,
    //     AdminUserPassword VARCHAR(50) NOT NULL,
    //     AdminFirstName VARCHAR(50) NOT NULL,
    //     AdminLastName VARCHAR(50) NOT NULL,
    //     AdminEmail VARCHAR(100) NOT NULL,
    //     ProfileImage TEXT
    // )";

    // $queryResult = mysqli_query($connect,$adminCreateQuery);
    // if ( $queryResult ) {
    //     echo "Admin table created successfully...";
    // }
    
    // $categoryCreateQuery = "CREATE TABLE category(
    //     CategoryId VARCHAR(10) NOT NULL PRIMARY KEY,
    //     CategoryName VARCHAR(50) NOT NULL
    // )";

    // $queryResult = mysqli_query($connect,$categoryCreateQuery);
    // if ( $queryResult ) {
    //     echo "Category table craeted successfully...";
    // }

    

    // $brandCreateQuery = "CREATE TABLE brand(
    //     BrandId VARCHAR(10) NOT NULL PRIMARY KEY,
    //     BrandName VARCHAR(50) NOT NULL
    // )";

    // $queryResult = mysqli_query($connect,$brandCreateQuery);
    // if ( $queryResult ) {
    //     echo "Brand table craeted successfully...";
    // }
    


    // $productCreateQuery = "CREATE TABLE product(
    //     ProductId VARCHAR(10) NOT NULL PRIMARY KEY,
    //     ProductName VARCHAR(50) NOT NULL,
    //     Quantity INT NOT NULL,
    //     Price DECIMAL NOT NULL,
    //     WarrantyMonth INT NOT NULL,
    //     Color VARCHAR(20) NOT NULL,
    //     Description TEXT NOT NULL,
    //     ProductImage TEXT NOT NULL,
    //     AdditionalImage1 TEXT,
    //     AdditionalImage2 TEXT,
    //     AdditionalImage3 TEXT,
    //     BrandId VARCHAR(10) NOT NULL,
    //     CategoryId VARCHAR(10) NOT NULL,
    //     FOREIGN KEY(BrandId) REFERENCES brand(BrandId),
    //     FOREIGN KEY(CategoryId) REFERENCES category(CategoryId)
    // )";

    // $queryResult = mysqli_query($connect,$productCreateQuery);
    // if ( $queryResult ) {
    //     echo "Product table craeted successfully...";
    // }



    // $discountCreateQuery = "CREATE TABLE discount(
    //     DiscountId VARCHAR(10) NOT NULL PRIMARY KEY,
    //     DiscountDescription TEXT NOT NULL,
    //     DiscountPercent INT NOT NULL,
    //     StartDate DATE NOT NULL,
    //     EndDate DATE NOT NULL,
    //     ProductId VARCHAR(10) NOT NULL,
    //     FOREIGN KEY(ProductId) REFERENCES product(ProductId)
    // )";

    // $queryResult = mysqli_query($connect,$discountCreateQuery);
    // if ( $queryResult ) {
    //     echo "Discount table craeted successfully...";
    // }

    // $userCreateQuery = "CREATE TABLE user(
    //     UserId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //     Username VARCHAR(50) NOT NULL,
    //     UserPassword VARCHAR(50) NOT NULL,
    //     FirstName VARCHAR(50) NOT NULL,
    //     LastName VARCHAR(50) NOT NULL,
    //     DateOfBirth DATE NOT NULL,
    //     Email VARCHAR(100) NOT NULL,
    //     Phone VARCHAR(30) NOT NULL,
    //     RegistrationDate DATE,
    //     ProfileImage TEXT
    // )";

    // $queryResult = mysqli_query($connect,$userCreateQuery);
    // if ( $queryResult ) {
    //     echo "User table created successfully...";
    // }

    // $shippingAddressCreateQuery = "CREATE TABLE shippingaddress(
    //     ShippingId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //     ShippingAddress TEXT,
    //     UserId INT,
    //     FOREIGN KEY(UserId) REFERENCES user(UserId)
    // )";

    // $queryResult = mysqli_query($connect,$shippingAddressCreateQuery);
    // if ( $queryResult ) {
    //     echo "Shipping address table craeted successfully...";
    // }

    // $orderCreateQuery = "CREATE TABLE purchase_order(
    //     OrderId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //     OrderDate DATE NOT NULL,
    //     UserId INT NOT NULL,
    //     Currency VARCHAR(10) NOT NULL,
    //     PaymentType VARCHAR(50) NOT NULL,
    //     DeliveryStatus VARCHAR(50) NOT NULL,
    //     FOREIGN KEY(UserId) REFERENCES user(UserId)
    // )";

    // $queryResult = mysqli_query($connect,$orderCreateQuery);
    // if ( $queryResult ) {
    //     echo "Order table created successfully...";
    // }

    // $orderProductQuery = "CREATE TABLE order_products(
    //     OrderId INT NOT NULL,
    //     ProductId VARCHAR(10),
    //     TotalQuantity INT NOT NULL,
    //     TotalAmount DECIMAL NOT NULL,
    //     FOREIGN KEY(OrderId) REFERENCES purchase_order(OrderId),
    //     FOREIGN KEY(ProductId) REFERENCES product(ProductId)
    // )";

    // $queryResult = mysqli_query($connect,$orderProductQuery);
    // if ( $queryResult ) {
    //     echo "Order product table created successfully...";
    // }

?>