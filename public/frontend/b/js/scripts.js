(function($) {
    "use strict";
     // responsive-menu tigger
    $(".responsive-menu-tigger").on('click', function() {
        $(".responsive-menu-area").toggleClass("active");
    });


        // toggle
    $('#toggle2').on('click', function() {
        $('#open2').slideToggle();
    })

    $('ul.metismenu').metisMenu();

    // click
    function DropDown(el) {
        this.dd = el;
        this.placeholder = this.dd.children('span');
        this.opts = this.dd.find('ul.dropdown > li');
        this.val = '';
        this.index = -1;
        this.initEvents();
    }
    DropDown.prototype = {
        initEvents: function() {
            var obj = this;

            obj.dd.on('click', function(event) {
                $(this).toggleClass('active');
                return false;
            });

            obj.opts.on('click', function() {
                var opt = $(this);
                obj.val = opt.text();
                obj.index = opt.index();
                obj.placeholder.text(obj.val);
            });
        },
        getValue: function() {
            return this.val;
        },
        getIndex: function() {
            return this.index;
        }
    }

    $(function() {

        var dd = new DropDown($('.select-menu'));

        $(document).on('click', function() {
            // all dropdowns
            $('.select-menu').removeClass('active');
        });

    });


    // slider-active
    $('.slider-active').owlCarousel({
        margin: 0,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        nav: true,
        smartSpeed: 800,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            450: {
                items: 1,
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // slider-active
    $(".slider-active").on('translate.owl.carousel', function() {
        $('.slider-item h2').removeClass('fadeInUp animated').hide();
        $('.slider-item h3').removeClass('fadeInUp animated').hide();
        $('.slider-item p').removeClass('slideInUp animated').hide();
        $('.slider-item ul').removeClass('fadeInUp animated').hide();
    });

    $(".slider-active").on('translated.owl.carousel', function() {
        $('.owl-item.active .slider-item h2').addClass('fadeInUp animated').show();
        $('.owl-item.active .slider-item h3').addClass('fadeInUp animated').show();
        $('.owl-item.active .slider-item p').addClass('slideInUp animated').show();
        $('.owl-item.active .slider-item ul').addClass('fadeInUp animated').show();
    });

    //slider-area background setting
    function sliderBgSetting() {
        if ($(".slider-active .slider-item").length) {
            $(".slider-active .slider-item").each(function() {
                var $this = $(this);
                var img = $this.find(".slider").attr("src");

                $this.css({
                    backgroundImage: "url(" + img + ")",
                    backgroundSize: "cover",
                    backgroundPosition: "center center"
                })
            });
        }
    }
    sliderBgSetting()
    /*==========================================================================
        WHEN DOCUMENT LOADING
    ==========================================================================*/


    // // stickey menu
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop(),
            mainHeader = $('#sticky-header'),
            mainHeaderHeight = mainHeader.innerHeight();

        // console.log(mainHeader.innerHeight());
        if (scroll > 265) {
            $("#sticky-header").addClass("sticky-menu");
        } else {
            $("#sticky-header").removeClass("sticky-menu");
        }
    });

    // slidebar-product-active
    $('.propuler-product-active').owlCarousel({
        margin: 0,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3500,
        nav: true,
        smartSpeed: 1000,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            450: {
                items: 1,
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });


    // product-active
    $('.product-active').owlCarousel({
        margin: 15,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        nav: true,
        smartSpeed: 800,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            450: {
                items: 2,
            },
            768: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });

    // team-active
    $('.team-active').owlCarousel({
        margin: 15,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        nav: true,
        smartSpeed: 800,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            450: {
                items: 2,
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });


    // slidebar-product-active
    $('.test-active').owlCarousel({
        margin: 15,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        nav: true,
        smartSpeed: 800,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            450: {
                items: 1,
            },
            768: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    });


    // slidebar-product-active
    $('.blog-active').owlCarousel({
        margin: 15,
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        nav: true,
        smartSpeed: 800,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            450: {
                items: 2,
            },
            768: {
                items: 2
            },
            900: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });
    // slidebar-product-active
    $('.brand-active').owlCarousel({
        margin: 15,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        nav: false,
        smartSpeed: 1000,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 2,
            },
            450: {
                items: 3,
            },
            768: {
                items: 4
            },
            1000: {
                items: 6
            }
        }
    });

// Single gallery slider
    function productGallary() {
        if ($('.product-single-active').length && $('.product-thumbnil-active').length) {

            var $sync1 = $(".product-single-active"),
                $sync2 = $(".product-thumbnil-active"),
                flag = false,
                duration = 500;

            $sync1
                .owlCarousel({
                    items: 1,
                    margin: 0,
                    nav: false,
                    dots: false
                })
                .on('changed.owl.carousel', function(e) {
                    if (!flag) {
                        flag = true;
                        $sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
                        flag = false;
                    }
                });

            $sync2
                .owlCarousel({
                    margin: 10,
                    items: 5,
                    nav: true,
                    dots: false,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    center: false,
                    responsive: {
                        0: {
                            items: 2,
                            autoWidth: false
                        },
                        400: {
                            items: 2,
                            autoWidth: false
                        },
                        500: {
                            items: 3,
                            center: false,
                            autoWidth: false
                        },
                        600: {
                            items: 3,
                            autoWidth: false
                        },
                        1200: {
                            items: 3,
                            autoWidth: false
                        }
                    },
                })
                .on('click', '.owl-item', function() {
                    $sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);

                })
                .on('changed.owl.carousel', function(e) {
                    if (!flag) {
                        flag = true;
                        $sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
                        flag = false;
                    }
                });

        };
    }

    productGallary();

    /*--------------------------
     scrollUp
    ---------------------------- */
    $.scrollUp({
        scrollText: '<i class="fa fa-arrow-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });


    // smttoh-scroll
    function scrollSpeed() {
        $.scrollSpeed(200, 800);
    };


    /*----------------------------
     price-slider active
    ------------------------------ */
    $("#slider-range").slider({
        range: true,
        min: 12,
        max: 200,
        values: [0, 100],
        slide: function(event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });


    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
        " - $" + $("#slider-range").slider("values", 1));
    /*-- price range End --*/

    /*==================================
            LOAD MORE JQUERY
    ================================== */
    var list1 = $(".moreload");
    var numToShow1 = 4;
    var button1 = $(".loadmore-btn");
    var numInList1 = list1.length;

    list1.hide();
    if (numInList1 > numToShow1) {
        button1.show();
    }
    list1.slice(0, numToShow1).show();
    button1.on('click', function() {
        var showing1 = list1.filter(':visible').length;
        list1.slice(showing1 - 1, showing1 + numToShow1).fadeIn();
        var nowShowing1 = list1.filter(':visible').length;
        if (nowShowing1 >= numInList1) {
            button1.hide();
        }
    });



    /*-----------------------
       cart-plus-minus-button 
     -------------------------*/
    $(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });
    /*====================================================
                    load-function
    ====================================================*/

    $(window).on('load', function() {
        /*-- preloader ---*/
        $('.preloader-wrap').fadeOut();
        /*-- Two Col EqHeight---*/
        /*-- Scroll Speed---*/
        scrollSpeed();

        $('#popup-subscribe').modal('show');
    });



    $(window).on("scroll", function() {
        /*-- preloader ---*/
        $('.preloader-wrap').fadeOut();
    });



    /*---------------------
     countdown
    --------------------- */
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Sec</p></span>'));
        });
    });
    

    /*-----------------------------
    14. Ajax MailChip
    ------------------------------- */
    $('#mc-form').ajaxChimp({
        url: 'http://www.wpocean.us13.list-manage.com/subscribe/post?u=e9d729be03847d1a66b143bd2&amp;id=21ac2a3302', //Set Your Mailchamp URL
        callback: function(resp) {
            if (resp.result === 'success') {
                $('.sform input, .sform .subscribe-btn').fadeOut();
            }
        }
    });

    /*---------------------
    // Ajax Contact Form
    --------------------- */

    $('.cf-msg').hide();
    $('form#cf button#submit').on('click', function() {
        var fname = $('#fname').val();
        var subject = $('#subject').val();
        var email = $('#email').val();
        var msg = $('#msg').val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!regex.test(email)) {
            alert('Please enter valid email');
            return false;
        }

        fname = $.trim(fname);
        subject = $.trim(subject);
        email = $.trim(email);
        msg = $.trim(msg);

        if (fname != '' && email != '' && msg != '') {
            var values = "fname=" + fname + "&subject=" + subject + "&email=" + email + " &msg=" + msg;
            $.ajax({
                type: "POST",
                url: "mail.php",
                data: values,
                success: function() {
                    $('#fname').val('');
                    $('#subject').val('');
                    $('#email').val('');
                    $('#msg').val('');

                    $('.cf-msg').fadeIn().html('<div class="alert alert-success"><strong>Success!</strong> Email has been sent successfully.</div>');
                    setTimeout(function() {
                        $('.cf-msg').fadeOut('slow');
                    }, 4000);
                }
            });
        } else {
            $('.cf-msg').fadeIn().html('<div class="alert alert-danger"><strong>Warning!</strong> Please fillup the informations correctly.</div>')
        }
        return false;
    });

})(jQuery);