<?php
/**
 * Sponsor
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\SliderTest;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Plugin;

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
        return 'flatpack-slider-test';
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
        return esc_html__( 'Slider Test', 'flatpack' );
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
        return 'fq-icon eicon-logo';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'sponsor', 'logo', 'logo grid', 'sponsor grid', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'fp-sponsor' ];
    }

    public function get_script_depends() {
        return ['swiper', 'slider-test'];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->sponsor_items_section();
        $this->settings_section();
        $this->grid_style();
        
    }

    /**
     * Sponsor Items
     *
     * @return void
     */
    protected function sponsor_items_section() {
        
        $this->start_controls_section(
            'sponsor_items_section',
            [
                'label' => esc_html__( 'Sponsor Items', 'flatpack' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Logo', 'flatpack'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Website URL', 'flatpack'),
                'type' => Controls_Manager::URL,
                'show_external' => false,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Brand Name', 'flatpack'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Brand Name', 'flatpack'),
            ]
        );

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Settings
     *
     * @return void
     */
	protected function settings_section() {
        
        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__( 'Settings', 'flatpack' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'skin',
			[
				'label'        => esc_html__('Layout', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'carousel',
				'options'      => [
					'carousel'  => esc_html__('Carousel', 'bdthemes-element-pack'),
					'coverflow' => esc_html__('Coverflow', 'bdthemes-element-pack'),
				],
				'prefix_class' => 'bdt-carousel-style-',
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'coverflow_toggle',
			[
				'label'        => __('Coverflow Effect', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition'    => [
					'skin' => 'coverflow'
				]
			]
		);

		$this->start_popover();

		$this->add_control(
			'coverflow_rotate',
			[
				'label'       => esc_html__('Rotate', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 50,
				],
				'range'       => [
					'px' => [
						'min'  => -360,
						'max'  => 360,
						'step' => 5,
					],
				],
				'condition'   => [
					'coverflow_toggle' => 'yes'
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'coverflow_stretch',
			[
				'label'       => __('Stretch', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 0,
				],
				'range'       => [
					'px' => [
						'min'  => 0,
						'step' => 10,
						'max'  => 100,
					],
				],
				'condition'   => [
					'coverflow_toggle' => 'yes'
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'coverflow_modifier',
			[
				'label'       => __('Modifier', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 1,
				],
				'range'       => [
					'px' => [
						'min'  => 1,
						'step' => 1,
						'max'  => 10,
					],
				],
				'condition'   => [
					'coverflow_toggle' => 'yes'
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'coverflow_depth',
			[
				'label'       => __('Depth', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 100,
				],
				'range'       => [
					'px' => [
						'min'  => 0,
						'step' => 10,
						'max'  => 1000,
					],
				],
				'condition'   => [
					'coverflow_toggle' => 'yes'
				],
				'render_type' => 'template',
			]
		);

		$this->end_popover();

		$this->add_control(
			'hr_005',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'skin' => 'coverflow'
				]
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => __('Autoplay', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',

			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__('Autoplay Speed', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pauseonhover',
			[
				'label' => esc_html__('Pause on Hover', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__('Slides to Scroll', 'bdthemes-element-pack'),
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
				'options'        => [
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6',
				],
			]
		);

		$this->add_control(
			'centered_slides',
			[
				'label'       => __('Center Slide', 'bdthemes-element-pack'),
				'description' => __('Use even items from Layout > Columns settings for better preview.', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'grab_cursor',
			[
				'label' => __('Grab Cursor', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'free_mode',
			[
				'label' => __('Drag Free Mode', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => __('Loop', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',

			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __('Animation Speed (ms)', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 500,
				],
				'range' => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 50,
					],
				],
			]
		);

		$this->add_control(
			'observer',
			[
				'label'       => __('Observer', 'bdthemes-element-pack'),
				'description' => __('When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_hidden_item',
			[
				'label' => __('Show Hidden Item', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-show-hidden-item--',
				'render_type' => 'template'
			]
		);

		$this->add_control(
			'hidden_item_opacity',
			[
				'label' => __('Hidden Item Opacity', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide:not(.swiper-slide-visible)' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'show_hidden_item' => 'yes',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'section_content_layout',
			[ 
				'label' => esc_html__( 'Additional Options', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'_skin',
			[ 
				'label'   => esc_html__( 'Style', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [ 
					''               => esc_html__( 'On Hover', 'bdthemes-element-pack' ),
					'bdt-middle'     => esc_html__( 'On Active', 'bdthemes-element-pack' ),
					'always-visible' => esc_html__( 'Always Visible', 'bdthemes-element-pack' ),
				],
			]
		);

		$this->add_responsive_control(
			'columns',
			[ 
				'label'              => esc_html__( 'Columns', 'bdthemes-element-pack' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => '3',
				'tablet_default'     => '2',
				'mobile_default'     => '1',
				'options'            => [ 
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'frontend_available' => true,
				'condition'          => [ 
					'_skin!' => 'bdt-middle',
				],
			]
		);

		$this->add_responsive_control(
			'skin_columns',
			[ 
				'label'          => esc_html__( 'Columns', 'bdthemes-element-pack' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '2',
				'mobile_default' => '2',
				'options'        => [ 
					'1'  => '1',
					'2'  => '2',
					'3'  => '3',
					'4'  => '4',
					'5'  => '5',
					'6'  => '6',
					'7'  => '7',
					'8'  => '8',
					'9'  => '9',
					'10' => '10',
				],
				'condition'      => [ 
					'_skin' => 'bdt-middle',
				],
			]
		);

		$this->add_responsive_control(
			'column_space',
			[ 
				'label' => esc_html__( 'Column Gap', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
			]
		);

		$this->add_responsive_control(
			'slider_height',
			[ 
				'label'      => esc_html__( 'Slider Height', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [ 
					'px' => [ 
						'min'  => 100,
						'step' => 20,
						'max'  => 1600
					],
					'vh' => [ 
						'min'  => 1,
						'step' => 1,
						'max'  => 100
					]
				],
				'default'    => [ 
					'size' => 620,
				],
				'selectors'  => [ 
					'{{WRAPPER}} .swiper-wrapper' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name'      => 'thumbnail_size',
				'label'     => esc_html__( 'Image Size', 'bdthemes-element-pack' ),
				'exclude'   => [ 'custom' ],
				'default'   => 'full',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_title',
			[ 
				'label'   => esc_html__( 'Show Title', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title_tags',
			[ 
				'label'     => __( 'Title HTML Tag', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h3',
				'options'   => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
				'condition' => [ 
					'show_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'button',
			[ 
				'label'       => esc_html__( 'Show Read More', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'yes',
				'description' => 'It will work when link field no null.',
				// 'condition'   => [ 
				// 	'_skin!' => 'bdt-middle',
				// ],
			]
		);

		$this->add_responsive_control(
			'align',
			[ 
				'label'     => esc_html__( 'Alignment', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [ 
					'left'    => [ 
						'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [ 
						'title' => esc_html__( 'Center', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [ 
						'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [ 
						'title' => esc_html__( 'Justified', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .bdt-panel-slider' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'vertical_align_content',
			[ 
				'label'     => esc_html__( 'Align Content', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [ 
					'flex-start'    => [ 
						'title' => esc_html__( 'Top', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center' => [ 
						'title' => esc_html__( 'Middle', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'flex-end' => [ 
						'title' => esc_html__( 'Bottom', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .bdt-panel-slide-desc' => 'align-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_skew',
			[ 
				'label'     => esc_html__( 'Slide Skew', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'min' => 0,
						'max' => 30,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .bdt-panel-slider .bdt-panel-slide-item' => 'transform: skew(-{{SIZE}}deg);',
					'{{WRAPPER}} .bdt-panel-slider .bdt-panel-slide-desc' => 'transform: skew({{SIZE}}deg);',
					'{{WRAPPER}} .bdt-panel-slider .bdt-panel-slide-link' => 'transform: skew(-{{SIZE}}deg);',
					'{{WRAPPER}} .bdt-panel-slider span'                  => 'transform: skew({{SIZE}}deg); display: inline-block;',
				],
				'condition' => [ 
					'_skin!' => 'bdt-middle',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mouse_interactivity',
			[ 
				'label'        => __( 'Item Mouse Interaction', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'separator'    => 'before',
				'prefix_class' => 'ep-mouse-interaction-',
				'render_type'  => 'template'
			]
		);

		$this->add_control(
			'global_link',
			[ 
				'label'        => __( 'Item Wrapper Link', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-global-link-',
				'description'  => __( 'Be aware! When Item Wrapper Link activated then read more link will not work', 'bdthemes-element-pack' ),
				'separator'    => 'before'
			]
		);

		$this->end_controls_section();

    }

    /**
     * Gird Style
     *
     * @return void
     */
    protected function grid_style() {
        
        $this->start_controls_section(
            'grid_style_section',
            [
                'label' => esc_html__( 'Grid', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-logo-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 500,
                        'min' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .fp-logo-item' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'grid_border_type',
            [
                'label' => esc_html__( 'Border Type', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'flatpack' ),
                    'solid' => esc_html__( 'Solid', 'flatpack' ),
                    'double' => esc_html__( 'Double', 'flatpack' ),
                    'dotted' => esc_html__( 'Dotted', 'flatpack' ),
                    'dashed' => esc_html__( 'Dashed', 'flatpack' ),
                    'groove' => esc_html__( 'Groove', 'flatpack' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .fp-logo-item' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_border_width',
            [
                'label' => esc_html__( 'Border Width', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '(desktop+){{WRAPPER}}.fp-logo-border .fp-logo-item' => 'border-right-width: {{grid_border_width.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border .fp-logo-item' => 'border-right-width: {{grid_border_width_tablet.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border .fp-logo-item' => 'border-right-width: {{grid_border_width_mobile.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-2 .fp-logo-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-3 .fp-logo-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-4 .fp-logo-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-5 .fp-logo-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-6 .fp-logo-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-2 .fp-logo-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-3 .fp-logo-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-4 .fp-logo-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-5 .fp-logo-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-6 .fp-logo-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet2 .fp-logo-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet3 .fp-logo-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet4 .fp-logo-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet5 .fp-logo-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet6 .fp-logo-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet2 .fp-logo-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet3 .fp-logo-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet4 .fp-logo-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet5 .fp-logo-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet6 .fp-logo-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile2 .fp-logo-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile3 .fp-logo-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile4 .fp-logo-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile5 .fp-logo-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile6 .fp-logo-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile2 .fp-logo-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile3 .fp-logo-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile4 .fp-logo-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile5 .fp-logo-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile6 .fp-logo-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.fp-logo-tictactoe .fp-logo-item' => 'border-top-width: {{SIZE}}{{UNIT}}; border-right-width: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.fp-logo-box .fp-logo-item' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'grid_border_type!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'grid_border_color',
            [
                'label' => esc_html__( 'Border Color', 'flatpack' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-logo-item' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'grid_border_type!' => 'none',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'grid_bg',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector' => '{{WRAPPER}} .fp-logo-wrap',
            ]
        );

        $this->add_responsive_control(
            'grid_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'flatpack' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}.fp-logo-border .fp-logo-wrapper, {{WRAPPER}}.fp-logo-box .fp-logo-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.fp-logo-border .fp-logo-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                    '{{WRAPPER}}.fp-logo-border .fp-logo-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-2 .fp-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-2 .fp-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-3 .fp-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-3 .fp-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-4 .fp-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-4 .fp-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-5 .fp-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-5 .fp-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-6 .fp-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-border.fp-logo-col-6 .fp-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet2 .fp-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet2 .fp-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet3 .fp-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet3 .fp-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet4 .fp-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet4 .fp-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet5 .fp-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet5 .fp-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet6 .fp-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-border.fp-logo-col-tablet6 .fp-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile2 .fp-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile2 .fp-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile3 .fp-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile3 .fp-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile4 .fp-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile4 .fp-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile5 .fp-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile5 .fp-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile6 .fp-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-border.fp-logo-col-mobile6 .fp-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',

                    // Tictactoe
                    '{{WRAPPER}}.fp-logo-tictactoe .fp-logo-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.fp-logo-tictactoe .fp-logo-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                    '{{WRAPPER}}.fp-logo-tictactoe .fp-logo-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-2 .fp-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-2 .fp-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-3 .fp-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-3 .fp-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-4 .fp-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-4 .fp-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-5 .fp-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-5 .fp-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-6 .fp-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-6 .fp-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet2 .fp-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet2 .fp-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet3 .fp-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet3 .fp-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet4 .fp-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet4 .fp-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet5 .fp-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet5 .fp-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet6 .fp-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-tablet6 .fp-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile2 .fp-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile2 .fp-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile3 .fp-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile3 .fp-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile4 .fp-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile4 .fp-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile5 .fp-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile5 .fp-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile6 .fp-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.fp-logo-tictactoe.fp-logo-col-mobile6 .fp-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'grid_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}}.fp-logo-tictactoe .fp-logo-wrapper, {{WRAPPER}}.fp-logo-border .fp-logo-wrapper, {{WRAPPER}}.fp-logo-box .fp-logo-item'
            ]
        );


        $this->start_controls_tabs(
            '_tabs_image_effects',
            [
                'separator' => 'before'
            ]
        );

        $this->start_controls_tab(
            '_tab_image_effects_normal',
            [
                'label' => esc_html__( 'Normal', 'flatpack' ),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label' => esc_html__( 'Opacity', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fp-logo-wrap > img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .fp-logo-wrap > img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => esc_html__( 'Hover', 'flatpack' ),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label' => esc_html__( 'Opacity', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fp-logo-wrap:hover > img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters_hover',
                'selector' => '{{WRAPPER}} .fp-logo-wrap:hover > img',
            ]
        );

        $this->add_control(
            'image_bg_hover_transition',
            [
                'label' => esc_html__( 'Transition Duration', 'flatpack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fp-logo-wrap:hover > img' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'flatpack' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
     * Render Content
     *
     * @return void
     */
    protected function render() {
        $id         = 'bdt-panel-slider-' . $this->get_id();
        $settings = $this->get_settings_for_display();
        $skin_class = '';

		$elementor_vp_lg = get_option( 'elementor_viewport_lg' );
		$elementor_vp_md = get_option( 'elementor_viewport_md' );
		$viewport_lg     = ! empty( $elementor_vp_lg ) ? $elementor_vp_lg - 1 : 1023;
		$viewport_md     = ! empty( $elementor_vp_md ) ? $elementor_vp_md - 1 : 767;

        $columns        = ( $settings['_skin'] == 'bdt-middle' ) ? $settings['skin_columns'] : $settings['columns'];
		$columns_tablet = ( $settings['_skin'] == 'bdt-middle' ) && isset( $settings['skin_columns_tablet'] ) ? $settings['skin_columns_tablet'] : $settings['columns_tablet'];
		$columns_mobile = ( $settings['_skin'] == 'bdt-middle' ) && isset( $settings['skin_columns_mobile'] ) ? $settings['skin_columns_mobile'] : $settings['columns_mobile'];

		if ( $settings['_skin'] == 'bdt-middle' ) {
			$skin_class = 'bdt-skin-middle';
		} else if ( $settings['_skin'] == 'always-visible' ) {
			$skin_class = 'bdt-text-on-always';
		} else {
			$skin_class = 'bdt-skin-default';
		}

        

        $this->add_render_attribute(
			[ 
				'panel-slider' => [ 
					'data-settings' => [ 
						wp_json_encode( array_filter( [ 
							"autoplay"        => ( "yes" == $settings["autoplay"] ) ? [ "delay" => $settings["autoplay_speed"] ] : false,
							"loop"            => ( $settings["loop"] == "yes" ) ? true : false,
							"speed"           => $settings["speed"]["size"],
							"pauseOnHover"    => ( "yes" == $settings["pauseonhover"] ) ? true : false,
							"slidesPerView"   => (int) $columns_mobile,
							"slidesPerGroup"  => isset( $settings["slides_to_scroll_mobile"] ) ? (int) $settings["slides_to_scroll_mobile"] : 1,
							"spaceBetween"    => $settings['column_space']['size'] ?: 0,
							"centeredSlides"  => ( $settings["centered_slides"] === "yes" ) ? true : false,
							"grabCursor"      => ( $settings["grab_cursor"] === "yes" ) ? true : false,
							"freeMode"        => ( $settings["free_mode"] === "yes" ) ? true : false,
							"effect"          => $settings["skin"],
							"observer"        => ( $settings["observer"] ) ? true : false,
							"observeParents"  => ( $settings["observer"] ) ? true : false,
							"breakpoints"     => [ 
								(int) $viewport_md => [ 
									"slidesPerView"  => (int) $columns_tablet,
									"spaceBetween"   => $settings['column_space']['size'] ?: 0,
									"slidesPerGroup" => isset( $settings["slides_to_scroll_tablet"] ) ? (int) $settings["slides_to_scroll_tablet"] : 1,
								],
								(int) $viewport_lg => [ 
									"slidesPerView"  => (int) $columns,
									"spaceBetween"   => $settings['column_space']['size'] ?: 0,
									"slidesPerGroup" => isset( $settings["slides_to_scroll"] ) ? (int) $settings["slides_to_scroll"] : 1,
								]
							],
							'coverflowEffect' => [ 
								'rotate'       => ( "yes" == $settings["coverflow_toggle"] ) ? $settings["coverflow_rotate"]["size"] : 50,
								'stretch'      => ( "yes" == $settings["coverflow_toggle"] ) ? $settings["coverflow_stretch"]["size"] : 0,
								'depth'        => ( "yes" == $settings["coverflow_toggle"] ) ? $settings["coverflow_depth"]["size"] : 100,
								'modifier'     => ( "yes" == $settings["coverflow_toggle"] ) ? $settings["coverflow_modifier"]["size"] : 1,
								'slideShadows' => true,
							],


						] ) )
					],
					'class'         => [ 
						'bdt-panel-slider',
						$skin_class,
					],
					'id'            => $id
				]
			]
		);

        $swiper_class = Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
        $this->add_render_attribute( 'swiper', 'class', 'swiper-carousel ' . $swiper_class );
        ?>
        <div <?php $this->print_render_attribute_string( 'panel-slider' ); ?>>
            <div <?php $this->print_render_attribute_string( 'swiper' ); ?>>
            <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">Slide 1</div>
                    <div class="swiper-slide">Slide 2</div>
                    <div class="swiper-slide">Slide 3</div>
                </div>
            </div>
        </div>
        <?php
    }


}