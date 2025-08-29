<?php
/**
 * Widgets class
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace DynamicLayers\FlatPack\Classes;

defined( 'ABSPATH' ) || die();

class Widgets {

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
            'heading'   => [
                'name' => 'Heading',
                'dep'   => ''
            ],
            'animated-text'   => [
                'name' => 'AnimatedText',
                'dep'   => ''
            ],
            'button'   => [
                'name' => 'Button',
                'dep'   => ''
            ],
            'image'   => [
                'name' => 'Image',
                'dep'   => ''
            ],
            'list'   => [
                'name' => 'List',
                'dep'   => ''
            ],
            'progress-bar'   => [
                'name' => 'ProgressBar',
                'dep'   => ''
            ],
            'counter'   => [
                'name' => 'Counter',
                'dep'   => ''
            ],
            'list-pricing'   => [
                'name' => 'ListPricing',
                'dep'   => ''
            ],
            'sponsor'   => [
                'name' => 'Sponsor',
                'dep'   => ''
            ],
            'contact-form-7'   => [
                'name' => 'ContactForm7',
                'dep'   => 'cf7'
            ],
            'mc4wp'   => [
                'name' => 'MailChimp',
                'dep'   => 'mc'
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
        
        if ( $widgets ) {
            foreach ($widgets as $widget){
                
                if( 'cf7' === $widget['dep'] ) {
                    if ( class_exists( 'WPCF7' ) ) {
                        $widget_init = 'DynamicLayers\FlatPack\Elementor\Widgets\\'. $widget['name'] .'\\Widget';
                        $widgets_manager->register( new $widget_init );
                    }
                }if( 'mc' === $widget['dep'] ) {
                    if( function_exists('_mc4wp_load_plugin') ) {
                        $widget_init = 'DynamicLayers\FlatPack\Elementor\Widgets\\'. $widget['name'] .'\\Widget';
                        $widgets_manager->register( new $widget_init );
                    }
                }else{
                    $widget_init = 'DynamicLayers\FlatPack\Elementor\Widgets\\'. $widget['name'] .'\\Widget';
                    $widgets_manager->register( new $widget_init );
                }
                
            }
        }
        
    }
}
