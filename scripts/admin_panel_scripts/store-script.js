const categoryAddButton = document.getElementsByClassName("category-add-button")[0];
const brandAddButton = document.getElementsByClassName("brand-add-button")[0];
const productAddButton = document.getElementsByClassName("product-add-button")[0];
const discountAddButton = document.getElementsByClassName("discount-add-button")[0];

const overlayWrapper = document.getElementsByClassName("overlay-wrapper")[0];

const categoryFormDesign = document.getElementsByClassName("category-form-design")[0];
const categoryUpdateFormDesign = document.getElementsByClassName("category-update-form-design")[0];
const brandFormDesign = document.getElementsByClassName("brand-form-design")[0];
const brandUpdateFormDesign = document.getElementsByClassName("brand-update-form-design")[0];
const productFormDesign = document.getElementsByClassName("product-form-design")[0];
const productUpdateFormDesign = document.getElementsByClassName("product-update-form-design")[0];
const discountFormDesign = document.getElementsByClassName("discount-form-design")[0];
const discountUpdateFormDesign = document.getElementsByClassName("discount-update-form-design")[0];

const cancelButtons = document.getElementsByClassName("cancel-button");

let categoryUpdateButtons = document.getElementsByClassName("category-update-button");
let brandUpdateButtons = document.getElementsByClassName("brand-update-button");
let productUpdateButtons = document.getElementsByClassName("product-update-button");
let discountUpdateButtons = document.getElementsByClassName("discount-update-button");

