<?php
/**
 * Counter
 *
 * @package EduMentor
 */
namespace HexQode\EduMentor\Elementor\Widgets\Counter;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

use HexQode\EduMentor\Classes\Helper;
use HexQode\EduMentor\Elementor\Controls\Foreground;

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
        return 'edumentor-counter';
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
        return esc_html__( 'Counter', 'edumentor' );
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
        return 'edumentor-icon eicon-number-field';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return ['counter', 'number', 'edumentor'];
    }

    public function get_script_depends() {
        return ['odometer', 'edumentor-el-script'];
    }

    public function get_style_depends() {
        return ['odometer', 'edumentor-counter'];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_counter_content();
        $this->section_divider();
        $this->section_settings();
        $this->counter_style();
        $this->icon_style();
        $this->number_style();
        $this->prefix_style();
        $this->suffix_style();
        $this->title_style();

    }

    /**
     * Section Counter Content
     *
     * @return void
     */
    protected function section_counter_content() {

        $this->start_controls_section(
            'section_counter',
            [
                'label' => esc_html__( 'Counter', 'edumentor' ),
            ]
        );

        $this->add_control(
            'dl_icon_type',
            [
                'label'       => esc_html__( 'Icon Type', 'edumentor' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'none'  => [
                        'title' => esc_html__( 'None', 'edumentor' ),
                        'icon'  => 'eicon-ban',
                    ],
                    'icon'  => [
                        'title' => esc_html__( 'Icon', 'edumentor' ),
                        'icon'  => 'eicon-info-circle',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'edumentor' ),
                        'icon'  => 'eicon-image',
                    ],
                ],
                'default'     => 'none',
                'condition'    => [
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'counter_icon',
            [
                'label'            => esc_html__( 'Icon', 'edumentor' ),
                'type'             => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-star',
                    'library' => 'solid',
                ],
                'fa4compatibility'  => 'icon',
                'skin'              => 'inline',
                'exclude_inline_options'  => ['svg'],
                'condition'        => [
                    'dl_icon_type' => 'icon',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'icon_image',
            [
                'label'     => esc_html__( 'Image', 'edumentor' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'dl_icon_type' => 'image',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'ending_number',
            [
                'label'     => esc_html__( 'Number', 'edumentor' ),
                'type'      => Controls_Manager::NUMBER,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => esc_html__( '250', 'edumentor' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'number_prefix',
            [
                'label'   => esc_html__( 'Number Prefix', 'edumentor' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'number_suffix',
            [
                'label'   => esc_html__( 'Number Suffix', 'edumentor' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'counter_title',
            [
                'label'     => esc_html__( 'Title', 'edumentor' ),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => esc_html__( 'Counter Title', 'edumentor' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label'   => esc_html__( 'Title HTML Tag', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'div',
                'options' => [
                    'h1'   => esc_html__( 'H1', 'edumentor' ),
                    'h2'   => esc_html__( 'H2', 'edumentor' ),
                    'h3'   => esc_html__( 'H3', 'edumentor' ),
                    'h4'   => esc_html__( 'H4', 'edumentor' ),
                    'h5'   => esc_html__( 'H5', 'edumentor' ),
                    'h6'   => esc_html__( 'H6', 'edumentor' ),
                    'div'  => esc_html__( 'div', 'edumentor' ),
                    'span' => esc_html__( 'span', 'edumentor' ),
                    'p'    => esc_html__( 'p', 'edumentor' ),
                ],
            ]
        );

        $this->add_control(
            'counter_layout',
            [
                'label'     => esc_html__( 'Layout', 'edumentor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'layout-1',
                'options'   => [
                    'layout-1' => esc_html__( 'Layout 1', 'edumentor' ),
                    'layout-2' => esc_html__( 'Layout 2', 'edumentor' ),
                    'layout-3' => esc_html__( 'Layout 3', 'edumentor' ),
                    'layout-4' => esc_html__( 'Layout 4', 'edumentor' ),
                    'layout-5' => esc_html__( 'Layout 5', 'edumentor' ),
                    'layout-6' => esc_html__( 'Layout 6', 'edumentor' ),
                    'layout-7' => esc_html__( 'Layout 7', 'edumentor' ),
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Section Divider
     *
     * @return void
     */
    protected function section_divider() {

        $this->start_controls_section(
            'section_counter_separators',
            [
                'label' => esc_html__( 'Dividers', 'edumentor' ),
                'condition'    => [
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'icon_divider',
            [
                'label'        => esc_html__( 'Icon Divider', 'edumentor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => esc_html__( 'On', 'edumentor' ),
                'label_off'    => esc_html__( 'Off', 'edumentor' ),
                'return_value' => 'yes',
                'condition'    => [
                    'dl_icon_type!' => 'none',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'num_divider',
            [
                'label'        => esc_html__( 'Number Divider', 'edumentor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => esc_html__( 'On', 'edumentor' ),
                'label_off'    => esc_html__( 'Off', 'edumentor' ),
                'return_value' => 'yes',
                'condition'    => [
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Section Settings
     *
     * @return void
     */
    protected function section_settings() {

        $this->start_controls_section(
            'section_counter_settings',
            [
                'label' => esc_html__( 'Settings', 'edumentor' ),
            ]
        );

        $this->add_control(
            'counter_speed',
            [
                'label'      => esc_html__( 'Counting Speed', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => ['size' => 1500],
                'range'      => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 3000
                    ],
                ],
                'size_units' => '',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Counter Style
     *
     * @return void
     */
    protected function counter_style() {

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Counter', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'    => [
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_align',
            [
                'label'        => esc_html__( 'Alignment', 'edumentor' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'edumentor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'edumentor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'      => 'center',
                'prefix_class' => 'counter-',
                'selectors'    => [
                    '{{WRAPPER}} .hq-counter-container' => 'text-align: {{VALUE}};',
                ],
                'toggle'  => false,
                'condition'    => [
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Icon Style
     *
     * @return void
     */
    protected function icon_style() {

        $this->start_controls_section(
            'section_counter_icon_style',
            [
                'label'     => esc_html__( 'Icon', 'edumentor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dl_icon_type!' => 'none',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'counter_icon_bg',
                'label'     => esc_html__( 'Background', 'edumentor' ),
                'types'     => ['none', 'classic', 'gradient'],
                'condition' => [
                    'dl_icon_type!' => 'none',
                    'counter_layout!' => 'layout-7',
                ],
                'selector'  => '{{WRAPPER}} .hq-counter-icon',
            ]
        );

        $this->add_control(
			'counter_icon_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

        $this->add_group_control(
            Foreground::get_type(),
            [
                'name'     => 'counter_icon_color',
                'label'    => esc_html__( 'Icon Color', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-counter-icon i',
                'condition' => [
                    'dl_icon_type' => 'icon',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_size',
            [
                'label'      => esc_html__( 'Size', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'separator'  => 'before',
                'range'      => [
                    'px' => [
                        'min'  => 5,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-icon'     => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .hq-counter-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                ],
                'condition'  => [
                    'dl_icon_type' => 'icon',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_img_width',
            [
                'label'      => esc_html__( 'Image Width', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 500,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'condition'  => [
                    'dl_icon_type' => 'image',
                    'counter_layout!' => 'layout-7',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_rotation',
            [
                'label'      => esc_html__( 'Rotation', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 360,
                        'step' => 1,
                    ],
                ],
                'size_units' => '',
                'condition'  => [
                    'dl_icon_type!' => 'none',
                    'counter_layout!' => 'layout-7',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-icon i, {{WRAPPER}} .hq-counter-icon svg, {{WRAPPER}} .hq-counter-icon img' => 'transform: rotate( {{SIZE}}deg );',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'counter_icon_border',
                'label'       => esc_html__( 'Border', 'edumentor' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .hq-counter-icon',
                'condition'   => [
                    'dl_icon_type!' => 'none',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'counter_icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'dl_icon_type!' => 'none',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_padding',
            [
                'label'       => esc_html__( 'Padding', 'edumentor' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => ['px', '%'],
                'placeholder' => [
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                ],
                'selectors'   => [
                    '{{WRAPPER}} .hq-counter-icon' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
                'condition'   => [
                    'dl_icon_type!' => 'none',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_margin',
            [
                'label'       => esc_html__( 'Margin', 'edumentor' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => ['px', '%'],
                'placeholder' => [
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                ],
                'selectors'   => [
                    '{{WRAPPER}} .hq-counter-icon-wrap' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
                'condition'   => [
                    'dl_icon_type!' => 'none',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'icon_divider_heading',
            [
                'label'     => esc_html__( 'Icon Divider', 'edumentor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'icon_divider_type',
            [
                'label'     => esc_html__( 'Divider Type', 'edumentor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'solid',
                'options'   => [
                    'solid'  => esc_html__( 'Solid', 'edumentor' ),
                    'double' => esc_html__( 'Double', 'edumentor' ),
                    'dotted' => esc_html__( 'Dotted', 'edumentor' ),
                    'dashed' => esc_html__( 'Dashed', 'edumentor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-counter-icon-divider' => 'border-bottom-style: {{VALUE}}',
                ],
                'condition' => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_divider_height',
            [
                'label'      => esc_html__( 'Height', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 2,
                ],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 20,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-icon-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_divider_width',
            [
                'label'      => esc_html__( 'Width', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 30,
                ],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-icon-divider' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'icon_divider_color',
            [
                'label'     => esc_html__( 'Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hq-counter-icon-divider' => 'border-bottom-color: {{VALUE}}',
                ],
                'condition' => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_divider_margin',
            [
                'label'      => esc_html__( 'Spacing', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 30,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-icon-divider-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Number Style
     *
     * @return void
     */
    protected function number_style() {

        $this->start_controls_section(
            'section_counter_num_style',
            [
                'label' => esc_html__( 'Number', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_num_color',
            [
                'label'     => esc_html__( 'Number Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hq-counter:not(.hq-counter-layout-7) .hq-counter-number' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hq-counter-layout-7 .hq-counter-number,{{WRAPPER}} .hq-counter-layout-7 .hq-counter-number-wrap .hq-counter-number-prefix, {{WRAPPER}} .hq-counter-layout-7 .hq-counter-number-wrap .hq-counter-number-suffix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'counter_num_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-counter:not(.hq-counter-layout-7) .hq-counter-number-wrap .hq-counter-number, {{WRAPPER}} .hq-counter-layout-7 .hq-counter-number,{{WRAPPER}} .hq-counter-layout-7 .hq-counter-number-wrap .hq-counter-number-prefix, {{WRAPPER}} .hq-counter-layout-7 .hq-counter-number-wrap .hq-counter-number-suffix',
            ]
        );

        $this->add_responsive_control(
            'counter_number_wrap_with',
            [
                'label'      => esc_html__( 'Width', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 200
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-layout-7' => 'grid-template-columns: {{SIZE}}{{UNIT}} 1fr;',
                ],
                'condition'    => [
                    'counter_layout' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_number_space_between',
            [
                'label'      => esc_html__( 'Space Between', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-layout-7' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'counter_layout' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_num_margin',
            [
                'label'       => esc_html__( 'Margin', 'edumentor' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => ['px', '%'],
                'placeholder' => [
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                ],
                'selectors'   => [
                    '{{WRAPPER}} .hq-counter-number-wrap' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'num_divider_heading',
            [
                'label'     => esc_html__( 'Number Divider', 'edumentor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'num_divider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'num_divider_type',
            [
                'label'     => esc_html__( 'Divider Type', 'edumentor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'solid',
                'options'   => [
                    'solid'  => esc_html__( 'Solid', 'edumentor' ),
                    'double' => esc_html__( 'Double', 'edumentor' ),
                    'dotted' => esc_html__( 'Dotted', 'edumentor' ),
                    'dashed' => esc_html__( 'Dashed', 'edumentor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-counter-num-divider' => 'border-bottom-style: {{VALUE}}',
                ],
                'condition' => [
                    'num_divider' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'num_divider_height',
            [
                'label'      => esc_html__( 'Height', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 2,
                ],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 20,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-num-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'num_divider' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'num_divider_width',
            [
                'label'      => esc_html__( 'Width', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 30,
                ],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-num-divider' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'num_divider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'num_divider_color',
            [
                'label'     => esc_html__( 'Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hq-counter-num-divider' => 'border-bottom-color: {{VALUE}}',
                ],
                'condition' => [
                    'num_divider' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'num_divider_margin',
            [
                'label'      => esc_html__( 'Spacing', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 30,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-counter-num-divider-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'num_divider' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Prefix Style
     *
     * @return void
     */
    protected function prefix_style() {

        $this->start_controls_section(
            'section_number_prefix_style',
            [
                'label'     => esc_html__( 'Prefix', 'edumentor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'number_prefix!' => '',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'number_prefix_color',
            [
                'label'     => esc_html__( 'Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hq-counter-number-prefix' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'number_prefix!' => '',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'number_prefix_typography',
                'label'     => esc_html__( 'Typography', 'edumentor' ),
                'selector'  => '{{WRAPPER}} .hq-counter-number-prefix',
                'condition' => [
                    'number_prefix!' => '',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Suffix Style
     *
     * @return void
     */
    protected function suffix_style() {

        $this->start_controls_section(
            'section_number_suffix_style',
            [
                'label'     => esc_html__( 'Suffix', 'edumentor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'number_suffix!' => '',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_control(
            'section_number_suffix_color',
            [
                'label'     => esc_html__( 'Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hq-counter-number-suffix' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'number_suffix!' => '',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'section_number_suffix_typography',
                'label'     => esc_html__( 'Typography', 'edumentor' ),
                'selector'  => '{{WRAPPER}} .hq-counter-number-suffix',
                'condition' => [
                    'number_suffix!' => '',
                    'counter_layout!' => 'layout-7',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Title Style
     *
     * @return void
     */
    protected function title_style() {

        $this->start_controls_section(
            'section_counter_title_style',
            [
                'label'     => esc_html__( 'Title', 'edumentor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'counter_title!' => '',
                ],
            ]
        );

        $this->add_control(
            'counter_title_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hq-counter-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'counter_title!' => '',
                ],
            ]
        );

        $this->add_control(
            'counter_title_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hq-counter-title' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'counter_title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'counter_title_typography',
                'label'     => esc_html__( 'Typography', 'edumentor' ),
                'selector'  => '{{WRAPPER}} .hq-counter-title',
                'condition' => [
                    'counter_title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'title_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-counter-layout-7 .hq-icon-title-wrap',
                'condition'    => [
                    'counter_layout' => 'layout-7',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_title_margin',
            [
                'label'       => esc_html__( 'Margin', 'edumentor' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => ['px', '%'],
                'placeholder' => [
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                ],
                'selectors'   => [
                    '{{WRAPPER}} .hq-counter-title' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
                'condition'   => [
                    'counter_title!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_title_padding',
            [
                'label'       => esc_html__( 'Padding', 'edumentor' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => ['px', '%'],
                'placeholder' => [
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                ],
                'selectors'   => [
                    '{{WRAPPER}} .hq-counter-title' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
                'condition'   => [
                    'counter_title!' => '',
                ],
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
        
        $this->add_render_attribute( 'counter', 'class', 'hq-counter hq-counter-'.esc_attr( $this->get_id() ) );
        
        if ( $settings['counter_layout'] ) {
            $this->add_render_attribute( 'counter', 'class', 'hq-counter-' . $settings['counter_layout'] );
        }
        
        $this->add_render_attribute( 'counter', 'data-target', '.hq-counter-number-'.esc_attr( $this->get_id() ) );
        
        $this->add_render_attribute( 'counter-number', 'class', 'hq-counter-number hq-counter-number-'.esc_attr( $this->get_id() ) );
        
        if ( $settings['ending_number'] != '' ) {
            $this->add_render_attribute( 'counter-number', 'data-to', $settings['ending_number'] );
        }
        
        if ( $settings['counter_speed']['size'] != '' ) {
            $this->add_render_attribute( 'counter-number', 'data-speed', $settings['counter_speed']['size'] );
        }
        
        $this->add_inline_editing_attributes( 'counter_title', 'none' );
        $this->add_render_attribute( 'counter_title', 'class', 'hq-counter-title' );
        ?>
        <div class="hq-counter-container">
            <div <?php echo $this->get_render_attribute_string( 'counter' ); ?>>
                <?php if ( $settings['counter_layout'] == 'layout-1' || $settings['counter_layout'] == 'layout-5' || $settings['counter_layout'] == 'layout-6' ) { ?>
                    <?php
                        // Counter icon
                        $this->render_icon();
                    ?>
                
                    <div class="hq-counter-number-title-wrap">
                        <div class="hq-counter-number-wrap">
                            <?php
                                if ( $settings['number_prefix'] != '' ) {
                                    printf( '<span class="hq-counter-number-prefix">%1$s</span>', $settings['number_prefix'] );
                                }
                            ?>
                            <div <?php echo $this->get_render_attribute_string( 'counter-number' ); ?>>
                                0
                            </div>
                            <?php
                                if ( $settings['number_suffix'] != '' ) {
                                    printf( '<span class="hq-counter-number-suffix">%1$s</span>', $settings['number_suffix'] );
                                }
                            ?>
                        </div>

                        <?php if ( $settings['num_divider'] == 'yes' ) { ?>
                            <div class="hq-counter-num-divider-wrap">
                                <span class="hq-counter-num-divider"></span>
                            </div>
                        <?php } ?>

                        <?php
                            if ( !empty( $settings['counter_title'] ) ) {
                                printf( '<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string( 'counter_title' ) );
                                    echo Helper::kses_basic( $settings['counter_title'] );
                                printf( '</%1$s>', $settings['title_html_tag'] );
                            }
                        ?>
                    </div>
                <?php } elseif ( $settings['counter_layout'] == 'layout-2' ) { ?>
                    <?php
                        // Counter icon
                        $this->render_icon();

                        if ( !empty( $settings['counter_title'] ) ) {
                            printf( '<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string( 'counter_title' ) );
                                echo Helper::kses_basic( $settings['counter_title'] );
                            printf( '</%1$s>', $settings['title_html_tag'] );
                        }
                    ?>
                
                    <div class="hq-counter-number-wrap">
                        <?php
                            if ( $settings['number_prefix'] != '' ) {
                                printf( '<span class="hq-counter-number-prefix">%1$s</span>', $settings['number_prefix'] );
                            }
                        ?>
                        <div <?php echo $this->get_render_attribute_string( 'counter-number' ); ?>>
                            0
                        </div>
                        <?php
                            if ( $settings['number_suffix'] != '' ) {
                                printf( '<span class="hq-counter-number-suffix">%1$s</span>', $settings['number_suffix'] );
                            }
                        ?>
                    </div>

                    <?php if ( $settings['num_divider'] == 'yes' ) { ?>
                        <div class="hq-counter-num-divider-wrap">
                            <span class="hq-counter-num-divider"></span>
                        </div>
                    <?php } ?>
                <?php } elseif ( $settings['counter_layout'] == 'layout-3' ) { ?>
                    <div class="hq-counter-number-wrap">
                        <?php
                            if ( $settings['number_prefix'] != '' ) {
                                printf( '<span class="hq-counter-number-prefix">%1$s</span>', $settings['number_prefix'] );
                            }
                        ?>
                        <div <?php echo $this->get_render_attribute_string( 'counter-number' ); ?>>
                            0
                        </div>
                        <?php
                            if ( $settings['number_suffix'] != '' ) {
                                printf( '<span class="hq-counter-number-suffix">%1$s</span>', $settings['number_suffix'] );
                            }
                        ?>
                    </div>

                    <?php if ( $settings['num_divider'] == 'yes' ) { ?>
                        <div class="hq-counter-num-divider-wrap">
                            <span class="hq-counter-num-divider"></span>
                        </div>
                    <?php } ?>
                
                    <div class="hq-icon-title-wrap">
                        <?php
                            // Counter icon
                            $this->render_icon();

                            if ( !empty( $settings['counter_title'] ) ) {
                                printf( '<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string( 'counter_title' ) );
                                    echo Helper::kses_basic( $settings['counter_title'] );
                                printf( '</%1$s>', $settings['title_html_tag'] );
                            }
                        ?>
                    </div>
                <?php } elseif ( $settings['counter_layout'] == 'layout-4' ) { ?>
                    <div class="hq-icon-title-wrap">
                        <?php
                            // Counter icon
                            $this->render_icon();

                            if ( !empty( $settings['counter_title'] ) ) {
                                printf( '<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string( 'counter_title' ) );
                                    echo Helper::kses_basic( $settings['counter_title'] );
                                printf( '</%1$s>', $settings['title_html_tag'] );
                            }
                        ?>
                    </div>
                
                    <div class="hq-counter-number-wrap">
                        <?php
                            if ( $settings['number_prefix'] != '' ) {
                                printf( '<span class="hq-counter-number-prefix">%1$s</span>', $settings['number_prefix'] );
                            }
                        ?>
                        <div <?php echo $this->get_render_attribute_string( 'counter-number' ); ?>>
                            0
                        </div>
                        <?php
                            if ( $settings['number_suffix'] != '' ) {
                                printf( '<span class="hq-counter-number-suffix">%1$s</span>', $settings['number_suffix'] );
                            }
                        ?>
                    </div>

                    <?php if ( $settings['num_divider'] == 'yes' ) { ?>
                        <div class="hq-counter-num-divider-wrap">
                            <span class="hq-counter-num-divider"></span>
                        </div>
                    <?php } ?>
                <?php } elseif( $settings['counter_layout'] == 'layout-7' ){ ?>

                    <div class="hq-counter-number-wrap">
                        <?php
                            if ( $settings['number_prefix'] != '' ) {
                                printf( '<span class="hq-counter-number-prefix">%1$s</span>', $settings['number_prefix'] );
                            }
                        ?>
                        <div <?php echo $this->get_render_attribute_string( 'counter-number' ); ?>>
                            0
                        </div>
                        <?php
                            if ( $settings['number_suffix'] != '' ) {
                                printf( '<span class="hq-counter-number-suffix">%1$s</span>', $settings['number_suffix'] );
                            }
                        ?>
                    </div>

                    <div class="hq-icon-title-wrap">
                        <?php
                            if ( !empty( $settings['counter_title'] ) ) {
                                printf( '<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string( 'counter_title' ) );
                                    echo Helper::kses_basic( $settings['counter_title'] );
                                printf( '</%1$s>', $settings['title_html_tag'] );
                            }
                        ?>
                    </div>
                    
                <?php } ?>
            </div>
        </div><!-- .hq-counter-container -->
        <?php
    }

    /**
	 * Render counter icon output on the frontend.
     */
    private function render_icon() {
        $settings = $this->get_settings_for_display();
        
        if ( $settings['dl_icon_type'] == 'icon' ) {
            if ( ! empty( $settings['icon'] ) ) {
                $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
            }
            $migrated = isset( $settings['__fa4_migrated']['counter_icon'] );
		    $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
            if ( !empty( $settings['counter_icon'] ) ) { ?>
                <span class="hq-counter-icon-wrap">
                    <span class="hq-counter-icon">
                    <?php if ( $is_new || $migrated ) :
                        Icons_Manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true' ] );
                    else : ?>
                        <span <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
                    <?php endif; ?>
                    </span>
                </span>
            <?php }
        } elseif ( $settings['dl_icon_type'] == 'image' ) {
            $image = $settings['icon_image'];
            if ( $image['url'] ) {
            ?>
                <span class="hq-counter-icon-wrap">
                    <span class="hq-counter-icon hq-counter-icon-img">
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true)); ?>">
                    </span>
                </span>
            <?php }
        }

        if ( $settings['icon_divider'] == 'yes' ) {
            if ( $settings['counter_layout'] == 'layout-1' || $settings['counter_layout'] == 'layout-2' ) { ?>
                <div class="hq-counter-icon-divider-wrap">
                    <span class="hq-counter-icon-divider"></span>
                </div>
                <?php
            }
        }
    }

}