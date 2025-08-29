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
        add_action( "elementor/editor/after_enqueue_styles", [$this, 'el_editor_styles'] );
        add_action( "elementor/frontend/after_enqueue_styles", [$this, 'el_frontend_assets_styles'], 5);
        add_action( "elementor/frontend/after_register_scripts", [$this, 'el_frontend_assets_scripts'], 10 );
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
                'src'     => FLATPACK_ASSETS . '/lib/slick/slick.css',
                'version' => '1.8.0',
            ],
            'odometer' => [
                'src'     => FLATPACK_ASSETS . '/lib/odometer/odometer-theme-default.min.css',
                'version' => '1.0.0',
            ],
            'fp-keyframes' => [
                'src'     => FLATPACK_ASSETS . '/css/keyframe-animation'. $min .'.css',
                'version' => '1.0.0',
            ],
            'fp-counter' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/counter'. $min .'.css',
                'version' => Helper::get_version( 'widgets/counter' ),
            ],
            'fp-countdown' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/countdown'. $min .'.css',
                'version' => Helper::get_version( 'widgets/countdown' ),
            ],
            'fp-team' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/team'. $min .'.css',
                'version' => Helper::get_version( 'widgets/team' ),
            ],
            'fp-mc4wp' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/mc4wp'. $min .'.css',
                'version' => Helper::get_version( 'widgets/mc4wp' ),
            ],
            'fp-timeline' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/timeline'. $min .'.css',
                'version' => Helper::get_version( 'widgets/timeline' ),
            ],
            'fp-blog-list' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/blog-list'. $min .'.css',
                'version' => Helper::get_version( 'widgets/blog-list' ),
            ],
            'hq-carousel-controls' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/controls'. $min .'.css',
                'version' => Helper::get_version( 'widgets/controls' ),
            ],
            'hq-post-cards' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/post-cards'. $min .'.css',
                'version' => Helper::get_version( 'widgets/post-cards' ),
            ],
            'fp-contact-form' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/contact-form'. $min .'.css',
                'version' => Helper::get_version( 'widgets/contact-form' ),
            ],
            'fp-sponsor' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/sponsor'. $min .'.css',
                'version' => Helper::get_version( 'widgets/sponsor' ),
            ],
            'fp-animated-text' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/animated-text'. $min .'.css',
                'version' => Helper::get_version( 'widgets/animated-text' ),
            ],
            'fp-image' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/image'. $min .'.css',
                'version' => Helper::get_version( 'widgets/image' ),
            ],
            'fp-progress-bar' => [
                'src'     => FLATPACK_ASSETS . '/css/widgets/progress-bar'. $min .'.css',
                'version' => Helper::get_version( 'widgets/progress-bar' ),
            ],
            'fp-main' => [
                'src'     => FLATPACK_ASSETS . '/css/main'. $min .'.css',
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
        wp_register_style( 'flatpack-el-editor-style', FLATPACK_ASSETS . '/admin/css/el-editor.css', false, time() );
        wp_enqueue_style( 'flatpack-el-editor-style' );
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
                'src'     => FLATPACK_ASSETS . '/lib/slick/slick.min.js',
                'version' => '1.8.0',
                'deps'    => '',
                'footer'  => true
            ],
            'odometer'   => [
                'src'     => FLATPACK_ASSETS . '/lib/odometer/odometer.min.js',
                'version' => '1.0.1',
                'deps'    => '',
                'footer'  => true
            ],
            'splitting'   => [
                'src'     => FLATPACK_ASSETS . '/lib/splitting.min.js',
                'version' => '1.0.0',
                'deps'    => '',
                'footer'  => true
            ],
            'wow'   => [
                'src'     => FLATPACK_ASSETS . '/lib/wow.min.js',
                'version' => '1.3.0',
                'deps'    => '',
                'footer'  => true
            ],
            'fp-countdown'   => [
                'src'     => FLATPACK_ASSETS . '/lib/countdown.min.js',
                'version' => '0.1.0',
                'deps'    => '',
                'footer'  => true
            ],
            'fp-animated-text'   => [
                'src'     => FLATPACK_ASSETS . '/lib/animated-text.min.js',
                'version' => FLATPACK_VERSION,
                'deps'    => '',
                'footer'  => true
            ],
            'fp-parallax-scroll'   => [
                'src'     => FLATPACK_ASSETS . '/lib/parallax-scroll.min.js',
                'version' => FLATPACK_VERSION,
                'deps'    => '',
                'footer'  => true
            ],
            'slider-test'   => [
                'src'     => FLATPACK_ASSETS . '/js/slider-test' . $min . '.js',
                'version' => Helper::get_version( 'slider-test', 'js' ),
                'deps'    => ['jquery', 'elementor-frontend'],
                'footer'  => true
            ],
            'flatpack-el-script'   => [
                'src'     => FLATPACK_ASSETS . '/js/el-scripts' . $min . '.js',
                'version' => Helper::get_version( 'el-scripts', 'js' ),
                'deps'    => ['jquery', 'elementor-frontend'],
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

    }

}
