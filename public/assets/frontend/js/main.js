;
(function($) {
    "use strict";

    $(document).ready(function() {
        $(document).on('click','.selected-language',function (e){
            e.preventDefault();
            $(this).next('ul').toggleClass('show');
 
         });
         var rtlEnable = $('html').attr('dir');
         var sliderRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr') ;
         var OwlRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr') ;
        // Tab Active
        document.addEventListener("DOMContentLoaded", function(event) {

            var iconTabs = document.getElementsByClassName('icon-tab'),
                iconTabActive;

            for (var i = 0; i < iconTabs.length; i++) {
                (function(iCopy) {
                    iconTabs[i].addEventListener('click', function() {
                        if (iconTabActive) { classie.toggle(iconTabActive, 'active'); }
                        classie.toggle(this, 'active');
                        iconTabActive = this;
                    });
                    setTimeout(function() {
                        iconTabs[iCopy].trigger('click');
                    }, iCopy * 350);
                }(i));
            }
        });

        /*-------------------------------
            Navbar Fix
          ------------------------------*/
        if ($(window).width() < 991) {
            navbarFix()
        }


        /*--------------------
            wow js init
        ---------------------*/
        new WOW().init();

        /*-------------------------
            magnific popup activation
        -------------------------*/
        $('.video-play-btn,.video-popup,.small-vide-play-btn').magnificPopup({
            type: 'video'
        });

        /*------------------
            back to top
        ------------------*/
        $(document).on('click', '.back-to-top', function() {
            $("html,body").animate({
                scrollTop: 0
            }, 2000);
        });
        /*------------------------------
            counter section activation
        -------------------------------*/
        var counternumber = $('.count-num');
        counternumber.counterUp({
            delay: 20,
            time: 1000
        });
        /*------------------------------
            donate activation
        -------------------------------*/
        var donate_link = '';
        $(document).on('change input', '.donation_wrapper > .amount_wrapper > input', function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
            $(this).parent().parent().find('> a').attr('href', donate_link.replace('{amount}', parseFloat($(this).val()).toFixed(2)));
        });
        $(document).on('click', '.donation_wrapper > .single_amount_wrapper > .single_amount', function() {
            $('.donation_wrapper > .amount_wrapper > input').val(parseFloat($(this).attr('data-value')).toFixed(2)).trigger('change');
        });

        /*---------------------------
            Testimonial carousel
        ---------------------------*/
        var $TestimonialCarousel = $('.testimonial-carousel');
        if ($TestimonialCarousel.length > 0) {
            $TestimonialCarousel.owlCarousel({
                rtl:OwlRtlValue,
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: false,
                navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    460: {
                        items: 1
                    },
                    599: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    992: {
                        items: 2
                    },
                    1200: {
                        items: 2
                    },
                    1920: {
                        items: 2
                    }
                }
            });
        }
        /*---------------------------
            Testimonial carousel
        ---------------------------*/
        var $TestimonialCarousel = $('.testimonial-carousel-02');
        if ($TestimonialCarousel.length > 0) {
            $TestimonialCarousel.owlCarousel({
                rtl:OwlRtlValue,
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: false,
                navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    460: {
                        items: 1
                    },
                    599: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    960: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1920: {
                        items: 1
                    }
                }
            });
        }
        /*---------------------------
            BLog Grid carousel
        ---------------------------*/
        var $TestimonialCarousel = $('.blog-grid-carousel');
        if ($TestimonialCarousel.length > 0) {
            $TestimonialCarousel.owlCarousel({
                rtl:OwlRtlValue,
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1
                    },
                    460: {
                        items: 1
                    },
                    599: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    960: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    },
                    1920: {
                        items: 3
                    }
                }
            });
        }
        /*---------------------------
            header carousel
        ---------------------------*/
        var $headerCarousel = $('.header-slider-one');
        if ($headerCarousel.length > 0) {
            $headerCarousel.owlCarousel({
                rtl: sliderRtlValue,
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                    },
                    460: {
                        items: 1,
                        nav: false,
                    },
                    599: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    960: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1920: {
                        items: 1
                    }
                }
            });
        }

        /*----------------------
            Search Popup
        -----------------------*/
        var bodyOvrelay = $('#body-overlay');
        var searchPopup = $('#search-popup');

        $(document).on('click', '#body-overlay', function(e) {
            e.preventDefault();
            bodyOvrelay.removeClass('active');
            searchPopup.removeClass('active');
        });
        $(document).on('click', '.border-none', function(e) {
            e.preventDefault();
            bodyOvrelay.removeClass('active');
            searchPopup.removeClass('active');
        });
        $(document).on('click', '#search', function(e) {
            e.preventDefault();
            searchPopup.addClass('active');
            bodyOvrelay.addClass('active');
        });


    });


    //define variable for store last scrolltop
    var lastScrollTop = '';

    $(window).on('scroll', function() {

        //back to top show/hide
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }

        // Sticky-Memu
        if ($(window).width() > 991) {
            StickyMenu();
        }



    });


    $(window).on('resize', function() {
        /*-------------------------------
            Navbar Fix
        ------------------------------*/
        if ($(window).width() < 991) {
            navbarFix()
        }
    });


    $(window).on('load', function() {

        /*-----------------
            preloader
        ------------------*/
        var preLoder = $("#preloader");
        preLoder.fadeOut(1000);

        /*-----------------
            back to top
        ------------------*/
        var backtoTop = $('.back-to-top')
        backtoTop.fadeOut();

    });

    function navbarFix() {
        $(document).on('click', '.navbar-area .navbar-nav li.menu-item-has-children>a, .navbar-area .navbar-nav li.appside-megamenu>a', function(e) {
            e.preventDefault();
        })
    }

    function StickyMenu() {
        /*--------------------------
                 sticky menu activation
        ---------------------------*/
        var st = $(this).scrollTop();
        var mainMenuTop = $('.navbar-area');
        if ($(window).scrollTop() > 1000) {
            mainMenuTop.addClass('nav-fixed');
        } else {
            mainMenuTop.removeClass('nav-fixed ');
        }
        lastScrollTop = st;
    }


})(jQuery);