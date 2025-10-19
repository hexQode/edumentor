<?php
/**
 * Blog List
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\BlogList;

use HexQode\EduMentor\Classes\Helper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

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
        return 'edumentor-blog-list';
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
        return esc_html__( 'Blog List', 'edumentor' );
    }

    public function get_custom_help_url() {
        return 'https://edumentor.com';
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
        return 'edumentor-icon eicon-posts-grid';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'blog', 'grid', 'list', 'posts', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'hq-blog-list' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->layout_section();
        $this->query_section();
        $this->useful_options_section();
        $this->scrolling_animation_section();
        
    }

    /**
     * Layout Section
     */
    protected function layout_section() {

        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Layout', 'redias-core' )
            ]
        );
        
        $this->add_responsive_control(
            'column',
            [
                'label' => esc_html__( 'Columns', 'textdomain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 4,
                        'step' => 1
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 3
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-blog-posts' => 'grid-template-columns: repeat({{SIZE}}, 1fr);'
                ]
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
				'label' => esc_html__( 'Query', 'softgen-core' )
			]
		);

		$this->add_control(
			'source',
			[
				'label' => _x( 'Source', 'Posts Query Control', 'softgen-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Show All', 'softgen-core' ),
					'by_name' => esc_html__( 'Manual Selection', 'softgen-core' ),
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'post_categories',
			[
				'label'       => esc_html__( 'Categories', 'softgen-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => Helper::el_get_terms(),
				'default'     => [],
				'label_block' => true,
				'multiple'    => true,
				'condition'   => [
					'source'    => 'by_name',
				],
			]
		);

		$this->add_control(
			'posts_limit',
			[
				'label'       => esc_html__( 'Posts Limit', 'softgen-core' ),
				'type'        => Controls_Manager::NUMBER,
				'desc'		  => esc_html__( 'Choose number of posts you want to show.', 'softgen-core' ),
				'default'     => 3
			]
		);

		$this->add_control(
			'img_size',
			[
				'label'       => esc_html__( 'Image Size', 'softgen-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => Helper::get_image_sizes(),
				'default'     => 'softgen-thumb-grid',
				'label_block' => true,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'softgen-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'ID' => esc_html__( 'Post Id', 'softgen-core' ),
                    'author' => esc_html__( 'Post Author', 'softgen-core' ),
                    'title' => esc_html__( 'Title', 'softgen-core' ),
                    'date' => esc_html__( 'Date', 'softgen-core' ),
                    'modified' => esc_html__( 'Last Modified Date', 'softgen-core' ),
                    'parent' => esc_html__( 'Parent Id', 'softgen-core' ),
                    'rand' => esc_html__( 'Random', 'softgen-core' ),
                    'comment_count' => esc_html__( 'Comment Count', 'softgen-core' ),
                    'menu_order' => esc_html__( 'Menu Order', 'softgen-core' ),
				],
			]
		);

		$this->add_control(
            'order',
            [
                'label' => __( 'Order', 'softgen-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => esc_html__( 'Ascending', 'softgen-core' ),
                    'desc' => esc_html__( 'Descending', 'softgen-core' )
                ],
                'default' => 'desc',
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
				'label' => esc_html__( 'Useful Options', 'softgen-core' )
			]
        );

        $this->add_control(
            'category',
            [
                'label'        => esc_html__( 'Category', 'softgen-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'softgen-core' ),
                'label_off'    => esc_html__( 'Hide', 'softgen-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'meta_info',
            [
                'label'        => esc_html__( 'Meta Info', 'softgen-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'softgen-core' ),
                'label_off'    => esc_html__( 'Hide', 'softgen-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
			'title_length',
			[
				'label'   => esc_html__( 'Title Length', 'softgen-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 42,
			]
		);

        $this->add_control(
            'title_suffix',
            [
                'label'       => esc_html__( 'Title Suffix', 'softgen-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '...',
                'placeholder' => esc_html__( 'Suffix...', 'softgen-core' ),
            ]
        );

		$this->add_control(
			'show_excerpt',
			[
				'label'   => esc_html__( 'Excerpt', 'softgen-core' ),
				'type'    => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'softgen-core' ),
                'label_off'    => esc_html__( 'Hide', 'softgen-core' ),
                'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'   => esc_html__( 'Excerpt Length', 'softgen-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 100,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

        $this->add_control(
            'excerpt_suffix',
            [
                'label'       => esc_html__( 'Excerpt Suffix', 'softgen-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '...',
                'placeholder' => esc_html__( 'Suffix...', 'softgen-core' ),
                'condition' => [
					'show_excerpt' => 'yes',
				],
            ]
        );

        $this->add_control(
			'show_readmore',
			[
				'label'   => esc_html__( 'Readmore', 'softgen-core' ),
				'type'    => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'softgen-core' ),
                'label_off'    => esc_html__( 'Hide', 'softgen-core' ),
                'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
            'readmore_text',
            [
                'label'       => __( 'Readmore Text', 'softgen-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'softgen-core' ),
                'placeholder' => esc_html__( 'Text...', 'softgen-core' ),
                'condition'    => [
                    'show_readmore'    => 'yes'
                ],
            ]
        );

		$this->add_control(
			'pagination_control',
			[
				'label' => esc_html__( 'Pagination', 'softgen-core' ),
				'type' => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'softgen-core' ),
                'label_off'    => esc_html__( 'Hide', 'softgen-core' ),
                'return_value' => 'yes',
				'default' => 'no',
                'condition'    => [
                    'carousel!'    => 'yes',
                ],
			]
		);

        $this->end_controls_section();

    }

    /**
     * Scrolling Animation
     *
     * @return void
     */
    protected function scrolling_animation_section() {
        
        $this->start_controls_section(
			'scrolling_animation_section',
			[
				'label' => esc_html__( 'Scrolling Animation', 'softgen-core' ),
                'condition' => [
                    'carousel!'    => 'yes',
                ]
			]
        );

        $this->add_control(
            'scroll_anim',
            [
                'label'        => esc_html__( 'Scrolling Animation', 'softgen-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'softgen-core' ),
                'label_off'    => esc_html__( 'No', 'softgen-core' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'carousel!'    => 'yes'
                ]
            ]
        );

        $this->add_control(
            'anim_effect',
            [
                'label'   => esc_html__( 'Effect', 'softgen-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dl-fadeIn',
                'options' => Helper::get_animation_effects(),
                'condition' => [
                    'scroll_anim' => 'yes',
                    'carousel!'    => 'yes'
				]
            ]
        );

        $this->add_control(
            'anim_offset',
            [
                'label'      => esc_html__( 'Offset', 'softgen-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range'      => [
                    'ms' => [
                        'min'  => 0,
                        'max'  => 2000,
                        'step' => 10,
                    ],
                ],
                'default'    => [
                    'unit' => 'ms',
                    'size' => 200,
                ],
                'condition' => [
                    'scroll_anim' => 'yes',
                    'carousel!'    => 'yes'
				]
            ]
        );

        $this->add_control(
            'anim_duration',
            [
                'label'      => esc_html__( 'Duration', 'softgen-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range'      => [
                    'ms' => [
                        'min'  => 0,
                        'max'  => 5000,
                        'step' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'ms',
                    'size' => 700,
                ],
                'condition' => [
                    'scroll_anim' => 'yes',
                    'carousel!'    => 'yes'
				]
            ]
        );
        
        $this->add_control(
            'anim_delay',
            [
                'label'      => esc_html__( 'Delay', 'softgen-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range'      => [
                    'ms' => [
                        'min'  => 0,
                        'max'  => 5000,
                        'step' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'ms',
                    'size' => 400,
                ],
                'condition' => [
                    'scroll_anim' => 'yes',
                    'carousel!'    => 'yes'
				]
            ]
        );

        $this->add_control(
            'anim_delay_interval',
            [
                'label'      => esc_html__( 'Delay Interval', 'softgen-core' ),
                'description'      => esc_html__( 'Delay interval between items.', 'softgen-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range'      => [
                    'ms' => [
                        'min'  => 0,
                        'max'  => 5000,
                        'step' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'ms',
                    'size' => 100,
                ],
                'condition' => [
                    'scroll_anim' => 'yes',
                    'carousel!'    => 'yes'
				]
            ]
        );

        $this->add_control(
			'entrance_animation',
			[
				'label' => esc_html__( 'Entrance Animation', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ANIMATION,
				'prefix_class' => 'animated ',
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

		if ( $settings['source'] === 'by_name'  ) :

			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $settings['post_categories'],
			);

		endif;
        $wp_query = new \WP_Query( $args );
        $this->add_render_attribute( 'wrapper', [ 'class' => [ 'hq-blog-posts' ] ] );

        if( 'yes' === $settings['scroll_anim'] ) {
            $anim_cls = ['wow', 'hq-animation', esc_attr( $settings['anim_effect'] )];
            $this->add_render_attribute( 'scrolling-animation', [ 
                'class' => array_merge(get_post_class('hq-blog-item'), $anim_cls),
                'data-wow-offset' => esc_attr( $settings['anim_offset']['size'] ),
                'data-wow-duration' => esc_attr( $settings['anim_duration']['size'] ) . 'ms',
            ] );
        }else{
            $this->add_render_attribute( 'scrolling-animation', [ 
                'class' => get_post_class('hq-blog-item')
            ] );
        }
        
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            
        </div>
        <?php
    }

    /**
     * Post Card
     */
    protected function get_post_card( $post_id = '', $index = 0) {
        if( empty($post_id) ) return;
        $settings = $this->get_settings_for_display();
        $img_placeholder = Utils::get_placeholder_image_src();
        if( 'yes' === $settings['scroll_anim'] ) {
            $delay = $settings['anim_delay']['size'] + ( $settings['anim_delay_interval']['size'] * $index );
            $delay_attr = ' data-wow-delay="'. $delay .'ms"';
        }else{
            $delay_attr = '';
        }
        ?>
        <article <?php echo $this->get_render_attribute_string( 'scrolling-animation' ) . $delay_attr; ?>>
            <div class="blog-post-inner">
                <div class="entry_thumb">
                    <a href="<?php the_permalink(); ?>" class="entry_thumb-link">
                    <?php if( has_post_thumbnail() ) : ?>
                        <?php echo get_the_post_thumbnail( $post_id, $settings['img_size'] ); ?>
                    <?php else: ?>
                        <img src="<?php echo esc_url( $img_placeholder ); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    </a>
                    <?php 
                    if( 'yes' === $settings['category'] ) {
                        Helper::get_terms( 'category', 1, true, 'category ' . $settings['cat_position'], false );
                    } ?>
                </div>
                <div class="entry_text">
                    <div class="entry_header">
                        
                    </div>
                </div>
            </div>
        </article>
        <?php
    }

}