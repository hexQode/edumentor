(function ($) {
    "use strict";

    var $window = $(window);

    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this,
                args = arguments;

            var later = function later() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };

            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    function initParallax() {
        var parallaxInstances = $('[data-parallax]');
        var html = $('html');

        if (parallaxInstances.length && !html.hasClass('touchevents') && typeof ParallaxScroll === 'object') {
            ParallaxScroll.init();
        }
    }

    $window.on('elementor/frontend/init', function () {

        var ModuleHandler = elementorModules.frontend.handlers.Base;
        var CarouselBase = ModuleHandler.extend({
            bindEvents: function bindEvents() {
                this.run();
            },
            getDefaultSettings: function getDefaultSettings() {
                return {
                    slidesToShow: 6,
                    slidesToScroll: 2,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    infinite: true,
                    arrows: false,
                    dots: true,
                    customPaging : function(slider, i) {
                        return '<span data-index="' + i + '"></span>';
                    },
                    rows: 0,
                    initialSlide: 0,
                    appendArrows: this.findElement('.hq-carousel-nav'),
                    appendDots: this.findElement('.hq-carousel-dots'),
                    prevArrow: $('<div />').append(this.findElement('.slick-prev').clone().show()).html(),
                    nextArrow: $('<div />').append(this.findElement('.slick-next').clone().show()).html()
                };
            },
            getDefaultElements: function getDefaultElements() {
                return {
                    $container: this.findElement('.hq-carousel'),
                    $carousel: !!this.getElementSettings('carousel')
                };
            },
            onElementChange: debounce(function () {
                this.elements.$container.slick('unslick');
                this.run();
            }, 200),
            getSlickSettings: function getSlickSettings() {
                var settings = {
                    slidesToShow: parseInt(this.getElementSettings('slides_per_show')) || 1,
                    slidesToScroll: parseInt(this.getElementSettings('slides_per_scroll')),
                    infinite: !!this.getElementSettings('infinite_loop'),
                    speed: parseInt(this.getElementSettings('anim_speed')) || 500
                };

                settings.autoplay = !!this.getElementSettings('autoplay');

                if ( 'yes' == this.getElementSettings('autoplay') ) {
                    settings.autoplaySpeed = parseInt(this.getElementSettings('autoplay_speed')) || 5000;
                    settings.pauseOnHover = !!this.getElementSettings('pause_on_hover');
                }

                if ( 'yes' == this.getElementSettings('center_mode') ) {
                    settings.centerMode = !!this.getElementSettings('center_mode');
                    settings.centerPadding = parseInt(this.getElementSettings('center_padding')) || 0 + 'px';
                }

                switch (this.getElementSettings('navigation')) {
                    case 'arrow':
                        settings.arrows = true;
                        break;

                    case 'dots':
                        settings.dots = true;
                        break;

                    case 'both':
                        settings.arrows = true;
                        settings.dots = true;
                        break;
                }

                if( 'dots' == this.getElementSettings('navigation') || 'both' == this.getElementSettings('navigation') ) {
                    if( '1' == this.getElementSettings('dots_style') ) {
                        settings.customPaging = function(slider, i) {
                            return '<span data-index="' + i + '"></span>';
                        }
                    }else{
                        settings.customPaging = function(slider, i) {
                            return '<span data-index="' + i + '">' + '<svg class="hq-circle-loader" width="20" height="20" viewBox="0 0 20 20">' +
                            '<circle class="path" cx="10" cy="10" r="5.5" fill="none" transform="rotate(-90 10 10)"' +
                            'stroke-opacity="1" stroke-width="2px"></circle>' +
                            '<circle class="solid-fill" cx="10" cy="10" r="3"></circle>' +
                            '</svg></span>';
                        }
                    }
                }

                settings.responsive = [{
                    breakpoint: elementorFrontend.config.breakpoints.lg,
                    settings: {
                        slidesToShow: parseInt(this.getElementSettings('slides_per_show_tablet')) || 1,
                        slidesToScroll: parseInt(this.getElementSettings('slides_per_scroll_tablet')) || 1,
                        centerPadding: parseInt(this.getElementSettings('center_padding_tablet')) || 0 + 'px',
                    }
                }, {
                    breakpoint: elementorFrontend.config.breakpoints.md,
                    settings: {
                        slidesToShow: parseInt(this.getElementSettings('slides_per_show_mobile')) || parseInt(this.getElementSettings('slides_per_show_tablet')) || 1,
                        slidesToScroll: parseInt(this.getElementSettings('slides_per_scroll_mobile')) || parseInt(this.getElementSettings('slides_per_scroll_tablet')) || 1,
                        centerPadding: parseInt(this.getElementSettings('center_padding_mobile')) || 0 + 'px',
                    }
                }];

                return $.extend({}, this.getSettings(), settings);
            },
            run: function run() {
                const preLoader = this.findElement('.carousel-preloader');
                if( this.elements.$carousel ) {
                    this.elements.$container.on('init', function(event, slick){
                        preLoader.fadeOut();
                    });
                    this.elements.$container.slick(this.getSlickSettings());
                }
            }
        });

        // Posts Carousel
        elementorFrontend.hooks.addAction('frontend/element_ready/hq-posts-carousel.default', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(CarouselBase, {
                $element: $scope
            });
        });

        // Category Carousel
        elementorFrontend.hooks.addAction('frontend/element_ready/hq-category-carousel.default', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(CarouselBase, {
                $element: $scope
            });
        });

        // Heading Splitting Effect
        elementorFrontend.hooks.addAction("frontend/element_ready/flatpack-heading.default", function ($scope) {
            Splitting();
            const wow = new WOW({
                mobile: false
            });
            wow.init();
        });

        // Animated Text
        elementorFrontend.hooks.addAction("frontend/element_ready/flatpack-animated-text.default", function ($scope) {
            
            var item = $scope.find('.cd-headline'),
				settings = item.data('settings'),
				type = settings.anim_type,
				delay = settings.delay,
				clipDuration = settings.clip_duration,
				clipDelay = settings.clip_delay,
				typeLetterDelay = settings.type_letter_delay,
				selectionDuration = settings.selection_duration,
				typeAnimDelay = settings.type_anim_delay,
				barAnimDelay = settings.bar_anim_delay,
				barWaiting = settings.bar_waiting;
			if( 'clip' === type ){
				FlatPackAnimatedText({
					selector: item,
					animationDelay: delay,
					revealDuration: clipDuration,
					revealAnimationDelay: clipDelay
				});
			}else if( 'letters type' === type ) {
				FlatPackAnimatedText({
					selector: item,
					animationDelay: delay,
					typeLettersDelay: typeLetterDelay,
					selectionDuration: selectionDuration,
					typeAnimationDelay: typeAnimDelay,
				});
			}else if( 'loading-bar' === type ) {
				FlatPackAnimatedText({
					selector: item,
					animationDelay: delay,
					barAnimationDelay: barAnimDelay,
					barWaiting: barWaiting
				});
			}else{
				FlatPackAnimatedText({
					selector: item,
					animationDelay: delay,
				});
			}

            const wow = new WOW({
                mobile: false
            });
            wow.init();
        });

        // Contact from splitting effect
        elementorFrontend.hooks.addAction("frontend/element_ready/flatpack-contact-form-7.default", function ($scope) {
            Splitting();
            const wow = new WOW({
                mobile: false
            });
            wow.init();
        });

        // Counter
        elementorFrontend.hooks.addAction("frontend/element_ready/flatpack-counter.default", function ($scope) {
            var counter_elem = $scope.find(".el-image").eq(0),
                $target = counter_elem.data("target");
            $(counter_elem).elementorWaypoint(
                function () {
                    $($target).each(function () {
                        var v = $(this).data("to"),
                            speed = $(this).data("speed"),
                            od = new Odometer({
                                el: this,
                                value: 0,
                                duration: speed
                            });
                        od.render();
                        setInterval(function () {
                            od.update(v);
                        });
                    });
                },
                {
                    offset: "80%",
                    triggerOnce: true
                }
            );
        });

        // Countdown
        elementorFrontend.hooks.addAction("frontend/element_ready/flatpack-countdown.default", function (scope, $) {
            var $item = $(scope).find('.fp-countdown');
            var $countdown_item = $item.find('.fp-countdown-item');
            var $end_action = $item.data('end-action');
            var $redirect_link = $item.data('redirect-link');
            var $end_action_div = $item.find('.fp-countdown-end-action');
            var $editor_mode_on = $(scope).hasClass('elementor-element-edit-mode');
            $item.countdown({
                end: function () {
                    if (('message' === $end_action || 'img' === $end_action) && $end_action_div !== undefined) {
                        $countdown_item.css("display", "none");
                        $end_action_div.css("display", "block");
                    } else if ('url' === $end_action && $redirect_link !== undefined && $editor_mode_on !== true) {
                        window.location.replace($redirect_link)
                    }
                }
            });
        });

        // Image
        elementorFrontend.hooks.addAction("frontend/element_ready/flatpack-image.default", function ($scope) {
            var image = $($scope).find(".el-image"),
                anim = image.data('anim');
            if ( image.length && 'parallax' == anim ) {
                var y = Math.floor(Math.random() * (-100 - (-25)) + (-25));
                image.attr(
                    'data-parallax',
                    '{"y": ' + y + ', "smoothness": ' + '30' + '}'
                );
                initParallax();
            }
        });

        // Progress Bar
        elementorFrontend.hooks.addAction("frontend/element_ready/flatpack-progress-bar.default", function ($scope) {
            elementorFrontend.waypoint($scope, function () {
                $scope.find('.fp-skill-level').each(function () {
                    var $current = $(this),
                        $lt = $current.find('.fp-skill-level-text'),
                        lv = $current.data('level');
                    $current.animate({
                        width: lv + '%'
                    }, 500);
                    $lt.numerator({
                        toValue: lv + '%',
                        duration: 1300,
                        onStep: function () {
                            $lt.append('%');
                        }
                    });
                });
            });
        });

    });

})(jQuery);