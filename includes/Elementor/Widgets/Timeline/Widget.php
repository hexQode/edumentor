<?php
/**
 * Timeline
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\Timeline;

use HexQode\EduMentor\Classes\Helper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
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
        return 'flatpack-timeline';
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
        return esc_html__( 'Timeline', 'flatpack' );
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
        return 'fq-icon eicon-time-line';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'timeline', 'card', 'timeline card', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'fp-timeline' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

       $this->timeline_item_section();
       $this->timeline_style_sectin();
       $this->card_style_section();
       $this->heading_style_section();
       $this->sub_heading_style_section();
       $this->description_style_section();
       $this->date_time_style_section();
       $this->readmore_style_section();
        
    }

    /**
     * Timeline Item Section
     */
    protected function timeline_item_section() {

        $this->start_controls_section(
            'timeline_item_section',
            [
                'label' => esc_html__( 'Timeline Items', 'redias-core' )
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control(
            'heading',
            [
                'label'        => esc_html__( 'Heading', 'textdomain' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 4,
                'default'      => esc_html__( 'Timeline Item Heading', 'textdomain' ),
                'placeholder'  => esc_html__( 'Heading...', 'textdomain' ),
            ]
        );

        $repeater->add_control(
            'sub-heading',
            [
                'label'        => esc_html__( 'Sub Heading', 'textdomain' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 4,
                'default'      => '',
                'placeholder'  => esc_html__( 'Sub Heading...', 'textdomain' ),
            ]
        );

        $repeater->add_control(
            'date-time',
            [
                'label'        => esc_html__( 'Date Time', 'textdomain' ),
                'type'         => Controls_Manager::TEXT,
                'label_block'  => true,
                'default'      => esc_html__( '2024', 'textdomain' ),
                'placeholder'  => esc_html__( 'Text goes here...', 'textdomain' ),
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label'        => esc_html__( 'Description', 'textdomain' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 4,
                'default'      => esc_html__( 'I love to work in User Experience & User Interface designing. Because I love to solve the design problem and find easy and better solutions to solve it.', 'flatpack' ),
                'placeholder'  => esc_html__( 'Sub Heading...', 'textdomain' ),
            ]
        );

        $repeater->add_control(
            'rm_text',
            [
                'label'        => esc_html__( 'Readmore Text', 'textdomain' ),
                'type'         => Controls_Manager::TEXT,
                'label_block'  => true,
                'default'      => esc_html__( 'Readmore', 'textdomain' ),
                'placeholder'  => esc_html__( 'Text goes here...', 'textdomain' ),
            ]
        );

        $repeater->add_control(
            'rm_link',
            [
                'label' => esc_html__( 'Readmore Link', 'textdomain' ),
                'type' => Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'rm_text!' => ''
                ]
            ]
        );
        
        
        $this->add_control(
            'timeline_items',
            [
                'label'       => esc_html__( 'Items', 'textdomain' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'heading' => esc_html__( 'FlatPack Award For Architecture', 'flatpack'),
                        'sub-heading' => esc_html__( 'Boston, Massachusetts', 'flatpack'),
                        'date-time' => esc_html__( '2024', 'flatpack'),
                        'desc' => esc_html__( 'I love to work in User Experience & User Interface designing. Because I love to solve the design problem and find easy and better solutions to solve it.', 'textdomain' ),
                    ],
                    [
                        'heading' => esc_html__( 'FlatPack - Project Of The Year', 'flatpack'),
                        'sub-heading' => esc_html__( 'Los Anglous, CA', 'flatpack'),
                        'date-time' => esc_html__( '2023', 'flatpack'),
                        'desc' => esc_html__( 'I love to work in User Experience & User Interface designing. Because I love to solve the design problem and find easy and better solutions to solve it.', 'textdomain' ),
                    ],
                    [
                        'heading' => esc_html__( 'FlatPack International Design', 'flatpack'),
                        'sub-heading' => esc_html__( 'Berline, Germany', 'flatpack'),
                        'date-time' => esc_html__( '2022', 'flatpack'),
                        'desc' => esc_html__( 'I love to work in User Experience & User Interface designing. Because I love to solve the design problem and find easy and better solutions to solve it.', 'textdomain' ),
                    ]
                ],
                'title_field' => '{{{ heading }}}',
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Timeline Controls
     */
    protected function timeline_style_sectin() {

        $this->start_controls_section(
            'timeline_style_sectin',
            [
                'label' => esc_html__( 'Timeline', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'line_size',
            [
                'label' => esc_html__( 'Line Width', 'textdomain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 1
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4
                ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-wrap' => '--fp-tl-hr-line-width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label' => esc_html__( 'Line Color', 'textdomain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-wrap' => '--fp-tl-hr-line-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'space_between_line',
            [
                'label' => esc_html__( 'Space Between Line', 'textdomain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30
                ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-wrap' => '--fp-tl-hr-line-spacing: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'space_between_item',
            [
                'label' => esc_html__( 'Space Between Item', 'textdomain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30
                ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-wrap' => 'row-gap: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'tl_circle_heading',
            [
                'label' => esc_html__( 'Circle Style', 'textdomain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'tl_circle_color',
            [
                'label' => esc_html__( 'Circle Color', 'textdomain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tl_circle_h_color',
            [
                'label' => esc_html__( 'Circle Hover Color', 'textdomain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item:hover:after' => 'background-color: {{VALUE}}',
                ]
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Card Controls
     */
    protected function card_style_section() {

        $this->start_controls_section(
            'card_style_section',
            [
                'label' => esc_html__( 'Card', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'card_bg',
                'types' => [ 'classic', 'gradient' ],
                'esclude' => ['image'],
                'selector' => '{{WRAPPER}} .fp-timeline-item',
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__( 'Padding', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        // Tab Start
        $this->start_controls_tabs( 'card_style_tabs' );
                
        $this->start_controls_tab(
            'card_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'redias-core' ),
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .fp-timeline-item',
            ]
        );

        $this->add_control(
            'card_bdrs',
            [
                'label' => esc_html__( 'Border Radius', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .fp-timeline-item',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'card_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'redias-core' )
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_hover_border',
                'selector' => '{{WRAPPER}} .fp-timeline-item:hover',
            ]
        );

        $this->add_control(
            'card_hover_bdrs',
            [
                'label' => esc_html__( 'Border Radius', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_hover_box_shadow',
                'selector' => '{{WRAPPER}} .fp-timeline-item:hover',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        // Tab End

        $this->add_control(
            'card_h_title',
            [
                'label' => esc_html__( 'Card Header', 'textdomain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_h_border',
                'selector' => '{{WRAPPER}} .fp-timeline-item .timeline-head',
            ]
        );

        $this->add_responsive_control(
            'card_h_padding',
            [
                'label' => esc_html__( 'Padding', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .timeline-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'card_h_margin',
            [
                'label' => esc_html__( 'Margin', 'textdomain' ),
                'type' =>  Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .timeline-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Heading Controls
     */
    protected function heading_style_section() {

        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => esc_html__( 'Heading', 'redias-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-tl-title',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-tl-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Margin', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-tl-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Sub Heading Controls
     */
    protected function sub_heading_style_section() {

        $this->start_controls_section(
            'sub_heading_style_section',
            [
                'label' => esc_html__( 'Sub Heading', 'redias-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-tl-subtitle',
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-tl-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_margin',
            [
                'label' => esc_html__( 'Margin', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-tl-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Description Controls
     */
    protected function description_style_section() {

        $this->start_controls_section(
            'description_style_section',
            [
                'label' => esc_html__( 'Description', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .fp-timeline-item .desc',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__( 'Margin', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Date Time Controls
     */
    protected function date_time_style_section() {

        $this->start_controls_section(
            'date_time_style_section',
            [
                'label' => esc_html__( 'Date Time', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'time_date_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-tl-date-time-inner',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'td_typography',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-tl-date-time-inner',
            ]
        );

        $this->add_control(
            'td_color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-tl-date-time-inner' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'td_border',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-tl-date-time-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'td_box_shadow',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-tl-date-time-inner',
            ]
        );

        $this->add_control(
            'td_bdrs',
            [
                'label' => esc_html__( 'Border Radius', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-tl-date-time-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'td_padding',
            [
                'label' => esc_html__( 'Padding', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-tl-date-time-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'td_margin',
            [
                'label' => esc_html__( 'Margin', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-tl-date-time-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Readmore Controls
     */
    protected function readmore_style_section() {

        $this->start_controls_section(
            'readmore_style_section',
            [
                'label' => esc_html__( 'Readmore', 'redias-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'readmore_typography',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-readmore',
            ]
        );
        
        $this->add_responsive_control(
            'readmore_padding',
            [
                'label' => esc_html__( 'Padding', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'readmore_margin',
            [
                'label' => esc_html__( 'Margin', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        // Tab Start
        $this->start_controls_tabs( 'readmore_style_tabs' );
                
        $this->start_controls_tab(
            'readmore_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'redias-core' ),
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'readmore_bg',
                'types' => [ 'classic', 'gradient' ],
                'esclude' => ['image'],
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-readmore',
            ]
        );

        $this->add_control(
            'readmore_txt_color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-readmore' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'readmore_border',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-readmore',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'readmore_box_shadow',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-readmore',
            ]
        );

        $this->add_control(
            'readmore_bdrs',
            [
                'label' => esc_html__( 'Border Radius', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'readmore_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'redias-core' )
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'readmore_h_bg',
                'types' => [ 'classic', 'gradient' ],
                'esclude' => ['image'],
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-readmore:hover',
            ]
        );

        $this->add_control(
            'readmore_h_txt_color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-readmore:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'readmore_h_border',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-readmore:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'readmore_h_box_shadow',
                'selector' => '{{WRAPPER}} .fp-timeline-item .fp-readmore:hover',
            ]
        );

        $this->add_control(
            'readmore_h_bdrs',
            [
                'label' => esc_html__( 'Border Radius', 'textdomain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fp-timeline-item .fp-readmore:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $timeline_items = $settings['timeline_items'];

        $this->add_render_attribute( 'wrapper', 'class', 'fp-timeline-wrap' );
        if( $timeline_items ) {
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <?php foreach( $timeline_items as $index => $timeline_item ) : 
                $repeater_setting_key_heading = $this->get_repeater_setting_key( 'heading', 'timeline_items', $index );
                $this->add_render_attribute( $repeater_setting_key_heading, 'class', 'fp-tl-title' );
                $this->add_inline_editing_attributes( $repeater_setting_key_heading );

                $repeater_setting_key_sub_heading = $this->get_repeater_setting_key( 'sub-heading', 'timeline_items', $index );
                $this->add_render_attribute( $repeater_setting_key_sub_heading, 'class', 'fp-tl-subtitle' );
                $this->add_inline_editing_attributes( $repeater_setting_key_sub_heading );

                $repeater_setting_key_date_time = $this->get_repeater_setting_key( 'date-time', 'timeline_items', $index );
                $this->add_render_attribute( $repeater_setting_key_date_time, 'class', 'fp-tl-date-time-inner' );
                $this->add_inline_editing_attributes( $repeater_setting_key_date_time );

                $repeater_setting_key_desc = $this->get_repeater_setting_key( 'desc', 'timeline_items', $index );
                $this->add_render_attribute( $repeater_setting_key_desc, 'class', 'desc' );
                $this->add_inline_editing_attributes( $repeater_setting_key_desc );

                $repeater_setting_key_readmore = $this->get_repeater_setting_key( 'rm_text', 'timeline_items', $index );
                $this->add_inline_editing_attributes( $repeater_setting_key_readmore );
                $this->add_render_attribute( $repeater_setting_key_readmore, 'class', 'fp-readmore' );
                if ( ! empty( $timeline_item['rm_link']['url'] ) ) {
                    $link_key = 'rm_link_' . $index;
                    $this->add_link_attributes( $link_key, $timeline_item['rm_link'] );
                }

            ?>
            <div class="fp-timeline-item">
                <div class="fp-timeline-inner">
                    <?php if( ! empty( $timeline_item['heading'] || $timeline_item['sub-heading'] || $timeline_item['date-time'] ) ) : ?>
                    <div class="timeline-head">
                        <div class="fp-tl-title-wrap">
                            <?php
                            if( ! empty( $timeline_item['heading'] ) ) {
                                echo '<h3 '. $this->get_render_attribute_string( $repeater_setting_key_heading ) .'>'. Helper::kses_basic( $timeline_item['heading'] ) .'</h3>';
                            }
                            if( ! empty( $timeline_item['sub-heading'] ) ) {
                                echo '<div '. $this->get_render_attribute_string( $repeater_setting_key_sub_heading ) .'>'. Helper::kses_basic( $timeline_item['sub-heading'] ) .'</div>';
                            }
                            ?>
                        </div>
                        <?php
                            if( ! empty( $timeline_item['date-time'] ) ) {
                                echo '<div class="fp-tl-date-time"><div '. $this->get_render_attribute_string( $repeater_setting_key_date_time ) .'>'. Helper::kses_basic( $timeline_item['date-time'] ) .'</div></div>';
                            }
                        ?>
                    </div>
                    <?php endif; 
                        if( ! empty( $timeline_item['desc'] ) ) {
                            echo '<p '. $this->get_render_attribute_string( $repeater_setting_key_desc ) .'>'. Helper::kses_basic( $timeline_item['desc'] ) .'</p>';
                        }
                        if( ! empty( $timeline_item['rm_text'] && $timeline_item['rm_link']['url'] ) ) {
                            echo '<a '. $this->get_render_attribute_string( $link_key ) .' '. $this->get_render_attribute_string( $repeater_setting_key_readmore ) .'>'. esc_html( $timeline_item['rm_text'] ) .'</a>';
                        }
                    ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
        }else{
            esc_html_e( 'No timeline item found! Please add the timeline item.', 'flatpack' );
        }
       
    }

}