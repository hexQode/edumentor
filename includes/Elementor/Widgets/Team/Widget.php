<?php
/**
 * Team
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace DynamicLayers\FlatPack\Elementor\Widgets\Team;

use DynamicLayers\FlatPack\Classes\Helper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Repeater;

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
        return 'flatpack-team';
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
        return esc_html__( 'Team', 'flatpack' );
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
        return 'fq-icon eicon-person';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'team', 'member', 'person', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'fp-team', 'elementor-icons-fa-brands' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_layout();
        $this->section_content();
        $this->style_content_box();
        $this->style_name();
        $this->style_position();
        $this->style_social_links();
        
    }

    protected function section_layout() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__( 'Layout', 'flatpack' )
            ]
        );

        $this->add_control(
            'team_style',
            [
                'label'   => esc_html__( 'Style', 'flatpack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'team-style-1',
                'options' => [
                    'team-style-1' => esc_html__( 'Style 1', 'flatpack' ),
                    'team-style-2' => esc_html__( 'Style 2', 'flatpack' ),
                    'team-style-3' => esc_html__( 'Style 3', 'flatpack' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'tm_st_1_shape',
            [
                'label'        => esc_html__( 'Hide Shape', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'flatpack' ),
                'label_off'    => esc_html__( 'No', 'flatpack' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition'    => [
                   'team_style!'    => 'team-style-3'
                ],
            ]
        );

        $this->add_control(
            'tm_st_1_shape_color',
            [
                'label'     => esc_html__( 'Shape Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-style-1 .top-shape .cls-1' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .team-style-2 .fp-team .color-shape .shape' => 'background-color: {{VALUE}}',
                ],
                'condition'    => [
                    'team_style!'    => 'team-style-3',
                    'tm_st_1_shape!'    => 'yes'
                 ],
            ]
        );

        $this->add_control(
            'tm_st_1_shape_bottom_color',
            [
                'label'     => esc_html__( 'Bottom Shape Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-style-1 .bottom-shape .cls-1' => 'fill: {{VALUE}}',
                ],
                'condition'    => [
                    'team_style'    => 'team-style-1',
                    'tm_st_1_shape!'    => 'yes'
                 ],
            ]
        );

        $this->add_control(
            'tmst2_shape_mode',
            [
                'label'   => esc_html__( 'Shape Mode', 'flatpack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'active',
                'options' => [
                    'active'  => esc_html__( 'Always Show', 'flatpack' ),
                    'hover' => esc_html__( 'Show On Hover', 'flatpack' ),
                ],
                'condition'    => [
                    'team_style'    => 'team-style-2',
                    'tm_st_1_shape!'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'tmst2_shape_x_position',
            [
                'label'      => esc_html__( 'Shape X Position', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .team-style-2.fp-team .color-shape' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'team_style'    => 'team-style-2',
                    'tm_st_1_shape!'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'tmst2_shape_y_position',
            [
                'label'      => esc_html__( 'Shape Y Position', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .team-style-2.fp-team .color-shape' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'team_style'    => 'team-style-2',
                    'tm_st_1_shape!'    => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function section_content() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'flatpack' )
            ]
        );

        $this->add_control(
            'team_img',
            [
                'label'   => esc_html__( 'Team Image', 'flatpack' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'name',
            [
                'label'       => __( 'Name', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Member Name', 'flatpack' ),
                'placeholder' => esc_html__( 'Name...', 'flatpack' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'position',
            [
                'label'       => __( 'Position', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Managing Director', 'flatpack' ),
                'placeholder' => esc_html__( 'Position...', 'flatpack' ),
                'label_block' => true
            ]
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'icon',
            [
                'label'   => esc_html__( 'Icon', 'flatpack' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => __( 'Title', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Default title', 'flatpack' ),
                'placeholder' => esc_html__( 'Type your title here', 'flatpack' ),
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'custom_social_color',
            [
                'label'        => esc_html__( 'Custom Colors', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
                'separator'    => 'before',
            ]
        );

        $repeater->add_control(
            'social_bg_color',
            [
                'label'     => __( 'Background Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social {{CURRENT_ITEM}} a' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_social_color' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'social_icon_color',
            [
                'label'     => __( 'Icon Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fa2d2d',
                'selectors' => [
                    '{{WRAPPER}} .team-social {{CURRENT_ITEM}} a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_social_color' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'social_hover_bg_color',
            [
                'label'     => __( 'Hover Background Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social {{CURRENT_ITEM}} a:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_social_color' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'social_icon_hover_color',
            [
                'label'     => __( 'Hover Icon Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fa2d2d',
                'selectors' => [
                    '{{WRAPPER}} .team-social {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_social_color' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        
        $this->add_control(
            'social_links',
            [
                'label'       => esc_html__( 'Social Links', 'flatpack' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'icon'   => [
                            'value'   => 'fab fa-facebook-f',
                            'library' => 'brands',
                        ],
                        'link' => '#'
                    ],
                    [
                        'icon'   => [
                            'value'   => 'fab fa-twitter',
                            'library' => 'brands',
                        ],
                        'link' => '#'
                    ],
                    [
                        'icon'   => [
                            'value'   => 'fab fa-pinterest',
                            'library' => 'brands',
                        ],
                        'link' => '#'
                    ],
                    [
                        'icon'   => [
                            'value'   => 'fab fa-facebook',
                            'library' => 'brands',
                        ],
                        'link' => '#'
                    ],
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) }}}',
            ]
        );
        
        $this->end_controls_section();

    }

    protected function style_content_box() {

        $this->start_controls_section(
            'content_box_style',
            [
                'label' => esc_html__( 'Content Box', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_align',
            [
                'label'   => esc_html__( 'Alignment', 'flatpack' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'flatpack' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'flatpack' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'flatpack' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle'  => false,
                'selectors' => [
                    '{{WRAPPER}} .team-content' => 'text-align: {{VALUE}}'
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'content_box_background',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .team-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_box_border',
                'label'    => esc_html__( 'Border', 'flatpack' ),
                'selector' => '{{WRAPPER}} .team-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .team-content',
            ]
        );

        $this->add_responsive_control(
            'content_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .team-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        
        $this->end_controls_section();

    }

    protected function style_name() {

        $this->start_controls_section(
            'name_style',
            [
                'label' => esc_html__( 'Name', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'name_background',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fp-team .team-content h3',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'label'    => esc_html__( 'Typography', 'flatpack' ),
                'selector' => '{{WRAPPER}} .fp-team .team-content h3',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-team .team-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'name_border',
                'label'    => esc_html__( 'Border', 'flatpack' ),
                'selector' => '{{WRAPPER}} .fp-team .team-content h3',
            ]
        );

        $this->add_responsive_control(
            'name_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-team .team-content h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'name_padding',
            [
                'label'      => esc_html__( 'Padding', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-team .team-content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'name_margin',
            [
                'label'      => esc_html__( 'Margin', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-team .team-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    protected function style_position() {

        $this->start_controls_section(
            'position_style',
            [
                'label' => esc_html__( 'Position', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'pos_background',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fp-team .team-content h4, {{WRAPPER}} .team-style-2.fp-team .team-thumb .position',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'position_typography',
                'label'    => esc_html__( 'Typography', 'flatpack' ),
                'selector' => '{{WRAPPER}} .fp-team .team-content h4, {{WRAPPER}} .team-style-2.fp-team .team-thumb .position h4',
            ]
        );

        $this->add_control(
            'position_color',
            [
                'label'     => esc_html__( 'Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-team .team-content h4' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .team-style-2.fp-team .team-thumb .position h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'position_border',
                'label'    => esc_html__( 'Border', 'flatpack' ),
                'selector' => '{{WRAPPER}} .fp-team .team-content h4, {{WRAPPER}} .team-style-2.fp-team .team-thumb .position',
            ]
        );

        $this->add_responsive_control(
            'position_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-team .team-content h4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-style-2.fp-team .team-thumb .position' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'position_padding',
            [
                'label'      => esc_html__( 'Padding', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-team .team-content h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-style-2.fp-team .team-thumb .position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'position_margin',
            [
                'label'      => esc_html__( 'Margin', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-team .team-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .team-style-2.fp-team .team-thumb .position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    protected function style_social_links() {

        $this->start_controls_section(
            'social_links_style',
            [
                'label' => esc_html__( 'Social Links', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'social_icons_style_tabs' );
        
        $this->start_controls_tab(
            'social_style_normal_tab',
            [
                'label' => __( 'Normal', 'flatpack' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'social_background',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .team-social li a',
            ]
        );

        $this->add_control(
            'social_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-social li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icon_box_size',
            [
                'label'      => esc_html__( 'Icon Box Size', 'flatpack' ),
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
                    '{{WRAPPER}} .team-social li a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 250,
                        'step' => 1,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .team-social li a' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-social li a svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'social_icon_pos',
            [
                'label'   => esc_html__( 'Icon Position', 'flatpack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'  => esc_html__( 'Left', 'flatpack' ),
                    'center' => esc_html__( 'Center', 'flatpack' ),
                    'center bottom' => esc_html__( 'Center Bottom', 'flatpack' ),
                ],
                'condition'    => [
                   'team_style'    => 'team-style-3',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icons_space_between',
            [
                'label'      => esc_html__( 'Icon Space Between', 'flatpack' ),
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
                    '{{WRAPPER}} .team-style-3 .team-social.center' => 'column-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-social li:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'social_icon_border',
                'label'    => esc_html__( 'Border', 'flatpack' ),
                'selector' => '{{WRAPPER}} .team-social li a',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'social_icon_box_shadow',
                'selector' => '{{WRAPPER}} .team-social li a',
            ]
        );

        $this->add_responsive_control(
            'socia_icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .team-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'social_style_hover_tab',
            [
                'label' => __( 'Hover', 'flatpack' ),
            ]
        );
                
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'social_hover_background',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fp-team .team-social li a:hover',
            ]
        );

        $this->add_control(
            'social_icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-team .team-social li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'social_icon_hover_border',
                'label'    => esc_html__( 'Border', 'flatpack' ),
                'selector' => '{{WRAPPER}} .fp-team .team-social li a:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'social_icon_hover_box_shadow',
                'selector' => '{{WRAPPER}} .fp-team .team-social li a:hover',
            ]
        );

        $this->add_responsive_control(
            'socia_icon_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-team .team-social li a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
        $social_links = $settings['social_links'];
        $this->add_render_attribute(
			'wrapper',
			[
				'class' => [ 'fp-team', $settings['tmst2_shape_mode'], $settings['team_style'] ],
			]
		);
        $this->add_inline_editing_attributes( 'name', 'none' );
        $this->add_inline_editing_attributes( 'position', 'none' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
        <?php if( ! empty( $settings['team_img']['url'] ) ) : ?>
            <div class="team-thumb">
                <?php if( $settings['team_style'] === 'team-style-1' && 'yes' != $settings['tm_st_1_shape'] ) : ?>
                <svg class="top-shape" viewBox="0 0 356.07 215" xmlns="http://www.w3.org/2000/svg"><g data-name="Layer 2"><g data-name="Layer 1"><path class="cls-1" transform="translate(-.73 -.97)" d="M.73,207V1h354c.11,1.32.12,2.66.34,4,2.5,14.71-1.86,27.2-13.13,36.72a98.23,98.23,0,0,1-19.19,12.4c-17.07,8.58-35.57,12.86-54.1,17C245,76.24,221,80.43,197.75,87.3,153.08,100.52,120,127.68,102.45,172a165.75,165.75,0,0,1-10.53,20.92c-6.87,12-17.26,19.57-31.11,20.8a130.72,130.72,0,0,1-27.33-.48C22.47,211.91,11.64,209.13.73,207Z" fill="#4154f1"/><path class="cls-2" transform="translate(-.73 -.97)" d="M.73,207c10.91,2.16,21.74,4.94,32.75,6.29a130.72,130.72,0,0,0,27.33.48c13.85-1.23,24.24-8.79,31.11-20.8A165.75,165.75,0,0,0,102.45,172c17.52-44.34,50.63-71.5,95.3-84.72C221,80.43,245,76.24,268.65,71c18.53-4.1,37-8.38,54.1-17a98.23,98.23,0,0,0,19.19-12.4c11.27-9.52,15.63-22,13.13-36.72-.22-1.3-.23-2.64-.34-4,.67.33,1.79.55,1.91,1a13.89,13.89,0,0,1,.09,3.48V216H.73Z" fill="transparent"/></g></g></svg>
                <svg class="bottom-shape" viewBox="0 0 137 143.92" xmlns="http://www.w3.org/2000/svg"><g data-name="Layer 2"><g data-name="Layer 1"><path class="cls-1" transform="translate(-.86 -.5)" d="M136.86,144.42H1.86a20.86,20.86,0,0,1,.83-3.83c6.72-15.73,12.51-31.95,20.45-47C39.64,62.2,62.38,36.2,93.4,18.19A136.68,136.68,0,0,1,136.86,1.66Z" fill="#4154f1"/><path class="cls-2" transform="translate(-.86 -.5)" d="M136.86,144.42V1.66A136.68,136.68,0,0,0,93.4,18.19c-31,18-53.76,44-70.26,75.36-7.94,15.09-13.73,31.31-20.45,47a20.86,20.86,0,0,0-.83,3.83,17.55,17.55,0,0,1-1-4Q.83,70.5.86.5h137V11.58q0,64.43,0,128.85A17.55,17.55,0,0,1,136.86,144.42Z" fill="transparent"/></g></g></svg>
                <?php endif; ?>
                <img src="<?php echo esc_url( $settings['team_img']['url'] ); ?>" alt="<?php echo esc_attr( $settings['name'] ); ?>">
                <?php
                    if( ! empty( $settings['position'] && $settings['team_style'] === 'team-style-2' ) ) {
                        echo '<div class="position"><h4 '. $this->get_render_attribute_string( 'position' ) .'>'. Helper::kses_basic( $settings['position'] ) .'</h4></div>';
                    }
                ?>
                <?php if( $social_links > 0 ) :
                    if( $settings['team_style'] === 'team-style-3' ) {
                        $social_pos = ' ' . $settings['social_icon_pos'];
                    }else{
                        $social_pos = '';
                    } 
                ?>
                <ul class="team-social<?php echo esc_attr( $social_pos ); ?>">
                    <?php 
                    foreach( $social_links as $index => $social_link ) : ?>
                    <?php if( ! empty( $social_link['link'] ) ) : ?>
                        <li class="elementor-repeater-item-<?php echo $social_link['_id']; ?>"><a href="<?php echo esc_url( $social_link['link'] ); ?>" target="_blank"><?php Icons_Manager::render_icon( $social_link['icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if( ! empty( $settings['name'] || $settings['position'] ) ) : ?>
            <div class="team-content">
                <?php
                    if( ! empty( $settings['name'] ) ) {
                        echo '<h3 '. $this->get_render_attribute_string( 'name' ) .'>'. Helper::kses_basic( $settings['name'] ) .'</h3>';
                    }
                    if( ! empty( $settings['position'] && $settings['team_style'] != 'team-style-2' ) ) {
                        echo '<h4 '. $this->get_render_attribute_string( 'position' ) .'>'. Helper::kses_basic( $settings['position'] ) .'</h4>';
                    }
                    if( $settings['team_style'] === 'team-style-2' ) {
                        echo '<div class="color-shape"><div class="shape shape-1"></div><div class="shape shape-2"></div><div class="shape shape-3"></div><div class="shape shape-4"></div><div class="shape shape-5"></div></div>';
                    }
                ?>
            </div>
            <?php endif; ?>
        </div>
        <?php
       
    }

    /**
     * Render output for editor
     */
    protected function content_template() {
        ?>
        <#
        view.addRenderAttribute( 'wrapper', 'class', [ 'fp-team', settings.tmst2_shape_mode, settings.team_style ] );
        view.addInlineEditingAttributes( 'name', 'none' );
        view.addInlineEditingAttributes( 'position', 'none' );
        #>
        <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
            <# if( '' != settings.team_img.url ) { #>
            <div class="team-thumb">
                <# if( 'team-style-1' === settings.team_style && 'yes' != settings.tm_st_1_shape ) { #>
                    <svg class="top-shape" viewBox="0 0 356.07 215" xmlns="http://www.w3.org/2000/svg"><g data-name="Layer 2"><g data-name="Layer 1"><path class="cls-1" transform="translate(-.73 -.97)" d="M.73,207V1h354c.11,1.32.12,2.66.34,4,2.5,14.71-1.86,27.2-13.13,36.72a98.23,98.23,0,0,1-19.19,12.4c-17.07,8.58-35.57,12.86-54.1,17C245,76.24,221,80.43,197.75,87.3,153.08,100.52,120,127.68,102.45,172a165.75,165.75,0,0,1-10.53,20.92c-6.87,12-17.26,19.57-31.11,20.8a130.72,130.72,0,0,1-27.33-.48C22.47,211.91,11.64,209.13.73,207Z" fill="#4154f1"/><path class="cls-2" transform="translate(-.73 -.97)" d="M.73,207c10.91,2.16,21.74,4.94,32.75,6.29a130.72,130.72,0,0,0,27.33.48c13.85-1.23,24.24-8.79,31.11-20.8A165.75,165.75,0,0,0,102.45,172c17.52-44.34,50.63-71.5,95.3-84.72C221,80.43,245,76.24,268.65,71c18.53-4.1,37-8.38,54.1-17a98.23,98.23,0,0,0,19.19-12.4c11.27-9.52,15.63-22,13.13-36.72-.22-1.3-.23-2.64-.34-4,.67.33,1.79.55,1.91,1a13.89,13.89,0,0,1,.09,3.48V216H.73Z" fill="transparent"/></g></g></svg>
                    <svg class="bottom-shape" viewBox="0 0 137 143.92" xmlns="http://www.w3.org/2000/svg"><g data-name="Layer 2"><g data-name="Layer 1"><path class="cls-1" transform="translate(-.86 -.5)" d="M136.86,144.42H1.86a20.86,20.86,0,0,1,.83-3.83c6.72-15.73,12.51-31.95,20.45-47C39.64,62.2,62.38,36.2,93.4,18.19A136.68,136.68,0,0,1,136.86,1.66Z" fill="#4154f1"/><path class="cls-2" transform="translate(-.86 -.5)" d="M136.86,144.42V1.66A136.68,136.68,0,0,0,93.4,18.19c-31,18-53.76,44-70.26,75.36-7.94,15.09-13.73,31.31-20.45,47a20.86,20.86,0,0,0-.83,3.83,17.55,17.55,0,0,1-1-4Q.83,70.5.86.5h137V11.58q0,64.43,0,128.85A17.55,17.55,0,0,1,136.86,144.42Z" fill="transparent"/></g></g></svg>
                <# } #>
                <img src="{{{ settings.team_img.url }}}" alt="{{{ settings.name }}}">
                <# if( '' != settings.position && 'team-style-2' === settings.team_style ){ #>
                <div class="position"><h4 {{{ view.getRenderAttributeString( 'position' ) }}}>{{{ settings.position }}}</h4></div>
                <# } #>
                <# if( settings.social_links.length ){ 
                    var social_pos = '';
                    if( 'team-style-3' === settings.team_style ){
                        var social_pos = settings.social_icon_pos;
                    }else{
                        var social_pos = '';
                    }
                #>
                <ul class="team-social {{{ social_pos }}}">
                <#
                _.each(settings.social_links, function(item, index){
                    var iconHTML = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' );
                    if( '' != item.link ) {
                #>
                <li class="elementor-repeater-item-{{{item._id}}}"><a href="{{{ item.link }}}" target="_blank">{{{ iconHTML.value }}}</a></li>
                <# } 
                }); #>
                </ul>
                <# } #>
            </div>
            <# } #>
            <# if( '' != settings.name || '' != settings.position ) { #>
            <div class="team-content">
                <# if( '' != settings.name ) { #>
                    <h3 {{{ view.getRenderAttributeString( 'name' ) }}}>{{{ settings.name }}}</h3>
                <# } #>
                <# if( '' != settings.position && 'team-style-2' != settings.team_style ) { #>
                    <h4 {{{ view.getRenderAttributeString( 'position' ) }}}>{{{ settings.position }}}</h4>
                <# } #>
                <# if( 'team-style-2' === settings.team_style ) { #>
                    <div class="color-shape"><div class="shape shape-1"></div><div class="shape shape-2"></div><div class="shape shape-3"></div><div class="shape shape-4"></div><div class="shape shape-5"></div></div>
                <# } #>
            </div>
            <# } #>
        </div>
        <?php
    }

    

}