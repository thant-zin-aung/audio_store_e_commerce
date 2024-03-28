let addToCartButtons = document.querySelectorAll("#most-order-products .item .product-detail .add-to-cart");
let cartItemBadge = document.querySelector(".nav-bar .right-wrapper .cart-wrapper .badge");
let accountWrapper = document.querySelector(".nav-bar .right-wrapper .account-wrapper");
let cartWrapper = document.querySelector(".nav-bar .right-wrapper .cart-wrapper");
let totalItemInCart = cartItemBadge.textContent;

function isUserLoggedIn() {
    let accountStatus = accountWrapper.getAttribute("isuserloggedin");
    if ( accountStatus === "false" ) {
        return false;
    } else return true;
}

function addToCartButtonsHandler() {
    for ( let count = 0 ; count < addToCartButtons.length ; count++ ) {
        addToCartButtons[count].addEventListener("click", event => {
            if ( !isUserLoggedIn() ) {
                window.location = "login.php";
            } else {
                let productId = addToCartButtons[count].getAttribute("productId");
                ++totalItemInCart;
                window.open("update-cart.php?productId="+productId,"_blank");
                cartItemBadge.innerHTML = totalItemInCart;
            }
        });
    }
}
addToCartButtonsHandler();

cartWrapper.addEventListener("click",event=> {
    window.location = "cart.php";
});