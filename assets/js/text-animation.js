(function ($) {
    "use strict";

    // Animation Effect
    function textAnimation(){
        let scrollAnim = edumentor_text_opt.scrolling_anim;
        var device_width = window.innerWidth;
        if (device_width < 768) {
            return;
        }
        let elSectionHeadings = gsap.utils.toArray(".el-section-heading");
        elSectionHeadings.forEach( elSection => {
            let textAnimations = gsap.utils.toArray(elSection.getElementsByClassName("hq-text-anim"));
            let borderAnim = gsap.utils.toArray(elSection.getElementsByClassName("hq-border-anim"));
            textAnimations.forEach( (textAnim, i) => {
                let hl = textAnim.getElementsByClassName("hl");
                let target = textAnim;
                let effect = "effect-3d",
                    duration = 1,
                    delay = 0.3,
                    split = "none",
                    ease = "Back.easeOut",
                    trigger= textAnim,
                    stagger = 0.3;
                if (textAnim.getAttribute("data-effect")) {
                    effect = textAnim.getAttribute("data-effect");
                }
                if (textAnim.getAttribute("data-duration")) {
                    duration = textAnim.getAttribute("data-duration");
                }
                if (textAnim.getAttribute("data-delay")) {
                    delay = textAnim.getAttribute("data-delay");
                }
                if (textAnim.getAttribute("data-stagger")) {
                    stagger = textAnim.getAttribute("data-stagger");
                }
                if (textAnim.getAttribute("data-split")) {
                    split = textAnim.getAttribute("data-split");
                }
                if (textAnim.getAttribute("data-ease")) {
                    ease = textAnim.getAttribute("data-ease");
                }
                if (textAnim.getAttribute("data-scroll-trigger")) {
                    trigger = textAnim.getAttribute("data-scroll-trigger");
                }
                if( "none" != split){
                    let itemSplitted = new SplitType( textAnim, { types: 'chars, words, lines' });
                    target = textAnim.getElementsByClassName(split);
                }

                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: trigger,
                        scrub: false,
                        markers: false,
                        toggleActions: scrollAnim,
                        start: "top 90%"
                    }
                });
                
                if( 'effect-3d' === effect ) {
                    gsap.set(textAnim, { perspective: 400 });
                    tl.from(textAnim.getElementsByClassName(split), { duration: duration, delay: delay, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1 });
                }

                if( 'clip-text' === effect ) {
                    gsap.set(textAnim, { overflow: "hidden" });
                    gsap.set(textAnim.getElementsByClassName('line'), { overflow: "hidden" });
                    tl.from(textAnim.getElementsByClassName(split), { duration: duration, delay: delay, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1 });
                }

                if( 'fade-in' === effect ) {
                    if (device_width < 1023) {
                        gsap.set(textAnim, { opacity: 0, y: 60 });
                        tl.to(target, {
                            opacity: 1,
                            y: 0,
                            duration: duration,
                            delay: delay * i,
                            ease: ease
                        });
                    }
                    else {
                        gsap.set(target, { opacity: 0, y: 40 })
                        tl.to(target, {
                            opacity: 1,
                            y: 0,
                            duration: duration,
                            ease: ease,
                            delay: delay * i,
                            stagger: 0.3
                        });
                    }
                }
                if( 'fade-in-left' === effect ) {
                    gsap.set(target, { x: -20, opacity: 0, });
                    tl.to(target, {
                        x: 0,
                        opacity: 1,
                        ease: ease,
                        duration: duration,
                        delay: delay * i,
                        stagger: {
                            each: 0.02,
                        }
                    });
                }

                if( 'fade-in-right' === effect ) {
                    gsap.set(target, { x: 50, opacity: 0, });
                    tl.to(target, {
                        x: 0,
                        opacity: 1,
                        ease: ease,
                        duration: duration,
                        delay: delay * i,
                        stagger: {
                            each: 0.02,
                        }
                    });
                }

                if( 'fade-in-top' === effect ) {
                    gsap.set(target, { y: -20, opacity: 0, });
                    tl.to(target, {
                        y: 0,
                        opacity: 1,
                        ease: ease,
                        duration: duration,
                        delay: delay * i,
                        stagger: {
                            each: 0.02,
                        }
                    });
                }

                if( 'fade-in-bottom' === effect ) {
                    gsap.set(target, { y: 50, opacity: 0, });
                    tl.to(target, {
                        y: 0,
                        opacity: 1,
                        ease: ease,
                        duration: duration,
                        delay: delay * i,
                        stagger: {
                            each: stagger,
                        }
                    });
                }

                if( 'zoom-in' === effect ) {
                    gsap.set(target, { opacity: 0, scale: 0.5 });
                    tl.to(target, {
                        opacity: 1,
                        scale: 1,
                        x: 20,
                        ease: ease,
                        duration: duration,
                        delay: delay * i,
                        stagger: {
                            each: 0.3
                        }
                    });
                }

                if(hl.length){
                    gsap.set(hl, { ["--edumentor-hl-clip"]: "100%", });
                    tl.to(hl, {
                        ["--edumentor-hl-clip"]: "0",
                        ease: "power1.in",
                        duration: 0.8,
                        delay: 0.2,
                        stagger: {
                            each: 0.02,
                        }
                    }, "-=1");
                }
            });

            borderAnim.forEach(borderAnim => {
                let wheat = borderAnim.getElementsByClassName('wheat');
                gsap.set(wheat, { ["--edumentor-sh-clip"]: "100%", });
    
                let shTl = gsap.timeline({
                    scrollTrigger: {
                        trigger: borderAnim,
                        start: "top 90%",
                        toggleActions: scrollAnim
                    }
                });
    
                shTl.to(wheat, {
                    ["--edumentor-sh-clip"]: "0%",
                    duration: 1,
                    delay: 0.02,
                    ease: "power1.in"
                });
    
            });
        });
    }

    // load text animation on window resize
    window.addEventListener('resize', function() {
        textAnimation();
    });

    $(window).on('elementor/frontend/init', function () {
        const widgets = [
            'edumentor-section-heading',
            'edumentor-contact-form',
        ];

         widgets.forEach(widget => {
            elementorFrontend.hooks.addAction(`frontend/element_ready/${widget}.default`, function ($scope) {
                textAnimation($scope);
            });
        });
        
    });

})(jQuery);