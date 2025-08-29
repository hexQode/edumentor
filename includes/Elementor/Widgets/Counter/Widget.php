<?php
/**
 * Counter
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\Counter;

use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

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
        return 'flatpack-counter';
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
        return esc_html__( 'Counter', 'flatpack' );
    }

    public function get_custom_help_url() {
        return 'https://flatpack.com';
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
        return 'fq-icon eicon-number-field';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'counter', 'funfact', 'count', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'fp-counter', 'odometer' ];
    }

    public function get_script_depends() {
        return [ 'flatpack-el-script', 'odometer', 'elementor-waypoints' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->counter_section();
        $this->dividers_section();
        $this->settings_section();
        $this->counter_style();
        $this->icon_style();
        $this->number_style();
        $this->prefix_style();
        $this->suffix_style();
        $this->title_style();
        
    }

    /**
     * Counter Section
     *
     * @return void
     */
    protected function counter_section() {

        $this->start_controls_section(
			'counter_section',
			[
				'label' => esc_html__( 'Counter', 'flatpack' )
			]
        );

        $this->add_control(
			'dl_icon_type',
			[
				'label'                 => esc_html__( 'Icon Type', 'flatpack' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'options'               => [
					'none'        => [
						'title'   => esc_html__( 'None', 'flatpack' ),
						'icon'    => 'eicon-ban',
					],
					'icon'        => [
						'title'   => esc_html__( 'Icon', 'flatpack' ),
						'icon'    => 'eicon-info-circle',
					],
					'image'       => [
						'title'   => esc_html__( 'Image', 'flatpack' ),
						'icon'    => 'eicon-image',
					],
				],
				'default'               => 'none',
			]
		);

        $this->add_control(
			'counter_icon',
			[
				'label' => esc_html__( 'Icon', 'flatpack' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
                ],
                'fa4compatibility' => 'icon',
                'condition'             => [
                    'dl_icon_type'  => 'icon',
                ],
			]
		);
        
        $this->add_control(
            'icon_image',
            [
                'label'                 => esc_html__( 'Image', 'flatpack' ),
                'type'                  => Controls_Manager::MEDIA,
                'default'               => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
				'condition'             => [
					'dl_icon_type'  => 'image',
				],
            ]
        );
        
        $this->add_control(
            'ending_number',
            [
                'label'                 => esc_html__( 'Number', 'flatpack' ),
                'type'                  => Controls_Manager::NUMBER,
				'dynamic'               => [
					'active'   => true,
				],
                'default'               => esc_html__( '250', 'flatpack' ),
                'separator'             => 'before',
            ]
        );
        
        $this->add_control(
            'number_prefix',
            [
                'label'                 => esc_html__( 'Number Prefix', 'flatpack' ),
                'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
            ]
        );
        
        $this->add_control(
            'number_suffix',
            [
                'label'                 => esc_html__( 'Number Suffix', 'flatpack' ),
                'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
            ]
        );

        $this->add_control(
            'counter_title',
            [
                'label'                 => esc_html__( 'Title', 'flatpack' ),
                'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
                'default'               => esc_html__( 'Counter Title', 'flatpack' ),
                'separator'             => 'before',
            ]
        );
        
        $this->add_control(
            'title_html_tag',
            [
                'label'                => esc_html__( 'Title HTML Tag', 'flatpack' ),
                'type'                 => Controls_Manager::SELECT,
                'default'              => 'div',
                'options'              => [
                    'h1'     => esc_html__( 'H1', 'flatpack' ),
                    'h2'     => esc_html__( 'H2', 'flatpack' ),
                    'h3'     => esc_html__( 'H3', 'flatpack' ),
                    'h4'     => esc_html__( 'H4', 'flatpack' ),
                    'h5'     => esc_html__( 'H5', 'flatpack' ),
                    'h6'     => esc_html__( 'H6', 'flatpack' ),
                    'div'    => esc_html__( 'div', 'flatpack' ),
                    'span'   => esc_html__( 'span', 'flatpack' ),
                    'p'      => esc_html__( 'p', 'flatpack' ),
                ],
            ]
        );

        $this->add_control(
            'counter_layout',
            [
                'label'                => esc_html__('Layout', 'flatpack'),
                'type'                 => Controls_Manager::SELECT,
                'default'              => 'layout-1',
                'options'              => [
                    'layout-1'     => esc_html__('Layout 1', 'flatpack'),
                    'layout-2'     => esc_html__('Layout 2', 'flatpack'),
                    'layout-3'     => esc_html__('Layout 3', 'flatpack'),
                    'layout-4'     => esc_html__('Layout 4', 'flatpack'),
                    'layout-5'     => esc_html__('Layout 5', 'flatpack'),
                    'layout-6'     => esc_html__('Layout 6', 'flatpack'),
                ],
                'separator' => 'before'
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Dividers Section
     *
     * @return void
     */
    protected function dividers_section() {

        $this->start_controls_section(
			'dividers_section',
			[
				'label' => esc_html__( 'Dividers', 'flatpack' )
			]
        );

        $this->add_control(
            'icon_divider',
            [
                'label'                 => esc_html__( 'Icon Divider', 'flatpack' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => esc_html__( 'On', 'flatpack' ),
                'label_off'             => esc_html__( 'Off', 'flatpack' ),
                'return_value'          => 'yes',
                'condition'             => [
                    'dl_icon_type!' => 'none'
                ]
            ]
        );
        
        $this->add_control(
            'num_divider',
            [
                'label'                 => esc_html__( 'Number Divider', 'flatpack' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => esc_html__( 'On', 'flatpack' ),
                'label_off'             => esc_html__( 'Off', 'flatpack' ),
                'return_value'          => 'yes'
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Settings Section
     *
     * @return void
     */
    protected function settings_section() {

        $this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'flatpack' )
			]
        );

        $this->add_responsive_control(
            'counter_speed',
            [
                'label'                 => esc_html__( 'Counting Speed', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 1500 ],
                'range'                 => [
                    'px' => [
                        'min'   => 100,
                        'max'   => 2000,
                        'step'  => 1
                    ],
                ],
                'size_units'            => ''
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Counter style
     *
     * @return void
     */
    protected function counter_style() {

        $this->start_controls_section(
            'counter_style',
            [
                'label' => esc_html__( 'Counter', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_responsive_control(
			'counter_align',
			[
				'label'                 => esc_html__( 'Alignment', 'flatpack' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'left'      => [
						'title' => esc_html__( 'Left', 'flatpack' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'    => [
						'title' => esc_html__( 'Center', 'flatpack' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'     => [
						'title' => esc_html__( 'Right', 'flatpack' ),
						'icon'  => 'eicon-text-align-right',
					]
				],
				'default'               => 'center',
                'prefix_class' => 'counter-',
				'selectors'             => [
					'{{WRAPPER}} .fp-counter-container'   => 'text-align: {{VALUE}};'
				]
			]
		);
        
        $this->end_controls_section();

    }

    /**
     * Icon style
     *
     * @return void
     */
    protected function icon_style() {

        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'counter_icon_bg',
                'label'                 => esc_html__( 'Background', 'flatpack' ),
                'types'                 => [ 'none','classic','gradient' ],
                'condition'             => [
                    'dl_icon_type!' => 'none',
                ],
                'selector'              => '{{WRAPPER}} .fp-counter-icon',
            ]
        );

        $this->add_control(
            'counter_icon_color',
            [
                'label'                 => esc_html__( 'Color', 'flatpack' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-icon' => 'color: {{VALUE}};',
                ],
                'condition'             => [
                    'dl_icon_type'  => 'icon',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'counter_icon_size',
            [
                'label'                 => esc_html__( 'Size', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 5,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em' ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .fp-counter-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                ],
                'condition'             => [
                    'dl_icon_type'  => 'icon',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'counter_icon_img_width',
            [
                'label'                 => esc_html__( 'Image Width', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 10,
                        'max'   => 500,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px', '%'],
                'condition'             => [
                    'dl_icon_type'  => 'image',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'counter_icon_rotation',
            [
                'label'                 => esc_html__( 'Rotation', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 360,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'condition'             => [
                    'dl_icon_type!' => 'none',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-icon i, {{WRAPPER}} .fp-counter-icon svg, {{WRAPPER}} .fp-counter-icon img' => 'transform: rotate( {{SIZE}}deg );',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'counter_icon_border',
				'label'                 => esc_html__( 'Border', 'flatpack' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .fp-counter-icon',
                'condition'             => [
                    'dl_icon_type!' => 'none',
                ],
			]
		);

		$this->add_control(
			'counter_icon_border_radius',
			[
				'label'                 => esc_html__( 'Border Radius', 'flatpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .fp-counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'             => [
                    'dl_icon_type!' => 'none',
                ],
			]
		);

		$this->add_responsive_control(
			'counter_icon_padding',
			[
				'label'                 => esc_html__( 'Padding', 'flatpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'           => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'             => [
					'{{WRAPPER}} .fp-counter-icon' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
				],
                'condition'             => [
                    'dl_icon_type!' => 'none',
                ],
			]
		);

		$this->add_responsive_control(
			'counter_icon_margin',
			[
				'label'                 => esc_html__( 'Margin', 'flatpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'           => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'             => [
					'{{WRAPPER}} .fp-counter-icon-wrap' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
                'condition'             => [
                    'dl_icon_type!' => 'none',
                ],
			]
		);
        
        $this->add_control(
            'icon_divider_heading',
            [
                'label'                 => esc_html__( 'Icon Divider', 'flatpack' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'icon_divider_type',
            [
            'label'                     => esc_html__( 'Divider Type', 'flatpack' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'solid',
                'options'               => [
                    'solid'     => esc_html__( 'Solid', 'flatpack' ),
                    'double'    => esc_html__( 'Double', 'flatpack' ),
                    'dotted'    => esc_html__( 'Dotted', 'flatpack' ),
                    'dashed'    => esc_html__( 'Dashed', 'flatpack' ),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-icon-divider' => 'border-bottom-style: {{VALUE}}',
                ],
                'condition'             => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_divider_height',
            [
                'label'                 => esc_html__( 'Height', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'  => 2,
                ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 20,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-icon-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_divider_width',
            [
                'label'                 => esc_html__( 'Width', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'  => 30,
                ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 1000,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 1,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-icon-divider' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_divider_color',
            [
                'label'                 => esc_html__( 'Color', 'flatpack' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-icon-divider' => 'border-bottom-color: {{VALUE}}',
                ],
                'condition'             => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_divider_margin',
            [
                'label'                 => esc_html__( 'Spacing', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-icon-divider-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'dl_icon_type!' => 'none',
                    'icon_divider'  => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Number style
     *
     * @return void
     */
    protected function number_style() {

        $this->start_controls_section(
            'number_style',
            [
                'label' => esc_html__( 'Number', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'counter_num_color',
            [
                'label'                 => esc_html__( 'Number Color', 'flatpack' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-number' => 'color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'counter_num_typography',
                'label'                 => esc_html__( 'Typography', 'flatpack' ),
                'selector'              => '{{WRAPPER}} .fp-counter-number-wrap .fp-counter-number'
            ]
        );

		$this->add_responsive_control(
			'counter_num_margin',
			[
				'label'                 => esc_html__( 'Margin', 'flatpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'           => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => ''
				],
				'selectors'             => [
					'{{WRAPPER}} .fp-counter-number-wrap' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				]
			]
		);
        
        $this->add_control(
            'num_divider_heading',
            [
                'label'                 => esc_html__( 'Number Divider', 'flatpack' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
                    'num_divider'  => 'yes'
                ]
            ]
        );
        
        $this->add_control(
            'num_divider_type',
            [
                'label'                 => esc_html__( 'Divider Type', 'flatpack' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'solid',
                'options'               => [
                    'solid'     => esc_html__( 'Solid', 'flatpack' ),
                    'double'    => esc_html__( 'Double', 'flatpack' ),
                    'dotted'    => esc_html__( 'Dotted', 'flatpack' ),
                    'dashed'    => esc_html__( 'Dashed', 'flatpack' ),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-num-divider' => 'border-bottom-style: {{VALUE}}',
                ],
                'condition'             => [
                    'num_divider'  => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'num_divider_height',
            [
                'label'                 => esc_html__( 'Height', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'  => 2,
                ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 20,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-num-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'num_divider'  => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'num_divider_width',
            [
                'label'                 => esc_html__( 'Width', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'  => 30,
                ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 1000,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 1,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-num-divider' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'num_divider'  => 'yes'
                ]
            ]
        );

        $this->add_control(
            'num_divider_color',
            [
                'label'                 => esc_html__( 'Color', 'flatpack' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-num-divider' => 'border-bottom-color: {{VALUE}}',
                ],
                'condition'             => [
                    'num_divider'  => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'num_divider_margin',
            [
                'label'                 => esc_html__( 'Spacing', 'flatpack' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-num-divider-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'num_divider'  => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Prefix style
     *
     * @return void
     */
    protected function prefix_style() {

        $this->start_controls_section(
            'prefix_style',
            [
                'label' => esc_html__( 'Prefix', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'number_prefix!' => ''
                ]
            ]
        );

        $this->add_control(
            'number_prefix_color',
            [
                'label'                 => esc_html__( 'Color', 'flatpack' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-number-prefix' => 'color: {{VALUE}};',
                ],
                'condition'             => [
                    'number_prefix!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'number_prefix_typography',
                'label'                 => esc_html__( 'Typography', 'flatpack' ),
                'selector'              => '{{WRAPPER}} .fp-counter-number-prefix',
                'condition'             => [
                    'number_prefix!' => ''
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Suffix style
     *
     * @return void
     */
    protected function suffix_style() {

        $this->start_controls_section(
            'suffix_style',
            [
                'label' => esc_html__( 'Suffix', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'number_suffix!' => ''
                ]
            ]
        );

        $this->add_control(
            'section_number_suffix_color',
            [
                'label'                 => esc_html__( 'Color', 'flatpack' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-number-suffix' => 'color: {{VALUE}};',
                ],
                'condition'             => [
                    'number_suffix!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'section_number_suffix_typography',
                'label'                 => esc_html__( 'Typography', 'flatpack' ),
                'selector'              => '{{WRAPPER}} .fp-counter-number-suffix',
                'condition'             => [
                    'number_suffix!' => ''
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Title style
     *
     * @return void
     */
    protected function title_style() {

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'counter_title!' => ''
                ]
            ]
        );

        $this->add_control(
            'counter_title_color',
            [
                'label'                 => esc_html__( 'Text Color', 'flatpack' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-title' => 'color: {{VALUE}};',
                ],
                'condition'             => [
                    'counter_title!' => ''
                ]
            ]
        );

        $this->add_control(
            'counter_title_bg_color',
            [
                'label'                 => esc_html__( 'Background Color', 'flatpack' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .fp-counter-title' => 'background-color: {{VALUE}};',
                ],
                'condition'             => [
                    'counter_title!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'counter_title_typography',
                'label'                 => esc_html__( 'Typography', 'flatpack' ),
                'selector'              => '{{WRAPPER}} .fp-counter-title',
                'condition'             => [
                    'counter_title!' => ''
                ]
            ]
        );

		$this->add_responsive_control(
			'counter_title_margin',
			[
				'label'                 => esc_html__( 'Margin', 'flatpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'           => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => ''
				],
				'selectors'             => [
					'{{WRAPPER}} .fp-counter-title' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
                'condition'             => [
                    'counter_title!' => ''
                ]
			]
		);

		$this->add_responsive_control(
			'counter_title_padding',
			[
				'label'                 => esc_html__( 'Padding', 'flatpack' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'           => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => ''
				],
				'selectors'             => [
					'{{WRAPPER}} .fp-counter-title' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
				],
                'condition'             => [
                    'counter_title!' => ''
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
        
        $this->add_render_attribute( 'counter', 'class', 'fp-counter fp-counter-'.esc_attr( $this->get_id() ) );
        
        if ( $settings['counter_layout'] ) {
            $this->add_render_attribute( 'counter', 'class', 'fp-counter-' . $settings['counter_layout'] );
        }
        
        $this->add_render_attribute( 'counter', 'data-target', '.fp-counter-number-'.esc_attr( $this->get_id() ) );
        
        $this->add_render_attribute( 'counter-number', 'class', 'fp-counter-number fp-counter-number-'.esc_attr( $this->get_id() ) );
        
        if ( $settings['ending_number'] != '' ) {
            $this->add_render_attribute( 'counter-number', 'data-to', $settings['ending_number'] );
        }
        
        if ( $settings['counter_speed']['size'] != '' ) {
            $this->add_render_attribute( 'counter-number', 'data-speed', $settings['counter_speed']['size'] );
        }
        
        $this->add_inline_editing_attributes( 'counter_title', 'none' );
        $this->add_render_attribute( 'counter_title', 'class', 'fp-counter-title' );
        ?>
        <div class="fp-counter-container">
            <div <?php echo $this->get_render_attribute_string( 'counter' ); ?>>
                <?php if ( $settings['counter_layout'] == 'layout-1' || $settings['counter_layout'] == 'layout-5' || $settings['counter_layout'] == 'layout-6' ) { ?>
                    <?php
                        // Counter icon
                        $this->render_icon();
                    ?>
                
                    <div class="fp-counter-number-title-wrap">
                        <div class="fp-counter-number-wrap">
                            <?php
                                if ( $settings['number_prefix'] != '' ) {
                                    printf( '<span class="fp-counter-number-prefix">%1$s</span>', $settings['number_prefix'] );
                                }
                            ?>
                            <div <?php echo $this->get_render_attribute_string( 'counter-number' ); ?>>
                                0
                            </div>
                            <?php
                                if ( $settings['number_suffix'] != '' ) {
                                    printf( '<span class="fp-counter-number-suffix">%1$s</span>', $settings['number_suffix'] );
                                }
                            ?>
                        </div>

                        <?php if ( $settings['num_divider'] == 'yes' ) { ?>
                            <div class="fp-counter-num-divider-wrap">
                                <span class="fp-counter-num-divider"></span>
                            </div>
                        <?php } ?>

                        <?php
                            if ( !empty( $settings['counter_title'] ) ) {
                                printf( '<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string( 'counter_title' ) );
                                    echo $settings['counter_title'];
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
                                echo $settings['counter_title'];
                            printf( '</%1$s>', $settings['title_html_tag'] );
                        }
                    ?>
                
                    <div class="fp-counter-number-wrap">
                        <?php
                            if ( $settings['number_prefix'] != '' ) {
                                printf( '<span class="fp-counter-number-prefix">%1$s</span>', $settings['number_prefix'] );
                            }
                        ?>
                        <div <?php echo $this->get_render_attribute_string( 'counter-number' ); ?>>
                            0
                        </div>
                        <?php
                            if ( $settings['number_suffix'] != '' ) {
                                printf( '<span class="fp-counter-number-suffix">%1$s</span>', $settings['number_suffix'] );
                            }
                        ?>
                    </div>

                    <?php if ( $settings['num_divider'] == 'yes' ) { ?>
                        <div class="fp-counter-num-divider-wrap">
                            <span class="fp-counter-num-divider"></span>
                        </div>
                    <?php } ?>
                <?php } elseif ( $settings['counter_layout'] == 'layout-3' ) { ?>
                    <div class="fp-counter-number-wrap">
                        <?php
                            if ( $settings['number_prefix'] != '' ) {
                                printf( '<span class="fp-counter-number-prefix">%1$s</span>', $settings['number_prefix'] );
                            }
                        ?>
                        <div <?php echo $this->get_render_attribute_string( 'counter-number' ); ?>>
                            0
                        </div>
                        <?php
                            if ( $settings['number_suffix'] != '' ) {
                                printf( '<span class="fp-counter-number-suffix">%1$s</span>', $settings['number_suffix'] );
                            }
                        ?>
                    </div>

                    <?php if ( $settings['num_divider'] == 'yes' ) { ?>
                        <div class="fp-counter-num-divider-wrap">
                            <span class="fp-counter-num-divider"></span>
                        </div>
                    <?php } ?>
                
                    <div class="fp-icon-title-wrap">
                        <?php
                            // Counter icon
                            $this->render_icon();

                            if ( !empty( $settings['counter_title'] ) ) {
                                printf( '<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string( 'counter_title' ) );
                                    echo $settings['counter_title'];
                                printf( '</%1$s>', $settings['title_html_tag'] );
                            }
                        ?>
                    </div>
                <?php } elseif ( $settings['counter_layout'] == 'layout-4' ) { ?>
                    <div class="fp-icon-title-wrap">
                        <?php
                            // Counter icon
                            $this->render_icon();

                            if ( !empty( $settings['counter_title'] ) ) {
                                printf( '<%1$s %2$s>', $settings['title_html_tag'], $this->get_render_attribute_string( 'counter_title' ) );
                                    echo $settings['counter_title'];
                                printf( '</%1$s>', $settings['title_html_tag'] );
                            }
                        ?>
                    </div>
                
                    <div class="fp-counter-number-wrap">
                        <?php
                            if ( $settings['number_prefix'] != '' ) {
                                printf( '<span class="fp-counter-number-prefix">%1$s</span>', $settings['number_prefix'] );
                            }
                        ?>
                        <div <?php echo $this->get_render_attribute_string( 'counter-number' ); ?>>
                            0
                        </div>
                        <?php
                            if ( $settings['number_suffix'] != '' ) {
                                printf( '<span class="fp-counter-number-suffix">%1$s</span>', $settings['number_suffix'] );
                            }
                        ?>
                    </div>

                    <?php if ( $settings['num_divider'] == 'yes' ) { ?>
                        <div class="fp-counter-num-divider-wrap">
                            <span class="fp-counter-num-divider"></span>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div><!-- .fp-counter-container -->
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
                <span class="fp-counter-icon-wrap">
                    <span class="fp-counter-icon">
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
                <span class="fp-counter-icon-wrap">
                    <span class="fp-counter-icon fp-counter-icon-img">
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true)); ?>">
                    </span>
                </span>
            <?php }
        }

        if ( $settings['icon_divider'] == 'yes' ) {
            if ( $settings['counter_layout'] == 'layout-1' || $settings['counter_layout'] == 'layout-2' ) { ?>
                <div class="fp-counter-icon-divider-wrap">
                    <span class="fp-counter-icon-divider"></span>
                </div>
                <?php
            }
        }
    }

    /**
	 * Render counter icon output in the editor.
	 */
    protected function _icon_template() {
        ?>
        <# if ( settings.dl_icon_type == 'icon' ) { #>
            <# if ( settings.counter_icon != '' ) { 
                
                var iconHTML = elementor.helpers.renderIcon( view, settings.counter_icon, { 'aria-hidden': true }, 'i' , 'object' ),
				migrated = elementor.helpers.isIconMigrated( settings, 'counter_icon' );
                #>
                <span class="fp-counter-icon-wrap">
                    <span class="fp-counter-icon">
                        <# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            <span class="{{ settings.icon }}" aria-hidden="true"></span>
                        <# } #>
                    </span>
                </span>
            <# } #>
        <# } else if ( settings.dl_icon_type == 'image' ) { #>
            <# if ( settings.icon_image.url != '' ) { #>
                <span class="fp-counter-icon-wrap">
                    <span class="fp-counter-icon fp-counter-icon-img">
                        <img src="{{ settings.icon_image.url }}">
                    </span>
                </span>
            <# } #>
        <# } #>

        <# if ( settings.icon_divider == 'yes' ) { #>
            <# if ( settings.counter_layout == 'layout-1' || settings.counter_layout == 'layout-2' ) { #>
                <div class="fp-counter-icon-divider-wrap">
                    <span class="fp-counter-icon-divider"></span>
                </div>
            <# } #>
        <# } #>
        <?php
    }

    /**
	 * Render counter number output in the editor.
	 */
    protected function _number_template() {
        ?>
        <div class="fp-counter-number-wrap">
            <#
                if ( settings.number_prefix != '' ) {
                    var prefix = settings.number_prefix;

                    view.addRenderAttribute( 'prefix', 'class', 'fp-counter-number-prefix' );

                    var prefix_html = '<span' + ' ' + view.getRenderAttributeString( 'prefix' ) + '>' + prefix + '</span>';

                    print( prefix_html );
                }
            #>
            <div class="fp-counter-number" data-to="{{ settings.ending_number }}" data-speed="{{ settings.counter_speed.size }}">
                0
            </div>
            <#
                if ( settings.number_suffix != '' ) {
                    var suffix = settings.number_suffix;

                    view.addRenderAttribute( 'suffix', 'class', 'fp-counter-number-suffix' );

                    var suffix_html = '<span' + ' ' + view.getRenderAttributeString( 'suffix' ) + '>' + suffix + '</span>';

                    print( suffix_html );
                }
            #>
        </div>
        <?php
    }

    /**
	 * Render counter title output in the editor.
	 */
    protected function _title_template() {
        ?>
        <#
            if ( settings.counter_title != '' ) {
                var title = settings.counter_title;

                view.addRenderAttribute( 'counter_title', 'class', 'fp-counter-title' );

                view.addInlineEditingAttributes( 'counter_title' );

                var title_html = '<' + settings.title_html_tag  + ' ' + view.getRenderAttributeString( 'counter_title' ) + '>' + title + '</' + settings.title_html_tag + '>';

                print( title_html );
            }
        #>
        <?php
    }

    /**
	 * Render counter widget output in the editor.
	 */
    protected function content_template() {
        ?>
        <div class="fp-counter-container">
            <div class="fp-counter fp-counter-{{ settings.counter_layout }}" data-target=".fp-counter-number">
                <# if ( settings.counter_layout == 'layout-1' || settings.counter_layout == 'layout-5' || settings.counter_layout == 'layout-6' ) { #>
                    <?php
                        // Counter icon
                        $this->_icon_template();
                    ?>
                
                    <div class="fp-counter-number-title-wrap">
                        <?php
                            // Counter number
                            $this->_number_template();
                        ?>

                        <# if ( settings.num_divider == 'yes' ) { #>
                            <div class="fp-counter-num-divider-wrap">
                                <span class="fp-counter-num-divider"></span>
                            </div>
                        <# } #>

                        <?php
                            // Title number
                            $this->_title_template();
                        ?>
                    </div>
                <# } else if ( settings.counter_layout == 'layout-2' ) { #>
                    <?php
                        // Counter icon
                        $this->_icon_template();
        
                        // Title number
                        $this->_title_template();
        
                        // Counter number
                        $this->_number_template();
                    ?>

                    <# if ( settings.num_divider == 'yes' ) { #>
                        <div class="fp-counter-num-divider-wrap">
                            <span class="fp-counter-num-divider"></span>
                        </div>
                    <# } #>
                <# } else if ( settings.counter_layout == 'layout-3' ) { #>
                    <?php
                        // Counter number
                        $this->_number_template();
                    ?>

                    <# if ( settings.num_divider == 'yes' ) { #>
                        <div class="fp-counter-num-divider-wrap">
                            <span class="fp-counter-num-divider"></span>
                        </div>
                    <# } #>
                
                    <div class="fp-icon-title-wrap">
                        <?php
                            // Counter icon
                            $this->_icon_template();
        
                            // Title number
                            $this->_title_template();
                        ?>
                    </div>
                <# } else if ( settings.counter_layout == 'layout-4' ) { #>
                    <div class="fp-icon-title-wrap">
                        <?php
                            // Counter icon
                            $this->_icon_template();

                            // Title number
                            $this->_title_template();
                        ?>
                    </div>
                
                    <?php
                        // Counter number
                        $this->_number_template();
                    ?>

                    <# if ( settings.num_divider == 'yes' ) { #>
                        <div class="fp-counter-num-divider-wrap">
                            <span class="fp-counter-num-divider"></span>
                        </div>
                    <# } #>
                <# } #>
            </div>
        </div>
        <?php
    }

}