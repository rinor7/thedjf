//Hamburger Menu
// var Menu = {
//     el: {
//     ham: jQuery('.menu-m'),
//     menuTop: jQuery('.menu-top'),
//     menuMiddle: jQuery('.menu-middle'),
//     menuBottom: jQuery('.menu-bottom')
//     },
//     init: function() {
//     Menu.bindUIactions();
//     },
//     bindUIactions: function() {
//     Menu.el.ham
//     .on(
//     'click',
//     function(event) {
//     Menu.activateMenu(event);
//     event.preventDefault();
//     }
//     );
//     },
//     activateMenu: function() {
//     Menu.el.menuTop.toggleClass('menu-top-click');
//     Menu.el.menuMiddle.toggleClass('menu-middle-click');
//     Menu.el.menuBottom.toggleClass('menu-bottom-click'); 
//     }
//     };
// Menu.init();

// Header change on scroll
$(document).ready(function() {
  $(window).scroll(function(){
      if ($(this).scrollTop() > 70) {
         $('.logo_header').addClass('logo-change-on-scroll'); 
         $('.logo_site').addClass('logo-change-on-scroll'); 
         $('.headerbar').addClass('reduce-header-height-on-scroll');
        //  $('.navbar-toggler2').addClass('scroll-hamburger');
         $('header').addClass('shadow-show-on-scroll');
         $('body').addClass('body-on-scroll');
      } else {
         $('.logo_header').removeClass('logo-change-on-scroll');
         $('.logo_site').removeClass('logo-change-on-scroll');
         $('.headerbar').removeClass('reduce-header-height-on-scroll');
        //  $('.navbar-toggler2').removeClass('scroll-hamburger');
         $('header').removeClass('shadow-show-on-scroll');
         $('body').removeClass('body-on-scroll');
      }
      if ($(this).scrollTop() > 30) {
        $('body').addClass('body-on-scroll');
     } else {
        $('body').removeClass('body-on-scroll');
     }
  });
});

// for rightmenu.php header
// $(document).ready(function() {
//   $('.navbar-toggler').click(function() {
//     $('.menu-menu-1-container').toggleClass('act');
//   });

//   $('li a').click(function() {
//     $('.menu-menu-1-container').removeClass('act');
//     $('.menu-bottom').removeClass('menu-bottom-click');
//     $('.menu-top').removeClass('menu-top-click');
//   });
// });
 
// Search Result
// $('.control').click( function(){
//   $('body').addClass('search-active');
//   $('.fa-search-loc').addClass('d-none');
//   $('.input-search').focus();
// });
// Search Result END

// $('.icon-close').click( function(){
//   $('body').removeClass('search-active');
//   $('.fa-search-loc').removeClass('d-none');
// });



// var prevScrollpos = window.pageYOffset;
// window.onscroll = function() {
// var currentScrollPos = window.pageYOffset;
//   if (prevScrollpos > currentScrollPos) {
//     document.getElementById("standard-header").style.cssText = "top: 0px; transition: .5s";
//   } else {
//     document.getElementById("standard-header").style.cssText = "top: -45px; transition: .5s;";
//   }
//   prevScrollpos = currentScrollPos;
// }

// $(document).ready(function() {
//   const navbarToggler = $('.navbar-toggler');
//   const site = $('.site-home, .site, .site-main, .page-all, .site-other');
//   const body = $('html');
//   navbarToggler.on('click', function() {
//     body.toggleClass('no-scroll');
//     site.toggleClass('filter-style');
//   });
//   });


// Menu for standard header with blur effect
$(document).ready(function() {
  const navbarToggler = $('.navbar-toggler-standard');
  const site = $('.site');
  const body = $('body');

  navbarToggler.on('click', function() {
    if (body.hasClass('no-scroll')) {
      body.removeClass('no-scroll');
      site.removeClass('filter-style');
      $(window).scrollTop(body.data('scroll-position')); // Restore previous scroll position
    } else {
      body.data('scroll-position', $(window).scrollTop()); // Save current scroll position
      body.addClass('no-scroll');
      site.addClass('filter-style');
    }
  });
});


