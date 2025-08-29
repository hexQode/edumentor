<?php
/**
 * Common Controls
 *
 * @package FlatPack
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
				'label' => esc_html__( 'Button', 'flatpack' )
			]
		);

		$this->add_responsive_control(
			'btn_alignment',
			[
				'label' => esc_html__( 'Alignment', 'flatpack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'flatpack' ),
						'icon' => 'eicon-text-align-left'
					],
					'center' => [
						'title' => esc_html__( 'Center', 'flatpack' ),
						'icon' => 'eicon-text-align-center'
					],
					'right' => [
						'title' => esc_html__( 'Right', 'flatpack' ),
						'icon' => 'eicon-text-align-right'
					],
					'justify' => [
						'title' => esc_html__( 'Justify', 'flatpack' ),
						'icon' => 'eicon-text-align-justify'
					],
				],
				'default' => 'left',
				'prefix_class' => 'fp-btn-align-',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .fp-btn-wrap' => 'text-align: {{VALUE}};',
					'{{WRAPPER}}.fp-btn-align-justify .fp-btn-wrap a' => 'width: 100%; text-align: center; justify-content: center;',
				]
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'        => esc_html__( 'Button Text', 'flatpack' ),
				'type'         => Controls_Manager::TEXT,
				'label_block'  => true,
				'default'      => esc_html__( 'Explore More', 'flatpack' ),
				'placeholder'  => esc_html__( 'Text goes here...', 'flatpack' )
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Link', 'flatpack' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'flatpack' ),
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
				'label' => esc_html__( 'Icon', 'flatpack' ),
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
				'label' => esc_html__( 'Icon Position', 'flatpack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'before' => [
						'title' => esc_html__( 'Before', 'flatpack' ),
						'icon' => 'eicon-h-align-left'
					],
					'after' => [
						'title' => esc_html__( 'After', 'flatpack' ),
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
					'{{WRAPPER}} .fp-btn-wrap a' => '{{VALUE}}'
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
				'label' => esc_html__( 'Icon Spacing', 'flatpack' ),
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
					'{{WRAPPER}} .fp-btn-wrap a' => 'column-gap: {{SIZE}}{{UNIT}};'
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
				'label' => esc_html__( 'Button', 'flatpack' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'flatpack' ),
				'name' => 'fp_button_typography',
				'selector' => '{{WRAPPER}} .fp-btn-wrap a',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->start_controls_tabs( 'fp_button_control_tabs' );

		$this->start_controls_tab(
			'fp_button_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'flatpack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'fp_button_bg_color',
				'label' => esc_html__( 'Background', 'flatpack' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .fp-btn-wrap a',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_control(
			'fp_button_color',
			[
				'label' => esc_html__( 'Text Color', 'flatpack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fp-btn-wrap a' => 'color: {{VALUE}};'
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
				'label' => esc_html__( 'Border Radius', 'flatpack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .fp-btn-wrap a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'fp_button_border',
				'label' => esc_html__( 'Border', 'flatpack' ),
				'selector' => '{{WRAPPER}} .fp-btn-wrap a',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fp_button_box_shadow',
				'selector' => '{{WRAPPER}} .fp-btn-wrap a',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'fp_button_margin',
			[
				'label' => esc_html__( 'Margin', 'flatpack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .fp-btn-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'fp_button_padding',
			[
				'label' => esc_html__( 'Padding', 'flatpack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .fp-btn-wrap a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
				'label' => esc_html__( 'Hover', 'flatpack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'fp_button_hover_bg_color',
				'label' => esc_html__( 'Background', 'flatpack' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .fp-btn-wrap a:before',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);

		$this->add_control(
			'fp_button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'flatpack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fp-btn-wrap a:hover' => 'color: {{VALUE}};',
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
				'label' => esc_html__( 'Border', 'flatpack' ),
				'selector' => '{{WRAPPER}} .fp-btn-wrap a:hover',
				'condition' => [
					'btn_text!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fp_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .fp-btn-wrap a:hover',
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
				'label' => esc_html__( 'Icon', 'flatpack' ),
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
				'label' => esc_html__( 'Icon Size', 'flatpack' ),
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
					'{{WRAPPER}} .fp-btn-wrap a i' => 'font-size: {{SIZE}}{{UNIT}};'
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
				'label' => esc_html__( 'Icon Color', 'flatpack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fp-btn-wrap a i' => 'color: {{VALUE}}',
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
				'label' => esc_html__( 'Icon Hover Color', 'flatpack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fp-btn-wrap a:hover i' => 'color: {{VALUE}}',
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
                'label' => esc_html__( 'Heading', 'flatpack' ),
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
                'selector' => '{{WRAPPER}} .fp-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->start_controls_tabs( 'heading_tabs' );
                
        $this->start_controls_tab(
            'normal_tab',
            [
                'label' => esc_html__( 'Normal', 'flatpack' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'heading_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .fp-heading',
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
                'selector' => '{{WRAPPER}} .fp-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'heading_box_shadow',
                'selector' => '{{WRAPPER}} .fp-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'heading_border',
                'selector' => '{{WRAPPER}} .fp-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            'heading_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => esc_html__( 'Padding', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Margin', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label' => esc_html__( 'Highlighted Text', 'flatpack' ),
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
                'selector' => '{{WRAPPER}} .fp-heading mark',
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
                'selector' => '{{WRAPPER}} .fp-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hl_box_shadow',
                'selector' => '{{WRAPPER}} .fp-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hl_border',
                'selector' => '{{WRAPPER}} .fp-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            'hl_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-heading mark' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'hl_padding',
            [
                'label' => esc_html__( 'Padding', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-heading mark' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'hl_margin',
            [
                'label' => esc_html__( 'Margin', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-heading mark' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'raw' => esc_html__( 'Background Text is Hidden on Content Tab', 'flatpack' ),
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
                'selector' => '{{WRAPPER}} .fp-heading:before',
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
                'selector' => '{{WRAPPER}} .fp-heading:before',
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
                'label' => esc_html__( 'Offset', 'flatpack' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'None', 'flatpack' ),
                'label_on' => esc_html__( 'Custom', 'flatpack' ),
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
                'label' => esc_html__( 'Horizontal Position', 'flatpack' ),
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
                    '{{WRAPPER}} .fp-heading:before' => 'left: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'background_vertical_position',
            [
                'label' => esc_html__( 'Vertical Position', 'flatpack' ),
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
                    '{{WRAPPER}} .fp-heading:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'background_text_rotation',
            [
                'label'        => esc_html__( 'Text Rotaion', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'flatpack' ),
                'label_off'    => esc_html__( 'Off', 'flatpack' ),
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
                'label'      => esc_html__( 'Rotate The Text', 'flatpack' ),
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
                    '{{WRAPPER}} .fp-heading:before' => 'transform: rotate({{SIZE}}deg);',
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