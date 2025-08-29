<?php
/**
 * Controls class
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace DynamicLayers\FlatPack\Classes;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

class Controls {

    /**
     * Initialize
     */
    public function __construct() {
        add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );
    }

    /**
     * Register Controls
     * 
     */
    public function register_controls( Controls_Manager $controls_Manager  ) {
        
        $controls_Manager->add_group_control( \DynamicLayers\FlatPack\Elementor\Controls\Foreground::get_type(), New \DynamicLayers\FlatPack\Elementor\Controls\Foreground() );
        
    }
}
