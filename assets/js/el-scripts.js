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

    // WOW Animation
    function wowAnimation() {
        var wowAnimation = new WOW({
            mobile: false,
            live: false
        });
        wowAnimation.init();
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
        elementorFrontend.hooks.addAction("frontend/element_ready/edumentor-heading.default", function ($scope) {
            Splitting();
            const wow = new WOW({
                mobile: false
            });
            wow.init();
        });

        // Animated Text
        elementorFrontend.hooks.addAction("frontend/element_ready/edumentor-animated-text.default", function ($scope) {
            
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
				EduMentorAnimatedText({
					selector: item,
					animationDelay: delay,
					revealDuration: clipDuration,
					revealAnimationDelay: clipDelay
				});
			}else if( 'letters type' === type ) {
				EduMentorAnimatedText({
					selector: item,
					animationDelay: delay,
					typeLettersDelay: typeLetterDelay,
					selectionDuration: selectionDuration,
					typeAnimationDelay: typeAnimDelay,
				});
			}else if( 'loading-bar' === type ) {
				EduMentorAnimatedText({
					selector: item,
					animationDelay: delay,
					barAnimationDelay: barAnimDelay,
					barWaiting: barWaiting
				});
			}else{
				EduMentorAnimatedText({
					selector: item,
					animationDelay: delay,
				});
			}
        });

        // Load WOW Animation
        elementorFrontend.hooks.addAction("frontend/element_ready/widget", function ($scope) {
            if ($scope.hasClass("edumentor-wow")) {
                wowAnimation();
            }
        });

        // Counter
        elementorFrontend.hooks.addAction("frontend/element_ready/edumentor-counter.default", function (scope, $) {
            var counter_elem = $(scope).find(".hq-counter").eq(0),
                $target = counter_elem.data("target");

            var observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $($target).each(function () {
                            var v = $(this).data("to"),
                                speed = $(this).data("speed"),
                                od = new Odometer({
                                    el: this,
                                    value: 0,
                                    duration: speed
                                });
                            od.render();
                            setTimeout(function () {
                                od.update(v);
                            }, 100);
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.8 });

            observer.observe(counter_elem[0]);
        });

        // Countdown
        elementorFrontend.hooks.addAction( 'frontend/element_ready/edumentor-countdown.default', function (scope, $) {
            const $widget = $(scope);
            const $countdown = $widget.find('.hq-countdown');

            if (!$countdown.length) return; // Exit early if countdown not found

            const $items = $countdown.find('.hq-countdown-item');
            const $endActionContainer = $countdown.find('.hq-countdown-end-action');

            const endAction = $countdown.data('end-action');
            const redirectUrl = $countdown.data('redirect-link');
            const isEditor = elementorFrontend.isEditMode(); // safer check

            // Initialize countdown only if plugin exists
            if (typeof $.fn.countdown !== 'function') return;

            $countdown.countdown({
                end: function () {
                    switch (endAction) {
                    case 'message':
                    case 'img':
                        $items.hide();
                        $endActionContainer.show();
                        break;

                    case 'url':
                        if (redirectUrl && !isEditor) {
                            window.location.replace(redirectUrl);
                        }
                        break;

                    default:
                        console.warn('Unknown end-action type:', endAction);
                    }
                },
            });
        });

        // Image
        elementorFrontend.hooks.addAction("frontend/element_ready/edumentor-image.default", function ($scope) {
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
        elementorFrontend.hooks.addAction("frontend/element_ready/edumentor-progress-bar.default", function ($scope) {
            elementorFrontend.waypoint($scope, function () {
                $scope.find('.hq-skill-level').each(function () {
                    var $current = $(this),
                        $lt = $current.find('.hq-skill-level-text'),
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