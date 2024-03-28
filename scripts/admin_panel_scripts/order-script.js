let deliveryStatusBox = document.querySelectorAll(".order-table .delivery-status select");
for ( let count=0 ; count < deliveryStatusBox.length ; count++ ) {
    let boxStatus = deliveryStatusBox[count].value;
    console.log(boxStatus);
    if ( boxStatus.toLowerCase() === "pending" ) {
        deliveryStatusBox[count].setAttribute("style","background-color: red; color: white;");
    } else if ( boxStatus.toLowerCase() === "processing" ) {
        deliveryStatusBox[count].setAttribute("style","background-color: orange; color: white;");
    } else if ( boxStatus.toLowerCase() === "delivered" ) {
        deliveryStatusBox[count].setAttribute("style","background-color: green; color: white;");
    }
}