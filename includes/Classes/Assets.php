<?php
/**
 * Assets class
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Classes;

defined( 'ABSPATH' ) || die();

class Assets {

    /**
     * Init
     */
    function __construct() {}

    /**
     * Elementor Scripts
     *
     * @return void
     */
    function el_scripts() {
        add_action( "wp_head", [$this, 'add_global_css_vars'] );
        add_action( "elementor/editor/after_enqueue_styles", [$this, 'el_editor_styles'] );
        add_action( "elementor/frontend/after_enqueue_styles", [$this, 'el_frontend_assets_styles'], 5);
        add_action( "elementor/frontend/after_register_scripts", [$this, 'el_frontend_assets_scripts'], 10 );
    }

    /**
     * Add Global CSS Variables
     *
     * @return void
     */
    public function add_global_css_vars() {
        ?>
        <style id="edumentor-global-css-vars">
            :root {
                --edumentor-primary-color: #6d28d2;
                --edumentor-secondary-color: #a435f0;
                --edumentor-heading-color: #2a2b3f;
                --edumentor-text-color: #595c73;
                --edumentor-dark-bg-color: #202230;
            }
        </style>
        <?php
    }

    /**
     * Elementor Styles List
     *
     * @return object
     */
    public function get_el_styles() {
        $min = ( WP_DEBUG === true ) ? '' : '.min';
        return [
            'slick' => [
                'src'     => EDUMENTOR_ASSETS . '/lib/slick/slick.css',
                'version' => '1.8.0',
            ],
            'odometer' => [
                'src'     => EDUMENTOR_ASSETS . '/lib/odometer/odometer-theme-default.min.css',
                'version' => '1.0.0',
            ],
            'edumentor-keyframes' => [
                'src'     => EDUMENTOR_ASSETS . '/css/keyframe-animation'. $min .'.css',
                'version' => '1.0.0',
            ],
            'edumentor-button' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/button'. $min .'.css',
                'version' => Helper::get_version( 'widgets/button' ),
            ],
            'edumentor-counter' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/counter'. $min .'.css',
                'version' => Helper::get_version( 'widgets/counter' ),
            ],
            'edumentor-countdown' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/countdown'. $min .'.css',
                'version' => Helper::get_version( 'widgets/countdown' ),
            ],
            'edumentor-marquee-text' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/marquee-text'. $min .'.css',
                'version' => Helper::get_version( 'widgets/marquee-text' ),
            ],
            'edumentor-video-elements' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/video-elements'. $min .'.css',
                'version' => Helper::get_version( 'widgets/video-elements' ),
            ],
            'edumentor-headings' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/section-heading'. $min .'.css',
                'version' => Helper::get_version( 'widgets/section-heading' ),
            ],
            'hq-team' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/team'. $min .'.css',
                'version' => Helper::get_version( 'widgets/team' ),
            ],
            'hq-mc4wp' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/mc4wp'. $min .'.css',
                'version' => Helper::get_version( 'widgets/mc4wp' ),
            ],
            'hq-timeline' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/timeline'. $min .'.css',
                'version' => Helper::get_version( 'widgets/timeline' ),
            ],
            'hq-blog-list' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/blog-list'. $min .'.css',
                'version' => Helper::get_version( 'widgets/blog-list' ),
            ],
            'hq-carousel-controls' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/controls'. $min .'.css',
                'version' => Helper::get_version( 'widgets/controls' ),
            ],
            'hq-post-cards' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/post-cards'. $min .'.css',
                'version' => Helper::get_version( 'widgets/post-cards' ),
            ],
            'edumentor-contact-form' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/contact-form'. $min .'.css',
                'version' => Helper::get_version( 'widgets/contact-form' ),
            ],
            'edumentor-sponsor' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/sponsor'. $min .'.css',
                'version' => Helper::get_version( 'widgets/sponsor' ),
            ],
            'edumentor-animated-text' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/animated-text'. $min .'.css',
                'version' => Helper::get_version( 'widgets/animated-text' ),
            ],
            'hq-image' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/image'. $min .'.css',
                'version' => Helper::get_version( 'widgets/image' ),
            ],
            'hq-progress-bar' => [
                'src'     => EDUMENTOR_ASSETS . '/css/widgets/progress-bar'. $min .'.css',
                'version' => Helper::get_version( 'widgets/progress-bar' ),
            ],
            'edumentor-main' => [
                'src'     => EDUMENTOR_ASSETS . '/css/main'. $min .'.css',
                'version' => Helper::get_version( 'main' ),
            ]

        ];
    }

    /**
     * Elementor Editor Styles
     *
     * @return void
     */
    public function el_editor_styles() {
        wp_register_style( 'edumentor-el-editor-style', EDUMENTOR_ASSETS . '/admin/css/el-editor.css', false, time() );
        wp_enqueue_style( 'edumentor-el-editor-style' );
    }

    /**
     * Elementor Frontend Styles
     *
     * @return void
     */
    public function el_frontend_assets_styles() {

        $styles = $this->get_el_styles();
        foreach ( $styles as $handle => $style ) {

            $deps = isset( $style['deps'] ) ? $style['deps'] : false;
            wp_register_style( $handle, $style['src'], $deps, $style['version'] );

        }

    }

    /**
     * Elementor Scripts List
     *
     * @return object
     */
    public function get_el_scripts() {

        $min = ( WP_DEBUG === true ) ? '' : '.min';

        return [
            'slick'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/slick/slick.min.js',
                'version' => '1.8.0',
                'deps'    => '',
                'footer'  => true
            ],
            'odometer'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/odometer/odometer.min.js',
                'version' => '1.0.1',
                'deps'    => '',
                'footer'  => true
            ],
            'splitting'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/splitting.min.js',
                'version' => '1.0.0',
                'deps'    => '',
                'footer'  => true
            ],
            'wow'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/wow.min.js',
                'version' => '1.3.0',
                'deps'    => '',
                'footer'  => true
            ],
            'gsap'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/gsap/gsap.min.js',
                'version' => '3.11.4',
                'deps'    => '',
                'footer'  => true
            ],
            'scrolltrigger'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/gsap/ScrollTrigger.min.js',
                'version' => '3.11.4',
                'deps'    => '',
                'footer'  => true
            ],
            'split-type'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/gsap/split-type.min.js',
                'version' => '0.3.4',
                'deps'    => '',
                'footer'  => true
            ],
            'edumentor-countdown'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/countdown.min.js',
                'version' => '0.1.0',
                'deps'    => '',
                'footer'  => true
            ],
            'edumentor-animated-text'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/animated-text.min.js',
                'version' => EDUMENTOR_VERSION,
                'deps'    => '',
                'footer'  => true
            ],
            'hq-parallax-scroll'   => [
                'src'     => EDUMENTOR_ASSETS . '/lib/parallax-scroll.min.js',
                'version' => EDUMENTOR_VERSION,
                'deps'    => '',
                'footer'  => true
            ],
            'slider-test'   => [
                'src'     => EDUMENTOR_ASSETS . '/js/slider-test' . $min . '.js',
                'version' => Helper::get_version( 'slider-test', 'js' ),
                'deps'    => ['jquery', 'elementor-frontend'],
                'footer'  => true
            ],
            'edumentor-el-script'   => [
                'src'     => EDUMENTOR_ASSETS . '/js/el-scripts' . $min . '.js',
                'version' => Helper::get_version( 'el-scripts', 'js' ),
                'deps'    => ['jquery', 'elementor-frontend'],
                'footer'  => true
            ],
            'edumentor-text-animation'   => [
                'src'     => EDUMENTOR_ASSETS . '/js/text-animation' . $min . '.js',
                'version' => Helper::get_version( 'text-animation', 'js' ),
                'deps'    => ['jquery', 'elementor-frontend', 'gsap', 'scrolltrigger', 'split-type'],
                'footer'  => true
            ],
        ];
    }

    /**
     * Elementor Frontend Scripts
     *
     * @return void
     */
    public function el_frontend_assets_scripts() {

        $scripts = $this->get_el_scripts();
        foreach ( $scripts as $handle => $script ) {

            $deps = isset( $script['deps'] ) ? $script['deps'] : false;
            wp_register_script( $handle, $script['src'], $deps, $script['version'], $script['footer'] );

        }

        // $scrolling_animation = ! empty( $options['scrolling_animation'] ) ? $options['scrolling_animation'] : 'restart pause resume reverse';
        $scrolling_animation = 'restart pause resume reverse';

        wp_localize_script( 'edumentor-text-animation', 'edumentor_text_opt', [
            'scrolling_anim' => esc_attr( $scrolling_animation )
        ] );

    }

}
