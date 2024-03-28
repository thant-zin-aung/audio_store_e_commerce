let placeOrderButton = document.querySelector(".checkout-main-wrapper .right-wrapper .order-summary-wrapper .place-order-button");
let radioButtons = document.querySelectorAll(".checkout-main-wrapper .left-wrapper .payment-wrapper form input[type=radio]");

placeOrderButton.addEventListener("click",event=>{
    let isUserSelectedPayment = false;
    for ( let count = 0 ; count < radioButtons.length ; count++ ) {
        if ( radioButtons[count].checked == true ) {
            let selectedPayment = radioButtons[count].getAttribute("payment-method");
            // switch(selectedPayment) {
            //     case "card":
            //     case "aya-pay":
            //     case "cb-pay":
            //     case "kbz-pay":
            //     case "cod":
            //     default:
            // }
            console.log(selectedPayment);
            if ( selectedPayment !== "cod" ) {
                alert("Selected payment is not currenly available yet.");
                isUserSelectedPayment = true;
                break;
            } else {
                isUserSelectedPayment = true;
                processAfterPlaceOrderButton();
                break;
            }
        }
    }
    if (!isUserSelectedPayment) {
        alert("Please select one payment method.");
    }
});

function processAfterPlaceOrderButton() {
    window.location = "order-confirmed.php";
}