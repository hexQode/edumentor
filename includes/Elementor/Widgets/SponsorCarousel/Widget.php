<?php
/**
 * Sponsor Carousel
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\SponsorCarousel;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

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
        return 'edumentor-sponsor-carousel';
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
        return esc_html__( 'Sponsor Carousel', 'edumentor' );
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
        return 'edumentor-icon eicon-logo';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'sponsor', 'logo', 'logo grid', 'sponsor carousel', 'carousel', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'edumentor-sponsor-carousel' ];
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
                'label' => esc_html__( 'Sponsor Items', 'edumentor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Logo', 'edumentor'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Website URL', 'edumentor'),
                'type' => Controls_Manager::URL,
                'show_external' => false,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Brand Name', 'edumentor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Brand Name', 'edumentor'),
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
                'label' => esc_html__( 'Settings', 'edumentor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Grid Layout', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'box' => esc_html__( 'Box', 'edumentor' ),
                    'border' => esc_html__( 'Border', 'edumentor' ),
                    'tictactoe' => esc_html__( 'Tic Tac Toe', 'edumentor' ),
                ],
                'default' => 'box',
                'prefix_class' => 'hq-logo-'
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    2 => esc_html__( '2 Columns', 'edumentor' ),
                    3 => esc_html__( '3 Columns', 'edumentor' ),
                    4 => esc_html__( '4 Columns', 'edumentor' ),
                    5 => esc_html__( '5 Columns', 'edumentor' ),
                    6 => esc_html__( '6 Columns', 'edumentor' ),
                ],
                'desktop_default' => 4,
                'tablet_default' => 2,
                'mobile_default' => 2,
                'prefix_class' => 'hq-logo-col-%s',
            ]
        );

        $this->add_responsive_control(
            'spacebetween_item',
            [
                'label'      => esc_html__( 'Space Between', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => .5,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}}.hq-logo-box .hq-logo-wrapper' => 'margin: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.hq-logo-box .hq-logo-item' => 'margin: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.hq-logo-box.hq-logo-col-2 .hq-logo-item' => 'width: calc((100%/2) - ({{SIZE}}{{UNIT}}*2));',
                    '{{WRAPPER}}.hq-logo-box.hq-logo-col-3 .hq-logo-item' => 'width: calc((100%/3) - ({{SIZE}}{{UNIT}}*2));',
                    '{{WRAPPER}}.hq-logo-box.hq-logo-col-4 .hq-logo-item' => 'width: calc((100%/4) - ({{SIZE}}{{UNIT}}*2));',
                    '{{WRAPPER}}.hq-logo-box.hq-logo-col-5 .hq-logo-item' => 'width: calc((100%/5) - ({{SIZE}}{{UNIT}}*2));',
                    '{{WRAPPER}}.hq-logo-box.hq-logo-col-6 .hq-logo-item' => 'width: calc((100%/6) - ({{SIZE}}{{UNIT}}*2));',
                ],
                'condition'    => [
                    'layout'    => 'box'
                ],
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
                'label' => esc_html__( 'Grid', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-logo-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 500,
                        'min' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-logo-item' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'grid_border_type',
            [
                'label' => esc_html__( 'Border Type', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'edumentor' ),
                    'solid' => esc_html__( 'Solid', 'edumentor' ),
                    'double' => esc_html__( 'Double', 'edumentor' ),
                    'dotted' => esc_html__( 'Dotted', 'edumentor' ),
                    'dashed' => esc_html__( 'Dashed', 'edumentor' ),
                    'groove' => esc_html__( 'Groove', 'edumentor' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .hq-logo-item' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_border_width',
            [
                'label' => esc_html__( 'Border Width', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '(desktop+){{WRAPPER}}.hq-logo-border .hq-logo-item' => 'border-right-width: {{grid_border_width.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border .hq-logo-item' => 'border-right-width: {{grid_border_width_tablet.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border .hq-logo-item' => 'border-right-width: {{grid_border_width_mobile.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-2 .hq-logo-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-3 .hq-logo-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-4 .hq-logo-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-5 .hq-logo-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-6 .hq-logo-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-2 .hq-logo-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-3 .hq-logo-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-4 .hq-logo-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-5 .hq-logo-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-6 .hq-logo-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet2 .hq-logo-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet3 .hq-logo-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet4 .hq-logo-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet5 .hq-logo-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet6 .hq-logo-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet2 .hq-logo-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet3 .hq-logo-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet4 .hq-logo-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet5 .hq-logo-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet6 .hq-logo-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile2 .hq-logo-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile3 .hq-logo-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile4 .hq-logo-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile5 .hq-logo-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile6 .hq-logo-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile2 .hq-logo-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile3 .hq-logo-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile4 .hq-logo-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile5 .hq-logo-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile6 .hq-logo-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.hq-logo-tictactoe .hq-logo-item' => 'border-top-width: {{SIZE}}{{UNIT}}; border-right-width: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.hq-logo-box .hq-logo-item' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'grid_border_type!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'grid_border_color',
            [
                'label' => esc_html__( 'Border Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-logo-item' => 'border-color: {{VALUE}};',
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
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector' => '{{WRAPPER}} .hq-logo-wrap',
            ]
        );

        $this->add_responsive_control(
            'grid_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}.hq-logo-border .hq-logo-wrapper, {{WRAPPER}}.hq-logo-box .hq-logo-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.hq-logo-border .hq-logo-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                    '{{WRAPPER}}.hq-logo-border .hq-logo-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-2 .hq-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-2 .hq-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-3 .hq-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-3 .hq-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-4 .hq-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-4 .hq-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-5 .hq-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-5 .hq-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-6 .hq-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-border.hq-logo-col-6 .hq-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet2 .hq-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet2 .hq-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet3 .hq-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet3 .hq-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet4 .hq-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet4 .hq-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet5 .hq-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet5 .hq-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet6 .hq-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-border.hq-logo-col-tablet6 .hq-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile2 .hq-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile2 .hq-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile3 .hq-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile3 .hq-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile4 .hq-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile4 .hq-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile5 .hq-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile5 .hq-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile6 .hq-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-border.hq-logo-col-mobile6 .hq-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',

                    // Tictactoe
                    '{{WRAPPER}}.hq-logo-tictactoe .hq-logo-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.hq-logo-tictactoe .hq-logo-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                    '{{WRAPPER}}.hq-logo-tictactoe .hq-logo-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-2 .hq-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-2 .hq-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-3 .hq-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-3 .hq-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-4 .hq-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-4 .hq-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-5 .hq-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-5 .hq-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-6 .hq-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-6 .hq-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet2 .hq-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet2 .hq-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet3 .hq-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet3 .hq-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet4 .hq-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet4 .hq-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet5 .hq-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet5 .hq-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet6 .hq-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-tablet6 .hq-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile2 .hq-logo-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile2 .hq-logo-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile3 .hq-logo-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile3 .hq-logo-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile4 .hq-logo-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile4 .hq-logo-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile5 .hq-logo-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile5 .hq-logo-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile6 .hq-logo-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.hq-logo-tictactoe.hq-logo-col-mobile6 .hq-logo-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}}.hq-logo-tictactoe .hq-logo-wrapper, {{WRAPPER}}.hq-logo-border .hq-logo-wrapper, {{WRAPPER}}.hq-logo-box .hq-logo-item'
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
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label' => esc_html__( 'Opacity', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-logo-wrap > img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .hq-logo-wrap > img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => esc_html__( 'Hover', 'edumentor' ),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label' => esc_html__( 'Opacity', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-logo-wrap:hover > img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters_hover',
                'selector' => '{{WRAPPER}} .hq-logo-wrap:hover > img',
            ]
        );

        $this->add_control(
            'image_bg_hover_transition',
            [
                'label' => esc_html__( 'Transition Duration', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-logo-wrap:hover > img' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'edumentor' ),
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

        $settings = $this->get_settings_for_display();

        if ( empty($settings['logo_list'] ) ) {
            return;
        }
        ?>

        <div class="hq-logo-wrapper">
            <?php
            foreach ( $settings['logo_list'] as $index => $item ) :
                $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
                if ( ! $image ) {
                    $image = Utils::get_placeholder_image_src();
                }
                $repeater_key = 'grid_item' . $index;
                $tag = 'div';
                $this->add_render_attribute( $repeater_key, 'class', 'hq-logo-item' );

                if ( $item['link']['url'] ) {
                    $tag = 'a';
                    $this->add_render_attribute( $repeater_key, 'class', 'hq-logo-link' );
                    $this->add_render_attribute( $repeater_key, 'target', '' );
                    $this->add_render_attribute( $repeater_key, 'rel', 'noopener' );
                    $this->add_render_attribute( $repeater_key, 'href', esc_url( $item['link']['url'] ) );
                }
                ?>
                <<?php echo $tag; ?> <?php $this->print_render_attribute_string( $repeater_key ); ?>>
                    <figure class="hq-logo-wrap">
                        <img class="hq-logo-img elementor-animation-<?php echo esc_attr( $settings['hover_animation'] ); ?>" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
                    </figure>
                </<?php echo $tag; ?>>
            <?php endforeach; ?>
        </div>

        <?php
    }


}