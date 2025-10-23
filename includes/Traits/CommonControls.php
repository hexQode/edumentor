<?php
/**
 * Common Controls
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Traits;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use HexQode\EduMentor\Elementor\Controls\Foreground;

defined( 'ABSPATH' ) || die();

trait CommonControls{
    /**
	 * Button
	 *
	 * @return void
	 */
	protected function button_section() {

		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__( 'Button', 'edumentor' )
			]
		);

		$this->add_control(
			'button_effect',
			[
				'label' => esc_html__( 'Effect', 'textdomain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'hq-el-btn-default',
				'options' => [
					'hq-el-btn-default' => esc_html__( 'Default', 'textdomain' ),
					'hq-el-effect-1' => esc_html__( 'Effect 1', 'textdomain' ),
					'hq-el-effect-2' => esc_html__( 'Effect 2', 'textdomain' ),
					'hq-el-effect-3' => esc_html__( 'Effect 3', 'textdomain' )
				]
			]
		);

		$this->add_control(
			'btn_ouline',
			[
				'label' => esc_html__( 'Outline Style', 'textdomain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'textdomain' ),
				'label_off' => esc_html__( 'No', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'button_effect' => 'hq-el-btn-default'
				]
			]
		);

		$this->add_responsive_control(
			'btn_alignment',
			[
				'label' => esc_html__( 'Alignment', 'edumentor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'edumentor' ),
						'icon' => 'eicon-text-align-left'
					],
					'center' => [
						'title' => esc_html__( 'Center', 'edumentor' ),
						'icon' => 'eicon-text-align-center'
					],
					'right' => [
						'title' => esc_html__( 'Right', 'edumentor' ),
						'icon' => 'eicon-text-align-right'
					],
					'justify' => [
						'title' => esc_html__( 'Justify', 'edumentor' ),
						'icon' => 'eicon-text-align-justify'
					],
				],
				'default' => 'left',
				'toggle' => false,
				'selectors_dictionary' => [
					'left' => 'justify-content: flex-start',
					'center' => 'justify-content: center',
					'right' => 'justify-content: flex-end',
					'justify' => 'flex-direction: column; align-items: stretch',
				],
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn-wrap' => '{{VALUE}}'
				]
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'        => esc_html__( 'Button Text', 'edumentor' ),
				'type'         => Controls_Manager::TEXT,
				'label_block'  => true,
				'default'      => esc_html__( 'Explore More', 'edumentor' ),
				'placeholder'  => esc_html__( 'Text goes here...', 'edumentor' )
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Link', 'edumentor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'edumentor' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true
				],
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label' => esc_html__( 'Icon', 'edumentor' ),
				'type' => Controls_Manager::ICONS,
				'label_block'  => false,
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_control(
			'btn_icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'edumentor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'before' => [
						'title' => esc_html__( 'Before', 'edumentor' ),
						'icon' => 'eicon-h-align-left'
					],
					'after' => [
						'title' => esc_html__( 'After', 'edumentor' ),
						'icon' => 'eicon-h-align-right'
					]
				],
				'default' => 'after',
				'toggle' => false,
				'selectors_dictionary' => [
					'before' => 'flex-direction: inherit',
					'after' => 'flex-direction: row-reverse'
				],
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn-inner' => '{{VALUE}}'
				],
				'condition' => [
					'btn_text!' => '',
					'btn_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'btn_icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'edumentor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
						'step' => 1
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10
				],
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn-inner' => 'gap: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'btn_text!' => '',
					'btn_icon[value]!' => ''
				]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Button Style
	 *
	 * @return void
	 */
	protected function button_style() {

		$this->start_controls_section(
			'fp_button-style',
			[
				'label' => esc_html__( 'Button', 'edumentor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'edumentor' ),
				'name' => 'fp_button_typography',
				'selector' => '{{WRAPPER}} .hq-el-btn',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->start_controls_tabs( 'fp_button_control_tabs' );

		$this->start_controls_tab(
			'fp_button_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'edumentor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'fp_button_bg_color',
				'label' => esc_html__( 'Background', 'edumentor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .hq-el-btn',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_control(
			'fp_button_color',
			[
				'label' => esc_html__( 'Text Color', 'edumentor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn' => 'color: {{VALUE}};'
				],
				'default'	=> '',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_control(
			'fp_button_radius',
			[
				'label' => esc_html__( 'Border Radius', 'edumentor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'fp_button_border',
				'label' => esc_html__( 'Border', 'edumentor' ),
				'selector' => '{{WRAPPER}} .hq-el-btn',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fp_button_box_shadow',
				'selector' => '{{WRAPPER}} .hq-el-btn',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'fp_button_margin',
			[
				'label' => esc_html__( 'Margin', 'edumentor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'fp_button_padding',
			[
				'label' => esc_html__( 'Padding', 'edumentor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'fp_button_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'edumentor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'fp_button_hover_bg_color',
				'label' => esc_html__( 'Background', 'edumentor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .hq-el-btn-default:hover, {{WRAPPER}} .hq-el-btn-outline:hover, {{WRAPPER}} .hq-el-effect-1::before, {{WRAPPER}} .hq-el-effect-2:before, {{WRAPPER}} .hq-el-effect-3  span.bg',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_control(
			'fp_button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'edumentor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn:hover' => 'color: {{VALUE}};',
				],
				'default'	=> '',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'fp_button_hover_border',
				'label' => esc_html__( 'Border', 'edumentor' ),
				'selector' => '{{WRAPPER}} .hq-el-btn:hover',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fp_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .hq-el-btn:hover',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Icon Style
	 *
	 * @return void
	 */
	protected function button_icon_style() {

		$this->start_controls_section(
			'fp_button_icon_style',
			[
				'label' => esc_html__( 'Icon', 'edumentor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn_text!' => '',
					'btn_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'btn_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'edumentor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn-inner i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hq-el-btn-inner svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
				],
				'condition' => [
					'btn_text!' => '',
					'btn_icon[value]!' => ''
				]
			]
		);

		$this->add_control(
			'btn_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'edumentor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn-inner i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .hq-el-btn-inner svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'btn_text!' => '',
					'btn_icon[value]!' => ''
				]
			]
		);

		$this->add_control(
			'btn_icon_hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'edumentor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-el-btn:hover .hq-el-btn-inner i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .hq-el-btn:hover .hq-el-btn-inner svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'btn_text!' => '',
					'btn_icon[value]!' => ''
				]
			]
		);

		$this->end_controls_section();

	}

	/**
     * Heading style
     *
     * @return void
     */
    protected function heading_style() {

        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->start_controls_tabs( 'heading_tabs' );
                
        $this->start_controls_tab(
            'normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'heading_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => 'heading_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'heading_box_shadow',
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'heading_border',
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            'heading_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'highlighted_tab',
            [
                'label' => esc_html__( 'Highlighted Text', 'edumentor' ),
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hl_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => 'hl_text_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hl_box_shadow',
                'selector' => '{{WRAPPER}} .hq-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hl_border',
                'selector' => '{{WRAPPER}} .hq-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            'hl_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading mark' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'hl_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading mark' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'hl_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading mark' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

		$this->add_control(
            'heading_bg_text',
            [
                'label' => esc_html__( 'Background Text', 'textdomain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'background_note',
            [
                'label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__( 'Background Text is Hidden on Content Tab', 'edumentor' ),
				'separator' => 'before',
                'condition' => [
                    'heading!' => '',
                    'show_background_text!' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'background_text_typography',
                'selector' => '{{WRAPPER}} .hq-heading:before',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => 'background_text_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-heading:before',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => ''
                ]
            ]
        );

        $this->add_control(
            'background_offset_toggle',
            [
                'label' => esc_html__( 'Offset', 'edumentor' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'None', 'edumentor' ),
                'label_on' => esc_html__( 'Custom', 'edumentor' ),
                'return_value' => 'yes',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => ''
                ]
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'background_horizontal_position',
            [
                'label' => esc_html__( 'Horizontal Position', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => '',
                    'background_offset_toggle' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading:before' => 'left: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'background_vertical_position',
            [
                'label' => esc_html__( 'Vertical Position', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => '',
                    'background_offset_toggle' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'background_text_rotation',
            [
                'label'        => esc_html__( 'Text Rotaion', 'edumentor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'edumentor' ),
                'label_off'    => esc_html__( 'Off', 'edumentor' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => ''
                ],
            ]
        );

        $this->add_responsive_control(
            'bg_text_rotation_val',
            [
                'label'      => esc_html__( 'Rotate The Text', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 1,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-heading:before' => 'transform: rotate({{SIZE}}deg);',
                ],
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => '',
                    'background_text_rotation' => 'yes'
                ],
            ]
        );
        
        $this->end_controls_section();

    }

}