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
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
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
     * Ease Effects
     * @return array
     */
    protected function get_ease_effects(){
        return [
            'none' => esc_html__( 'None', 'edumentor' ),
            'power1.in' => esc_html__( 'Power1 In', 'edumentor' ),
            'power1.out' => esc_html__( 'Power1 Out', 'edumentor' ),
            'power1.inOut' => esc_html__( 'Power1 In Out', 'edumentor' ),
            'power2.in'  => esc_html__( 'Power2 In', 'edumentor' ),
            'power2.out'  => esc_html__( 'Power2 Out', 'edumentor' ),
            'power2.inOut'  => esc_html__( 'Power2 In Out', 'edumentor' ),
            'power3.in'  => esc_html__( 'Power3 In', 'edumentor' ),
            'power3.out'  => esc_html__( 'Power3 Out', 'edumentor' ),
            'power3.inOut'  => esc_html__( 'Power3 In Out', 'edumentor' ),
            'power4.in'  => esc_html__( 'Power4 In', 'edumentor' ),
            'power4.out'  => esc_html__( 'Power4 Out', 'edumentor' ),
            'power4.inOut'  => esc_html__( 'Power4 In Out', 'edumentor' ),
            'back.in(1.7)'  => esc_html__( 'Back In', 'edumentor' ),
            'back.out(1.7)'  => esc_html__( 'Back Out', 'edumentor' ),
            'back.inOut(1.7)'  => esc_html__( 'Back In Out', 'edumentor' ),
            'Back.easeOut'  => esc_html__( 'Back Ease Out', 'edumentor' ),
            'bounce.in'  => esc_html__( 'Bounce In', 'edumentor' ),
            'bounce.out'  => esc_html__( 'Bounce Out', 'edumentor' ),
            'bounce.inOut'  => esc_html__( 'Bounce In Out', 'edumentor' ),
            'circ.in'  => esc_html__( 'Circ In', 'edumentor' ),
            'circ.out'  => esc_html__( 'Circ Out', 'edumentor' ),
            'circ.inOut'  => esc_html__( 'Circ In Out', 'edumentor' ),
            'elastic.in'  => esc_html__( 'Elastic In', 'edumentor' ),
            'elastic.out'  => esc_html__( 'Elastic Out', 'edumentor' ),
            'elastic.inOut'  => esc_html__( 'Elastic In Out', 'edumentor' ),
            'expo.in'  => esc_html__( 'Expo In', 'edumentor' ),
            'expo.out'  => esc_html__( 'Expo Out', 'edumentor' ),
            'expo.inOut'  => esc_html__( 'Expo In Out', 'edumentor' ),
            'sine.in'  => esc_html__( 'Sine In', 'edumentor' ),
            'sine.out'  => esc_html__( 'Sine Out', 'edumentor' ),
            'sine.inOut'  => esc_html__( 'Sine In Out', 'edumentor' ),
            'steps(12)'  => esc_html__( 'Steps', 'edumentor' ),
        ];
    }

    /**
     * Heading Controls
     *
     * @return void
     */
    protected function heading_section( $prefix = 'hq_', $default_text = '', $is_border = false ) {

        $this->start_controls_section(
			$prefix . 'heading_section',
			[
				'label' => esc_html__( 'Heading', 'edumentor' )
			]
        );

        $this->start_controls_tabs( $prefix . 'heading_content_tabs' );

        $this->start_controls_tab(
            $prefix . 'heading_content_tab',
            [
                'label' => esc_html__( 'Text', 'edumentor' )
            ]
        );

        $text = '' != $default_text ? $default_text : esc_html__( 'The #1 Place to Grow Your Career!', 'edumentor' );
        
        $this->add_control(
            $prefix . 'heading',
            [
                'label'        => esc_html__( 'Content', 'edumentor' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 5,
                'default'      => $text,
                'placeholder'  => esc_html__( 'Text goes here...', 'edumentor' ),
                'description'  => esc_html__( 'Use this {Text} format to highlight the text.', 'edumentor' ),
            ]
        );

        $this->add_control(
            $prefix . 'h_link',
            [
                'label' => esc_html__( 'Link', 'edumentor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://example.com/', 'edumentor' ),
				'separator' => 'after',
				'dynamic' => [
					'active' => true,
                ],
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'h_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'h2',
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'edumentor' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'edumentor' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'edumentor' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'edumentor' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'edumentor' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'edumentor' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'toggle' => false,
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        if( $is_border === true ){
            $this->add_control(
                $prefix . 'is_border',
                [
                    'label' => esc_html__( 'Border Bottom', 'edumentor' ),
                    'description' => esc_html__( 'Border bottom on hightlithed text.', 'edumentor' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'edumentor' ),
                    'label_off' => esc_html__( 'Hide', 'edumentor' ),
                    'return_value' => 'yes',
                    'default' => 'yes'
                ]
            );

            $this->add_responsive_control(
                $prefix . 'border_size',
                [
                    'label' => esc_html__( 'Border Size', 'edumentor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 50,
                            'step' => 1,
                        ]
                        ],
                    'selectors' => [
                        '{{WRAPPER}} .hq-heading.is-border span.hl svg' => 'height: {{SIZE}}{{UNIT}};'
                    ],
                    'condition' => [
                        $prefix . 'is_border' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                $prefix . 'border_color',
                [
                    'label' => esc_html__( 'Border Color', 'edumentor' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hq-heading.is-border span.hl svg' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        $prefix . 'is_border' => 'yes'
                    ]
                ]
            );

            $this->add_responsive_control(
                $prefix . 'border_y_position',
                [
                    'label' => esc_html__( 'Border Y Position', 'edumentor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 1
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .hq-heading.is-border span.hl svg' => 'bottom: {{SIZE}}{{UNIT}};'
                    ],
                    'condition' => [
                        $prefix . 'is_border' => 'yes'
                    ]
                ]
            );
        }

        $this->end_controls_tab();

        $this->start_controls_tab(
            $prefix . 'heading_animation_tab',
            [
                'label' => esc_html__( 'Animation', 'edumentor' )
            ]
        );

        $this->add_control(
            $prefix . 'heading_animation',
            [
                'label' => esc_html__( 'Animation', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edumentor' ),
                'label_off' => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'h_normal_anim_effect',
            [
                'label' => esc_html__( 'Effect', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fade-in',
                'options' => [
                    'effect-3d' => esc_html__( '3d Effect', 'edumentor' ),
                    'clip-text' => esc_html__( 'Clip Text', 'edumentor' ),
                    'fade-in'  => esc_html__( 'Fade In', 'edumentor' ),
                    'fade-in-left' => esc_html__( 'Fade In Left', 'edumentor' ),
                    'fade-in-right' => esc_html__( 'Fade In Right', 'edumentor' ),
                    'fade-in-top' => esc_html__( 'Fade In Top', 'edumentor' ),
                    'fade-in-bottom' => esc_html__( 'Fade In Bottom', 'edumentor' ),
                    'zoom-in' => esc_html__( 'Zoom In', 'edumentor' )
                ],
                'condition' => [
                    $prefix . 'heading!' => '',
                    $prefix . 'heading_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'h_split_type',
            [
                'label' => esc_html__( 'Split Type', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'edumentor' ),
                    'word' => esc_html__( 'Words', 'edumentor' ),
                    'line'  => esc_html__( 'Lines', 'edumentor' ),
                    'char'  => esc_html__( 'Chars', 'edumentor' )
                ],
                'condition' => [
                    $prefix . 'heading!' => '',
                    $prefix . 'heading_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'h_ease_effect',
            [
                'label' => esc_html__( 'Ease Effect', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'Back.easeOut',
                'options' => $this->get_ease_effects(),
                'condition' => [
                    $prefix . 'heading!' => '',
                    $prefix . 'heading_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'h_anim_delay',
            [
                'label' => esc_html__( 'Delay', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0.3,
                'min' => 0,
                'max' => 20,
                'step' => 0.1,
                'condition' => [
                    $prefix . 'heading!' => '',
                    $prefix . 'heading_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'h_anim_duration',
            [
                'label' => esc_html__( 'Duration', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 0,
                'max' => 20,
                'step' => 0.1,
                'condition' => [
                    $prefix . 'heading!' => '',
                    $prefix . 'heading_animation' => 'yes'
                ]
            ]
        );

        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Heading style
     *
     * @return void
     */
    protected function heading_style( $prefix = 'hq_', $is_border = false ) {

        $this->start_controls_section(
            $prefix . 'heading_style',
            [
                'label' => esc_html__( 'Heading', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => $prefix . 'heading_typography',
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->start_controls_tabs( $prefix . 'heading_tabs' );
                
        $this->start_controls_tab(
            $prefix . 'normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $prefix . 'heading_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => $prefix . 'heading_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-heading, {{WRAPPER}} .hq-heading a',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => $prefix . 'heading_text_stroke',
				'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
			]
		);

        $this->add_control(
            $prefix . 'heading_hover_color',
            [
                'label' => esc_html__( 'Hover Text Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-heading a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    $prefix . 'heading!' => '',
                    $prefix . 'h_link[url]!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $prefix . 'heading_box_shadow',
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $prefix . 'heading_border',
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'heading_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'heading_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'heading_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            $prefix . 'h_highlighted_tab',
            [
                'label' => esc_html__( 'Highlighted Text', 'edumentor' ),
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $prefix . 'h_hl_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-heading span',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => $prefix . 'h_hl_text_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-heading span',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => $prefix . 'h_hl_text_stroke',
				'selector' => '{{WRAPPER}} .hq-heading span',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $prefix . 'h_hl_box_shadow',
                'selector' => '{{WRAPPER}} .hq-heading span',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $prefix . 'h_hl_border',
                'selector' => '{{WRAPPER}} .hq-heading span',
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'h_hl_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'h_hl_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'h_hl_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'heading!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

    }

    /**
     * Sub Heading Controls
     *
     * @return void
     */
    protected function sub_heading_section( $prefix = 'hq_', $default_text = '' ) {

        $this->start_controls_section(
			$prefix . 'sub_heading_section',
			[
				'label' => esc_html__( 'Sub Heading', 'edumentor' )
			]
        );

        $this->start_controls_tabs( $prefix . 'sub_heading_content_tabs' );

        $this->start_controls_tab(
            $prefix . 'sub_heading_content_tab',
            [
                'label' => esc_html__( 'Text', 'edumentor' )
            ]
        );

        $text = '' != $default_text ? $default_text : '';

        $this->add_control(
            $prefix . 'sub_heading',
            [
                'label'        => esc_html__( 'Content', 'edumentor' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 5,
                'default'      => $text,
                'placeholder'  => esc_html__( 'Text goes here...', 'edumentor' ),
                'description'  => esc_html__( 'Use this {Text} format to highlight the text.', 'edumentor' ),
            ]
        );

        $this->add_control(
            $prefix . 'sh_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'h4',
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'edumentor' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'edumentor' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'edumentor' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'edumentor' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'edumentor' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'edumentor' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'toggle' => false,
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'sub_heading_layout',
            [
                'label' => esc_html__( 'Display', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inline-flex' => [
                        'title' => esc_html__( 'Inline', 'edumentor' ),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                    'flex' => [
                        'title' => esc_html__( 'Block', 'edumentor' ),
                        'icon' => 'eicon-menu-bar',
                    ],
                ],
                'default' => 'inline-flex',
                'prefix_class' => 'sub-h-',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .hq-sub-heading' => 'display: {{VALUE}};',
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'sh_border',
            [
                'label' => esc_html__( 'Leaf', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edumentor' ),
                'label_off' => esc_html__( 'Hide', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'sh_leaf_size',
            [
                'label' => esc_html__( 'Leaf Size', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 15,
                        'max' => 150,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-sub-heading.is-border .sh-underline img' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => '',
                    $prefix . 'sh_border' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'sh_leaf_spacing',
            [
                'label' => esc_html__( 'Leaf X Spacing', 'edumentor' ),
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
                    '{{WRAPPER}} .hq-sub-heading.is-border' => 'padding-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .hq-sub-heading.is-border' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: 0;'
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => '',
                    $prefix . 'sh_border' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'sh_leaf_y_spacing',
            [
                'label' => esc_html__( 'Leaf Y Spacing', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -150,
                        'max' => 150,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-sub-heading.is-border img' => 'bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => '',
                    $prefix . 'sh_border' => 'yes'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            $prefix . 'sub_heading_animation_tab',
            [
                'label' => esc_html__( 'Animation', 'edumentor' )
            ]
        );

        $this->add_control(
            $prefix . 'sub_heading_animation',
            [
                'label' => esc_html__( 'Animation', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edumentor' ),
                'label_off' => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'sh_normal_anim_effect',
            [
                'label' => esc_html__( 'Effect', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fade-in',
                'options' => [
                    'effect-3d' => esc_html__( '3d Effect', 'edumentor' ),
                    'clip-text' => esc_html__( 'Clip Text', 'edumentor' ),
                    'fade-in'  => esc_html__( 'Fade In', 'edumentor' ),
                    'fade-in-left' => esc_html__( 'Fade In Left', 'edumentor' ),
                    'fade-in-right' => esc_html__( 'Fade In Right', 'edumentor' ),
                    'fade-in-top' => esc_html__( 'Fade In Top', 'edumentor' ),
                    'fade-in-bottom' => esc_html__( 'Fade In Bottom', 'edumentor' ),
                    'zoom-in' => esc_html__( 'Zoom In', 'edumentor' )
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => '',
                    $prefix . 'sub_heading_animation' => 'yes',
                    $prefix . 'sh_border!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'sh_split_type',
            [
                'label' => esc_html__( 'Split Type', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'edumentor' ),
                    'word' => esc_html__( 'Words', 'edumentor' ),
                    'line'  => esc_html__( 'Lines', 'edumentor' ),
                    'char'  => esc_html__( 'Chars', 'edumentor' )
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => '',
                    $prefix . 'sub_heading_animation' => 'yes',
                    $prefix . 'sh_border!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'sh_ease_effect',
            [
                'label' => esc_html__( 'Ease Effect', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'Back.easeOut',
                'options' => $this->get_ease_effects(),
                'condition' => [
                    $prefix . 'sub_heading!' => '',
                    $prefix . 'heading_animation' => 'yes',
                    $prefix . 'sh_border!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'sh_anim_delay',
            [
                'label' => esc_html__( 'Delay', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0.3,
                'min' => 0,
                'max' => 20,
                'step' => 0.1,
                'condition' => [
                    $prefix . 'sub_heading!' => '',
                    $prefix . 'sub_heading_animation' => 'yes',
                    $prefix . 'sh_border!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'sh_anim_duration',
            [
                'label' => esc_html__( 'Duration', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 0,
                'max' => 20,
                'step' => 0.1,
                'condition' => [
                    $prefix . 'sub_heading!' => '',
                    $prefix . 'sub_heading_animation' => 'yes',
                    $prefix . 'sh_border!' => 'yes'
                ]
            ]
        );

        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Sub Heading style
     *
     * @return void
     */
    protected function sub_heading_style( $prefix = 'hq_' ) {

        $this->start_controls_section(
            $prefix . 'sub_heading_style',
            [
                'label' => esc_html__( 'Sub Heading', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => $prefix . 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .hq-sub-heading',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->start_controls_tabs( $prefix . 'sub_heading_tabs' );
                
        $this->start_controls_tab(
            $prefix . 'sub_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $prefix . 'sub_heading_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-sub-heading',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => $prefix . 'sub_heading_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-sub-heading',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => $prefix . 'sub_heading_text_stroke',
				'selector' => '{{WRAPPER}} .hq-sub-heading',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $prefix . 'sub_heading_box_shadow',
                'selector' => '{{WRAPPER}} .hq-sub-heading',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $prefix . 'sub_heading_border',
                'selector' => '{{WRAPPER}} .hq-sub-heading',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'sub_heading_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-sub-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'sub_heading_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-sub-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'sub_heading_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            $prefix . 'sh_highlighted_tab',
            [
                'label' => esc_html__( 'Highlighted Text', 'edumentor' ),
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $prefix . 'sh_hl_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-sub-heading span',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => $prefix . 'sh_hl_text_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-sub-heading span',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => $prefix . 'sh_hl_text_stroke',
				'selector' => '{{WRAPPER}} .hq-sub-heading span',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $prefix . 'sh_hl_box_shadow',
                'selector' => '{{WRAPPER}} .hq-sub-heading span',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $prefix . 'sh_hl_border',
                'selector' => '{{WRAPPER}} .hq-sub-heading span',
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'sh_hl_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-sub-heading span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'sh_hl_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-sub-heading span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'sh_hl_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-sub-heading span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'sub_heading!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

    }

    /**
     * Description Controls
     *
     * @return void
     */
    protected function description_section( $prefix = 'hq_' ) {

        $this->start_controls_section(
			$prefix . 'description_section',
			[
				'label' => esc_html__( 'Description', 'edumentor' )
			]
        );

        $this->start_controls_tabs( $prefix . 'desc_content_tabs' );

        $this->start_controls_tab(
            $prefix . 'desc_content_tab',
            [
                'label' => esc_html__( 'Text', 'edumentor' )
            ]
        );

        $this->add_control(
            $prefix . 'desc',
            [
                'label'        => esc_html__( 'Content', 'edumentor' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 5,
                'default'      => esc_html__( 'Search & Study any topics, anytime. Choose from thousands of expert-led courses now.', 'edumentor' ),
                'placeholder'  => esc_html__( 'Text goes here...', 'edumentor' )
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            $prefix . 'desc_animation_tab',
            [
                'label' => esc_html__( 'Animation', 'edumentor' )
            ]
        );

        $this->add_control(
            $prefix . 'desc_animation',
            [
                'label' => esc_html__( 'Animation', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edumentor' ),
                'label_off' => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'desc_normal_anim_effect',
            [
                'label' => esc_html__( 'Effect', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fade-in',
                'options' => [
                    'effect-3d' => esc_html__( '3d Effect', 'edumentor' ),
                    'clip-text' => esc_html__( 'Clip Text', 'edumentor' ),
                    'fade-in'  => esc_html__( 'Fade In', 'edumentor' ),
                    'fade-in-left' => esc_html__( 'Fade In Left', 'edumentor' ),
                    'fade-in-right' => esc_html__( 'Fade In Right', 'edumentor' ),
                    'fade-in-top' => esc_html__( 'Fade In Top', 'edumentor' ),
                    'fade-in-bottom' => esc_html__( 'Fade In Bottom', 'edumentor' ),
                    'zoom-in' => esc_html__( 'Zoom In', 'edumentor' )
                ],
                'condition' => [
                    $prefix . 'desc!' => '',
                    $prefix . 'desc_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'desc_split_type',
            [
                'label' => esc_html__( 'Split Type', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'edumentor' ),
                    'word' => esc_html__( 'Words', 'edumentor' ),
                    'line'  => esc_html__( 'Lines', 'edumentor' ),
                    'char'  => esc_html__( 'Chars', 'edumentor' )
                ],
                'condition' => [
                    $prefix . 'desc!' => '',
                    $prefix . 'desc_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'desc_ease_effect',
            [
                'label' => esc_html__( 'Ease Effect', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'Back.easeOut',
                'options' => $this->get_ease_effects(),
                'condition' => [
                    $prefix . 'desc!' => '',
                    $prefix . 'desc_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'desc_anim_delay',
            [
                'label' => esc_html__( 'Delay', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0.3,
                'min' => 0,
                'max' => 20,
                'step' => 0.1,
                'condition' => [
                    $prefix . 'desc!' => '',
                    $prefix . 'desc_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            $prefix . 'desc_anim_duration',
            [
                'label' => esc_html__( 'Duration', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 0,
                'max' => 20,
                'step' => 0.1,
                'condition' => [
                    $prefix . 'desc!' => '',
                    $prefix . 'desc_animation' => 'yes'
                ]
            ]
        );

        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Description style
     *
     * @return void
     */
    protected function description_style( $prefix = 'hq_' ) {

        $this->start_controls_section(
            $prefix . 'desc_style',
            [
                'label' => esc_html__( 'Description', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => $prefix . 'desc_typography',
                'selector' => '{{WRAPPER}} .hq-desc',
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $prefix . 'desc_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-desc',
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => $prefix . 'desc_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-desc',
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $prefix . 'desc_box_shadow',
                'selector' => '{{WRAPPER}} .hq-desc',
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $prefix . 'desc_border',
                'selector' => '{{WRAPPER}} .hq-desc',
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );

        $this->add_control(
            $prefix . 'desc_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'desc_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            $prefix . 'desc_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .hq-desc' => 'margin-left: {{RIGHT}}{{UNIT}}; margin-right: {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    $prefix . 'desc!' => ''
                ]
            ]
        );
        
        $this->end_controls_section();

    }

}