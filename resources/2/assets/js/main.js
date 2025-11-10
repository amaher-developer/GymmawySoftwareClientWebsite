(function($) {
    "use strict";
    /* -------------------------------------
               Prealoder
         -------------------------------------- */
    $(window).on('load', function(event) {
        $('.proloader').delay(500).fadeOut(500);
    });
    
    /* -------------------------------------
          Product Quantity
    -------------------------------------- */
    var minVal = 1,
        maxVal = 20;
    $(".increaseQty").on('click', function() {
        var $parentElm = $(this).parents(".qtySelector");
        $(this).addClass("clicked");
        setTimeout(function() {
            $(".clicked").removeClass("clicked");
        }, 100);
        var value = $parentElm.find(".qtyValue").val();
        if (value < maxVal) {
            value++;
        }
        $parentElm.find(".qtyValue").val(value);
    });
    // Decrease product quantity on cart page
    $(".decreaseQty").on('click', function() {
        var $parentElm = $(this).parents(".qtySelector");
        $(this).addClass("clicked");
        setTimeout(function() {
            $(".clicked").removeClass("clicked");
        }, 100);
        var value = $parentElm.find(".qtyValue").val();
        if (value > 1) {
            value--;
        }
        $parentElm.find(".qtyValue").val(value);
    });

    /* -------------------------------------
          Sidebar Popup
    -------------------------------------- */
    $('.sidebar-menu').on('click', function() {
        $('.contact-popup').addClass('open');
        $('.body_overlay').addClass('open');
    });
    $('.close-popup, .body_overlay').on('click', function() {
        $('.contact-popup').removeClass('open');
        $('.body_overlay').removeClass('open');

    });
    /* -------------------------------------
          Language Selector
    -------------------------------------- */
    $('.shopcart').on('click', function() {
        $('.cart-popup').addClass('open')
    });
    $('.close-popup').on('click', function() {
        $('.cart-popup').removeClass('open')
    });

     $('.mobile-top-bar').on('click', function() {
        $('.header-top-right').addClass('open')
    });
      $('.close-header-top').on('click', function() {
        $('.header-top-right').removeClass('open')
    });

    /* -------------------------------------
          sticky Header
    -------------------------------------- */
    var wind = $(window);
    var sticky = $('.header-wrap');
    wind.on('scroll', function() {
        var scroll = wind.scrollTop();
        if (scroll < 100) {
            sticky.removeClass('sticky');
        } else {
            sticky.addClass('sticky');
        }
    });

    /*---------------------------------
        Jquery mmenu
    ---------------------------------*/
    $('#menu').mmenu({}, {
        offCanvas: {
            clone: true
        }
    });
    $('#ham-menu').mmenu();
    /*---------------------------------
        Tweenmax js
    ---------------------------------*/
    $('.hero-wrap.style3').mousemove(function (e) {
        var wx = $(window).width();
        var wy = $(window).height();
        var x = e.pageX - this.offsetLeft;
        var y = e.pageY - this.offsetTop;
        var newx = x - wx / 2;
        var newy = y - wy / 2;
        $('.hero-img-wrap .hero-shape-three img').each(function () {
            var speed = $(this).attr('data-speed');
            if ($(this).attr('data-revert')) speed *= -.4;
            TweenMax.to($(this), 1, { x: (1 - newx * speed), y: (1 - newy * speed) });
        });
    });
    $('.hero-wrap.style4').mousemove(function (e) {
        var wx = $(window).width();
        var wy = $(window).height();
        var x = e.pageX - this.offsetLeft;
        var y = e.pageY - this.offsetTop;
        var newx = x - wx / 2;
        var newy = y - wy / 2;
        $('.hero-img ').each(function () {
            var speed = $(this).attr('data-speed');
            if ($(this).attr('data-revert')) speed *= -.4;
            TweenMax.to($(this), 1, { x: (1 - newx * speed), y: (1 - newy * speed) });
        });
    });
    $('.hero-wrap.style-six').mousemove(function (e) {
        var wx = $(window).width();
        var wy = $(window).height();
        var x = e.pageX - this.offsetLeft;
        var y = e.pageY - this.offsetTop;
        var newx = x - wx / 2;
        var newy = y - wy / 2;
        $('.hero-img').each(function () {
            var speed = $(this).attr('data-speed');
            if ($(this).attr('data-revert')) speed *= -.4;
            TweenMax.to($(this), 1, { x: (1 - newx * speed), y: (1 - newy * speed) });
        });
    });
    $('.hero-wrap.style-seven').mousemove(function (e) {
        var wx = $(window).width();
        var wy = $(window).height();
        var x = e.pageX - this.offsetLeft;
        var y = e.pageY - this.offsetTop;
        var newx = x - wx / 2;
        var newy = y - wy / 2;
        $('.hero-img').each(function () {
            var speed = $(this).attr('data-speed');
            if ($(this).attr('data-revert')) speed *= -.4;
            TweenMax.to($(this), 1, { x: (1 - newx * speed), y: (1 - newy * speed) });
        });
        $('.hero-section-shape').each(function () {
            var speed = $(this).attr('data-speed');
            if ($(this).attr('data-revert')) speed *= -.4;
            TweenMax.to($(this), 1, { x: (1 - newx * speed), y: (1 - newy * speed) });
        });
    });
    $('.about-area.style-seven').mousemove(function (e) {
        var wx = $(window).width();
        var wy = $(window).height();
        var x = e.pageX - this.offsetLeft;
        var y = e.pageY - this.offsetTop;
        var newx = x - wx / 2;
        var newy = y - wy / 2;
        $('.about-img').each(function () {
            var speed = $(this).attr('data-speed');
            if ($(this).attr('data-revert')) speed *= -.4;
            TweenMax.to($(this), 1, { x: (1 - newx * speed), y: (1 - newy * speed) });
        });
    });
    /*---------------------------------
        Program Slider on click
    ---------------------------------*/
    // When a list item is clicked
    $('.program-wrapper .program-card').on('click', function() {
        // Remove 'active' class from all list items
        $('.program-wrapper .program-card').removeClass('active');
        
        // Add 'active' class to the clicked item
        $(this).addClass('active');
      });
    /*---------------------------------
        Hero Slider 1
    ---------------------------------*/
    $(".hero-slider-v1").owlCarousel({
        items: 1,
        nav: true,
        dot: false,
        rtl:true,
        loop: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: ['<i class="las la-angle-right"></i>', '<i class="las la-angle-left"></i>'],
        margin: 0,
        smartSpeed: 1300,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: false,
        responsiveClass: true,
    });

    $(".hero-slider-four").owlCarousel({
        items: 1,
        nav: true,
        dots: false,
        loop: true,
        rtl:true,
        navText: ['<i class="las la-angle-right"></i>', '<i class="las la-angle-left"></i>'],
        margin: 0,
        autoHeight:true,
        smartSpeed: 1300,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: false,
        responsiveClass: true,
    });

    $(".hero-slider-five").owlCarousel({
        items: 1,
        nav: false,
        dots: true,
        loop: true,
        rtl:true,
        margin: 0,
        autoHeight:true,
        smartSpeed: 1300,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: false,
        responsiveClass: true,
    });
    
    $(".hero-slider-v2").owlCarousel({
        items: 1,
        nav: true,
        dot: true,
        loop: true,
        rtl:true,
        margin: 0,
        smartSpeed: 1500,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        autoHeight: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                autoHeight: true

            },
            768: {
                items:1
            }
        }
    });

    $(".hero-slider-v3").owlCarousel({
        items: 1,
        nav: true,
        dot: false,
        loop: true,
        rtl:true,
        navText: ['<i class="las la-angle-right"></i>', '<i class="las la-angle-left"></i>'],
        margin: 0,
        smartSpeed: 1500,
        autoHeight: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true
    });

    /*---------------------------------
            Product Slider 1
    ---------------------------------*/
    $(".product-slider").owlCarousel({
        items: 1,
        nav: false,
        dot: true,
        loop: true,
        rtl:true,
        autoHeight: true,
        navText: ['<i class="las la-angle-right"></i>', '<i class="las la-angle-left"></i>'],
        margin: 0,
        smartSpeed: 1500,
        autoHeight: true
    });

    /*---------------------------------
            Product Slider 1
    ---------------------------------*/
    $(".partner-slider").owlCarousel({
        nav: false,
        dots: false,
        loop: true,
        margin: 25,
        rtl:true,
        items: 1,
        thumbs: false,
        smartSpeed: 1300,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: false,
        responsiveClass: true,
        autoHeight: true,
        responsive: {
            0: {
                items: 3,
            },
            768: {
                items: 4,
            },
            992: {
                items: 5,
            },
            1200: {
                items: 6,
            }
        }
    });

    /*---------------------------------
            Team Slider 
    ---------------------------------*/
    $(".member-slider").owlCarousel({
        items: 1,
        nav: false,
        dot: true,
        loop: true,
        rtl:true,
        margin: 20,
        smartSpeed: 1500,
        autoHeight: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items:1
            },
            768: {
                items:2
            },
            992: {
                items:3
            },
            1200: {
                items:4
            }

        }
    });

    $(".member-slider-two").owlCarousel({
        items: 1,
        nav: false,
        dot: true,
        loop: true,
        rtl:true,
        margin: 20,
        smartSpeed: 1500,
        autoHeight: true,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items:1
            },
            768: {
                items:2
            },
            992: {
                items:2
            },
            1200: {
                items:3
            }

        }
    });

    /*---------------------------------
            Tesimonial Slider 
    ---------------------------------*/
    $(".testimonial-slider-v1").owlCarousel({
        items: 1,
        nav: false,
        dot: true,
        loop: true,
        rtl:true,
        margin: 10,
        smartSpeed: 1500,
        responsiveClass: true,
        responsive: {
            0: {
                autoHeight: true

            },
            768: {
                items:1
            }
        }
    });
      
    /*---------------------------------
            Tesimonial Slider 2
    ---------------------------------*/
    $(".testimonial-slider-v2").owlCarousel({
        items: 1,
        nav: false,
        dot: true,
        rtl:true,
        loop: true,
        margin: 0,
        smartSpeed: 1500,
    });

    /*---------------------------------
            Tesimonial Slider 3
    ---------------------------------*/
    $(".testimonial-slider-v3").owlCarousel({
        items: 1,
        nav: true,
        dot: false,
        rtl:true,
        animateOut: 'fadeOut',
        navText: ['<i class="las la-long-arrow-alt-right"></i>', '<i class="las la-long-arrow-alt-left"></i>'],
        loop: true,
        margin: 0,
        smartSpeed: 3500,
    });

     /*---------------------------------
            Tesimonial Slider 4
    ---------------------------------*/
    var swiper = new Swiper(".testimonial-slider-thumbs", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            0: {
                slidesPerView: 2,

            },
            768: {
                slidesPerView: 3,

            },
            1200: {
                slidesPerView: 4,

            },
        }
    });
    var swiper2 = new Swiper(".testimonial-slider-four", {
        spaceBetween: 10,
        slidesPerView: 1,
        centeredSlides: true,
        loop: true,
        navigation: {
          nextEl: ".testimonial-four-next",
          prevEl: ".testimonial-four-prev",
        },
        thumbs: {
          swiper: swiper,
        },
    });

    var swiper3 = new Swiper(".testimonial-slider-six", {
        spaceBetween: 10,
        slidesPerView: 1,
        loop: true,
        speed: 1500,
        fadeEffect: { crossFade: true },
        effect: "fade",
        pagination: {
            el: ".testimonial-pagination",
            clickable: true,
        },
    });
    /*---------------------------------
               About image 3
    ---------------------------------*/
    $(".about-img-slider").owlCarousel({
        items: 1,
        dot: false,
        nav: true,
        rtl:true,
        loop: true,
        navText: ['<span>Prev</span>', '<span>Next</span>'],
        margin: 0,
        smartSpeed: 1500,
    });
    /*---------------------------------
               Promo Slider 
    ---------------------------------*/
    $(".promo-slider-v1").owlCarousel({
        dot: false,
        nav: true,
        loop: true,
        rtl:true,
        navText: ['<i class="las la-angle-right"></i>', '<i class="las la-angle-left"></i>'],
        margin: 0,
        smartSpeed: 1500,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                margin: 8

            },
            768: {
                items: 2,

            },
            992: {
                items: 2,

            },
            1200: {
                items: 4,

            }
        }
    });

    /*---------------------------------
               Product Slider 1
    ---------------------------------*/
    $(".product-slider-v1").owlCarousel({
        dot: false,
        nav: true,
        rtl:true,
        loop: true,
        navText: ['<i class="las la-long-arrow-alt-right"></i>', '<i class="las la-long-arrow-alt-left"></i>'],
        margin: 30,
        smartSpeed: 1500,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                margin: 10

            },
            768: {
                items: 2,

            },
            992: {
                items: 2,

            },
            1200: {
                items: 3,

            }
        }
    });

    /*---------------------------------
        Single  Product Slider 
    ---------------------------------*/
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 30,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        breakpoints: {
            0: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 3,
            },
        }
    });

    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs
        },
    });

    let productCarouselTopWidth = $('.gallery-top').outerWidth();
    $('.gallery-top').css('height', productCarouselTopWidth);

    // gallery-thumbs
    let productCarouselThumbsItemWith = $('.gallery-thumbs .swiper-slide').outerWidth();
    $('.gallery-thumbs').css('height', productCarouselThumbsItemWith);

    /* ----------------------------------------
          Class Filter Item Slider
     ------------------------------------------*/
    $('.class-filter').on( 'click', 'a', function() {
        var filter = $(this).attr('data-filter');
        
        $('.class-item-slider .swiper-slide').css('display', 'none')
        $('.class-item-slider .swiper-slide' + filter).css('display', '')
        $( '.class-filter a' ).removeClass( 'filter-active' );
        $( this ).addClass( 'filter-active' );
        productSwiper.updateSize();
        productSwiper.updateSlides();
        productSwiper.updateProgress();
        productSwiper.updateSlidesClasses();
        productSwiper.slideTo(0);
        productSwiper.scrollbar.updateSize();
        return false;
    });
    var productSwiper = new Swiper ('.class-item-slider', {
        observer: true,
        spaceBetween: 20,
        runCallbacksOnInit: true,
        observer: true,
        smartSpeed:5000,
        breakpoints: {
            480: {
            slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
            slidesPerView: 2,
            },
            1200: {
            slidesPerView: 3,
            }
        },
        spaceBetween: 30,
        navigation: {
            nextEl: '.class-filter-next',
            prevEl: '.class-filter-prev',
        },
        scrollbarHide:false,
        updateOnImagesReady: true
        })
        
    /* ----------------------------------------
           Gallery Slider js
     ------------------------------------------*/
    var swiper = new Swiper(".gallery-slider", {
        spaceBetween: 30,
        loop:false,
        navigation: {
            nextEl: '.gallery-filter-next',
            prevEl: '.gallery-filter-prev',
        },
        // And if we need scrollbar
        scrollbar: {
            el: '.gallery-scrollbar',
            draggable : true,
            snapOnRelease : true,
        },
        breakpoints: {
            0: {
            slidesPerView: 1,
            },
            768: {
            slidesPerView: 2,
            },
            992: {
            slidesPerView: 3,
            }
        },
    });
    /* ----------------------------------------
           Course Slider js
     ------------------------------------------*/
     var swiper = new Swiper(".course-slider-one", {
        slidesPerView: "auto",
        loop:true,
        spaceBetween: 22,
        navigation: {
            nextEl: '.course-next',
            prevEl: '.course-prev',
        },
        breakpoints: {
            0: {
                slidesPerView: 1.5,
            },
            768: {
                slidesPerView: 2,
            },
            1200: {
                slidesPerView: 4,
            },
            1400: {
                slidesPerView: 4,
            }
        },
      });
     /* ----------------------------------------
           Brand Slider js
     ------------------------------------------*/
	var brand_slider = new Swiper(".brand-slider", {
		loop: false,
		speed: 15000,
		freemode: false,
		spaceBetween: 45,
		simulateTouch: false,
		autoplay: {
			delay: 1,
			disableOnInteraction: false
		},
        breakpoints:{
            0: {
                slidesPerView: 2.5
            },
            576: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 4
            },
            992: {
                slidesPerView: 5
            },
            1200: {
                slidesPerView: 6.2
            },
            1400: {
                slidesPerView: 7
            }
        }
	});
    /* ----------------------------------------
           Counter js
     ------------------------------------------*/
    $(".odometer").appear(function (e) {
        var odo = $(".odometer");
        odo.each(function () {
            var countNumber = $(this).attr("data-count");
            $(this).html(countNumber);
        });
    });

    /*-------------------------------------
         nice Selcet
    ----------------------------------*/
    $('select').niceSelect();

    /*-------------------------------------
        Isotope Filter
    ----------------------------------*/
    try {
        var mixer = mixitup('.grid', {
            controls: {
                toggleDefault: 'none'
            }
        });
    } catch (err) {}

    // filter items on button click
    $('.filter-button-group').on('click', 'li', function() {
        var filterValue = $(this).attr('data-filter');
        $('.grid').isotope({ filter: filterValue });
        $('.filter-button-group li').removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------------------------
         Scroll to top
    ----------------------------------*/
    // Show or hide the  button
    $(window).on('scroll', function(event) {
        if ($(this).scrollTop() > 600) {
            $('.back-to-top').fadeIn(200)
        } else {
            $('.back-to-top').fadeOut(200)
        }
    });

    //Animate the scroll to top
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: 0,
        }, 0);
    });

})(jQuery);

// function to set a given theme/color-scheme
function setTheme(themeName) {
    localStorage.setItem('fiyn_theme', themeName);
    document.documentElement.className = themeName;
}

// function to toggle between light and dark theme
function toggleTheme() {
    if (localStorage.getItem('fiyn_theme') === 'theme-dark') {
        setTheme('theme-light');
    } else {
        setTheme('theme-dark');
    }
}

// Immediately invoked function to set the theme on initial load
(function () {
    if (localStorage.getItem('fiyn_theme') === 'theme-dark') {
        setTheme('theme-dark');
        document.getElementById('slider').checked = false;
    } else {
        setTheme('theme-light');
        document.getElementById('slider').checked = true;
    }
})();