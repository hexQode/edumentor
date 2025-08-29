<?php
/**
 * Sponsor
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace DynamicLayers\FlatPack\Elementor\Widgets\Sponsor;

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
        return 'flatpack-sponsor';
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
        return esc_html__( 'Sponsor', 'flatpack' );
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
                'label' => esc_html__( 'Grid Layout', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'box' => esc_html__( 'Box', 'flatpack' ),
                    'border' => esc_html__( 'Border', 'flatpack' ),
                    'tictactoe' => esc_html__( 'Tic Tac Toe', 'flatpack' ),
                ],
                'default' => 'box',
                'prefix_class' => 'fp-logo-'
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    2 => esc_html__( '2 Columns', 'flatpack' ),
                    3 => esc_html__( '3 Columns', 'flatpack' ),
                    4 => esc_html__( '4 Columns', 'flatpack' ),
                    5 => esc_html__( '5 Columns', 'flatpack' ),
                    6 => esc_html__( '6 Columns', 'flatpack' ),
                ],
                'desktop_default' => 4,
                'tablet_default' => 2,
                'mobile_default' => 2,
                'prefix_class' => 'fp-logo-col-%s',
            ]
        );

        $this->add_responsive_control(
            'spacebetween_item',
            [
                'label'      => esc_html__( 'Space Between', 'flatpack' ),
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
                    '{{WRAPPER}}.fp-logo-box .fp-logo-wrapper' => 'margin: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.fp-logo-box .fp-logo-item' => 'margin: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.fp-logo-box.fp-logo-col-2 .fp-logo-item' => 'width: calc((100%/2) - ({{SIZE}}{{UNIT}}*2));',
                    '{{WRAPPER}}.fp-logo-box.fp-logo-col-3 .fp-logo-item' => 'width: calc((100%/3) - ({{SIZE}}{{UNIT}}*2));',
                    '{{WRAPPER}}.fp-logo-box.fp-logo-col-4 .fp-logo-item' => 'width: calc((100%/4) - ({{SIZE}}{{UNIT}}*2));',
                    '{{WRAPPER}}.fp-logo-box.fp-logo-col-5 .fp-logo-item' => 'width: calc((100%/5) - ({{SIZE}}{{UNIT}}*2));',
                    '{{WRAPPER}}.fp-logo-box.fp-logo-col-6 .fp-logo-item' => 'width: calc((100%/6) - ({{SIZE}}{{UNIT}}*2));',
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

        $settings = $this->get_settings_for_display();

        if ( empty($settings['logo_list'] ) ) {
            return;
        }
        ?>

        <div class="fp-logo-wrapper">
            <?php
            foreach ( $settings['logo_list'] as $index => $item ) :
                $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
                if ( ! $image ) {
                    $image = Utils::get_placeholder_image_src();
                }
                $repeater_key = 'grid_item' . $index;
                $tag = 'div';
                $this->add_render_attribute( $repeater_key, 'class', 'fp-logo-item' );

                if ( $item['link']['url'] ) {
                    $tag = 'a';
                    $this->add_render_attribute( $repeater_key, 'class', 'fp-logo-link' );
                    $this->add_render_attribute( $repeater_key, 'target', '' );
                    $this->add_render_attribute( $repeater_key, 'rel', 'noopener' );
                    $this->add_render_attribute( $repeater_key, 'href', esc_url( $item['link']['url'] ) );
                }
                ?>
                <<?php echo $tag; ?> <?php $this->print_render_attribute_string( $repeater_key ); ?>>
                    <figure class="fp-logo-wrap">
                        <img class="fp-logo-img elementor-animation-<?php echo esc_attr( $settings['hover_animation'] ); ?>" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
                    </figure>
                </<?php echo $tag; ?>>
            <?php endforeach; ?>
        </div>

        <?php
    }


}