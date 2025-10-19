<?php
/**
 * List
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\List;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use HexQode\EduMentor\Classes\Helper;
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
        return 'edumentor-list';
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
        return esc_html__( 'List', 'edumentor' );
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
        return 'edumentor-icon eicon-post-list';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'icon list', 'list', 'icon', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'hq-main', 'elementor-icons-fa-solid' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_layout();
        $this->section_list_items();
        $this->box_style();
        $this->icon_style();
        $this->heading_style();
        $this->description_style();
        $this->readmore_style();
        
    }

    /**
     * Layout Section
     *
     * @return void
     */
    protected function section_layout() {
        
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__( 'Layout', 'ridek-core' ),
            ]
        );

        $this->add_responsive_control(
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'ridek-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'block'   => [
                        'title' => esc_html__( 'Block', 'ridek-core' ),
                        'icon'  => 'eicon-editor-list-ul',
                    ],
                    'inline' => [
                        'title' => esc_html__( 'Inline', 'ridek-core' ),
                        'icon'  => 'eicon-navigation-horizontal',
                    ],
                ],
                'default' => 'block',
                'toggle'  => false,
                'prefix_class' => 'layout-',
                'selectors_dictionary' => [
                    'inline' => 'display: grid',
                    'block' => 'display: block',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-el-items' => '{{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'      => esc_html__( 'Column', 'ridek-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 6
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors'  => [
                    '{{WRAPPER}}.layout-inline .hq-el-items' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                ],
                'condition'    => [
                    'layout'    => 'inline',
                ],
            ]
        );

        $this->add_responsive_control(
            'space_between_item',
            [
                'label'      => esc_html__( 'Space Between Item', 'ridek-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 20
                ],
                'selectors'  => [
                    '{{WRAPPER}}.layout-block .hq-el-items .hq-el-item:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.layout-inline .hq-el-items' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'   => esc_html__( 'Alignment', 'ridek-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'ridek-core' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'ridek-core' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'ridek-core' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle'  => false,
                'selectors_dictionary' => [
                    'left' => 'margin-right: auto; margin-left: 0; text-align: left;',
                    'center' => 'margin: 0 auto; text-align: center;',
                    'right' => 'margin-left: auto; margin-right: 0; text-align: right;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-el-items .hq-el-list-content' => '{{VALUE}}',
                    '{{WRAPPER}} .hq-el-items .hq-el-list-icon' => '{{VALUE}}',
                ],
                'condition'    => [
                    'icon_postion'    => 'top',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Section List Items
     *
     * @return void
     */
    protected function section_list_items() {

        $this->start_controls_section(
            'section_items',
            [
                'label' => esc_html__( 'List Items', 'ridek-core' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label'   => esc_html__( 'Icon', 'ridek-core' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-check',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'heading', [
                'label'       => esc_html__( 'Heading', 'ridek-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Business Solution', 'ridek-core' ),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__( 'Description', 'ridek-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 5,
                'placeholder' => esc_html__( 'Description goes here...', 'ridek-core' ),
            ]
        );

        $repeater->add_control(
            'readmore_text',
            [
                'label'       => __( 'Readmore Text', 'ridek-core' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Text goes here...', 'ridek-core' ),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'         => esc_html__( 'Link', 'ridek-core' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'ridek-core' ),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => true,
                ],
                'condition'    => [
                    'readmore_text!'    => ''
                ],
            ]
        );

        $repeater->add_control(
            'customize',
            [
                'label'        => esc_html__( 'Want To Customize?', 'ridek-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'ridek-core' ),
                'label_off'    => esc_html__( 'No', 'ridek-core' ),
                'return_value' => 'yes',
                'description'  => esc_html__( 'You can customize this list from here.', 'ridek-core' ),
            ]
        );

        $repeater->add_control(
            'bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
            ]
        );

        $repeater->add_control(
            'icon_bg_color',
            [
                'label'     => esc_html__( 'Icon Background', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-el-list-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes',
                    'icon[value]!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-el-list-icon' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes',
                    'icon[value]!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'heading_color',
            [
                'label'     => esc_html__( 'Heading Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-el-list-content h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes',
                    'heading!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'description_color',
            [
                'label'     => esc_html__( 'Description Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-el-list-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes',
                    'description!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'readmore_color',
            [
                'label'     => esc_html__( 'Readmore Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-el-list-content a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes',
                    'readmore_text!' => '',
                    'link[url]!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'readmore_hover_color',
            [
                'label'     => esc_html__( 'Readmore Hover Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-el-list-content a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes',
                    'readmore_text!' => '',
                    'link[url]!' => ''
                ],
            ]
        );
        
        $this->add_control(
            'list_items',
            [
                'label'       => esc_html__( 'List Items', 'ridek-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'icon'   => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'heading' => esc_html__( 'Business Solution'),
                        'description' => esc_html__( 'We develop highly complex technical projects geared to improving people\'s quality of life.', 'ridek-core' ),
                    ],
                    [
                        'icon'   => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'heading' => esc_html__( 'Data Analytics'),
                        'description' => esc_html__( 'We develop highly complex technical projects geared to improving people\'s quality of life.', 'ridek-core' ),
                    ],
                    [
                        'icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
                        'heading' => esc_html__( 'Market Strategy'),
                        'description' => esc_html__( 'We develop highly complex technical projects geared to improving people\'s quality of life.', 'ridek-core' ),
                    ],
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) }}} {{{ heading }}}',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Box Style
     *
     * @return void
     */
    protected function box_style() {
        
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => esc_html__( 'Box', 'ridek-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'box_background',
                'label'    => esc_html__( 'Background', 'ridek-core' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .hq-el-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__( 'Border', 'ridek-core' ),
                'selector' => '{{WRAPPER}} .hq-el-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .hq-el-item',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Padding', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
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
                'label' => esc_html__( 'Icon', 'ridek-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_control',
            [
                'label'   => esc_html__( 'Icon', 'ridek-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'show'   => [
                        'title' => esc_html__( 'Show', 'ridek-core' ),
                        'icon'  => 'eicon-eye',
                    ],
                    'hide' => [
                        'title' => esc_html__( 'Hide', 'ridek-core' ),
                        'icon'  => 'eicon-ban',
                    ],
                ],
                'prefix_class' => 'icon-',
                'default' => 'show',
                'selectors' => [
                    '{{WRAPPER}}.icon-hide .hq-el-items .hq-el-item' => 'grid-template-columns: 1fr;'
                ],
                'toggle'  => false,
            ]
        );
        
        $this->add_control(
            'icon_postion',
            [
                'label'   => esc_html__( 'Icon Position', 'ridek-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'ridek-core' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => esc_html__( 'Top', 'ridek-core' ),
                        'icon'  => 'eicon-v-align-top',
                    ]
                ],
                'prefix_class' => 'list-',
                'default' => 'left',
                'toggle'  => false,
                'condition'    => [
                   'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_alignment',
            [
                'label'   => esc_html__( 'Icon Alignment', 'ridek-core' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'top'   => [
                        'title' => esc_html__( 'Top', 'ridek-core' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__( 'Middle', 'ridek-core' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom'  => [
                        'title' => esc_html__( 'Bottom', 'ridek-core' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'selectors_dictionary' => [
                    'top' => 'align-items: flex-start',
                    'middle' => 'align-items: center',
                    'bottom' => 'align-items: flex-end'
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item' => '{{VALUE}}'
                ],
                'toggle'  => false,
                'condition'    => [
                   'icon_postion'    => 'left',
                   'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'icon_background',
                'label'    => esc_html__( 'Background', 'ridek-core' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon',
                'condition'    => [
                    'icon_control'    => 'show',
                 ],
            ]
        );

        $this->add_control(
			'hr_icon_bg',
			[
				'type' => Controls_Manager::DIVIDER,
                'condition'    => [
                    'icon_control'    => 'show',
                ],
			]
		);

        $this->add_control(
			'icon_color_heading',
			[
				'label' => esc_html__( 'Icon Color', 'ridek-core' ),
				'type' => Controls_Manager::HEADING,
                'condition'    => [
                    'icon_control'    => 'show',
                ],
			]
		);

        $this->add_group_control(
            Foreground::get_type(),
            [
                'name'     => 'icon_color',
                'label'    => esc_html__( 'Icon Color', 'ridek-core' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon i',
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_control(
            'svg_icon_color',
            [
                'label'     => esc_html__( 'SVG Icon Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon svg' => 'fill: {{VALUE}}',
                ],
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_width',
            [
                'label'      => esc_html__( 'Width', 'ridek-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 300,
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors'  => [
                    '{{WRAPPER}}.list-left .hq-el-items .hq-el-item' => 'grid-template-columns: {{SIZE}}{{UNIT}} 1fr;',
                    '{{WRAPPER}}.list-top .hq-el-items .hq-el-item' => 'grid-template-columns: 1fr;',
                    '{{WRAPPER}}.list-top .hq-el-items .hq-el-item .hq-el-list-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_height',
            [
                'label'      => esc_html__( 'Height', 'ridek-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 300,
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors'  => [
                    '{{WRAPPER}}.list-left .hq-el-items .hq-el-item .hq-el-list-icon' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.list-top .hq-el-items .hq-el-item .hq-el-list-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space_between',
            [
                'label'      => esc_html__( 'Space Between', 'ridek-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item' => 'grid-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'ridek-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 300,
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon',
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'label'    => esc_html__( 'Border', 'ridek-core' ),
                'selector' => '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon',
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => esc_html__( 'Margin', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'show',
                ],
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
                'label' => esc_html__( 'Heading', 'ridek-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => esc_html__( 'Typography', 'ridek-core' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content h3',
            ]
        );

        $this->add_group_control(
            Foreground::get_type(),
            [
                'name'     => 'heading_color',
                'label'    => esc_html__( 'Text Color', 'ridek-core' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content h3',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'heading_border',
                'label'    => esc_html__( 'Border', 'ridek-core' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content h3',
            ]
        );

        $this->add_responsive_control(
            'heading_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label'      => esc_html__( 'Padding', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label'      => esc_html__( 'Margin', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Description Style
     *
     * @return void
     */
    protected function description_style() {
        
        $this->start_controls_section(
            'desc_style_section',
            [
                'label' => esc_html__( 'Description', 'ridek-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'label'    => esc_html__( 'Typography', 'ridek-core' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content p',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Text Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'desc_border',
                'label'    => esc_html__( 'Border', 'ridek-core' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content p',
            ]
        );

        $this->add_responsive_control(
            'desc_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label'      => esc_html__( 'Padding', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label'      => esc_html__( 'Margin', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'label' => esc_html__( 'Readmore', 'ridek-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'readmore_typography',
                'label'    => esc_html__( 'Typography', 'ridek-core' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a',
            ]
        );

        $this->add_responsive_control(
            'readmore_padding',
            [
                'label'      => esc_html__( 'Padding', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'readmore_margin',
            [
                'label'      => esc_html__( 'Margin', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'reamore_style_tabs' );
        
        $this->start_controls_tab(
            'reamore_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'ridek-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'readmore_background',
                'label'    => esc_html__( 'Background', 'ridek-core' ),
                'types'    => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a',
            ]
        );

        $this->add_control(
            'readmore_color',
            [
                'label'     => esc_html__( 'Text Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'readmore_border',
                'label'    => esc_html__( 'Border', 'ridek-core' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a',
            ]
        );

        $this->add_responsive_control(
            'readmore_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'reamore_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'ridek-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'readmore_hover_background',
                'label'    => esc_html__( 'Background', 'ridek-core' ),
                'types'    => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a:hover',
            ]
        );

        $this->add_control(
            'readmore_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'ridek-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'readmore_hover_border',
                'label'    => esc_html__( 'Border', 'ridek-core' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a:hover',
            ]
        );

        $this->add_responsive_control(
            'readmore_h_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ridek-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-item .hq-el-list-content a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->add_render_attribute( 'wrapper', 'class', 'hq-el-items' );
        $list_items = $settings['list_items'];
        if( $list_items ) :
        ?>
        <div class="hq-el-items">
            <?php 
            foreach ( $list_items as $index => $item ) : 
                $repeater_setting_key_heading = $this->get_repeater_setting_key( 'heading', 'list_items', $index );
                $this->add_inline_editing_attributes( $repeater_setting_key_heading );
                $repeater_setting_key_desc = $this->get_repeater_setting_key( 'description', 'list_items', $index );
                $this->add_inline_editing_attributes( $repeater_setting_key_desc );
                $repeater_setting_key_readmore = $this->get_repeater_setting_key( 'readmore_text', 'list_items', $index );
                $this->add_inline_editing_attributes( $repeater_setting_key_readmore );
                if ( ! empty( $item['link']['url'] ) ) {
                    $link_key = 'link_' . $index;
                    $this->add_link_attributes( $link_key, $item['link'] );
                }
            ?>
            <div class="hq-el-item elementor-repeater-item-<?php echo $item['_id']; ?>">
                <?php if( $item['icon'] && 'show' === $settings['icon_control'] ) : ?>
                    <div class="hq-el-list-icon">
                        <?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                <?php endif; ?>
                <div class="hq-el-list-content">
                    <?php if( $item['heading'] ) : ?>
                        <h3 <?php $this->print_render_attribute_string( $repeater_setting_key_heading ); ?>><?php echo Helper::kses_basic( $item['heading'] ); ?></h3>
                    <?php endif; ?>
                    <?php if( $item['description'] ) : ?>
                        <p <?php $this->print_render_attribute_string( $repeater_setting_key_desc ); ?>><?php echo Helper::kses_basic( $item['description'] ); ?></p>
                    <?php endif; ?>
                    <?php if( ! empty( $item['readmore_text'] && $item['link']['url'] ) ) : ?>
                        <a <?php $this->print_render_attribute_string( $link_key ); ?> <?php $this->print_render_attribute_string( $repeater_setting_key_readmore ); ?>><?php echo esc_html( $item['readmore_text'] ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
        endif;
    }

}