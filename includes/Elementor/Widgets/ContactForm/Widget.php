<?php
/**
 * Contact Form
 *
 * @package EduMentor
 */
namespace HexQode\EduMentor\Elementor\Widgets\ContactForm;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use HexQode\EduMentor\Classes\Helper;
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
        return 'edumentor-contact-form';
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
        return esc_html__( 'Contact Form 7', 'edumentor' );
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
        return 'edumentor-icon eicon-mail';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'contact', 'form', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'edumentor-headings', 'edumentor-keyframes', 'edumentor-contact-form' ];
    }

    public function get_script_depends() {
        return [ 'edumentor-text-animation','gsap', 'scrolltrigger', 'split-type' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_general();
        $this->sub_heading_section( 'hq_' );
        $this->heading_section( 'hq_', esc_html__( 'Get In Touch!', 'edumentor' ), true );
        $this->description_section();
        $this->select_form_section();
        $this->column_controls_section();
        $this->wrapper_style();
        $this->sub_heading_style();
        $this->heading_style();
        $this->description_style();
        $this->form_label_style();
        $this->form_text_style();
        $this->form_select_box_style();
        $this->form_checkbox_radio_style();
        $this->form_submit_style();

    }

    /**
     * Select Form
     *
     * @return void
     */
    protected function select_form_section() {

        $this->start_controls_section(
			'select_form_section',
			[
				'label' => esc_html__( 'Form', 'edumentor' )
			]
        );

        $this->add_control(
            'contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => Helper::el_get_contact_forms(),
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Columns Control
     *
     * @return void
     */
    protected function column_controls_section() {

        $this->start_controls_section(
			'column_controls_section',
			[
				'label' => esc_html__( 'Column Controls', 'edumentor' )
			]
        );

        $this->add_control(
            'column_layout',
            [
                'label'   => esc_html__( 'Column Layout', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'  => esc_html__( 'Default', 'edumentor' ),
                    'layout-1'  => esc_html__( '2 2 1 Column', 'edumentor' ),
                    'layout-2' => esc_html__( '2 1 Column', 'edumentor' ),
                    'layout-3' => esc_html__( '2 1 2 Column', 'edumentor' ),
                    'layout-4' => esc_html__( '1 2 1 Column', 'edumentor' ),
                    'layout-5' => esc_html__( '1 2 2 Column', 'edumentor' ),
                    'layout-6' => esc_html__( '2 Column', 'edumentor' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'col_spacing',
            [
                'label'      => esc_html__( 'Space Between', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form' => 'margin: 0 calc(-{{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .wpcf7-form p:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7-form p' => 'padding: 0 calc({{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * General Control
     *
     * @return void
     */
    protected function section_general() {

        $this->start_controls_section(
			'section_heading_general',
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

        $this->add_responsive_control(
            'section_margin',
            [
                'label'      => esc_html__( 'Section Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'allowed_dimensions' => 'vertical',
                'selectors'  => [
                    '{{WRAPPER}} .el-section-heading' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;'
                ]
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Wrapper Style
     *
     * @return void
     */
    protected function wrapper_style() {
        
        $this->start_controls_section(
            'wrapper_style_section',
            [
                'label' => esc_html__( 'Wrapper', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'wrapper_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .el-cf7-form-wrap',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .el-cf7-form-wrap',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .el-cf7-form-wrap',
            ]
        );

        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .el-cf7-form-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .el-cf7-form-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .el-cf7-form-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wrapper_overlay',
            [
                'label'        => esc_html__( 'Overlay', 'edumentor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'edumentor' ),
                'label_off'    => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'ov_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .el-cf7-form-wrap .overlay',
                'condition'    => [
                   'wrapper_overlay' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ov_opacity',
            [
                'label'      => esc_html__( 'Opacity', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0.5,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .el-cf7-form-wrap .overlay' => 'opacity: {{SIZE}};',
                ],
                'condition'    => [
                    'wrapper_overlay' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Form Label Style
     *
     * @return void
     */
    protected function form_label_style() {
        
        $this->start_controls_section(
            'form_label_style_section',
            [
                'label' => esc_html__( 'Form Label', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_label_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-form p > label, {{WRAPPER}} .wpcf7-not-valid-tip',
            ]
        );

        $this->add_control(
            'form_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p > label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_required_text_color',
            [
                'label'     => esc_html__( 'Required Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-not-valid-tip' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'required_txt_margin',
            [
                'label'      => esc_html__( 'Required Text Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-not-valid-tip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Form Input Style
     *
     * @return void
     */
    protected function form_text_style() {
        
        $this->start_controls_section(
            'form_text_style_section',
            [
                'label' => esc_html__( 'Form Fields', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_input_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-number, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz,{{WRAPPER}} .wpcf7-form p .wpcf7-textarea',
            ]
        );

        $this->add_responsive_control(
            'input_field_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-number, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_field_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-number, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea, {{WRAPPER}} .wpcf7-form p .wpcf7-form-control:not(.wpcf7-submit)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'textarea_field_height',
            [
                'label' => esc_html__( 'Textarea Height', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 140
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'input_style_tabs' );
        
        $this->start_controls_tab(
            'input_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-number' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-quiz' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_txt_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-number, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_txt_placeholder_color',
            [
                'label'     => esc_html__( 'Placeholder Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control::placeholder, {{WRAPPER}} .wpcf7-form .wpcf7-form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'input_txt_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-number, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'input_txt_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-number, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea',
            ]
        );

        $this->add_responsive_control(
            'input_txt_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-number, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'input_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edumentor' ),
            ]
        );

        $this->add_control(
            'input_bg_h_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-text:focus' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-number:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-number:focus' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-quiz:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:focus' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'input_txt_h_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-number:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-text:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'input_txt_h_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-number:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-text:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:focus',
            ]
        );

        $this->add_responsive_control(
            'input_txt_h_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-number:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-text:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

    }

    /**
     * Form Select Box Style
     *
     * @return void
     */
    protected function form_select_box_style() {
        
        $this->start_controls_section(
            'form_select_box_style_section',
            [
                'label' => esc_html__( 'Form Select Field', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'select_box_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .ui-selectmenu-text',
            ]
        );
        
        $this->add_control(
            'form_select_box_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ui-selectmenu-button.ui-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_select_txt_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ui-selectmenu-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'select_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .ui-selectmenu-button.ui-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'select_box_shadow',
                'selector' => '{{WRAPPER}} .ui-selectmenu-button.ui-button',
            ]
        );

        $this->add_responsive_control(
            'select_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ui-selectmenu-button.ui-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_select_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ui-selectmenu-button.ui-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_select_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ui-selectmenu-button.ui-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Checkbox/Radio Field
     *
     * @return void
     */
    protected function form_checkbox_radio_style() {
        
        $this->start_controls_section(
            'form_cb_radio_style_section',
            [
                'label' => esc_html__( 'Form Checkbox/Radio Field', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cb_radio_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-list-item-label',
            ]
        );

        $this->add_control(
            'cb_radio_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-list-item-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'cb_radio_space_between_item',
            [
                'label'      => esc_html__( 'Space Between Item', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form-control.wpcf7-radio' => 'column-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7-form-control.wpcf7-checkbox' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cb_radio_space_between_box_text',
            [
                'label'      => esc_html__( 'Space Between Box & Text', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-list-item > label' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'radio_cb_bd_color',
            [
                'label'     => esc_html__( 'Border Color Normal', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input[type=checkbox]' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-radio input' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'radio_cb_bd_hover_color',
            [
                'label'     => esc_html__( 'Border Color Hover', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input[type=checkbox]:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-radio input:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'radio_cb_bd_active_color',
            [
                'label'     => esc_html__( 'Active Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input[type=checkbox]:before' => 'box-shadow: inset 1em 1em {{VALUE}}',
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-radio input::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Form Submit Style
     *
     * @return void
     */
    protected function form_submit_style() {
        
        $this->start_controls_section(
            'form_submit_style_section',
            [
                'label' => esc_html__( 'Form Button', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btn_alignment',
            [
                'label'   => esc_html__( 'Alignment', 'edumentor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'edumentor' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'edumentor' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle'  => false,
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center; flex-direction: column',
                    'right' => 'justify-content: flex-end; flex-direction: row-reverse'
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form>p:last-of-type' => '{{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_btn_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_top_spacing',
            [
                'label' => esc_html__( 'Top Spacing', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'btn_style_tabs' );
        
        $this->start_controls_tab(
            'btn_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'btn_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'    => ['image'],
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'btn_h_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'    => ['image'],
                'selector' => '{{WRAPPER}} .wpcf7-submit:hover',
            ]
        );

        $this->add_control(
            'btn_h_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_h_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-submit:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_h_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-submit:hover',
            ]
        );

        $this->add_responsive_control(
            'btn_h_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-submit:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
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
        
        $this->add_render_attribute( 'wrapper', [ 'class' => [ 'el-cf7-form-wrap', $settings['column_layout'] ] ] );
        
        echo '<div '. $this->get_render_attribute_string( 'wrapper' ) .'>';
        if( 'yes' === $settings['wrapper_overlay'] ) {
            echo '<div class="overlay"></div>';
        } 
        if( ! empty($settings['hq_heading'] || $settings['hq_sub_heading'] || $settings['hq_desc']) ) : ?>
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
        endif;
            echo do_shortcode( $this->get_shortcode() );
        echo '</div>';
        
    }

    private function get_shortcode() {
        $settings = $this->get_settings();

        if ( ! $settings['contact_form'] ) {
            return '<div class="alert alert-warning" role="alert">' . __( 'Please select a Contact Form From Setting!', 'edumentor' ) . '</div>';
        }

        $attributes = [
            'id' => $settings['contact_form'],
        ];

        $this->add_render_attribute( 'shortcode', $attributes );

        $shortcode   = [];
        $shortcode[] = sprintf( '[contact-form-7 %s]', $this->get_render_attribute_string( 'shortcode' ) );

        return implode( "", $shortcode );
    }

}