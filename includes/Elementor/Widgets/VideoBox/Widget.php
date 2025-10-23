<?php
/**
 * Video Box
 *
 * @package EduMentor
 */
namespace HexQode\EduMentor\Elementor\Widgets\VideoBox;

use HexQode\EduMentor\Classes\Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
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
        return 'edumentor-video-box';
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
        return esc_html__( 'Video Box', 'edumentor' );
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
        return 'edumentor-icon eicon-play';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'video', 'video box', 'petfun' ];
    }

    public function get_style_depends() {
        return ['edumentor-video-elements'];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_video();
        $this->section_content();
		$this->section_image_options();
		$this->section_play_button();
		$this->icon_style();
		$this->title_style();
		$this->content_style();
		$this->style_play_button();

    }

    /**
	 * Section Video 
	 *
	 * @return void
	 */
	protected function section_video() {

		$this->start_controls_section(
			'video_box',
			[
				'label' => esc_html__( 'Video', 'edumentor' )
			]
		);

        $this->add_control(
			'video_url',
			[
				'label' => esc_html__( 'Video URL', 'edumentor' ),
				'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'label_block' => true,
				'default' => esc_html__( '#', 'edumentor' ),
				'placeholder' => esc_html__( 'Video url goes here...', 'edumentor' ),
			]
		);

		$this->add_control(
			'play_icon',
			[
				'label'   => esc_html__( 'Play Icon', 'edumentor' ),
				'type'    => Controls_Manager::ICONS,
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'default' => [
					'value' => 'fas fa-play',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'play',
						'play-circle'
					],
					'fa-regular' => [
						'play-circle'
					]
				],
				'condition'    => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4'
				],
			]
		);

        $this->add_control(
			'video_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'edumentor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
                'condition' => [
					'video_url!' => ''
				]
			]
		);

        $this->add_control(
			'popup_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'edumentor' ),
				'type' => Controls_Manager::COLOR,
				'default'	=> 'rgba(0,0,0,0.6)',
				'description' => esc_html__( 'Video popup background overlay color.', 'edumentor' ),
                'condition' => [
					'video_url!' => ''
				]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Content Section
	 *
	 * @return void
	 */
	protected function section_content(){
		
		$this->start_controls_section(
			'video_box_title_n_icon',
			[
				'label' => esc_html__( 'Content', 'edumentor' ),
				'condition'    => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4'
				],
			]
		);

		$this->add_responsive_control(
			'vb_alignment',
			[
				'label'   => esc_html__( 'Alignment', 'edumentor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'   => [
						'title' => esc_html__( 'Left', 'edumentor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'edumentor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'edumentor' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle'  => false,
				'selectors' => [
					'{{WRAPPER}} .hq-style-4 .hq-style-4-inner' => 'text-align: {{VALUE}};',
				],
				'condition'    => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4'
				],
			]
		);

		$this->add_control(
			'vb_icon',
			[
				'label'   => esc_html__( 'Icon', 'edumentor' ),
				'type'    => Controls_Manager::ICONS,
				'label_block' => false,
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'condition'    => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4'
				],
			]
		);

		$this->add_control(
			'vb_title',
			[
				'label'       => __( 'Title', 'edumentor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Business Running Since 1987', 'edumentor' ),
				'placeholder' => esc_html__( 'Title goes here...', 'edumentor' ),
				'rows'		  => 3,
				'condition'    => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4'
				],
			]
		);

		$this->add_control(
            'vb_title_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'h3',
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
                'condition'    => [
					'video_url!' => '',
					'vb_title!' => '',
					'video_box_play_btn_style' => 'style4'
                ]
            ]
        );

		$this->add_control(
			'vb_content',
			[
				'label'       => esc_html__( 'Description', 'edumentor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'placeholder' => esc_html__( 'Description goes here...', 'edumentor' ),
				'condition'    => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4'
                ]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Section Image Options
	 *
	 * @return void
	 */
	protected function section_image_options() {

		$this->start_controls_section(
			'video_box_img',
			[
				'label' => esc_html__( 'Image', 'edumentor' )
			]
		);

		$this->add_control(
			'wt_video_img',
			[
				'label' => esc_html__( 'Upload Image', 'edumentor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'wt_video_img',
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
            'image_blend_mode',
            [
                'label' => esc_html__( 'Blend Mode', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'default' => 'inherit',
                'options' => [
                    'inherit' => esc_html__( 'Normal', 'edumentor' ),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-video-box-wrap img' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
			'wt_enable_overlay',
			[
				'label' => esc_html__( 'Image Overlay', 'edumentor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'edumentor' ),
				'label_off' => esc_html__( 'No', 'edumentor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'wt_image_overlay',
				'label' => esc_html__( 'Overlay Color', 'edumentor' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .hq-video-box-wrap .overlay, {{WRAPPER}} .hq-style-4',
				'condition' => [
					'wt_enable_overlay' => 'yes'
				]
			]
		);

		$this->add_control(
			'wt_image_overlay_opacity',
			[
				'label' => esc_html__( 'Overlay Opacity', 'edumentor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
		                'min' => 0,
		                'max' => 1,
		                'step' => 0.1,
		            ],
				],
				'default' => [
						'size' => 0.4,
				],
				'selectors' => [
					'{{WRAPPER}} .hq-video-box-wrap .overlay' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'wt_enable_overlay' => 'yes',
					'video_box_play_btn_style!' => 'style4'
				]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Section Play Button
	 *
	 * @return void
	 */
	protected function section_play_button() {

		$this->start_controls_section(
			'video_box_play_icon',
			[
				'label' => esc_html__( 'Play Button', 'edumentor' ),
				'condition' => [
					'video_url!' => ''
				]
			]
		);

		$this->add_control(
			'video_box_play_btn_style',
			[
				'label' => esc_html__( 'Play Button Style', 'edumentor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style1' => esc_html__( 'Style 1', 'edumentor' ),
					'style2' => esc_html__( 'Style 2', 'edumentor' ),
					'style3' => esc_html__( 'Style 3', 'edumentor' ),
					'style4' => esc_html__( 'Style 4', 'edumentor' )
				],
				'default' => 'style1',
				'condition' => [
					'video_url!' => ''
				]
			]
		);

		$this->add_control(
            'ripple_color',
            [
                'label' => esc_html__( 'Ripple Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'selectors' => [
                    '{{WRAPPER}} .hq-vb-2, {{WRAPPER}} .hq-vb-3' => '--edumentor-play-btn-ripple-color: {{VALUE}}',
                ],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => ['style2', 'style3']
				]
            ]
        );

		$this->add_responsive_control(
			'video_box_play_btn_style2_width',
			[
				'label' => esc_html__( 'Width / Height', 'edumentor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .hq-vb-2' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hq-vb-2 .ripple, {{WRAPPER}} .hq-vb-2 .ripple:before, {{WRAPPER}} .hq-vb-2 .ripple:after' => 'width: calc({{SIZE}}{{UNIT}} - 2px); height: calc({{SIZE}}{{UNIT}} - 2px);'
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style2'
				]
			]
		);

		$this->add_responsive_control(
			'video_box_play_btn_style2_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'edumentor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .hq-vb-2 svg' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style2'
				]
			]
		);

		$this->add_responsive_control(
			'video_box_play_btn_style3_width',
			[
				'label' => esc_html__( 'Width / Height', 'edumentor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .hq-vb-3' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style3'
				]
			]
		);

		$this->add_responsive_control(
			'video_box_play_btn_style3_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'edumentor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 15,
						'max' => 80,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .hq-vb-3 svg' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style3'
				]
			]
		);

		$this->add_responsive_control(
			'video_box_play_btn_style3_icon_pos_x',
			[
				'label' => esc_html__( 'Icon Position X', 'edumentor' ),
				'type' =>Controls_Manager::NUMBER,
				'step' => 1,
				'default' => 0,
				'selectors' => [
					'{{WRAPPER}} .hq-vb-3 svg' => 'margin-left: {{VALUE}}px;'
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style3'
				]
			]
		);

		$this->add_responsive_control(
			'video_box_play_btn_style3_icon_pos_y',
			[
				'label' => esc_html__( 'Icon Position Y', 'edumentor' ),
				'type' =>Controls_Manager::NUMBER,
				'step' => 1,
				'default' => 0,
				'selectors' => [
					'{{WRAPPER}} .hq-vb-3 svg' => 'margin-bottom: {{VALUE}}px;'
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style3'
				]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Style Play Button
	 *
	 * @return void
	 */
	protected function style_play_button() {

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Play Button', 'edumentor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'video_url!' => ''
				]
			]
		);

		$this->add_control(
			'vb_play_btn_pos',
			[
				'label'   => esc_html__( 'Position', 'edumentor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom-right',
				'options' => [
					'top-left'  => esc_html__( 'Top Left', 'edumentor' ),
					'top-right'  => esc_html__( 'Top Right', 'edumentor' ),
					'bottom-left' => esc_html__( 'Bottom Left', 'edumentor' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'edumentor' ),
				],
				'condition'    => [
					'video_url!' => '',
				   'video_box_play_btn_style'    => 'style4'
				],
			]
		);

		$this->start_controls_tabs( 'tab_box_style' );

		$this->start_controls_tab(
			'tab_box_normal',
			[
				'label' => esc_html__( 'Normal', 'edumentor' ),
				'condition' => [
					'video_url!' => ''
				]
			]
		);
			// Start play button 1 style
			$this->add_control(
				'pbtn_circle_color',
				[
					'label' => esc_html__( 'Color', 'edumentor' ),
					'type' =>Controls_Manager::COLOR,
					'default'	=> '#fff',
					'selectors' => [
						'{{WRAPPER}} .hq-vb-1 .triangle' => 'stroke: {{VALUE}}'
					],
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style1'
					]
				]
			);
			// End play button 1 style

			// Start play button 2 style
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'pbtn_style_2_bg_color',
					'label' => esc_html__( 'Background Color', 'edumentor' ),
					'types' => [ 'classic', 'gradient'],
					'selector' => '{{WRAPPER}} .hq-vb-2',
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style2'
					]
				]
			);

			$this->add_control(
				'pbtn_style_2_icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'edumentor' ),
					'type' =>Controls_Manager::COLOR,
					'default'	=> '#333',
					'selectors' => [
						'{{WRAPPER}} .hq-vb-2' => 'color: {{VALUE}}'
					],
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style2'
					]
				]
			);
			// End play button 2 style

			// Start play button 3 style
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'pbtn_style_3_bg_color',
					'label' => esc_html__( 'Background Color', 'edumentor' ),
					'types' => [ 'classic', 'gradient'],
					'selector' => '{{WRAPPER}} .hq-vb-3',
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style3'
					]
				]
			);

			$this->add_control(
				'pbtn_style_3_icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'edumentor' ),
					'type' =>Controls_Manager::COLOR,
					'default'	=> '#333',
					'selectors' => [
						'{{WRAPPER}} .hq-vb-3 svg' => 'fill: {{VALUE}}'
					],
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style3'
					]
				]
			);
			// End play button 3 style

			// Start style 4
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'vb_ply_btn_bg',
					'label'    => esc_html__( 'Background', 'edumentor' ),
					'types'    => ['classic', 'gradient'],
					'exclude'  => [ 'image' ],
					'selector' => '{{WRAPPER}} .hq-style-4 .hq-vb-play-icon',
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style4'
					]
				]
			);

			$this->add_control(
				'vb_ply_btn_icon_color',
				[
					'label'     => esc_html__( 'Icon Color', 'edumentor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .hq-style-4 .hq-vb-play-icon' => 'color: {{VALUE}}',
					],
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style4'
					]
				]
			);

			$this->add_responsive_control(
				'vb_ply_btn_box_size',
				[
					'label'      => esc_html__( 'Box Size', 'edumentor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'range'      => [
						'px' => [
							'min'  => 5,
							'max'  => 500
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .hq-style-4 .hq-vb-play-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style4'
					]
				]
			);

			$this->add_responsive_control(
				'vb_ply_btn_icon_size',
				[
					'label'      => esc_html__( 'Icon Size', 'edumentor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'range'      => [
						'px' => [
							'min'  => 5,
							'max'  => 250
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .hq-style-4 .hq-vb-play-icon' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hq-style-4 .hq-vb-play-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style4'
					]
				]
			);
			// End style 4

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_box_hover',
			[
				'label' => esc_html__( 'Hover', 'edumentor' ),
				'condition' => [
					'video_url!' => ''
				]
			]
		);
			// Start play button 1 hover style
			$this->add_control(
				'pbtn_circle_hover_color',
				[
					'label' => esc_html__( 'Color', 'edumentor' ),
					'type' =>Controls_Manager::COLOR,
					'default'	=> '#fff',
					'selectors' => [
						'{{WRAPPER}} .hq-vb-1:hover .triangle' => 'stroke: {{VALUE}}',
						'{{WRAPPER}} .hq-vb-1 .circle' => 'stroke: {{VALUE}}'
					],
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style1'
					]
				]
			);
			// End play button 1 hover style

			// Start play button 2 hover style
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'pbtn_style_2_bg_hover_color',
					'label' => esc_html__( 'Background Color', 'edumentor' ),
					'types' => [ 'classic', 'gradient'],
					'exclude'  => [ 'image' ],
					'selector' => '{{WRAPPER}} .hq-vb-2:hover, {{WRAPPER}} .hq-style-4 .hq-vb-play-icon:hover',
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => ['style2', 'style4']
					]
				]
			);

			$this->add_control(
				'pbtn_style_2_icon_hover_color',
				[
					'label' => esc_html__( 'Icon Color', 'edumentor' ),
					'type' =>Controls_Manager::COLOR,
					'default'	=> '#fff',
					'selectors' => [
						'{{WRAPPER}} .hq-vb-2:hover,{{WRAPPER}} .hq-style-4 .hq-vb-play-icon:hover' => 'color: {{VALUE}}'
					],
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => ['style2', 'style4']
					]
				]
			);
			// End play button 2 hover style

			// Start play button 3 hover style
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'pbtn_style_3_bg_hover_color',
					'label' => esc_html__( 'Background Color', 'edumentor' ),
					'types' => [ 'classic', 'gradient'],
					'exclude'  => [ 'image' ],
					'selector' => '{{WRAPPER}} .hq-vb-3:hover',
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style3'
					]
				]
			);

			$this->add_control(
				'pbtn_style_3_icon_hover_color',
				[
					'label' => esc_html__( 'Icon Color', 'edumentor' ),
					'type' =>Controls_Manager::COLOR,
					'default'	=> '#fff',
					'selectors' => [
						'{{WRAPPER}} .hq-vb-3:hover svg' => 'fill: {{VALUE}}'
					],
					'condition' => [
						'video_url!' => '',
						'video_box_play_btn_style' => 'style3'
					]
				]
			);
			// End play button 3 hover style

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	/**
	 * Icon Style
	 *
	 * @return void
	 */
	protected function icon_style() {

		$this->start_controls_section(
			'icon_style_section',
			[
				'label' => esc_html__( 'Icon', 'edumentor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'vb_icon_bg',
				'label'    => esc_html__( 'Background', 'edumentor' ),
				'types'    => ['classic', 'gradient'],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .hq-style-4 .hq-style-4-inner .vb-icon',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
			]
		);

		$this->add_control(
			'vb_icon_hr',
			[
				'type' =>Controls_Manager::DIVIDER,
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
			]
		);
		
		$this->add_group_control(
			Foreground::get_type(),
			[
				'name'     => 'vb_icon_color',
				'label'    => esc_html__( 'Icon Color', 'edumentor' ),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .hq-style-4 .hq-style-4-inner .vb-icon i',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'vb_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'edumentor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200
					]
				],
				'separator' => 'before',
				'selectors'  => [
					'{{WRAPPER}} .hq-style-4 .hq-style-4-inner .vb-icon' => 'font-size: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'vb_icon_box_shadow',
				'selector' => '{{WRAPPER}} .hq-style-4 .hq-style-4-inner .vb-icon',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'vb_icon_border',
				'label'    => esc_html__( 'Border', 'edumentor' ),
				'selector' => '{{WRAPPER}} .hq-style-4 .hq-style-4-inner .vb-icon',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'vb_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'edumentor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .hq-style-4 .hq-style-4-inner .vb-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'vb_icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'edumentor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .hq-style-4 .hq-style-4-inner .vb-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'vb_icon_margin',
			[
				'label'      => esc_html__( 'Margin', 'edumentor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .hq-style-4 .hq-style-4-inner .vb-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_icon[value]!' => ''
				]
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
			'title_style_section',
			[
				'label' => esc_html__( 'Title', 'edumentor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_title!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'vb_title_typography',
				'label'    => esc_html__( 'Typography', 'edumentor' ),
				'selector' => '{{WRAPPER}} .hq-style-4 .vb-title',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_title!' => ''
				]
			]
		);

		$this->add_group_control(
			Foreground::get_type(),
			[
				'name'     => 'vb_title_color',
				'label'    => esc_html__( 'Title Color', 'edumentor' ),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .hq-style-4 .vb-title',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_title!' => ''
				]
			]
		);

		$this->add_control(
			'vb_title_hr',
			[
				'type' =>Controls_Manager::DIVIDER,
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_title!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'vb_title_text_shadow',
				'selector' => '{{WRAPPER}} .hq-style-4 .vb-title',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_title!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'vb_title_border',
				'label'    => esc_html__( 'Border', 'edumentor' ),
				'selector' => '{{WRAPPER}} .hq-style-4 .vb-title',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_title!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'vb_title_padding',
			[
				'label'      => esc_html__( 'Padding', 'edumentor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .hq-style-4 .vb-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_title!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'vb_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'edumentor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .hq-style-4 .vb-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_title!' => ''
				]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Content Style
	 *
	 * @return void
	 */
	protected function content_style() {

		$this->start_controls_section(
			'content_style_section',
			[
				'label' => esc_html__( 'Content', 'edumentor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_content!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'vb_content_typography',
				'label'    => esc_html__( 'Typography', 'edumentor' ),
				'selector' => '{{WRAPPER}} .hq-style-4 .vb-desc',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_content!' => ''
				]
			]
		);

		$this->add_control(
			'vb_content_color',
			[
				'label'     => esc_html__( 'Text Color', 'edumentor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hq-style-4 .vb-desc' => 'color: {{VALUE}}',
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_content!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'vb_content_text_shadow',
				'selector' => '{{WRAPPER}} .hq-style-4 .vb-desc',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_content!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'vb_content_border',
				'label'    => esc_html__( 'Border', 'edumentor' ),
				'selector' => '{{WRAPPER}} .hq-style-4 .vb-desc',
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_content!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'vb_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'edumentor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .hq-style-4 .vb-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_content!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'vb_content_margin',
			[
				'label'      => esc_html__( 'Margin', 'edumentor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .hq-style-4 .vb-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'video_url!' => '',
					'video_box_play_btn_style' => 'style4',
					'vb_content!' => ''
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

        $video_img = $settings['wt_video_img'];
        $video_url = $settings['video_url'];
        $popup_bg_color = $settings['popup_bg_color'];
        $video_autoplay = $settings['video_autoplay'];
        $enable_overlay = $settings['wt_enable_overlay'];
        $play_btn_style = $settings['video_box_play_btn_style'];
        if( $video_autoplay === 'yes' ){
            $autoplay = "true";
        }else{
            $autoplay = "false";
        }
		$this->add_render_attribute( 'wrapper', 'class', 'hq-video-box-wrap' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <?php if($video_img['url']){
                $video_img_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'wt_video_img' );
                echo wp_kses_post($video_img_html);
            } ?>
			<?php 
			if( 'style4' != $play_btn_style ) : 
			if( '' !== $video_url || 'yes' === $enable_overlay ) : ?>
            <div class="hq-video-box-overlay">
				<?php if( 'yes' === $enable_overlay ){
					echo '<div class="overlay"></div>';
				} ?>
				<?php if($video_url) : ?>
                <div class="hq-video-box-icon">
                    <a href="<?php echo esc_url($video_url); ?>" class="hq-video-popup" data-overlay="<?php echo esc_attr($popup_bg_color); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-vbtype="video">
						<?php if( 'style1' === $play_btn_style ) : ?>
							<div class="hq-vb-1">
	                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
	                            x="0px" y="0px" width="120px" height="120px" viewBox="0 0 213.7 213.7" enable-background="new 0 0 213.7 213.7"
	                            xml:space="preserve"> <polygon class='triangle' id="XMLID_18_" fill="none" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
	                            73.5,62.5 148.5,105.8 73.5,149.1 "/><circle class='circle' id="XMLID_17_" fill="none"  stroke-width="7" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8" r="103.3"/>
	                            </svg>
	                        </div>
						<?php elseif( 'style2' === $play_btn_style ) : ?>
							<div class="hq-vb-2">
								<svg aria-hidden="true" fill="currentColor" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
	                            <div class="ripple"></div>
	                        </div>
						<?php elseif( 'style3' === $play_btn_style ) : ?>
							<div class="hq-vb-3">
	                            <svg enable-background="new 0 0 41.999 41.999" version="1.1" viewBox="0 0 41.999 41.999" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
	                                <path d="M36.068,20.176l-29-20C6.761-0.035,6.363-0.057,6.035,0.114C5.706,0.287,5.5,0.627,5.5,0.999v40  c0,0.372,0.206,0.713,0.535,0.886c0.146,0.076,0.306,0.114,0.465,0.114c0.199,0,0.397-0.06,0.568-0.177l29-20  c0.271-0.187,0.432-0.494,0.432-0.823S36.338,20.363,36.068,20.176z M7.5,39.095V2.904l26.239,18.096L7.5,39.095z"/>
	                            </svg>
	                        </div>
						<?php endif; ?>
                    </a>
                </div>
				<?php endif; ?>
            </div>
			<?php endif; ?>
			<?php else : 
				$this->add_render_attribute( 'vb_title', [ 'class' => 'vb-title' ] );
				$this->add_render_attribute( 'vb_content', [ 'class' => 'vb-desc' ] );
				$this->add_inline_editing_attributes( 'vb_title', 'none' );
				$this->add_inline_editing_attributes( 'vb_content', 'none' );
				$title_tag = $settings['vb_title_tag'];
			?>
			<div class="hq-style-4">
				<div class="hq-style-4-inner">
				<?php if( ! empty( $settings['vb_icon']['value'] ) ) : ?>
					<div class="vb-icon">
					<?php Icons_Manager::render_icon( $settings['vb_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
				<?php endif; ?>
				<?php if( ! empty( $settings['vb_title'] ) ) : ?>
					<<?php echo esc_attr( $title_tag ); ?> <?php $this->print_render_attribute_string( 'vb_title' ); ?>><?php echo Helper::kses_advance( $settings['vb_title'] ); ?></<?php echo esc_attr( $title_tag ); ?>>
				<?php endif; ?>
				<?php if( ! empty( $settings['vb_content'] ) ) : ?>
					<p <?php $this->print_render_attribute_string( 'vb_content' ); ?>><?php echo Helper::kses_basic( $settings['vb_content'] ); ?></p>
				<?php endif; ?>
				</div>
				<?php if( ! empty( $settings['play_icon']['value'] ) ) : ?>
				<a href="<?php echo esc_url($video_url); ?>" class="hq-video-popup hq-vb-play-icon <?php echo esc_attr( $settings['vb_play_btn_pos'] ); ?>" data-overlay="<?php echo esc_attr($popup_bg_color); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-vbtype="video">
					<?php Icons_Manager::render_icon( $settings['play_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
        </div>
        <?php

    }

}