// Close navbar when click on link ( used for Landingpages )
// function closeNavbar() {
//   $(".navbar-toggler").attr("aria-expanded", "false");
//   $(".navbar-collapse").removeClass("show");
//   $(".menu-top").removeClass("menu-top-click");
//   $(".menu-middle").removeClass("menu-middle-click");
//   $(".menu-bottom").removeClass("menu-bottom-click");
//   $("body").removeClass("no-scroll");
//   $(".site").removeClass("filter-style");
//   $(".menu-menu-1-container").removeClass("act");
//   toggleScroll();
// }
// $(".navbar-collapse li a").on("click", function() {
//   closeNavbar();
// });


//For all navigation, add menu-open class on body
// document.addEventListener('DOMContentLoaded', function () {
//   var navbar = document.getElementById('navbarNav');

//   navbar.addEventListener('show.bs.collapse', function () {
//     document.body.classList.add('menu-open');
//   });

//   navbar.addEventListener('hide.bs.collapse', function () {
//     document.body.classList.remove('menu-open');
//   });
// });


// var swiper = new Swiper(".mySwiper", {
//   pagination: {
//     el: ".swiper-pagination",
//   },
// });

var swiper = new Swiper(".mySwiper-boxes-section", {
  slidesPerView: 1,
  spaceBetween: 15,
  loop: true,
  autoHeight: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 15,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 16,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 16,
    },
  },
});

var swiper = new Swiper(".banner-slider", {
  slidesPerView: 1,
  loop: true,
  effect: "fade",
  autoHeight: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
});


document.addEventListener('DOMContentLoaded', function () {
  const urlParams = new URLSearchParams(window.location.search);
  const agentEmail = urlParams.get('agent');

  if (agentEmail) {
    const agentField = document.getElementById('agent-email');
    if (agentField) {
      agentField.value = agentEmail;
    }
  }
});

//When signature exist on form and not valid add border
document.addEventListener('DOMContentLoaded', function () {
  // Observe all .wpcf7-form-control elements
  document.querySelectorAll('.wpcf7-form-control').forEach(function (el) {
    const observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (mutation.attributeName === 'class') {
          if (el.classList.contains('wpcf7-not-valid')) {
            const container = el.closest('.dscf7_signature');
            if (container) {
              const inner = container.querySelector('.dscf7_signature_inner');
              if (inner) {
                inner.classList.add('wpcf7-not-valid');
              }
            }
          }
        }
      });
    });

    observer.observe(el, { attributes: true });
  });
});



const ssnInput = document.getElementById("ssn");
  ssnInput.addEventListener("input", function () {
    let value = ssnInput.value.replace(/\D/g, ""); // Remove non-digits
    value = value.slice(0, 9); // Limit to 9 digits
    if (value.length > 5) {
      value = value.slice(0, 3) + '-' + value.slice(3, 5) + '-' + value.slice(5);
    } else if (value.length > 3) {
      value = value.slice(0, 3) + '-' + value.slice(3);
    }
    ssnInput.value = value;
  });

const input = document.getElementById("federal-tax-id");
  input.addEventListener("input", function (e) {
    let value = input.value.replace(/\D/g, "");
    value = value.slice(0, 9);
    if (value.length > 2) {
      value = value.slice(0, 2) + '-' + value.slice(2);
    }
    input.value = value;
  });

  
  function formatDateInput(el) {
    el.addEventListener("input", function () {
      let value = el.value.replace(/\D/g, "").slice(0, 8);
      if (value.length >= 5) {
        value = value.slice(0, 2) + '/' + value.slice(2, 4) + '/' + value.slice(4);
      } else if (value.length >= 3) {
        value = value.slice(0, 2) + '/' + value.slice(2);
      }
      el.value = value;
    });
  }

  const dobInput = document.getElementById("dob");
  const startDateInput = document.getElementById("business-start-date");

  if (dobInput) formatDateInput(dobInput);
  if (startDateInput) formatDateInput(startDateInput);