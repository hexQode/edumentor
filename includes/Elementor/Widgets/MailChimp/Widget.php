<?php
/**
 * MailChimp for WP
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\MailChimp;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || die();

class Widget extends Widget_Base {

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'edumentor-mc4wp';
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
        return esc_html__( 'MailChimp WP', 'edumentor' );
    }

    public function get_custom_help_url() {
        return 'https://edumentor.com';
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
        return 'edumentor-icon eicon-mailchimp';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'newsletter', 'mc4wp', 'mailchimp', 'mailchimp for wp', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'hq-mc4wp' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->mailchimp_config_section();
        $this->wrapper_style_section();
        $this->input_field_style_section();
        $this->button_style_section();
        
    }

    /**
     * Mailchimp Config Controls
     */
    protected function mailchimp_config_section() {

        $this->start_controls_section(
            'fp_mailchimp',
            [
                'label' => esc_html__( 'Mailchimp', 'edumentor' ),
            ]
        );

        $this->add_control(
            'fp_mailchimp_form_style',
            [
                'label'   => esc_html__( 'Style', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '1' => esc_html__( 'Style One', 'edumentor' ),
                    '2' => esc_html__( 'Style Two', 'edumentor' ),
                    '3' => esc_html__( 'Style Three', 'edumentor' ),
                    '4' => esc_html__( 'Style Four', 'edumentor' )
                ],
            ]
        );

        $this->add_control(
            'fp_mailchimp_id',
            [
                'label'       => esc_html__( 'Mailchimp ID', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '250', 'edumentor' ),
                'description' => esc_html__( 'For show ID <a href="admin.php?page=mailchimp-for-wp-forms" target="_blank"> Click here </a>', 'edumentor' ),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Wrapper Style Controls
     */
    protected function wrapper_style_section() {

        $this->start_controls_section(
            'fp_mailchimp_section_style',
            [
                'label' => esc_html__( 'Wrapper', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'fp_mailchimp_section_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-input-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'fp_mailchimp_section_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-input-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'fp_mailchimp_section_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-input-box',
            ]
        );

        $this->add_responsive_control(
            'fp_mailchimp_section_align',
            [
                'label'     => esc_html__( 'Alignment', 'edumentor' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'edumentor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__( 'Center', 'edumentor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-input-box' => 'text-align: {{VALUE}};',
                ],
                'default'   => 'center',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Input Field Style Controls
     */
    protected function input_field_style_section() {

        // Input Box style tab start
        $this->start_controls_section(
            'fp_mailchimp_input_style',
            [
                'label' => esc_html__( 'Input Box', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'dl_input_box_height',
            [
                'label'     => esc_html__( 'Height', 'edumentor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'default'   => [
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]'  => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dl_input_box_typography',
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="email"]',
            ]
        );

        $this->add_control(
            'dl_input_box_background',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]'          => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]'         => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form select[name*="_mc4wp_lists"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dl_input_box_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dl_input_box_placeholder_color',
            [
                'label'     => esc_html__( 'Placeholder Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]::-moz-placeholder'           => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]:-ms-input-placeholder'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]::-moz-placeholder'          => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]:-ms-input-placeholder'      => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mc4wp-form select[name*="_mc4wp_lists"]'                    => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'dl_input_box_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="email"]',
            ]
        );

        $this->add_responsive_control(
            'dl_input_box_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'edumentor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]'  => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'dl_input_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'dl_input_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mc4wp-form input[type*="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_control(
			'fh_style_heading',
			[
				'label' => esc_html__( 'Hover/Focus Style', 'edumentor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'text_fh_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="text"]:hover, {{WRAPPER}} .mc4wp-form input[type*="text"]:focus, {{WRAPPER}} .mc4wp-form input[type*="email"]:hover, {{WRAPPER}} .mc4wp-form input[type*="email"]:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'text_fh_box_shadow',
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="text"]:hover, {{WRAPPER}} .mc4wp-form input[type*="text"]:focus, {{WRAPPER}} .mc4wp-form input[type*="email"]:hover, {{WRAPPER}} .mc4wp-form input[type*="email"]:focus',
            ]
        );

        $this->add_responsive_control(
            'text_fh_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mc4wp-form input[type*="text"]:hover, {{WRAPPER}} .mc4wp-form input[type*="text"]:focus, {{WRAPPER}} .mc4wp-form input[type*="email"]:hover, {{WRAPPER}} .mc4wp-form input[type*="email"]:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Button Style Controls
     */
    protected function button_style_section() {

        $this->start_controls_section(
            'fp_mailchimp_inputsubmit_style',
            [
                'label' => esc_html__( 'Button', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'dl_submit_style_tabs' );

        // Button Normal tab start
        $this->start_controls_tab(
            'dl_submit_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_responsive_control(
            'dl_input_submit_width',
            [
                'label'     => esc_html__( 'Width', 'edumentor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'default'   => [
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl-mailchimp-style-4 .mc4wp-form input[type*="submit"]' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'fp_mailchimp_form_style'    => '4',
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_input_submit_height',
            [
                'label'     => esc_html__( 'Height', 'edumentor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'default'   => [
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_input_submit_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'edumentor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 150,
                    ],
                ],
                'default'   => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl-mailchimp-style-4 .mc4wp-form input[type*="submit"]' => 'background-size: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'fp_mailchimp_form_style'    => '4',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dl_input_submit_typography',
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]',
            ]
        );

        $this->add_control(
            'dl_input_submit_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dl_input_submit_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_input_submit_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'dl_input_submit_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'dl_input_submit_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]',
            ]
        );

        $this->add_responsive_control(
            'dl_input_submit_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'edumentor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'dl_input_submit_box_shadow',
                'label'    => esc_html__( 'Box Shadow', 'edumentor' ),
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]',
            ]
        );

        $this->end_controls_tab(); // Button Normal tab end

        // Button Hover tab start
        $this->start_controls_tab(
            'dl_submit_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edumentor' ),
            ]
        );

        $this->add_control(
            'dl_input_submithover_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dl_input_submithover_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form input[type*="submit"]:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'dl_input_submithover_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .mc4wp-form input[type*="submit"]:hover',
            ]
        );

        $this->end_controls_tab(); // Button Hover tab end

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
     * Render Content
     *
     * @return void
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'mailchimp_area_attr', 'class', 'hq-mailchimp' );
        $this->add_render_attribute( 'mailchimp_area_attr', 'class', 'hq-mailchimp-style-' . $settings['fp_mailchimp_form_style'] );

        ?>
        <div <?php echo $this->get_render_attribute_string( 'mailchimp_area_attr' ); ?> >
            <div class="hq-input-box">
                <?php 
                echo do_shortcode( '[mc4wp_form  id="' . $settings['fp_mailchimp_id'] . '"]' );
                ?>
            </div>
        </div>
        <?php
       
    }

}