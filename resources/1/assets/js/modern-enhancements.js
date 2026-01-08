/**
 * Modern Enhancements JavaScript for Demo Module
 * Handles animated counters, FAQ accordion, and scroll animations
 */

(function($) {
    'use strict';

    // === ANIMATED COUNTER ===
    function animateCounter() {
        $('.stat-number').each(function() {
            var $this = $(this);
            var target = parseInt($this.data('target'));
            var suffix = $this.data('suffix') || '';

            if (!$this.hasClass('counted')) {
                $this.addClass('counted');

                $({ count: 0 }).animate({ count: target }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.count) + suffix);
                    },
                    complete: function() {
                        $this.text(target + suffix);
                    }
                });
            }
        });
    }

    // === FAQ ACCORDION ===
    window.toggleFaq = function(element) {
        var $question = $(element);
        var $answer = $question.next('.faq-answer');

        // Close all other FAQs
        $('.faq-question').not($question).removeClass('active');
        $('.faq-answer').not($answer).removeClass('active');

        // Toggle current FAQ
        $question.toggleClass('active');
        $answer.toggleClass('active');
    };

    // === SCROLL ANIMATIONS ===
    function initScrollAnimations() {
        // Intersection Observer for animations
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-on-scroll');

                        // Trigger counter animation when stats section is visible
                        if (entry.target.classList.contains('stats-section')) {
                            animateCounter();
                        }
                    }
                });
            }, {
                threshold: 0.1
            });

            // Observe sections
            var sections = document.querySelectorAll('.stats-section, .testimonials-section, .faq-section, .trust-badges-section');
            sections.forEach(function(section) {
                observer.observe(section);
            });
        } else {
            // Fallback for older browsers
            animateCounter();
        }
    }

    // === TESTIMONIAL CAROUSEL ===
    function initTestimonialCarousel() {
        if ($('.testimonials-carousel').length) {
            $('.testimonials-carousel').owlCarousel({
                items: 2,
                margin: 30,
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                nav: true,
                dots: true,
                rtl: $('body').hasClass('rtl') || $('html').attr('dir') === 'rtl',
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    }
                }
            });
        }
    }

    // === SMOOTH SCROLL TO SECTIONS ===
    function initSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
            }
        });
    }

    // === LAZY LOAD YOUTUBE VIDEOS ===
    function initYoutubeLazyLoad() {
        $('.testimonial-video-wrapper iframe[data-src]').each(function() {
            var $iframe = $(this);
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var src = $iframe.data('src');
                        if (src) {
                            $iframe.attr('src', src);
                            $iframe.removeAttr('data-src');
                        }
                        observer.disconnect();
                    }
                });
            });

            observer.observe($iframe[0]);
        });
    }

    // === INITIALIZE ON DOCUMENT READY ===
    $(document).ready(function() {
        initScrollAnimations();
        initTestimonialCarousel();
        initSmoothScroll();

        // Initialize lazy loading if supported
        if ('IntersectionObserver' in window) {
            initYoutubeLazyLoad();
        }

        // Trigger animations for elements already in viewport
        setTimeout(function() {
            $(window).trigger('scroll');
        }, 100);
    });

})(jQuery);
