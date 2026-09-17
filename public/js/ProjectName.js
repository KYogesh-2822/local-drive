let openMenu = document.getElementById('open_menu');
let shutMenu = document.getElementById('shut_menu');
let myMenu = document.getElementById('navbarSupportedContent');
let mediaQuery = window.matchMedia('(min-width: 991px)');

function handleResize() {
    if (mediaQuery.matches) {
        // If screen width is greater than 991px, hide both buttons
        if (shutMenu) shutMenu.style.display = "none";
        if (openMenu) openMenu.style.display = "none";
    } else {
        // Restore visibility if needed (optional)
        if (shutMenu) shutMenu.style.display = "none";
        if (openMenu) openMenu.style.display = "block";
        if (myMenu.classList.contains('show')) {
          myMenu.classList.remove('show');
      }
    }
}

// Add event listeners for the menu buttons
if (openMenu) {
    openMenu.addEventListener('click', () => {
        if (shutMenu) shutMenu.style.display = "block";
        if (openMenu) openMenu.style.display = "none";
    });
}

if (shutMenu) {
    shutMenu.addEventListener('click', () => {
        if (openMenu) openMenu.style.display = "block";
        if (shutMenu) shutMenu.style.display = "none";
    });
}

// Listen for window resize and execute the initial check
window.addEventListener('resize', handleResize);
handleResize();


document.addEventListener("DOMContentLoaded", function() {
  // Add click event listener to all dropdowns
  var dropdowns = document.querySelectorAll('.nav-item.dropdown');

  dropdowns.forEach(function(dropdown) {
      dropdown.addEventListener('click', function(e) {
          if (window.innerWidth <= 992) { // For mobile devices
              e.preventDefault(); // Prevent default anchor behavior

              var dropdownMenu = this.querySelector('.dropdown-menu');
              var isOpen = dropdownMenu.classList.contains('show');

              // Toggle current dropdown
              if (isOpen) {
                  dropdownMenu.classList.remove('show'); // Close dropdown if open
              } else {
                  // Close all other dropdowns first
                  document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                      menu.classList.remove('show');
                  });
                  dropdownMenu.classList.add('show'); // Open current dropdown
              }
          }
      });
  });

  // Prevent collapse of navbar when clicking on dropdown in mobile view
  document.querySelectorAll('.navbar-nav .dropdown').forEach(function(dropdown) {
      dropdown.addEventListener('click', function(e) {
          if (window.innerWidth <= 992) { // Mobile check
              e.stopPropagation(); // Prevent the navbar from collapsing
          }
      });
  });
});



// let updateColor = document.querySelectorAll('.accordion-header');
// let updateBtn = document.querySelectorAll('.accordion-button');



// updateColor.forEach((color) => {
//   updateBtn.forEach((butn) => {
//   })
//   color.addEventListener('click', () => {
//     color.classList.toggle('add_green');
//     butn.classList.toggle('clr_green');
//   })
// })