function handleCategoryUpdateButtons() {
    for ( let count = 0 ; count < categoryUpdateButtons.length ; count++ ) {
        categoryUpdateButtons.item(count).addEventListener("click",()=>{
            let categoryTableRow = categoryUpdateButtons.item(count).parentElement.parentElement;
            let categoryId = categoryTableRow.querySelector("td:nth-child(1)").innerHTML;
            let categoryName = categoryTableRow.querySelector("td:nth-child(2)").innerHTML;
            overlayWrapper.style.display = "inline-block";
            categoryUpdateFormDesign.style.display = "flex";
            categoryUpdateFormDesign.reset();
            let categoryIdInputForm = categoryUpdateFormDesign.querySelector("input:nth-child(2)");
            let categoryNameInputForm = categoryUpdateFormDesign.querySelector("input:nth-child(3)");
            categoryIdInputForm.setAttribute("value",categoryId);
            categoryNameInputForm.setAttribute("value",categoryName);
        });
    }
}
function handleBrandUpdateButtons() {
    for ( let count = 0 ; count < brandUpdateButtons.length ; count++ ) {
        brandUpdateButtons.item(count).addEventListener("click",()=>{
            let brandTableRow = brandUpdateButtons.item(count).parentElement.parentElement;
            let brandId = brandTableRow.querySelector("td:nth-child(1)").innerHTML;
            let brandName = brandTableRow.querySelector("td:nth-child(2)").innerHTML;
            overlayWrapper.style.display = "inline-block";
            brandUpdateFormDesign.style.display = "flex";
            brandUpdateFormDesign.reset();
            let brandIdInputForm = brandUpdateFormDesign.querySelector("input:nth-child(2)");
            let brandNameInputForm = brandUpdateFormDesign.querySelector("input:nth-child(3)");
            brandIdInputForm.setAttribute("value",brandId);
            brandNameInputForm.setAttribute("value",brandName);
        });
    }
}
function handleProductUpdateButtons() {
    for ( let count = 0 ; count < productUpdateButtons.length ; count++ ) {
        productUpdateButtons.item(count).addEventListener("click",()=>{
            let productTableRow = productUpdateButtons.item(count).parentElement.parentElement;
            let productId = productTableRow.querySelector("td:nth-child(1)").innerHTML;
            let productName = productTableRow.querySelector("td:nth-child(2)").innerHTML;
            let productPrice = productTableRow.querySelector("td:nth-child(5)").innerHTML;
            let productQuantity = productTableRow.querySelector("td:nth-child(6)").innerHTML;
            overlayWrapper.style.display = "inline-block";
            productUpdateFormDesign.style.display = "flex";
            productUpdateFormDesign.reset();
            let productIdInputForm = productUpdateFormDesign.querySelector("input:nth-child(2)");
            let productNameInputForm = productUpdateFormDesign.querySelector("input:nth-child(3)");
            let productPriceInputForm = productUpdateFormDesign.querySelector("input:nth-child(4)");
            let productQuantityInputForm = productUpdateFormDesign.querySelector("input:nth-child(5)");
            productIdInputForm.setAttribute("value",productId);
            productNameInputForm.setAttribute("value",productName);
            productPriceInputForm.setAttribute("value",productPrice);
            productQuantityInputForm.setAttribute("value",productQuantity);
        });
    }
}
function handleDiscountUpdateButtons() {
    for ( let count = 0 ; count < discountUpdateButtons.length ; count++ ) {
        discountUpdateButtons.item(count).addEventListener("click",()=>{
            let discountTableRow = discountUpdateButtons.item(count).parentElement.parentElement;
            let discountId = discountTableRow.querySelector("td:nth-child(1)").innerHTML;
            let discountDesc = discountTableRow.querySelector("td:nth-child(2)").innerHTML;
            let discountPercent = discountTableRow.querySelector("td:nth-child(3)").innerHTML.replace("%","");
            let discountStartDate = discountTableRow.querySelector("td:nth-child(4)").innerHTML;
            let discountEndDate = discountTableRow.querySelector("td:nth-child(5)").innerHTML;

            overlayWrapper.style.display = "inline-block";
            discountUpdateFormDesign.style.display = "flex";
            discountUpdateFormDesign.reset();
            let discountIdInputForm = discountUpdateFormDesign.querySelector("input:nth-child(2)");
            let discountDescInputForm = discountUpdateFormDesign.querySelector("input:nth-child(3)");
            let discountPercentInputForm = discountUpdateFormDesign.querySelector("input:nth-child(4)");
            let discountStartDateInputForm = discountUpdateFormDesign.querySelector("input:nth-child(5)");
            let discountEndDateInputForm = discountUpdateFormDesign.querySelector("input:nth-child(6)");

            discountIdInputForm.setAttribute("value",discountId);
            discountDescInputForm.setAttribute("value",discountDesc);
            discountPercentInputForm.setAttribute("value",discountPercent);
            discountStartDateInputForm.setAttribute("value",discountStartDate);
            discountEndDateInputForm.setAttribute("value",discountEndDate);
        });
    }
}

handleCategoryUpdateButtons();
handleBrandUpdateButtons();
handleProductUpdateButtons();
handleDiscountUpdateButtons();

// form cancel buttons handler...
for ( let count = 0 ; count < cancelButtons.length ; count++ ) {
    cancelButtons.item(count).addEventListener("click",()=>{
        overlayWrapper.style.display="none";
        categoryFormDesign.style.display="none";
        brandFormDesign.style.display="none";
        productFormDesign.style.display="none";
        discountFormDesign.style.display="none";
        categoryUpdateFormDesign.style.display="none";
        brandUpdateFormDesign.style.display="none";
        productUpdateFormDesign.style.display="none";
        discountUpdateFormDesign.style.display="none";
    });
}

categoryAddButton.addEventListener("click",()=>{
    overlayWrapper.style.display = "inline-block";
    categoryFormDesign.style.display = "flex";
}); 

brandAddButton.addEventListener("click",()=>{
    overlayWrapper.style.display = "inline-block";
    brandFormDesign.style.display = "flex";
}); 

productAddButton.addEventListener("click",()=>{
    overlayWrapper.style.display = "inline-block";
    productFormDesign.style.display = "flex";
}); 

discountAddButton.addEventListener("click",()=>{
    overlayWrapper.style.display = "inline-block";
    discountFormDesign.style.display = "flex";
}); 
