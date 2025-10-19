<?php
/**
 * Progress Bar
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\ProgressBar;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;

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
        return 'edumentor-progress-bar';
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
        return esc_html__( 'Progress Bar', 'edumentor' );
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
        return 'edumentor-icon eicon-skill-bar';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'progress', 'skill', 'bar', 'chart', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'hq-progress-bar' ];
    }

    public function get_script_depends() {
        return [ 'edumentor-el-script', 'jquery-numerator', 'waypoints' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->progress_bar_section();
        $this->progress_bar_style();
        $this->text_style();
        $this->percentage_style();
        
    }

    /**
     * Progress Bars
     *
     * @return void
     */
    protected function progress_bar_section() {

        $this->start_controls_section(
            'section_progress_bars',
            [
                'label' => esc_html__( 'Progress Bars', 'edumentor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Name', 'edumentor' ),
                'default'     => esc_html__( 'Progress Bar', 'edumentor' ),
                'placeholder' => esc_html__( 'Type Progress Bar Name', 'edumentor' ),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label'      => esc_html__( 'Level (Out Of 100)', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => '%',
                    'size' => 85,
                ],
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
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
                'description'  => esc_html__( 'You can customize this skill bar color from here or customize from Style tab', 'edumentor' ),
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-skill-info' => 'color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
            ]
        );

        $repeater->add_control(
            'r_level_color_type',
            [
                'label'   => esc_html__( 'Level Color Type', 'edumentor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'color'   => [
                        'title' => esc_html__( 'Color', 'edumentor' ),
                        'icon'  => 'eicon-paint-brush',
                    ],
                    'gradient' => [
                        'title' => esc_html__( 'Gradient', 'edumentor' ),
                        'icon'  => 'eicon-barcode',
                    ],
                ],
                'default' => 'color',
                'toggle'  => false,
                'condition' => ['customize' => 'yes'],
            ]
        );

        $repeater->add_control(
            'r_level_color',
            [
                'label'     => esc_html__( 'Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-skill-level' => 'background-color: {{VALUE}}; background-image: inherit;',
                ],
                'condition'    => [
                    'r_level_color_type'    => 'color',
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'r_g_f_color',
            [
                'label'     => esc_html__( 'Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default' => '#ff5e17',
                'render_type' => 'ui',
                'condition'    => [
                    'r_level_color_type'    => 'gradient',
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'r_g_f_location',
            [
                'label'      => esc_html__( 'Location', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range'      => [
                    '%'  => [
                        'min' => 0,
                        'max' => 100
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 0
                ],
                'render_type' => 'ui',
                'condition'    => [
                    'r_level_color_type'    => 'gradient',
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'r_g_s_color',
            [
                'label'     => esc_html__( 'Second Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default' => '#5333f2',
                'render_type' => 'ui',
                'condition'    => [
                    'r_level_color_type'    => 'gradient',
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'r_g_s_location',
            [
                'label'      => esc_html__( 'Location', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range'      => [
                    '%'  => [
                        'min' => 0,
                        'max' => 100
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 100
                ],
                'render_type' => 'ui',
                'condition'    => [
                    'r_level_color_type'    => 'gradient',
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'r_g_type',
            [
                'label'   => esc_html__( 'Type', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear'  => esc_html__( 'Linear', 'edumentor' ),
                    'radial' => esc_html__( 'Radial', 'edumentor' ),
                ],
                'condition'    => [
                    'r_level_color_type'    => 'gradient',
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'r_g_angle',
            [
                'label'      => esc_html__( 'Angle', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px'  => [
                        'min' => 0,
                        'max' => 360
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 180
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-skill-level' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}deg, {{r_g_f_color.VALUE}} {{r_g_f_location.SIZE}}{{r_g_f_location.UNIT}}, {{r_g_s_color.VALUE}} {{r_g_s_location.SIZE}}{{r_g_s_location.UNIT}})',
                    '{{WRAPPER}}.text-outside {{CURRENT_ITEM}} .hq-skill-level-text' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}deg, {{r_g_f_color.VALUE}} {{r_g_f_location.SIZE}}{{r_g_f_location.UNIT}}, {{r_g_s_color.VALUE}} {{r_g_s_location.SIZE}}{{r_g_s_location.UNIT}})',
                ],
                'condition'    => [
                    'r_level_color_type'    => 'gradient',
                    'r_g_type' => 'linear',
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'r_g_postion',
            [
                'label'   => esc_html__( 'Position', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'center center'  => esc_html__( 'Center Center', 'edumentor' ),
                    'center left' => esc_html__( 'Center Left', 'edumentor' ),
                    'center right' => esc_html__( 'Center Right', 'edumentor' ),
                    'top center' => esc_html__( 'Top Center', 'edumentor' ),
                    'top left' => esc_html__( 'Top Left', 'edumentor' ),
                    'top right' => esc_html__( 'Top Right', 'edumentor' ),
                    'bottom center' => esc_html__( 'Bottom Center', 'edumentor' ),
                    'bottom left' => esc_html__( 'Bottom Left', 'edumentor' ),
                    'bottom right' => esc_html__( 'Bottom Right', 'edumentor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-skill-level' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{r_g_f_color.VALUE}} {{r_g_f_location.SIZE}}{{r_g_f_location.UNIT}}, {{r_g_s_color.VALUE}} {{r_g_s_location.SIZE}}{{r_g_s_location.UNIT}})',
                    '{{WRAPPER}}.text-outside {{CURRENT_ITEM}} .hq-skill-level-text' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{r_g_f_color.VALUE}} {{r_g_f_location.SIZE}}{{r_g_f_location.UNIT}}, {{r_g_s_color.VALUE}} {{r_g_s_location.SIZE}}{{r_g_s_location.UNIT}})',
                ],
                'condition'    => [
                    'r_level_color_type'    => 'gradient',
                    'r_g_type' => 'radial',
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'percent_level_bg',
            [
                'label'     => esc_html__( 'Percent Background Color', 'edumentor' ),
                'description' => esc_html__( 'For text position outside.', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}}.text-outside {{CURRENT_ITEM}} .hq-skill-level-text' => 'background-color: {{VALUE}}',
                ],
                'condition'    => [
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'percent_level_text',
            [
                'label'     => esc_html__( 'Percent Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}}.text-inside {{CURRENT_ITEM}} .hq-skill-level-text' => 'color: {{VALUE}}',
                    '{{WRAPPER}}.text-outside {{CURRENT_ITEM}} .hq-skill-level-text' => 'color: {{VALUE}}',
                ],
                'condition'    => [
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label'     => esc_html__( 'Base Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hq-skill' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label'  => false,
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default'     => [
                    [
                        'name'  => 'Design',
                        'level' => ['size' => 97, 'unit' => '%'],
                    ],
                    [
                        'name'  => 'UX',
                        'level' => ['size' => 88, 'unit' => '%'],
                    ],
                    [
                        'name'  => 'Coding',
                        'level' => ['size' => 92, 'unit' => '%'],
                    ],
                    [
                        'name' => 'Speed',
                        'level' => ['size' => 85, 'unit' => '%'],
                    ],
                    [
                        'name'  => 'Passion',
                        'level' => ['size' => 100, 'unit' => '%'],
                    ],
                ],
            ]
        );

        $this->add_control(
            'view',
            [
                'type'      => Controls_Manager::SELECT,
                'label'     => esc_html__( 'Text Position', 'edumentor' ),
                'separator' => 'before',
                'default'   => 'inside',
                'prefix_class' => 'text-',
                'options'   => [
                    'inside'  => esc_html__( 'Text Inside', 'edumentor' ),
                    'outside' => esc_html__( 'Text Outside', 'edumentor' ),
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Progress Bars Style
     *
     * @return void
     */
    protected function progress_bar_style() {

        $this->start_controls_section(
            'section_style_skill_bars',
            [
                'label' => esc_html__( 'Skill Bars', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'level_color_type',
            [
                'label'   => esc_html__( 'Bar Color Type', 'edumentor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'color'   => [
                        'title' => esc_html__( 'Color', 'edumentor' ),
                        'icon'  => 'eicon-paint-brush',
                    ],
                    'gradient' => [
                        'title' => esc_html__( 'Gradient', 'edumentor' ),
                        'icon'  => 'eicon-barcode',
                    ],
                ],
                'default' => 'color',
                'toggle'  => false,
            ]
        );

        $this->add_control(
            'level_color',
            [
                'label'     => esc_html__( 'Bar Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5e2ced',
                'selectors' => [
                    '{{WRAPPER}} .hq-skill-level' => 'background-color: {{VALUE}}',
                ],
                'condition'    => [
                    'level_color_type'    => 'color'
                ],
            ]
        );

        $this->add_control(
            'g_f_color',
            [
                'label'     => esc_html__( 'Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default' => '#5e2ced',
                'render_type' => 'ui',
                'condition'    => [
                    'level_color_type'    => 'gradient'
                ],
            ]
        );

        $this->add_control(
            'g_f_location',
            [
                'label'      => esc_html__( 'Location', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range'      => [
                    '%'  => [
                        'min' => 0,
                        'max' => 100
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 0
                ],
                'render_type' => 'ui',
                'condition'    => [
                    'level_color_type'    => 'gradient'
                ],
            ]
        );

        $this->add_control(
            'g_s_color',
            [
                'label'     => esc_html__( 'Second Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default' => '#6832fc',
                'render_type' => 'ui',
                'condition'    => [
                    'level_color_type'    => 'gradient'
                ],
            ]
        );

        $this->add_control(
            'g_s_location',
            [
                'label'      => esc_html__( 'Location', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range'      => [
                    '%'  => [
                        'min' => 0,
                        'max' => 100
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 100
                ],
                'render_type' => 'ui',
                'condition'    => [
                    'level_color_type'    => 'gradient'
                ],
            ]
        );

        $this->add_control(
            'g_type',
            [
                'label'   => esc_html__( 'Type', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear'  => esc_html__( 'Linear', 'edumentor' ),
                    'radial' => esc_html__( 'Radial', 'edumentor' ),
                ],
                'condition'    => [
                    'level_color_type'    => 'gradient'
                ],
            ]
        );

        $this->add_control(
            'g_angle',
            [
                'label'      => esc_html__( 'Angle', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px'  => [
                        'min' => 0,
                        'max' => 360
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 180
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-skill-level' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}deg, {{g_f_color.VALUE}} {{g_f_location.SIZE}}{{g_f_location.UNIT}}, {{g_s_color.VALUE}} {{g_s_location.SIZE}}{{g_s_location.UNIT}})',
                ],
                'condition'    => [
                    'level_color_type'    => 'gradient',
                    'g_type' => 'linear'
                ],
            ]
        );

        $this->add_control(
            'g_postion',
            [
                'label'   => esc_html__( 'Position', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'center center'  => esc_html__( 'Center Center', 'edumentor' ),
                    'center left' => esc_html__( 'Center Left', 'edumentor' ),
                    'center right' => esc_html__( 'Center Right', 'edumentor' ),
                    'top center' => esc_html__( 'Top Center', 'edumentor' ),
                    'top left' => esc_html__( 'Top Left', 'edumentor' ),
                    'top right' => esc_html__( 'Top Right', 'edumentor' ),
                    'bottom center' => esc_html__( 'Bottom Center', 'edumentor' ),
                    'bottom left' => esc_html__( 'Bottom Left', 'edumentor' ),
                    'bottom right' => esc_html__( 'Bottom Right', 'edumentor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-skill-level' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{g_f_color.VALUE}} {{g_f_location.SIZE}}{{g_f_location.UNIT}}, {{g_s_color.VALUE}} {{g_s_location.SIZE}}{{g_s_location.UNIT}})',
                ],
                'condition'    => [
                    'level_color_type'    => 'gradient',
                    'g_type' => 'radial'
                ],
            ]
        );

        $this->add_control(
            'base_color',
            [
                'label'     => esc_html__( 'Base Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .hq-skill' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'height',
            [
                'label'      => esc_html__( 'Height', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 250,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}.text-outside .hq-skill' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.text-inside .hq-skill'  => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'spacing',
            [
                'label'      => esc_html__( 'Spacing Between', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-skill-items' => 'grid-row-gap: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'bar_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-skill-items > div',
            ]
        );

        $this->add_responsive_control(
            'bar_inside_spacing',
            [
                'label'      => esc_html__( 'Inside Spacing', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-skill-items > div' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-skill-items > div, {{WRAPPER}} .hq-skill, {{WRAPPER}} .hq-skill-level' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .hq-skill-items > div',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Text Style
     *
     * @return void
     */
    protected function text_style() {

        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__( 'Text', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-skill-info' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'info_typography',
                'selector' => '{{WRAPPER}} .hq-skill-info',
            ]
        );

        $this->add_responsive_control(
            'label_spacing',
            [
                'label'      => esc_html__( 'Label Spacing', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 20,
                        'max'  => 100
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 30
                ],
                'selectors'  => [
                    '{{WRAPPER}}.text-outside .hq-skill-info' => 'top: -{{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'view'    => 'outside'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'info_text_shadow',
                'selector' => '{{WRAPPER}} .hq-skill-info',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Percentage Style
     *
     * @return void
     */
    protected function percentage_style() {

        $this->start_controls_section(
            'section_style_percentage',
            [
                'label' => esc_html__( 'Percentage', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'percent_typography',
                'selector' => '{{WRAPPER}} .hq-skill-level-text'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'percent_bg',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => [ 'image' ],
                'selector' => '{{WRAPPER}}.text-outside .hq-skill-level-text',
                'condition'    => [
                    'view'    => 'outside'
                ],
            ]
        );

        $this->add_control(
            'percent_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-skill-level-text ' => 'color: {{VALUE}}',
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
		if ( ! is_array( $settings['skills'] ) ) {
            return;
        }
        echo '<div class="hq-skill-items">';
        foreach ( $settings['skills'] as $index => $skill ) :
            $name_key = $this->get_repeater_setting_key( 'name', 'bars', $index );
            $this->add_inline_editing_attributes( $name_key, 'none' );
            ?>
            <div class="hq-skill--wrap elementor-repeater-item-<?php echo $skill['_id']; ?>">
                <div class="hq-skill">
                    <div class="hq-skill-level" data-level="<?php echo esc_attr( $skill['level']['size'] ); ?>">
                        <div class="hq-skill-info"><span <?php echo $this->get_render_attribute_string( $name_key ); ?>><?php echo esc_html( $skill['name'] ); ?></span><span class="hq-skill-level-text"></span></div>
                    </div>
                </div>
            </div>
            <?php
        endforeach;
        echo '</div>';
    }

    /**
     * Elementor content template function
     *
     * @return void
     */
    protected function content_template() {
        ?>
        <div class="hq-skill-items">
        <#
        if (_.isArray(settings.skills)) {
            _.each(settings.skills, function(skill, index) {
            var nameKey = view.getRepeaterSettingKey( 'name', 'skills', index);
            view.addInlineEditingAttributes( nameKey, 'none' );
            #>
            <div class="elementor-repeater-item-{{skill._id}} hq-skill--wrap">
                <div class="hq-skill">
                    <div class="hq-skill-level" data-level="{{skill.level.size}}">
                        <div class="hq-skill-info"><span {{{view.getRenderAttributeString( nameKey )}}}>{{skill.name}}</span><span class="hq-skill-level-text"></span></div>
                    </div>
                </div>
            </div>
            <# });
        } #>
        </div>
        <?php
    }

}