(function ($) {
  'use strict';
  AOS.init();

  // slider

  $('.car-slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1500,
    arrows: true,
    dots: true,
    centerMode: true,
    centerPadding: '160px',
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 2,
          centerPadding: '170px',
        }
      },
      {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        centerPadding: '70px',
        arrows: false,
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 1,
        centerPadding: '0px',
        arrows: false,
      }
    }]
  });


  $('.vehicle-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1500,
    arrows: true,
    dots: true,
    centerMode: true,
    centerPadding: '460px',
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 1,
          centerPadding: '170px',
        }
      },
      {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        centerPadding: '70px',
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 1,
        centerPadding: '0px',
      }
    }]
  });



  // slider 2

  $('.car-slider-2').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1500,
    arrows: false,
    dots: true,
    centerMode: true,
    centerPadding: '300px',
    pauseOnHover: false,
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 2
      }
    }]
  });


  // slider milestone

  $('.slider-mileston-grid').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: true,
    prevArrow: '<button class="slide-arrow prev-arrow"><i class="fa fa-angle-left"></i></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><i class="fa fa-angle-right"></i></button>',
    dots: false,
    pauseOnHover: false,
    responsive:[
      {breakpoint:575,
        settings:{
          arrows: false,
        }
      }
    ]
  });


  // drives-slider

  $('.drives-slider').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1500,
    arrows: false,
    dots: false,
    centerMode: true,
    centerPadding: '80px',
    pauseOnHover: false,
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 2
      }
    }]
  });


  // add class checkbox

  $('#exampleCheck11').change(function () {
    if ($(this).is(":checked")) {
      $('.date-grid').addClass('d-block');
    } else {
      $('.date-grid').removeClass('d-block');
    }
  });


  // $('#exampleCheck1').change(function () {
  //   if ($(this).is(":checked")) {
  //     $('.date-griddd').addClass('d-block');
  //   } else {
  //     $('.date-griddd').removeClass('d-block');
  //   }
  // });


  $('.exampleCheck, #exampleCheck1').change(function () {
    if ($(this).is(":checked")) {
      $('.date-griddd').addClass('d-block');
    } else {
      $('.date-grid-off').removeClass('d-block');
    }
  });


  $(' #exampleCheck2').change(function () {
    if ($(this).is(":checked")) {
      $('.date-gridd').addClass('d-block');
    } else {
      $('.date-gridd').removeClass('d-block');
    }
  });




  $(document).click(function (e) {
    if (!$(e.target).is('.accordion-body, .accordion-body *')) {
      $('.collapse').collapse('hide');
    }
  });



  /*-- arrow-alider --*/


  $('.img-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 3000,
    arrows: true,
    dots: false,
    pauseOnHover: true,
    prevArrow: "<button type='button' class='arrow slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
    nextArrow: "<button type='button' class='arrow slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
  });



  var $status_ps = $('.pagingInfo-ps');
  var $slickElement_ps = $('.img-slider');

  $slickElement_ps.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
    //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
    var i = (currentSlide ? currentSlide : 0) + 1;
    $status_ps.text(i + '/' + slick.slideCount);
  });



  // fiter class

  $(document).ready(function () {
    $('.vehicle-redemption__options-item').on('click', function () {
      $('.vehicle-redemption__options-item').removeClass('vehicle-redemption__options-item--active');
      $(this).addClass('vehicle-redemption__options-item--active');
    })



    $('.v-pay').on('click', function () {
      $('.vehicle-filter-grid').addClass('active-filter');
    })

    $('.v-point').on('click', function () {
      $('.vehicle-filter-grid').removeClass('active-filter');
    })

  });









  // $(".click-btn").on("click", function (event) {
  //   event.stopPropagation();
  //   $(".price-detail").toggleClass("show");
  // });






  //Avoid pinch zoom on iOS
  document.addEventListener('touchmove', function (event) {
    if (event.scale !== 1) {
      event.preventDefault();
    }
  }, false);
})(jQuery)

let mYfilter = document.getElementById('filter');
let locationHeader = document.getElementsByClassName('location_header_section');
let filterArrow = document.getElementById("filterArrow")

mYfilter.addEventListener('click', () => {
  if (locationHeader[0].style.display === "block" && filterArrow.style.rotate === '180deg') {
    locationHeader[0].style.display = "none";
    filterArrow.style.rotate = '360deg'
  }
  else {
    locationHeader[0].style.display = "block";
    filterArrow.style.rotate = '180deg'
  }
})

let filter = document.getElementById('changeLoc');
let locationchange = document.getElementsByClassName('location_change');
let locArrow = document.getElementById("locArrow")

filter.addEventListener('click', () => {
  if (locationchange[0].style.display === "block" && locArrow.style.rotate === '180deg') {
    locationchange[0].style.display = "none";
    locArrow.style.rotate = '360deg'
  }
  else {
    locationchange[0].style.display = "block";
    locArrow.style.rotate = '180deg'
  }
})


