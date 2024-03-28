let deliveryStatus = document.querySelectorAll(".main-wrapper table .delivery-status");
for ( let count = 0 ; count < deliveryStatus.length ; count++ ) {
    let currentDeliveryStatus = deliveryStatus[count].textContent;
    if ( currentDeliveryStatus.toLocaleLowerCase() === "pending" ) {
        deliveryStatus[count].style.color = "red";
    } else if ( currentDeliveryStatus.toLocaleLowerCase() === "processing" ) {
        deliveryStatus[count].style.color = "orange";
    }if ( currentDeliveryStatus.toLocaleLowerCase() === "delivered" ) {
        deliveryStatus[count].style.color = "green";
    }
}