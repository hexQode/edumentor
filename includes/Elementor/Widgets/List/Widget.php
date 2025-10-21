<?php
/**
 * List Items
 *
 * @package PetFunCore
 */
namespace HexQode\EduMentor\Elementor\Widgets\List;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Widget_Base;

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
        return 'edumentor-icon eicon-post-list';
    }

    protected function get_html_wrapper_class() {
        return parent::get_html_wrapper_class() . ' edumentor-wow';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return ['icon list', 'list', 'icon', 'edumentor'];
    }

    public function get_style_depends() {
        return [ 'edumentor-main', 'edumentor-keyframes', 'elementor-icons-fa-solid' ];
    }

    public function get_script_depends() {
        return [ 'edumentor-el-script', 'wow' ];
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
                'label' => esc_html__( 'Layout', 'edumentor' ),
            ]
        );

        $this->add_responsive_control(
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'edumentor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'block'   => [
                        'title' => esc_html__( 'Block', 'edumentor' ),
                        'icon'  => 'eicon-editor-list-ul',
                    ],
                    'inline' => [
                        'title' => esc_html__( 'Inline', 'edumentor' ),
                        'icon'  => 'eicon-navigation-horizontal',
                    ],
                ],
                'default' => 'block',
                'toggle'  => false,
                'prefix_class' => 'layout-',
                'selectors_dictionary' => [
                    'inline' => 'display: grid',
                    'block' => 'display: grid; grid-template-columns: 1fr;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-el-items' => '{{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'      => esc_html__( 'Column', 'edumentor' ),
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
                    '{{WRAPPER}} .hq-el-items' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                ],
                'condition'    => [
                    'layout'    => 'inline',
                ],
            ]
        );

        $this->add_responsive_control(
            'space_between_item',
            [
                'label'      => esc_html__( 'Space Between Item', 'edumentor' ),
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
                    '{{WRAPPER}} .hq-el-items' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label'   => esc_html__( 'Alignment', 'edumentor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'edumentor' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'edumentor' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'align-',
                'default' => 'left',
                'toggle'  => false,
                'selectors' => [
                    '{{WRAPPER}} .hq-el-items .hq-el-list-content' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}}.align-center .hq-el-items .hq-el-list-icon' => 'margin: 0 auto;',
                    '{{WRAPPER}}.align-right .hq-el-items .hq-el-list-icon' => 'margin-left: auto;',
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
                'label' => esc_html__( 'List Items', 'edumentor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon_type',
            [
                'label' => esc_html__( 'Icon Type', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'image' => [
                        'title' => esc_html__( 'Image', 'edumentor' ),
                        'icon' => 'eicon-image',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'edumentor' ),
                        'icon' => 'eicon-info-circle-o',
                    ]
                ],
                'default' => 'icon',
                'toggle' => false
            ]
        );

        $repeater->add_control(
            'image_icon',
            [
                'label' => esc_html__( 'Choose Image', 'edumentor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ],
                'condition' => [
                    'icon_type' => 'image'
                ]
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label'   => esc_html__( 'Icon', 'edumentor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'icon_type' => 'icon'
                ]
            ]
        );

        $repeater->add_control(
            'heading', [
                'label'       => esc_html__( 'Heading', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Business Solution', 'edumentor' ),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__( 'Description', 'edumentor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 5,
                'placeholder' => esc_html__( 'Description goes here...', 'edumentor' ),
            ]
        );

        $repeater->add_control(
            'readmore_text',
            [
                'label'       => __( 'Readmore Text', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Text goes here...', 'edumentor' ),
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'         => esc_html__( 'Link', 'edumentor' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'edumentor' ),
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
                'label'        => esc_html__( 'Want To Customize?', 'edumentor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'edumentor' ),
                'label_off'    => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'description'  => esc_html__( 'You can customize this list from here.', 'edumentor' ),
            ]
        );

        $repeater->add_control(
            'bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
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
                'label'     => esc_html__( 'Icon Background', 'edumentor' ),
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
			'icon_r_color_heading',
			[
				'label' => esc_html__( 'Icon Color', 'edumentor' ),
				'type' => Controls_Manager::HEADING,
                'condition' => [
                    'customize' => 'yes',
                    'icon[value]!' => ''
                ],
			]
		);

        $repeater->add_group_control(
            Foreground::get_type(),
            [
                'name'     => 'icon_r_color',
                'label'    => esc_html__( 'Icon Color', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} div.hq-el-items {{CURRENT_ITEM}}.hq-el-item .hq-el-list-icon i',
                'condition' => [
                    'customize' => 'yes',
                    'icon[value]!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'svg_r_icon_color',
            [
                'label'     => esc_html__( 'SVG Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} div.hq-el-items {{CURRENT_ITEM}}.hq-el-item .hq-el-list-icon svg' => 'fill: {{VALUE}}',
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
                'label'     => esc_html__( 'Heading Color', 'edumentor' ),
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
                'label'     => esc_html__( 'Description Color', 'edumentor' ),
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
                'label'     => esc_html__( 'Readmore Color', 'edumentor' ),
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
                'label'     => esc_html__( 'Readmore Hover Color', 'edumentor' ),
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

        $repeater->add_responsive_control(
            'field_id',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'customize' => 'yes'
                ],
            ]
        );
        
        $this->add_control(
            'list_items',
            [
                'label'       => esc_html__( 'List Items', 'edumentor' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'icon'   => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'heading' => esc_html__( 'Business Solution'),
                        'description' => esc_html__( 'We develop highly complex technical projects geared to improving people\'s quality of life.', 'edumentor' ),
                    ],
                    [
                        'icon'   => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                        'heading' => esc_html__( 'Data Analytics'),
                        'description' => esc_html__( 'We develop highly complex technical projects geared to improving people\'s quality of life.', 'edumentor' ),
                    ],
                    [
                        'icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
                        'heading' => esc_html__( 'Market Strategy'),
                        'description' => esc_html__( 'We develop highly complex technical projects geared to improving people\'s quality of life.', 'edumentor' ),
                    ],
                ],
                'title_field' => '{{{ heading }}}',
            ]
        );

        $this->add_control(
            'scrolling_anim_label',
            [
                'label' => esc_html__( 'Scrolling Animation', 'edumentor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'list_animation',
            [
                'label' => esc_html__( 'Animation', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edumentor' ),
                'label_off' => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_control(
            'list_anim_effect',
            [
                'label' => esc_html__( 'Effect', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fadeIn',
                'options' => [
                    'fadeIn' => esc_html__( 'Fade In', 'edumentor' ),
                    'fadeInLeft' => esc_html__( 'Fade In Left', 'edumentor' ),
                    'fadeInRight'  => esc_html__( 'Fade In Right', 'edumentor' ),
                    'fadeInTop' => esc_html__( 'Fade In Top', 'edumentor' ),
                    'fadeInBottom' => esc_html__( 'Fade In Bottom', 'edumentor' )
                ],
                'condition' => [
                    'list_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'list_anim_offset',
            [
                'label' => esc_html__( 'Offset', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 200,
                'condition' => [
                    'list_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'list_anim_delay',
            [
                'label' => esc_html__( 'Delay', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 400,
                'condition' => [
                    'list_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'list_anim_duration',
            [
                'label' => esc_html__( 'Duration', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 700,
                'condition' => [
                    'list_animation' => 'yes'
                ]
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
                'label' => esc_html__( 'Box', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'box_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .hq-el-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
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
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
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
                'label'      => esc_html__( 'Padding', 'edumentor' ),
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
                'label' => esc_html__( 'Icon', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_control',
            [
                'label' => esc_html__( 'Icon', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'edumentor' ),
                'label_off' => esc_html__( 'Hide', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        
        
        $this->add_responsive_control(
            'icon_postion',
            [
                'label'   => esc_html__( 'Icon Position', 'edumentor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'edumentor' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => esc_html__( 'Top', 'edumentor' ),
                        'icon'  => 'eicon-v-align-top',
                    ]
                ],
                'prefix_class' => 'list-',
                'default' => 'left',
                'selectors_dictionary' => [
                    'top' => 'grid-template-columns: 1fr',
                    'left' => 'grid-template-columns: var(--edumentor-list-icon-width) 1fr;'
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item' => '{{VALUE}}'
                ],
                'toggle'  => false,
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_alignment',
            [
                'label'   => esc_html__( 'Icon Alignment', 'edumentor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'top'   => [
                        'title' => esc_html__( 'Top', 'edumentor' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__( 'Middle', 'edumentor' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom'  => [
                        'title' => esc_html__( 'Bottom', 'edumentor' ),
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
                   'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'icon_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon',
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_control(
			'hr_icon_bg',
			[
				'type' => Controls_Manager::DIVIDER,
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
			]
		);

        $this->add_control(
			'icon_color_heading',
			[
				'label' => esc_html__( 'Icon Color', 'edumentor' ),
				'type' => Controls_Manager::HEADING,
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
			]
		);

        $this->add_group_control(
            Foreground::get_type(),
            [
                'name'     => 'icon_color',
                'label'    => esc_html__( 'Icon Color', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon i',
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_control(
            'svg_icon_color',
            [
                'label'     => esc_html__( 'SVG Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon svg' => 'fill: {{VALUE}}',
                ],
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_width',
            [
                'label'      => esc_html__( 'Width', 'edumentor' ),
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
                    '{{WRAPPER}} .hq-el-items .hq-el-item' => '--edumentor-list-icon-width: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_height',
            [
                'label'      => esc_html__( 'Height', 'edumentor' ),
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
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space_between',
            [
                'label'      => esc_html__( 'Space Between', 'edumentor' ),
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
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'edumentor' ),
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
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon img' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon',
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon',
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-el-items .hq-el-item .hq-el-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'icon_control'    => 'yes',
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
                'label' => esc_html__( 'Heading', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content h3',
            ]
        );

        $this->add_group_control(
            Foreground::get_type(),
            [
                'name'     => 'heading_color',
                'label'    => esc_html__( 'Text Color', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content h3',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'heading_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content h3',
            ]
        );

        $this->add_responsive_control(
            'heading_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
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
                'label'      => esc_html__( 'Padding', 'edumentor' ),
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
                'label'      => esc_html__( 'Margin', 'edumentor' ),
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
                'label' => esc_html__( 'Description', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content p',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
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
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content p',
            ]
        );

        $this->add_responsive_control(
            'desc_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
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
                'label'      => esc_html__( 'Padding', 'edumentor' ),
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
                'label'      => esc_html__( 'Margin', 'edumentor' ),
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
                'label' => esc_html__( 'Readmore', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'readmore_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a',
            ]
        );

        $this->add_responsive_control(
            'readmore_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
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
                'label'      => esc_html__( 'Margin', 'edumentor' ),
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
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'readmore_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a',
            ]
        );

        $this->add_control(
            'readmore_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
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
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a',
            ]
        );

        $this->add_responsive_control(
            'readmore_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
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
                'label' => esc_html__( 'Hover', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'readmore_hover_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a:hover',
            ]
        );

        $this->add_control(
            'readmore_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
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
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-el-item .hq-el-list-content a:hover',
            ]
        );

        $this->add_responsive_control(
            'readmore_h_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
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
        $icon_control = 'yes' === $settings['icon_control'] ? '' : ' no-icon';
        if( $list_items ) :

            if( 'yes' === $settings['list_animation'] ) {
                $animation_effect = ' wow hq-' . $settings['list_anim_effect'];
                $animation_offset = ' data-wow-offset="'. $settings['list_anim_offset'] .'"';
                $animation_duration = ' data-wow-duration="'. $settings['list_anim_duration'] .'ms"';
            }else{
                $animation_effect = '';
                $animation_duration = '';
                $animation_offset = '';
            }

            $anim_attr = $animation_offset . $animation_duration;
        ?>
        <div class="hq-el-items<?php echo esc_attr( $icon_control ); ?>">
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
                if( 'yes' === $settings['list_animation'] ) {
                    $dealy = $settings['list_anim_delay'] + (50 * $index );
                    $animation_delay = ' data-wow-delay="'. $dealy .'ms"';
                }else{
                    $animation_delay = '';
                }
            ?>
            <div class="hq-el-item elementor-repeater-item-<?php echo $item['_id'] . $animation_effect; ?>"<?php echo $anim_attr . $animation_delay; ?>>
                <?php if( 'yes' === $settings['icon_control'] ) : ?>
                    <div class="hq-el-list-icon">
                        <?php
                        if( 'image' === $item['icon_type'] ) {
                            if( ! empty( $item['image_icon']['url'] ) ){
                                echo '<img src="'. esc_url( $item['image_icon']['url'] ) .'" alt="'. esc_attr( $item['heading'] ) .'">';
                            }
                        }else{
                            if($item['icon']){
                                Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
                            }
                        }
                        ?>
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