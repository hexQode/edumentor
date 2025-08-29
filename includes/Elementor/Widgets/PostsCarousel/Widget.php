<?php
/**
 * Posts Carousel
 *
 * @package FlatPack
 */
namespace HexQode\EduMentor\Elementor\Widgets\PostsCarousel;

use HexQode\EduMentor\Classes\Helper;
use HexQode\EduMentor\Traits\CarouselControls;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use HexQode\EduMentor\Classes\CardStyle;

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
        return 'hq-posts-carousel';
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
        return esc_html__( 'Posts Carousel', 'flatpack' );
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
        return 'fq-icon eicon-posts-carousel';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'blog', 'posts', 'carousel', 'blog carousel', 'post carousel', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'hq-post-cards', 'hq-carousel-controls', 'slick', 'elementor-icons-fa-regular', 'elementor-icons-fa-solid' ];
    }

    public function get_script_depends() {
        return [ 'slick', 'flatpack-el-script' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->layout_section();
        $this->query_section();
        $this->useful_options_section();
        $this->section_controls();
        $this->wrapper_style();
        $this->overlay_style();
        $this->content_area_style();
        $this->heading_style();
        $this->category_style();
        $this->post_meta_info_style();
        $this->reading_time_style();
        $this->readmore_style();
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
                    '2'  => esc_html__( 'Style 2', 'flatpack' ),
                    '3'  => esc_html__( 'Style 3', 'flatpack' ),
                    '4'  => esc_html__( 'Style 4', 'flatpack' ),
                    '5'  => esc_html__( 'Style 5', 'flatpack' )
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
                    '{{WRAPPER}} .hq-card .hq-card-thumb' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
       
        $this->add_control(
            'heading_tag',
            [
                'label'   => esc_html__( 'Heading Tag', 'flatpack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1'  => esc_html__( 'H1', 'flatpack' ),
                    'h2'  => esc_html__( 'H2', 'flatpack' ),
                    'h3'  => esc_html__( 'H3', 'flatpack' ),
                    'h4'  => esc_html__( 'H4', 'flatpack' ),
                    'h5'  => esc_html__( 'H5', 'flatpack' ),
                    'h6'  => esc_html__( 'H6', 'flatpack' )
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Query Section
     *
     * @return void
     */
    protected function query_section() {
        
        $this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Query', 'flatpack' )
			]
		);

		$this->add_control(
			'source',
			[
				'label' => _x( 'Source', 'Posts Query Control', 'flatpack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Show All', 'flatpack' ),
					'by_name' => esc_html__( 'By Categories', 'flatpack' ),
					'by_tags' => esc_html__( 'By Tags', 'flatpack' ),
				],
				'label_block' => true
			]
		);

		$this->add_control(
			'post_categories',
			[
				'label'       => esc_html__( 'Categories', 'flatpack' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => Helper::el_get_terms(),
				'default'     => [],
				'label_block' => true,
				'multiple'    => true,
				'condition'   => [
					'source'    => 'by_name'
				]
			]
		);

        $this->add_control(
			'post_tags',
			[
				'label'       => esc_html__( 'Tags', 'flatpack' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => Helper::el_get_tags(),
				'default'     => [],
				'label_block' => true,
				'multiple'    => true,
				'condition'   => [
					'source'    => 'by_tags'
				]
			]
		);

		$this->add_control(
			'posts_limit',
			[
				'label'       => esc_html__( 'Posts Limit', 'flatpack' ),
				'type'        => Controls_Manager::NUMBER,
				'desc'		  => esc_html__( 'Choose number of posts you want to show.', 'flatpack' ),
				'default'     => 6
			]
		);

		$this->add_control(
			'img_size',
			[
				'label'       => esc_html__( 'Image Size', 'flatpack' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => Helper::get_image_sizes(),
				'default'     => 'medium',
				'label_block' => true
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'flatpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'ID' => esc_html__( 'Post Id', 'flatpack' ),
                    'author' => esc_html__( 'Post Author', 'flatpack' ),
                    'title' => esc_html__( 'Title', 'flatpack' ),
                    'date' => esc_html__( 'Date', 'flatpack' ),
                    'modified' => esc_html__( 'Last Modified Date', 'flatpack' ),
                    'parent' => esc_html__( 'Parent Id', 'flatpack' ),
                    'rand' => esc_html__( 'Random', 'flatpack' ),
                    'comment_count' => esc_html__( 'Comment Count', 'flatpack' ),
                    'menu_order' => esc_html__( 'Menu Order', 'flatpack' ),
				],
			]
		);

		$this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => esc_html__( 'Ascending', 'flatpack' ),
                    'desc' => esc_html__( 'Descending', 'flatpack' )
                ],
                'default' => 'desc',
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
				'default' => 3,
				'tablet_default' => 2,
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
     * Useful Options Section
     *
     * @return void
     */
    protected function useful_options_section() {
        
        $this->start_controls_section(
			'useful_section',
			[
				'label' => esc_html__( 'Useful Options', 'flatpack' )
			]
        );

        $this->add_control(
            'category',
            [
                'label'        => esc_html__( 'Category', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'flatpack' ),
                'label_off'    => esc_html__( 'Hide', 'flatpack' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'meta_info',
            [
                'label'        => esc_html__( 'Meta Info', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'flatpack' ),
                'label_off'    => esc_html__( 'Hide', 'flatpack' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'card_style!' => '4'
                ]
            ]
        );

        $this->add_control(
            'meta_icon',
            [
                'label' => esc_html__( 'Meta Icon', 'flatpack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'flatpack' ),
                'label_off' => esc_html__( 'Hide', 'flatpack' ),
                'return_value' => 'yes',
                'condition' => [
                    'card_style!' => '4'
                ]
            ]
        );

        $this->add_control(
            'author',
            [
                'label'        => esc_html__( 'Author', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'flatpack' ),
                'label_off'    => esc_html__( 'Hide', 'flatpack' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'meta_info',
                            'operator' => '===',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'card_style',
                            'operator' => '===',
                            'value' => '4'
                        ],
                    ],
                ]
            ]
        );

        $this->add_control(
            'author_avatar',
            [
                'label' => esc_html__( 'Author Avatar', 'flatpack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'flatpack' ),
                'label_off' => esc_html__( 'Hide', 'flatpack' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'card_style' => '4',
                    'author' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'posted_by',
            [
                'label'        => esc_html__( 'Posted by Text', 'flatpack' ),
                'type'         => Controls_Manager::TEXT,
                'default'      => esc_html__( 'By', 'flatpack' ),
                'placeholder'  => esc_html__( 'Posted by text...', 'flatpack' ),
                'condition' => [
                    'card_style' => '4',
                    'author' => 'yes',
                    'author_avatar!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'date',
            [
                'label'        => esc_html__( 'Date', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'flatpack' ),
                'label_off'    => esc_html__( 'Hide', 'flatpack' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'meta_info' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'date_type',
            [
                'label' => esc_html__( 'Date Type', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'publish',
                'options' => [
                    'publish' => esc_html__( 'Publish', 'flatpack' ),
                    'modified' => esc_html__( 'Modified / Updated', 'flatpack' )
                ],
                'condition' => [
                    'meta_info' => 'yes',
                    'date' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'comments',
            [
                'label'        => esc_html__( 'Comments', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'flatpack' ),
                'label_off'    => esc_html__( 'Hide', 'flatpack' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'meta_info' => 'yes',
                    'card_style!' => '4'
                ]
            ]
        );

        $this->add_control(
            'reading_time',
            [
                'label'        => esc_html__( 'Reading Time', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'flatpack' ),
                'label_off'    => esc_html__( 'Hide', 'flatpack' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'meta_info',
                            'operator' => '===',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'card_style',
                            'operator' => '===',
                            'value' => ['4','5']
                        ],
                    ],
                ]
            ]
        );

        $this->add_control(
			'title_length',
			[
				'label'   => esc_html__( 'Title Length', 'flatpack' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 42,
			]
		);

        $this->add_control(
            'title_suffix',
            [
                'label'       => esc_html__( 'Title Suffix', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '...',
                'placeholder' => esc_html__( 'Suffix...', 'flatpack' ),
            ]
        );

        $this->add_control(
			'show_readmore',
			[
				'label'   => esc_html__( 'Readmore', 'flatpack' ),
				'type'    => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'flatpack' ),
                'label_off'    => esc_html__( 'Hide', 'flatpack' ),
                'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
            'readmore_text',
            [
                'label'       => esc_html__( 'Readmore Text', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'flatpack' ),
                'placeholder' => esc_html__( 'Text...', 'flatpack' ),
                'condition'    => [
                    'show_readmore'    => 'yes',
                    'card_style!'   => '4'
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Wrapper Section
     *
     * @return void
     */
    protected function wrapper_style() {
        
        $this->start_controls_section(
            'wrapper_style_section',
            [
                'label' => esc_html__( 'Wrapper', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'wrapper_background',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .style-2.hq-card, {{WRAPPER}} .style-4.hq-card .hq-card-inner',
                'condition' => [
                    'card_style!' => ['1', '3', '5']
                ]
            ]
        );

        $this->add_control(
			'wrapper_divider',
			[
				'type' => Controls_Manager::DIVIDER,
                'condition' => [
                    'card_style!' => ['1', '3']
                ]
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .style-1.hq-card, {{WRAPPER}} .style-2.hq-card, {{WRAPPER}} .style-4.hq-card .hq-card-inner, {{WRAPPER}} .style-5.hq-card .hq-card-inner',
                'condition' => [
                    'card_style!' => '3'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'label'    => esc_html__( 'Border', 'flatpack' ),
                'selector' => '{{WRAPPER}} .style-1.hq-card, {{WRAPPER}} .style-2.hq-card, {{WRAPPER}} .style-3.hq-card, {{WRAPPER}} .style-4.hq-card .hq-card-inner, {{WRAPPER}} .style-5.hq-card .hq-card-inner',
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .style-1.hq-card, {{WRAPPER}} .style-2.hq-card, {{WRAPPER}} .style-3.hq-card, {{WRAPPER}} .style-4.hq-card .hq-card-inner, {{WRAPPER}} .style-4.hq-card .hq-card-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .style-4.hq-card .hq-card-inner .hq-card-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'card_style' => '4'
                ]
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .style-2.hq-card, {{WRAPPER}} .style-4.hq-card .hq-card-inner, {{WRAPPER}} .style-5.hq-card .hq-card-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'card_style!' => ['1', '3']
                ]
            ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Overlay Section
     *
     * @return void
     */
    protected function overlay_style() {
        
        $this->start_controls_section(
            'overlay_style_section',
            [
                'label' => esc_html__( 'Overlay', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'card_style' => [ '1', '4' ]
                ]
            ]
        );
        
        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__( 'Overlay Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-1 .hq-card-thumb:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .style-4 .hq-card-thumb .hq-overlay' => 'background-color: {{VALUE}}'
                ],
                'condition' => [
                    'card_style' => [ '1', '4' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'overlay_opacity',
            [
                'label' => esc_html__( 'Opacity', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .style-1 .hq-card-thumb::before' => 'opacity: {{SIZE}};'
                ],
                'condition' => [
                    'card_style' => '1'
                ]
            ]
        );

        $this->add_responsive_control(
            'overlay_hover_opacity',
            [
                'label' => esc_html__( 'Hover Opacity', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .style-1:hover .hq-card-thumb::before' => 'opacity: {{SIZE}};'
                ],
                'condition' => [
                    'card_style' => '1'
                ]
            ]
        );

        $this->add_control(
            'ov_icon_style',
            [
                'label' => esc_html__( 'Icon Style', 'flatpack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'card_style' => '4'
                ]
            ]
        );

        $this->add_control(
            'ov_icon_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-4 .hq-card-thumb .hq-overlay a' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
                'condition' => [
                    'card_style' => '4'
                ]
            ]
        );

        $this->add_control(
            'ov_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-4 .hq-card-thumb .hq-overlay a svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'card_style' => '4'
                ]
            ]
        );

        $this->add_control(
            'ov_icon_bg_hover_color',
            [
                'label' => esc_html__( 'Hover Background Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-4 .hq-card-thumb .hq-overlay a:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'card_style' => '4'
                ]
            ]
        );

        $this->add_control(
            'ov_icon_hover_color',
            [
                'label' => esc_html__( 'Hover Icon Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-4 .hq-card-thumb .hq-overlay a:hover svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'card_style' => '4'
                ]
            ]
        );

        $this->add_responsive_control(
            'ov_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .style-4 .hq-card-thumb .hq-overlay a svg' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'card_style' => '4'
                ]
            ]
        );

        $this->add_control(
            'ov_date_style_heading',
            [
                'label' => esc_html__( 'Date Style', 'flatpack' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'card_style' => '4',
                    'date'  => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ov_date_typography',
                'selector' => '{{WRAPPER}} .style-4 .hq-card-thumb .hq-overlay .date',
                'condition' => [
                    'card_style' => '4',
                    'date'  => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ov_date_color',
            [
                'label' => esc_html__( 'Text Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-4 .hq-card-thumb .hq-overlay .date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'card_style' => '4',
                    'date'  => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'ov_date_margin',
            [
                'label' => esc_html__( 'Margin', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .style-4 .hq-card-thumb .hq-overlay .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'card_style' => '4',
                    'date'  => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Content Area Section
     *
     * @return void
     */
    protected function content_area_style() {
        
        $this->start_controls_section(
            'content_area_style_section',
            [
                'label' => esc_html__( 'Content Area', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-card .hq-card-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .hq-card .hq-card-content'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .hq-card .hq-card-content',
            ]
        );

        $this->add_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-card .hq-card-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-card .hq-card-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .hq-card .hq-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Heading Style
     *
     * @return void
     */
    protected function heading_style() {
        
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => esc_html__( 'Heading', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => esc_html__( 'Typography', 'flatpack' ),
                'selector' => '{{WRAPPER}} .hq-card-title',
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label'      => esc_html__( 'Padding', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-card-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label'      => esc_html__( 'Margin', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'heading_style_tabs' );
        
        $this->start_controls_tab(
            'heading_style_normal',
            [
                'label' => esc_html__( 'Normal', 'flatpack' ),
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => esc_html__( 'Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-card-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'heading_text_shadow',
                'selector' => '{{WRAPPER}} .hq-card-title a',
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'heading_style_hover',
            [
                'label' => esc_html__( 'Hover', 'flatpack' )
            ]
        );

        $this->add_control(
            'title_underline_effect',
            [
                'label'   => esc_html__( 'Line Effect', 'flatpack' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'yes'   => [
                        'title' => esc_html__( 'Yes', 'flatpack' ),
                        'icon'  => 'eicon-check',
                    ],
                    'no' => [
                        'title' => esc_html__( 'No', 'flatpack' ),
                        'icon'  => 'eicon-ban',
                    ],
                ],
                'prefix_class' => 'line-effect-',
                'default' => 'yes',
                'toggle'  => false,
            ]
        );

        $this->add_control(
            'heading_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-card-title a:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'heading_hover_line_color',
            [
                'label'     => esc_html__( 'Line Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.line-effect-yes .hq-card-title a.hq-link-hover' => 'background-image: linear-gradient({{VALUE}} 0%, {{VALUE}} 98%);',
                ],
                'condition'    => [
                    'title_underline_effect' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'heading_hover_text_shadow',
                'selector' => '{{WRAPPER}} .hq-card-title a:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

    }

    /**
     * Category Style
     *
     * @return void
     */
    protected function category_style() {
        
        $this->start_controls_section(
            'category_style_section',
            [
                'label' => esc_html__( 'Category', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_control(
            'cat_pos',
            [
                'label' => esc_html__( 'Position', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'flatpack' ),
                    'bottom-left' => esc_html__( 'Bottom left', 'flatpack' ),
                    'bottom-center' => esc_html__( 'Bottom Center', 'flatpack' ),
                    'bottom-right' => esc_html__( 'Bottom Right', 'flatpack' ),
                    'top-left' => esc_html__( 'Top Left', 'flatpack' ),
                    'top-center' => esc_html__( 'Top Center', 'flatpack' ),
                    'top-right' => esc_html__( 'Top Right', 'flatpack' ),
                    'center' => esc_html__( 'Center', 'flatpack' ),
                ],
                'selectors_dictionary' => [
                    'bottom-left' => 'left: var(--hq-cat-left); right: auto; top: auto; bottom: var(--hq-cat-bottom);',
                    'bottom-center' => 'left: 50%; bottom: var(--hq-cat-bottom); right: auto; top: auto; transform: translateX(-50%);',
                    'bottom-right' => 'left: auto; right: var(--hq-cat-left); top: auto; bottom: var(--hq-cat-bottom);',
                    'top-left' => 'left: var(--hq-cat-left); right: auto; top: var(--hq-cat-bottom); bottom: auto;',
                    'top-center' => 'left: 50%; right: auto; top: var(--hq-cat-top); bottom: auto; transform: translateX(-50%);',
                    'top-right' => 'left: auto; right: var(--hq-cat-left); top: var(--hq-cat-top); bottom: auto;',
                    'center' => 'left: 50%; right: auto; top: 50%; bottom: auto; transform: translate(-50%, -50%);',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-card .hq-card-category' => '{{VALUE}}',
                ],
                'condition'    => [
                    'category'    => 'yes',
                    'card_style!' => [ '1', '4' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'cat_x_position',
            [
                'label' => esc_html__( 'X Position', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-card .hq-card-category' => '--hq-cat-left: {{SIZE}}{{UNIT}}; --hq-cat-right: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'category'    => 'yes',
                    'card_style!' => [ '1', '4' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'cat_y_position',
            [
                'label' => esc_html__( 'Y Position', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-card .hq-card-category' => '--hq-cat-top: {{SIZE}}{{UNIT}}; --hq-cat-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'category'    => 'yes',
                    'card_style!' => [ '1', '4' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cat_typography',
                'label'    => esc_html__( 'Typography', 'flatpack' ),
                'selector' => '{{WRAPPER}} .hq-card .hq-card-category',
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'category_padding',
            [
                'label'      => esc_html__( 'Padding', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-card .hq-card-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs( 'category_style_tabs' );
        
        $this->start_controls_tab(
            'category_style_normal',
            [
                'label' => esc_html__( 'Normal', 'flatpack' ),
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'cat_background',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-card .hq-card-category',
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_control(
            'cat_color',
            [
                'label'     => esc_html__( 'Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .hq-card .hq-card-category' => 'color: {{VALUE}}',
                ],
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cat_box_shadow',
                'selector' => '{{WRAPPER}} .hq-card .hq-card-category',
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'cat_border',
                'label'    => esc_html__( 'Border', 'flatpack' ),
                'selector' => '{{WRAPPER}} .hq-card .hq-card-category',
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'cat_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-card .hq-card-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'category_style_hover',
            [
                'label' => esc_html__( 'Hover', 'flatpack' ),
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'cat_hover_background',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-card .hq-card-category:hover',
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_control(
            'cat_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .hq-card .hq-card-category:hover' => 'color: {{VALUE}}',
                ],
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cat_hover_box_shadow',
                'selector' => '{{WRAPPER}} .hq-card .hq-card-category:hover',
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'cat_hover_border',
                'label'    => esc_html__( 'Border', 'flatpack' ),
                'selector' => '{{WRAPPER}} .hq-card .hq-card-category:hover',
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'cat_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-card .hq-card-category:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'category'    => 'yes'
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

    }

    /**
     * Post Meta Info Style
     *
     * @return void
     */
    protected function post_meta_info_style() {
        
        $this->start_controls_section(
            'meta_info_style_section',
            [
                'label' => esc_html__( 'Meta Info', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'    => [
                   'meta_info'    => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_info_typography',
                'label'    => esc_html__( 'Typography', 'flatpack' ),
                'selector' => '{{WRAPPER}} .hq-meta li, {{WRAPPER}} .hq-meta li a, {{WRAPPER}} .card-footer a',
                'condition'    => [
                    'meta_info'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_info_space_between_item',
            [
                'label'      => esc_html__( 'Space Between Item', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-meta' => 'column-gap: {{SIZE}}{{UNIT}}; row-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hq-meta li:not(:last-of-type)' => 'padding-right: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'meta_info'    => 'yes',
                    'card_Style!' => '4'
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_info_space_between_icon',
            [
                'label'      => esc_html__( 'Space Between Icon', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-meta li a i' => 'margin-right: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'meta_info'    => 'yes',
                    'meta_icon'    => 'yes',
                    'card_Style!' => '4'
                 ],
            ]
        );
        
        $this->add_responsive_control(
            'meta_info_margin',
            [
                'label'      => esc_html__( 'Margin', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .card-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'meta_info'    => 'yes'
                 ],
            ]
        );

        $this->start_controls_tabs( 'meta_info_style_tabs' );
        
        $this->start_controls_tab(
            'meta_info_style_normal',
            [
                'label' => esc_html__( 'Normal', 'flatpack' ),
                'condition'    => [
                    'meta_info'    => 'yes'
                 ],
            ]
        );

        $this->add_control(
            'meta_info_color',
            [
                'label'     => esc_html__( 'Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-meta li' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hq-meta li a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .card-footer a' => 'color: {{VALUE}}'
                ],
                'condition'    => [
                    'meta_info'    => 'yes'
                ],
            ]
        );

        $this->add_control(
            'meta_info_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-meta li i' => 'color: {{VALUE}}',
                ],
                'condition'    => [
                    'meta_info'    => 'yes',
                    'meta_icon'    => 'yes',
                    'card_style!'   => '4'
                ],
            ]
        );

        $this->add_control(
            'meta_info_dot_color',
            [
                'label'     => esc_html__( 'Dot Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-meta li:not(:last-of-type):after' => 'background-color: {{VALUE}}',
                ],
                'condition'    => [
                    'meta_info'    => 'yes',
                    'card_style!'   => '4'
                ]
            ]
        );

        $this->add_control(
            'meta_info_by_txt',
            [
                'label'     => esc_html__( 'By Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card-footer .author .by' => 'color: {{VALUE}}',
                ],
                'condition'    => [
                    'card_style'   => '4'
                ]
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'meta_info_style_hover',
            [
                'label' => esc_html__( 'Hover', 'flatpack' ),
                'condition'    => [
                    'meta_info'    => 'yes'
                ],
            ]
        );

        $this->add_control(
            'meta_info_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-meta li a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .card-footer a:hover' => 'color: {{VALUE}}'
                ],
                'condition'    => [
                    'meta_info'    => 'yes'
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        
        $this->end_controls_section();
    }

    /**
     * Reading Time Style
     *
     * @return void
     */
    protected function reading_time_style() {
        
        $this->start_controls_section(
            'reading_time_style_section',
            [
                'label' => esc_html__( 'Reading Time', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'    => [
                    'card_style' => ['4', '5'],
                   'reading_time' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'reading_time_typography',
                'label'    => esc_html__( 'Typography', 'flatpack' ),
                'selector' => '{{WRAPPER}} .style-4 .hq-card-content .card-header .reading-time, {{WRAPPER}} .style-5 .hq-card-content .card-footer .reading-time',
                'condition'    => [
                    'card_style' => ['4', '5'],
                   'reading_time' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'reading_time_space_between_icon',
            [
                'label'      => esc_html__( 'Space Between Icon', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .style-4 .hq-card-content .card-header .reading-time i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .style-5 .hq-card-content .card-footer .reading-time i' => 'margin-right: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'card_style' => ['4', '5'],
                   'reading_time' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'reading_time_txt_color',
            [
                'label' => esc_html__( 'Text Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-4 .hq-card-content .card-header .reading-time' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .style-5 .hq-card-content .card-footer .reading-time' => 'color: {{VALUE}}'
                ],
                'condition'    => [
                    'card_style' => ['4', '5'],
                    'reading_time' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'reading_time_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .style-4 .hq-card-content .card-header .reading-time i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .style-5 .hq-card-content .card-footer .reading-time i' => 'color: {{VALUE}}'
                ],
                'condition'    => [
                    'card_style' => ['4', '5'],
                    'reading_time' => 'yes'
                ]
            ]
        );
        
        
        $this->end_controls_section();
    }

    /**
     * Readmore Style
     *
     * @return void
     */
    protected function readmore_style() {
        
        $this->start_controls_section(
            'readmore_style_section',
            [
                'label' => esc_html__( 'Read More', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'    => [
                    'card_style' => ['4', '5'],
                    'show_readmore'    => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'readmore_typography',
                'label'    => esc_html__( 'Typography', 'flatpack' ),
                'selector' => '{{WRAPPER}} .style-5 .hq-card-content .card-footer .read-more',
                'condition'    => [
                    'card_style' => ['5'],
                    'show_readmore'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'readmore_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-card-content .card-footer .read-more svg' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'card_style' => ['4', '5'],
                    'show_readmore'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'readmore_margin',
            [
                'label'      => esc_html__( 'Margin', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-card-content .card-footer .read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'card_style' => ['4', '5'],
                    'show_readmore'    => 'yes'
                ],
            ]
        );

        // Tab Start
        $this->start_controls_tabs( 'readmore_style_tabs' );
                
        $this->start_controls_tab(
            'readmore_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'flatpack' ),
            ]
        );
        
        $this->add_control(
            'readmore_txt_color',
            [
                'label' => esc_html__( 'Text Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-card-content .card-footer .read-more' => 'color: {{VALUE}}',
                ],
                'condition'    => [
                    'card_style' => ['5'],
                    'show_readmore'    => 'yes'
                ],
            ]
        );

        $this->add_control(
            'readmore_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-card-content .card-footer .read-more svg' => 'fill: {{VALUE}}',
                ],
                'condition'    => [
                    'card_style' => ['4', '5'],
                    'show_readmore'    => 'yes'
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'readmore_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'flatpack' )
            ]
        );
        
        $this->add_control(
            'readmore_txt_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-card-content .card-footer .read-more:hover' => 'color: {{VALUE}}',
                ],
                'condition'    => [
                    'card_style' => ['5'],
                    'show_readmore'    => 'yes'
                ],
            ]
        );

        $this->add_control(
            'readmore_icon_hover_color',
            [
                'label' => esc_html__( 'Icon Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-card-content .card-footer .read-more:hover svg' => 'fill: {{VALUE}}',
                ],
                'condition'    => [
                    'card_style' => ['4', '5'],
                    'show_readmore'    => 'yes'
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        // Tab End
        
        $this->end_controls_section();

    }

    /**
     * Render Content
     *
     * @return void
     */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
		$args = array(
            'post_type'   => 'post',
            'post__not_in' => get_option( 'sticky_posts' ),
            'posts_per_page' => $settings['posts_limit'],
            'orderby'	=> $settings['orderby'],
            'order'	=> $settings['order'],
            'post_status' => 'publish',
            'paged' => $paged,
		);

		if ( 'by_name' === $settings['source'] ) {
            $args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $settings['post_categories'],
			);
        }elseif( 'by_tags' === $settings['source'] ) {
            $args['tax_query'] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $settings['post_tags']
            );
        }
        
        $wp_query = new \WP_Query( $args );

		if( 'arrow' === $settings['navigation'] || 'both' === $settings['navigation'] ){
			$nav_style = 'top-right' == $settings['nav_style'] ? 'navi-top-right' : '';
		}else{
			$nav_style = '';
		}

        $card_style = $settings['card_style'];

        $this->add_render_attribute(
            'carousel_wrapper',
            [ 
                'class' => [ 'hq-carousel', $nav_style ]
            ]
        ); ?>
        <div class="hq-blog-wrapper">
            <?php if( $wp_query->have_posts() ) : ?>
                <div <?php echo $this->get_render_attribute_string( 'carousel_wrapper' ); ?>>
                    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                        <div class="slick-slide">
                            <?php CardStyle::{"style_{$card_style}"}($settings, $wp_query->ID); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="carousel-preloader"><span></span></div>
            <?php
            Helper::get_carousel_control_layout($settings);
            wp_reset_postdata();
            else :
                esc_html_e( 'No posts found!', 'flatpack' );
            endif;
            ?>
        </div>
        <?php
    }

}