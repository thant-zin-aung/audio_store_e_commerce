let addresses = document.querySelectorAll(".right-wrapper .shipping-address-wrapper .address-wrapper .address");
let checkoutButton = document.querySelector(".main-wrapper .right-wrapper .order-summary-wrapper button");
let selectedAddress="";

for ( let count=0 ; count < addresses.length ; count++ ) {
    addresses[count].addEventListener("click",event=>{
        for ( let iCount=0 ; iCount < addresses.length ; iCount++ ) {
            addresses[iCount].classList.remove("select-address");
        }
        addresses[count].classList.toggle("select-address");
        selectedAddress=addresses[count].getAttribute("addressid");
    });
}

checkoutButton.addEventListener("click",event=>{
    if ( selectedAddress === "" ) {
        alert("Please select or enter one address!");
    } else {
        window.location = "checkout-payment.php?addressId="+selectedAddress;
    }
});
