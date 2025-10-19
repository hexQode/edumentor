<?php
/**
 * Carousel Controls
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Traits;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

trait CarouselControls{
    /**
	 * Style Carousel Navigation
	 *
	 * @return void
	 */
	protected function style_navigation( $condition_key = 'carousel' ) {

		$this->start_controls_section(
			'section_carousel_navigation_style',
			[
				'label' => esc_html__( 'Navigation', 'edumentor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_control(
			'nav_hide_mobile',
			[
				'label'        => esc_html__( 'Hide on Mobile/Tablet', 'edumentor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'edumentor' ),
				'label_off'    => esc_html__( 'No', 'edumentor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_control(
			'nav_style',
			[
				'label'   => esc_html__( 'Style', 'edumentor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'centered',
				'options' => [
					'centered'  => esc_html__( 'Centered', 'edumentor' ),
					'top-right' => esc_html__( 'Together', 'edumentor' ),
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_control(
			'nav_visibility',
			[
				'label' => esc_html__( 'Nav Visibility', 'edumentor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'always-visible' => [
						'title' => esc_html__( 'Always Visible', 'edumentor' ),
						'icon' => 'eicon-eye',
					],
					'visible-on-hover' => [
						'title' => esc_html__( 'Visible on Hover', 'edumentor' ),
						'icon' => 'eicon-click',
					],
				],
				'default' => 'visible-on-hover',
				'prefix_class' => 'nav-',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}}.nav-visible-on-hover .hq-carousel-nav.nav-centered button' => 'visbility: hidden; opacity: 0;',
					'{{WRAPPER}}.nav-visible-on-hover:hover .hq-carousel-nav.nav-centered button' => 'visbility: visible; opacity: 1;',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both'],
					'nav_style' => 'centered'
				]
			]
		);

		$this->add_responsive_control(
			'nav_spacebetween',
			[
				'label'      => esc_html__( 'Space Between', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
					'em'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hq-carousel-nav.nav-top-right' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both'],
					'nav_style' => 'top-right'
				]
			]
		);

		$this->add_responsive_control(
			'nav_width',
			[
				'label'      => esc_html__( 'Width', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
					'em'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hq-carousel-nav button' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_responsive_control(
			'nav_height',
			[
				'label'      => esc_html__( 'Height', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
					'em'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hq-carousel-nav button' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .navi-top-right .slick-slider' => 'padding-top: calc({{SIZE}}{{UNIT}} + 10px);'
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_responsive_control(
			'nav_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .hq-carousel-nav button' => 'font-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_responsive_control(
			'nav_x_position',
			[
				'label'      => esc_html__( 'X Position', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .nav-centered.hq-carousel-nav button' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .nav-centered.hq-carousel-nav button.slick-next' => 'left: auto; right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hq-carousel-nav.nav-top-right' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_responsive_control(
			'nav_y_position',
			[
				'label'      => esc_html__( 'Y Position', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => -100,
						'max'  => 1500,
						'step' => 1,
					],
					'%'  => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .nav-centered.hq-carousel-nav button' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hq-carousel-nav.nav-top-right' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_control(
			'nav_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'edumentor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .hq-carousel-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->start_controls_tabs( 'nav_style_tabs' );
		
		$this->start_controls_tab(
			'nav_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'edumentor' ),
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'nav_normal_bg',
				'label'    => esc_html__( 'Background', 'edumentor' ),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .hq-carousel-nav button',
				'exclude'  => ['image'],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_control(
			'nav_icon_color',
			[
				'label'       => esc_html__( 'Icon Color', 'Text-domain' ),
				'type'     => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-carousel-nav button' => 'color: {{VALUE}}',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);
				
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'nav_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'edumentor' ),
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);
				
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'nav_hover_bg',
				'label'    => esc_html__( 'Background', 'edumentor' ),
				'types'    => ['classic', 'gradient'],
				'exclude'  => ['image'],
				'selector' => '{{WRAPPER}} .hq-carousel-nav button:hover',
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);

		$this->add_control(
			'nav_icon_hover_color',
			[
				'label'       => esc_html__( 'Icon Color', 'Text-domain' ),
				'type'     => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-carousel-nav button:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['arrow', 'both']
				]
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	/**
	 * Style Carousel Pagination
	 *
	 * @return void
	 */
	protected function style_pagination( $condition_key = 'carousel' ) {

		$this->start_controls_section(
			'section_carousel_pagination_style',
			[
				'label' => esc_html__( 'Pagination ( Bullets )', 'edumentor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both']
				]
			]
		);

		$this->add_control(
			'dots_hide_mobile',
			[
				'label'        => esc_html__( 'Hide on Mobile/Tablet', 'edumentor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'edumentor' ),
				'label_off'    => esc_html__( 'No', 'edumentor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both']
				]
			]
		);

		$this->add_responsive_control(
			'dots_top_spacing',
			[
				'label'      => esc_html__( 'Top Spacing', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .carousel-wrapper' => '--hq-edumentor-dots-spacing: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hq-carousel-dots.dot-style-2' => 'margin-bottom: 4px;',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both']
				]
			]
		);

		$this->add_responsive_control(
            'dots_alignment',
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
                    ]
                ],
                'default' => 'center',
                'toggle' => false,
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right' => 'justify-content: flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-carousel-dots .slick-dots' => '{{VALUE}}'
                ]
            ]
        );

		$this->add_responsive_control(
			'bullet_size',
			[
				'label'      => esc_html__( 'Size', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .carousel-wrapper .hq-carousel-dots' => '--hq-edumentor-dots-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both']
				]
			]
		);

		$this->add_responsive_control(
			'dots_space_between_item',
			[
				'label'      => esc_html__( 'Space Between Item', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .hq-carousel-dots .slick-dots' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both']
				]
			]
		);

		$this->add_responsive_control(
            'dots_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-carousel-dots .slick-dots li span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    $condition_key => 'yes',
					'navigation' => ['dots', 'both'],
					'dots_style' => '1'
                ],
            ]
        );

		$this->start_controls_tabs( 'bullet_style_tabs' );
		
		$this->start_controls_tab(
			'bullet_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'edumentor' ),
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both']
				]
			]
		);
		
		$this->add_control(
			'bullet_color',
			[
				'label'     => esc_html__( 'Color', 'edumentor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-carousel-dots.dot-style-1 .slick-dots li span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .hq-carousel-dots.dot-style-2 .slick-dots li span .solid-fill' => 'fill: {{VALUE}}',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both']
				]
			]
		);
		
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'bullet_style_active_tab',
			[
				'label' => esc_html__( 'Active', 'edumentor' ),
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both']
				]
			]
		);
		
		$this->add_control(
			'bullet_hover_color',
			[
				'label'     => esc_html__( 'Color', 'edumentor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-carousel-dots.dot-style-1 .slick-dots li.slick-active span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .hq-carousel-dots.dot-style-2 .slick-dots li.slick-active .solid-fill' => 'fill: {{VALUE}}',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both']
				]
			]
		);

		$this->add_control(
			'bullet_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'edumentor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-carousel-dots .slick-dots li.slick-active span' => 'box-shadow: 0px 0px 0px 3px {{VALUE}};',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both'],
					'dots_style' => '1'
				]
			]
		);

		$this->add_control(
			'bullet_stroke_color',
			[
				'label'     => esc_html__( 'Stroke Color', 'edumentor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-carousel-dots.dot-style-2 .slick-dots li.slick-active .path' => 'stroke: {{VALUE}}',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both'],
					'dots_style' => '2'
				]
			]
		);

		$this->add_responsive_control(
			'bullet_stroke_width',
			[
				'label'      => esc_html__( 'Stroke Size', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 1
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .hq-carousel-dots.dot-style-2 .slick-dots li.slick-active' => 'stroke-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					$condition_key => 'yes',
					'navigation' => ['dots', 'both'],
					'dots_style' => '2'
				]
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

	}

}