document.addEventListener( 'DOMContentLoaded', function() {
    let title = document.querySelectorAll(`.splide .item .slide-show-detail .title`)[0];
    let description = document.querySelectorAll(`.splide .item .slide-show-detail .description`)[0];
    let exploreButton = document.querySelectorAll(`.splide .item .slide-show-detail .explore-button-form`)[0];
    title.classList.add("unhide-info");
    description.classList.add("unhide-info");
    exploreButton.classList.add("unhide-info");
    var splide = new Splide( '#slide-show', {
        type    : 'loop',
        perPage : 1,
        autoplay: true,
        pagination: false,
        arrows: false,
        interval: 5000,
    } );
    splide.mount();

    splide.on('move',function(newIndex,prevIndex,destIndex) {
        let title = document.querySelector(`.splide #slide-show-slide0${newIndex+1} .slide-show-detail .title`);
        let description = document.querySelector(`.splide #slide-show-slide0${newIndex+1} .slide-show-detail .description`);
        let exploreButton = document.querySelector(`.splide #slide-show-slide0${newIndex+1} .slide-show-detail .explore-button-form`);
        let prevTitle = document.querySelector(`.splide #slide-show-slide0${prevIndex+1} .slide-show-detail .title`);
        let prevDescription = document.querySelector(`.splide #slide-show-slide0${prevIndex+1} .slide-show-detail .description`);
        let prevExploreButton = document.querySelector(`.splide #slide-show-slide0${prevIndex+1} .slide-show-detail .explore-button-form`);
        title.classList.add("unhide-info");
        prevTitle.classList.remove("unhide-info");
        description.classList.add("unhide-info");
        prevDescription.classList.remove("unhide-info");
        exploreButton.classList.add("unhide-info");
        prevExploreButton.classList.remove("unhide-info");
    });

    var mostOrderSplide = new Splide( '#most-order-products', {
        type    : 'loop',
        gap: '1rem',
        autoplay: true,
        pagination: false,
        fixedWidth: '300px',
        padding: 3,
        // arrows: false,
        interval: 5000,
        breakpoints: {
            1920: { 
                fixedWidth: '240px',
                gap: '0.5em',
             },
            1366: { 
                fixedWidth: '240px',
                gap: '0.5em',
             },
            640 : { 
                fixedWidth: '150px',
                gap: '0.5em',
             },
          },
    } );
    mostOrderSplide.mount();
});


// Scroll event listener for nav bar style and route intro section...
const navBarWrapper = document.querySelector(".nav-bar-wrapper");
const navATags = document.querySelectorAll(".nav-bar .middle-wrapper a");
const navSearchBox = document.querySelector(".nav-bar .right-wrapper .search-box-wrapper input[type=text]");
const topLeftDetailWrapper = document.querySelector("#route-intro .left-wrapper .top-wrapper .left");
const topRightDetailWrapper = document.querySelector("#route-intro .left-wrapper .top-wrapper .right");
const bottomDetailWrapper = document.querySelector("#route-intro .left-wrapper .bottom-wrapper");
const rightDetailWrapper = document.querySelector("#route-intro .right-wrapper");

const elementIsVisibleInViewport = (el, partiallyVisible = false) => {
    const { top, left, bottom, right } = el.getBoundingClientRect();
    const { innerHeight, innerWidth } = window;
    return partiallyVisible
      ? ((top > 0 && top < innerHeight) ||
          (bottom > 0 && bottom < innerHeight)) &&
          ((left > 0 && left < innerWidth) || (right > 0 && right < innerWidth))
      : top >= 0 && left >= 0 && bottom <= innerHeight && right <= innerWidth;
  };

document.addEventListener('scroll', event => {
    if (window.scrollY == 0 ) {
        for (let count = 0 ; count < navATags.length ; count++) {
            navATags[count].classList.remove("change-nav-text");
        }
        navBarWrapper.classList.remove("change-nav-background","change-nav-text");
        navSearchBox.setAttribute("style","background-color: white");
    } else {
        for (let count = 0 ; count < navATags.length ; count++) {
            navATags[count].classList.add("change-nav-text");
        }
        navBarWrapper.classList.add("change-nav-background","change-nav-text");
        navSearchBox.setAttribute("style","background-color: #ECECEC");
    }

    if ( elementIsVisibleInViewport(topLeftDetailWrapper,true) ) {
        topLeftDetailWrapper.classList.add("unhide-route-intro-wrappers");
        topRightDetailWrapper.classList.add("unhide-route-intro-wrappers");
    }
    if ( elementIsVisibleInViewport(bottomDetailWrapper,true) ) {
        bottomDetailWrapper.classList.add("unhide-route-intro-wrappers");
        rightDetailWrapper.classList.add("unhide-route-intro-wrappers");
    }
});
