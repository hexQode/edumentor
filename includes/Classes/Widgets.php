<?php
/**
 * Widgets class
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Classes;

defined( 'ABSPATH' ) || die();

class Widgets {

    private static $instance = null;

    public static function instance() {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Initialize
     */
    public function __construct() {
        add_action( 'elementor/widgets/register', [ $this, 'register'] );
    }

    /**
     * Widgets List
     *
     * @return array
     */
    public function get_widgets() {
        return [
            // 'heading'   => [
            //     'name' => 'Heading',
            //     'dep'   => ''
            // ],
            'animated-text'   => [
                'name' => 'AnimatedText',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            'section-heading'   => [
                'name' => 'SectionHeading',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            'working-hours'   => [
                'name' => 'WorkingHours',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            'button'   => [
                'name' => 'Button',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            // 'image'   => [
            //     'name' => 'Image',
            //     'dep'   => ''
            // ],
            'list'   => [
                'name' => 'List',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            // 'progress-bar'   => [
            //     'name' => 'ProgressBar',
            //     'dep'   => ''
            // ],
            'counter'   => [
                'name' => 'Counter',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            'countdown'   => [
                'name' => 'Countdown',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            'marquee-text'   => [
                'name' => 'MarqueeText',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            'sponsor'   => [
                'name' => 'Sponsor',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            'social-icons'   => [
                'name' => 'SocialIcons',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            'video-box'   => [
                'name' => 'VideoBox',
                'group'  => 'basic',
                'dep'   => '',
                'active' => true,
            ],
            'play-button'   => [
                'name' => 'PlayButton',
                'group'  => 'basic',
                'dep'   => '',
                'active' => false,
            ],
            'contact-form-7'   => [
                'name' => 'ContactForm',
                'group'  => 'integrations',
                'dep'   => 'cf7',
                'active' => true,
            ],
            'mc4wp'   => [
                'name' => 'MailChimp',
                'group'  => 'integrations',
                'dep'   => 'mc',
                'active' => true,
            ]
        ];
    }

    /**
     * Widgets register
     *
     * @param [type] $widgets_manager
     * @return void
     */
    public function register( $widgets_manager ) {

        $widgets = $this->get_widgets();
        if ( empty( $widgets ) ) {
            return;
        }

        // Get saved enabled widgets
        $enabled = get_option( 'edumentor_enabled_widgets', [] );

        // Automatically initialize enabled widgets if none saved yet
        if ( empty( $enabled ) ) {
            $enabled = array_keys( array_filter(
                $widgets,
                static fn( $widget ) => ! empty( $widget['active'] )
            ));
            update_option( 'edumentor_enabled_widgets', $enabled, false );
        }

        // Allow filtering of enabled widgets (for addons or child themes)
        $enabled = apply_filters( 'edumentor_enabled_widgets', $enabled );

        // Dependency availability map
        $deps = [
            'cf7' => static fn() => class_exists( 'WPCF7' ),
            'mc'  => static fn() => defined( 'MC4WP_VERSION' ),
        ];

        $namespace = 'HexQode\\EduMentor\\Elementor\\Widgets\\%s\\Widget';

        foreach ( $widgets as $slug => $widget ) {

            // Skip if widget not in enabled list
            if ( ! in_array( $slug, $enabled, true ) ) {
                continue;
            }

            // Check dependency availability
            $dep = $widget['dep'] ?? '';
            if ( $dep && isset( $deps[ $dep ] ) && ! $deps[ $dep ]() ) {
                continue;
            }

            // Build class name
            $class = sprintf( $namespace, $widget['name'] );

            // Skip if widget class missing
            if ( ! class_exists( $class ) ) {
                continue;
            }

            // Register with Elementor
            $widgets_manager->register( new $class() );
        }
        
    }
}
