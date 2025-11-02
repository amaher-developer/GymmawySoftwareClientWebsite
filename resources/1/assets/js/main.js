(function($) {

	"use strict";

    // preloader
    jQuery(document).ready(function($) {  
        $(window).load(function(){
          $('#preloader').fadeOut('slow',function(){$(this).remove();});
        });
    });

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (
            location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate(
                    {
                        scrollTop: target.offset().top - 72,
                    },
                    1000,
                    "easeInOutExpo"
                );
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $(".js-scroll-trigger").click(function () {
        $(".navbar-collapse").collapse("hide");
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $("body").scrollspy({
        target: "#mainNav",
        offset: 100,
    });

    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
 


    // Pogo Slider
    $('#pogo-slider').pogoSlider({
        autoplay: true,
        autoplayTimeout: 5000,
        displayProgess: true,
        targetWidth: 1920,
        targetHeight: 750,
        responsive: true,
        pauseOnHover: false,
    }).data('plugin_pogoSlider');


    // Full Screen Background
    function fullscreen(){
        jQuery('#hero').css({
            width: jQuery(window).width(),
            height: jQuery(window).height()
        });
    }
    fullscreen();
    jQuery(window).resize(function() {
       fullscreen();         
    });


    // slick-carousel for courses
    $(".courses-carousel").slick({
            dots: false,
            arrows: true,
            infinite: true,
            autoplay: true,
            pauseOnHover: false,
            speed: 800,
            autoplaySpeed: 3000,
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 750,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            
          ]

      });


    // slick-carousel for courses for RTL
    $(".courses-carousel-rtl").slick({
            rtl: true,
            dots: false,
            arrows: true,
            infinite: true,
            autoplay: true,
            pauseOnHover: false,
            speed: 800,
            autoplaySpeed: 3000,
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 750,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            
          ]

      });





    // slick-carousel for trainer
    $(".trainer-carousel").slick({
            dots: false,
            arrows: true,
            infinite: true,
            autoplay: true,
            pauseOnHover: false,
            speed: 800,
            autoplaySpeed: 3000,
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 750,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            
          ]

      });

    // slick-carousel for trainer RTL
    $(".trainer-carousel-rtl").slick({
            rtl: true,
            dots: false,
            arrows: true,
            infinite: true,
            autoplay: true,
            pauseOnHover: false,
            speed: 800,
            autoplaySpeed: 3000,
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 750,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            
          ]

      });

    // slick-carousel for testimonial
    $(".testimonial-carousel").slick({
            dots: true,
            arrows: false,
            infinite: true,
            autoplay: true,
            pauseOnHover: false,
            speed: 800,
            autoplaySpeed: 3000,
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 750,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            
          ]

      });

    // slick-carousel for testimonial RTL
    $(".testimonial-carousel-rtl").slick({
            rtl: true,
            dots: true,
            arrows: false,
            infinite: true,
            autoplay: true,
            pauseOnHover: false,
            speed: 800,
            autoplaySpeed: 3000,
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
              }
            },
            {
              breakpoint: 750,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            
          ]

      });
    

    // Light box - featherlightGallery
    $('.gallery').featherlightGallery({
      gallery: {
          fadeIn: 300,
          fadeOut: 300
      },
      openSpeed: 300,
      closeSpeed: 300
    });
    $('.gallery2').featherlightGallery({
        gallery: {
            next: 'next Â»',
            previous: 'Â« previous'
        },
        variant: 'featherlight-gallery2'
    });


    // Parallax background
    $('.jarallax').jarallax({
            speed: 0.5,
    })




})(window.jQuery);