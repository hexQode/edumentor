<?php
/**
 * Section Heading
 *
 * @package EduMentor
 */
namespace HexQode\EduMentor\Elementor\Widgets\SectionHeading;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use HexQode\EduMentor\Traits\CommonControls;
use HexQode\EduMentor\Traits\RenderTemplates;

defined( 'ABSPATH' ) || die();

class Widget extends Widget_Base {

    use CommonControls;
    use RenderTemplates;

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'edumentor-section-heading';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Section Heading', 'edumentor' );
    }

    public function get_custom_help_url() {
        return 'https://hexqode.com';
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'edumentor-icon eicon-form-horizontal';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'section', 'heading', 'title', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'edumentor-headings', 'edumentor-keyframes' ];
    }

    public function get_script_depends() {
        return [ 'edumentor-text-animation', 'gsap', 'scrolltrigger', 'split-type' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->general_section();
        $this->sub_heading_section( 'hq_' );
        $this->heading_section( 'hq_', esc_html__( 'The #1 Place to Grow Your Career!', 'edumentor' ), true );
        $this->description_section();
        $this->sub_heading_style();
        $this->heading_style();
        $this->description_style();
    }

    /**
     * General Controls
     *
     * @return void
     */
    protected function general_section() {

        $this->start_controls_section(
            'general_section',
            [
                'label' => esc_html__( 'General', 'edumentor' )
            ]
        );
        
        $this->add_responsive_control(
            'section_heading_alignment',
            [
                'label' => esc_html__( 'Alignment', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'edumentor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'edumentor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors_dictionary' => [
                    'left' => 'text-align: start',
                    'center' => 'text-align: center',
                    'right' => 'text-align: end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper' => '{{VALUE}}'
                ]
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Render Content
     *
     * @return void
     */
    protected function render() {

        $settings = $this->get_settings_for_display();
        
        ?>
        <div class="el-section-heading">
            <div class="content-wrapper">
                <?php
                $this->get_sub_heading_template( 'hq_', false );
                $this->get_heading_template( 'hq_', true );
                $this->get_description_template();
                ?>
            </div>
        </div>
        <?php
    }

}