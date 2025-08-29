<?php
/**
 * Category Carousel
 *
 * @package FlatPack
 */
namespace HexQode\EduMentor\Elementor\Widgets\CategoryCarousel;

use HexQode\EduMentor\Classes\Helper;
use HexQode\EduMentor\Traits\CarouselControls;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || die();

class Widget extends Widget_Base {

    use CarouselControls;

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'hq-category-carousel';
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
        return esc_html__( 'Category Carousel', 'flatpack' );
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
        return 'fq-icon eicon-tags';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'blog', 'posts', 'carousel', 'category carousel', 'category', 'categories', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'hq-categories', 'hq-carousel-controls', 'slick', 'elementor-icons-fa-regular', 'elementor-icons-fa-solid' ];
    }

    public function get_script_depends() {
        return [ 'slick', 'flatpack-el-script' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->layout_section();
        $this->categories_section();
        $this->section_controls();
        $this->content_area_style();
        $this->category_style();
        $this->post_count_style();
        $this->style_navigation();
        $this->style_pagination();
        
    }

    /**
     * Layout Section
     *
     * @return void
     */
    protected function layout_section() {

        $this->start_controls_section(
			'layout_section',
			[
				'label' => esc_html__( 'Layout', 'flatpack' )
			]
        );

        $this->add_control(
            'card_style',
            [
                'label'   => esc_html__( 'Card Layout', 'flatpack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'  => esc_html__( 'Style 1', 'flatpack' ),
                    '2'  => esc_html__( 'Style 2', 'flatpack' )
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Image Height', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card .hq-cat-card-thumb' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card .hq-cat-card-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Categories Section
     *
     * @return void
     */
    protected function categories_section() {

        $this->start_controls_section(
			'categories_section',
			[
				'label' => esc_html__( 'Categories', 'flatpack' )
			]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'cat',
            [
                'label' => esc_html__( 'Select Category', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'options' => Helper::el_get_terms()
            ]
        );
        
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Category Image', 'flatpack' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ],
                'condition' => [
                    'cat!' => ''
                ]
            ]
        );

        $repeater->add_control(
            'customize',
            [
                'label' => esc_html__( 'Cutomize Colors?', 'flatpack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'flatpack' ),
                'label_off' => esc_html__( 'No', 'flatpack' ),
                'return_value' => 'yes',
                'condition' => [
                    'cat!' => ''
                ]
            ]
        );

        // Tab Start
        $repeater->start_controls_tabs( 'customize_style_tabs' );
                
        $repeater->start_controls_tab(
            'category_style_tab',
            [
                'label' => esc_html__( 'Category', 'flatpack' ),
                'condition' => [
                    'cat!' => '',
                    'customize' => 'yes'
                ]
            ]
        );
        
        $repeater->add_control(
            'cat_bg_color',
            [
                'label' => esc_html__( 'Backgorund Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-cat-card .hq-cat-card-content .hq-cat-name' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'cat!' => '',
                    'customize' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'cat_text_color',
            [
                'label' => esc_html__( 'Text Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-cat-card .hq-cat-card-content .hq-cat-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'cat!' => '',
                    'customize' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'cat_bg_hover_color',
            [
                'label' => esc_html__( 'Hover Backgorund Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-cat-card .hq-cat-card-content .hq-cat-name:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'cat!' => '',
                    'customize' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'cat_text_hover_color',
            [
                'label' => esc_html__( 'Text Hover Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-cat-card .hq-cat-card-content .hq-cat-name:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'cat!' => '',
                    'customize' => 'yes'
                ]
            ]
        );
        
        $repeater->end_controls_tab();
        
        $repeater->start_controls_tab(
            'count_text_tab',
            [
                'label' => esc_html__( 'Count Text', 'flatpack' ),
                'condition' => [
                    'cat!' => '',
                    'customize' => 'yes'
                ]
            ]
        );
        
        $repeater->add_control(
            'count_text_color',
            [
                'label' => esc_html__( 'Text Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-cat-card .hq-cat-card-content .hq-cat-post-count' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'cat!' => '',
                    'customize' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'count_dot_color',
            [
                'label' => esc_html__( 'Dot Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-cat-card .hq-cat-card-content .hq-cat-post-count:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'cat!' => '',
                    'customize' => 'yes'
                ]
            ]
        );
        
        $repeater->end_controls_tab();
        
        $repeater->end_controls_tabs();
        // Tab End
        
        $this->add_control(
            'category_items',
            [
                'label'       => esc_html__( 'Category Items', 'flatpack' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ cat }}}'
            ]
        );

        $this->add_control(
            'count_text',
            [
                'label'        => esc_html__( 'Count Text', 'textdomain' ),
                'type'         => Controls_Manager::TEXT,
                'label_block'  => true,
                'default'      => esc_html__( 'Posts', 'textdomain' ),
                'placeholder'  => esc_html__( 'Count text...', 'textdomain' ),
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );
        
        $this->end_controls_section();

    }

    /**
	 * Carousel Controls
	 *
	 * @return void
	 */
	protected function section_controls() {

		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'flatpack' )
			]
		);

        $this->add_control(
			'carousel',
			[
				'label' => esc_html__( 'Carousel', 'flatpack' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'yes',
                'frontend_available' => true,
				'render_type' => 'ui'
			]
		);

		$slides_per_show = range( 1, 10 );
		$slides_per_show = array_combine( $slides_per_show, $slides_per_show );

		$this->add_responsive_control(
			'slides_per_show',
			[
				'label' => esc_html__( 'Slides to Show', 'flatpack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 4,
				'tablet_default' => 3,
				'mobile_default' => 1,
				'options' => $slides_per_show,
				'frontend_available' => true,
				'render_type' => 'ui',
			]
		);

		$this->add_responsive_control(
			'slides_per_scroll',
			[
				'label' => esc_html__( 'Slides to Scroll', 'flatpack' ),
				'type' => Controls_Manager::SELECT,
				'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'flatpack' ),
				'default' => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
				'options' => $slides_per_show,
				'condition' => [
					'slides_per_show!' => '1'
				],
				'frontend_available' => true,
				'render_type' => 'ui'
			]
		);

        $this->add_responsive_control(
			'spaceBetween',
			[
				'label'      => esc_html__( 'Space Between', 'flatpack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1
					],
					'em'  => [
						'min' => 0,
						'max' => 100
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-list' => 'margin: 0 -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .slick-slide' => 'margin: 0 {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'flatpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'flatpack' ),
				'label_off'    => esc_html__( 'No', 'flatpack' ),
				'return_value' => 'yes',
				'default'      => 'yes',
                'frontend_available' => true,
				'render_type' => 'ui'
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'   => esc_html__( 'Autoplay Speed', 'flatpack' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 500,
				'max'     => 20000,
				'step'    => 5,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes'
                ],
                'frontend_available' => true,
				'render_type' => 'ui'
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'        => esc_html__( 'Pause on Hover', 'flatpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'flatpack' ),
				'label_off'    => esc_html__( 'No', 'flatpack' ),
				'return_value' => 'yes',
				'default'      => 'yes',
                'condition' => [
					'autoplay' => 'yes'
				],
                'frontend_available' => true,
				'render_type' => 'ui'
			]
		);

		$this->add_control(
			'infinite_loop',
			[
				'label'        => esc_html__( 'Infinite Loop', 'flatpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'flatpack' ),
				'label_off'    => esc_html__( 'No', 'flatpack' ),
				'return_value' => 'yes',
				'default'      => 'yes',
                'frontend_available' => true,
				'render_type' => 'ui'
			]
		);

		$this->add_control(
			'anim_speed',
			[
				'label'   => esc_html__( 'Animation Speed', 'flatpack' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 100,
				'max'     => 3000,
				'step'    => 5,
				'default' => 500,
                'frontend_available' => true,
				'render_type' => 'ui'
			]
		);

        $this->add_control(
			'center_mode',
			[
				'label'        => esc_html__( 'Center Mode', 'flatpack' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'flatpack' ),
				'label_off'    => esc_html__( 'No', 'flatpack' ),
				'return_value' => 'yes',
				'default'      => 'no',
                'frontend_available' => true,
				'render_type' => 'ui'
			]
		);

        $this->add_responsive_control(
			'center_padding',
			[
				'label'   => esc_html__( 'Center Padding', 'flatpack' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 200,
				'step'    => 1,
				'default' => 50,
				'tablet_default' => 30,
				'mobile_default' => 10,
                'frontend_available' => true,
				'render_type' => 'ui',
                'condition' => [
					'center_mode' => 'yes'
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => esc_html__( 'Navigation', 'flatpack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'flatpack' ),
					'arrow' => esc_html__( 'Arrow', 'flatpack' ),
					'dots' => esc_html__( 'Dots', 'flatpack' ),
					'both' => esc_html__( 'Arrow & Dots', 'flatpack' ),
				],
				'default' => 'dots',
				'frontend_available' => true,
				'style_transfer' => true
			]
		);

        $this->add_control(
            'dots_style',
            [
                'label' => esc_html__( 'Dots Style', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'flatpack' ),
                    '2' => esc_html__( 'Style 2', 'flatpack' )
                ],
                'frontend_available' => true,
				'style_transfer' => true,
                'condition' => [
					'navigation' => ['dots', 'both']
				],
            ]
        );

        $this->add_control(
			'arrow_prev_icon',
			[
				'label' => esc_html__( 'Previous Icon', 'flatpack' ),
				'label_block' => false,
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
                'exclude_inline_options' => ['svg'],
				'default' => [
					'value' => 'fas fa-chevron-left',
					'library' => 'elementor-icons-line-awesome-icons',
				],
				'condition' => [
					'navigation' => ['arrow', 'both']
				],
			]
		);

		$this->add_control(
			'arrow_next_icon',
			[
				'label' => esc_html__( 'Next Icon', 'flatpack' ),
				'label_block' => false,
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
                'exclude_inline_options' => ['svg'],
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'elementor-icons-line-awesome-icons',
				],
				'condition' => [
					'navigation' => ['arrow', 'both']
				],
			]
		);

		$this->end_controls_section();

	}

    /**
	 * Content area style
	 *
	 * @return void
	 */
    protected function content_area_style() {

        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content Area', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-cat-card .hq-cat-card-content',
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .hq-cat-card .hq-cat-card-content',
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_control(
            'content_radius',
            [
                'label' => esc_html__( 'Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card .hq-cat-card-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card .hq-cat-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card .hq-cat-card-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );
        
        $this->end_controls_section();
    }

    /**
	 * Category style
	 *
	 * @return void
	 */
    protected function category_style() {
        
        $this->start_controls_section(
            'category_style',
            [
                'label' => esc_html__( 'Category', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'selector' => '{{WRAPPER}} .hq-cat-card-content .hq-cat-name',
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'category_padding',
            [
                'label' => esc_html__( 'Padding', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'category_margin',
            [
                'label' => esc_html__( 'Margin', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        // Tab Start
        $this->start_controls_tabs( 'category_style_tabs' );
                
        $this->start_controls_tab(
            'category_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'flatpack' ),
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );
        
        $this->add_control(
            'cat_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-name' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_control(
            'cat_text_color',
            [
                'label' => esc_html__( 'Text Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cate_border',
                'selector' => '{{WRAPPER}} .hq-cat-card-content .hq-cat-name',
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_control(
            'cat_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'category_box_shadow',
                'selector' => '{{WRAPPER}} .hq-cat-card-content .hq-cat-name',
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'category_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'flatpack' ),
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );
        
        $this->add_control(
            'cat_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-name:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_control(
            'cat_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-name:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cat_hover_border',
                'selector' => '{{WRAPPER}} .hq-cat-card-content .hq-cat-name:hover',
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_control(
            'cat_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-name:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'category_hover_box_shadow',
                'selector' => '{{WRAPPER}} .hq-cat-card-content .hq-cat-name:hover',
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        // Tab End
        
        $this->end_controls_section();
    }

    /**
	 * Post count style
	 *
	 * @return void
	 */
    protected function post_count_style() {

        $this->start_controls_section(
            'post_count_style',
            [
                'label' => esc_html__( 'Post Count', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'p_count_typography',
                'selector' => '{{WRAPPER}} .hq-cat-card-content .hq-cat-post-count',
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_control(
            'p_count_text_color',
            [
                'label' => esc_html__( 'Text Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-post-count' => 'color: {{VALUE}}'
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'p_count_padding',
            [
                'label' => esc_html__( 'Padding', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-post-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'p_count_margin',
            [
                'label' => esc_html__( 'Margin', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-post-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_control(
            'dot_label',
            [
                'label' => esc_html__( 'Dot Style', 'flatpack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'dot_size',
            [
                'label' => esc_html__( 'Dot Size', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 3,
                        'max' => 20,
                        'step' => 1
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-post-count:before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'category_items!' => ''
                ]
            ]
        );

        $this->add_control(
            'dot_color',
            [
                'label' => esc_html__( 'Dot Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-cat-card-content .hq-cat-post-count:before' => 'background-color: {{VALUE}}'
                ],
                'condition' => [
                    'category_items!' => ''
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
        $card_style = $settings['card_style'];
        $categories = $settings['category_items'];
        $count_text = $settings['count_text'];
        $this->add_render_attribute(
            'carousel_wrapper',
            [ 
                'class' => [ 'hq-carousel' ]
            ]
        ); ?>
        <div class="hq-blog-wrapper">
            <?php if( ! empty( $categories ) ) : ?>
            <div <?php echo $this->get_render_attribute_string( 'carousel_wrapper' ); ?>>
                <?php foreach( $categories as $category ) : 
                    if( ! empty( $category['image']['url'] && $category['cat'] ) ) : 
                        $term_data = get_term_by('slug', $category['cat'], 'category' );
                ?>
                <div class="slick-slide elementor-repeater-item-<?php echo $category['_id']; ?>">
                    <div class="hq-cat-card style-<?php echo esc_attr( $card_style ); ?>">
                        <div class="hq-cat-card-thumb">
                            <a href="<?php echo esc_url( get_term_link( $term_data->slug, 'category' ) ); ?>">
                                <img src="<?php echo esc_url( $category['image']['url'] ); ?>" alt="<?php echo esc_attr( $term_data->name ); ?>" title="<?php echo esc_attr( $term_data->name ); ?>">
                            </a>
                        </div>
                        <div class="hq-cat-card-content">
                            <a href="<?php echo esc_url( get_term_link( $term_data->slug, 'category' ) ); ?>" class="hq-cat-name"><?php echo esc_html( $term_data->name ); ?></a>
                            <div class="hq-cat-post-count"><?php echo esc_html( $term_data->count ) . ' ' . esc_html( $count_text ); ?></div>
                        </div>
                    </div>
                </div>
                <?php endif;
                endforeach; ?>
            </div>
            <?php Helper::get_carousel_control_layout($settings); ?>
            <div class="carousel-preloader"><span></span></div>
            <?php 
            else:
                esc_html_e( 'No category found!', 'flatpack' );
            endif; ?>
        </div>
        <?php

    }

}