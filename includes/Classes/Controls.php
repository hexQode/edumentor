<?php
/**
 * Controls class
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Classes;

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
        
        $controls_Manager->add_group_control( \HexQode\EduMentor\Elementor\Controls\Foreground::get_type(), New \HexQode\EduMentor\Elementor\Controls\Foreground() );
        
    }
}
