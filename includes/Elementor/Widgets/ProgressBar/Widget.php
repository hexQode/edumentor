<?php
/**
 * Progress Bar
 *
 * @package FlatPack
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
        return 'flatpack-progress-bar';
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
        return esc_html__( 'Progress Bar', 'flatpack' );
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
        return 'fq-icon eicon-skill-bar';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'progress', 'skill', 'bar', 'chart', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'fp-progress-bar' ];
    }

    public function get_script_depends() {
        return [ 'flatpack-el-script', 'jquery-numerator', 'waypoints' ];
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
                'label' => esc_html__( 'Progress Bars', 'flatpack' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Name', 'flatpack' ),
                'default'     => esc_html__( 'Progress Bar', 'flatpack' ),
                'placeholder' => esc_html__( 'Type Progress Bar Name', 'flatpack' ),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label'      => esc_html__( 'Level (Out Of 100)', 'flatpack' ),
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
                'label'        => esc_html__( 'Want To Customize?', 'flatpack' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'flatpack' ),
                'label_off'    => esc_html__( 'No', 'flatpack' ),
                'return_value' => 'yes',
                'description'  => esc_html__( 'You can customize this skill bar color from here or customize from Style tab', 'flatpack' ),
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label'     => esc_html__( 'Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .fp-skill-info' => 'color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
            ]
        );

        $repeater->add_control(
            'r_level_color_type',
            [
                'label'   => esc_html__( 'Level Color Type', 'flatpack' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'color'   => [
                        'title' => esc_html__( 'Color', 'flatpack' ),
                        'icon'  => 'eicon-paint-brush',
                    ],
                    'gradient' => [
                        'title' => esc_html__( 'Gradient', 'flatpack' ),
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
                'label'     => esc_html__( 'Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .fp-skill-level' => 'background-color: {{VALUE}}; background-image: inherit;',
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
                'label'     => esc_html__( 'Color', 'flatpack' ),
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
                'label'      => esc_html__( 'Location', 'flatpack' ),
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
                'label'     => esc_html__( 'Second Color', 'flatpack' ),
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
                'label'      => esc_html__( 'Location', 'flatpack' ),
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
                'label'   => esc_html__( 'Type', 'flatpack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear'  => esc_html__( 'Linear', 'flatpack' ),
                    'radial' => esc_html__( 'Radial', 'flatpack' ),
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
                'label'      => esc_html__( 'Angle', 'flatpack' ),
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
                    '{{WRAPPER}} {{CURRENT_ITEM}} .fp-skill-level' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}deg, {{r_g_f_color.VALUE}} {{r_g_f_location.SIZE}}{{r_g_f_location.UNIT}}, {{r_g_s_color.VALUE}} {{r_g_s_location.SIZE}}{{r_g_s_location.UNIT}})',
                    '{{WRAPPER}}.text-outside {{CURRENT_ITEM}} .fp-skill-level-text' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}deg, {{r_g_f_color.VALUE}} {{r_g_f_location.SIZE}}{{r_g_f_location.UNIT}}, {{r_g_s_color.VALUE}} {{r_g_s_location.SIZE}}{{r_g_s_location.UNIT}})',
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
                'label'   => esc_html__( 'Position', 'flatpack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'center center'  => esc_html__( 'Center Center', 'flatpack' ),
                    'center left' => esc_html__( 'Center Left', 'flatpack' ),
                    'center right' => esc_html__( 'Center Right', 'flatpack' ),
                    'top center' => esc_html__( 'Top Center', 'flatpack' ),
                    'top left' => esc_html__( 'Top Left', 'flatpack' ),
                    'top right' => esc_html__( 'Top Right', 'flatpack' ),
                    'bottom center' => esc_html__( 'Bottom Center', 'flatpack' ),
                    'bottom left' => esc_html__( 'Bottom Left', 'flatpack' ),
                    'bottom right' => esc_html__( 'Bottom Right', 'flatpack' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .fp-skill-level' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{r_g_f_color.VALUE}} {{r_g_f_location.SIZE}}{{r_g_f_location.UNIT}}, {{r_g_s_color.VALUE}} {{r_g_s_location.SIZE}}{{r_g_s_location.UNIT}})',
                    '{{WRAPPER}}.text-outside {{CURRENT_ITEM}} .fp-skill-level-text' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{r_g_f_color.VALUE}} {{r_g_f_location.SIZE}}{{r_g_f_location.UNIT}}, {{r_g_s_color.VALUE}} {{r_g_s_location.SIZE}}{{r_g_s_location.UNIT}})',
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
                'label'     => esc_html__( 'Percent Background Color', 'flatpack' ),
                'description' => esc_html__( 'For text position outside.', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}}.text-outside {{CURRENT_ITEM}} .fp-skill-level-text' => 'background-color: {{VALUE}}',
                ],
                'condition'    => [
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'percent_level_text',
            [
                'label'     => esc_html__( 'Percent Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}}.text-inside {{CURRENT_ITEM}} .fp-skill-level-text' => 'color: {{VALUE}}',
                    '{{WRAPPER}}.text-outside {{CURRENT_ITEM}} .fp-skill-level-text' => 'color: {{VALUE}}',
                ],
                'condition'    => [
                    'customize' => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label'     => esc_html__( 'Base Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .fp-skill' => 'background-color: {{VALUE}}',
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
                'label'     => esc_html__( 'Text Position', 'flatpack' ),
                'separator' => 'before',
                'default'   => 'inside',
                'prefix_class' => 'text-',
                'options'   => [
                    'inside'  => esc_html__( 'Text Inside', 'flatpack' ),
                    'outside' => esc_html__( 'Text Outside', 'flatpack' ),
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
                'label' => esc_html__( 'Skill Bars', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'level_color_type',
            [
                'label'   => esc_html__( 'Bar Color Type', 'flatpack' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'color'   => [
                        'title' => esc_html__( 'Color', 'flatpack' ),
                        'icon'  => 'eicon-paint-brush',
                    ],
                    'gradient' => [
                        'title' => esc_html__( 'Gradient', 'flatpack' ),
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
                'label'     => esc_html__( 'Bar Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5e2ced',
                'selectors' => [
                    '{{WRAPPER}} .fp-skill-level' => 'background-color: {{VALUE}}',
                ],
                'condition'    => [
                    'level_color_type'    => 'color'
                ],
            ]
        );

        $this->add_control(
            'g_f_color',
            [
                'label'     => esc_html__( 'Color', 'flatpack' ),
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
                'label'      => esc_html__( 'Location', 'flatpack' ),
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
                'label'     => esc_html__( 'Second Color', 'flatpack' ),
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
                'label'      => esc_html__( 'Location', 'flatpack' ),
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
                'label'   => esc_html__( 'Type', 'flatpack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'linear',
                'options' => [
                    'linear'  => esc_html__( 'Linear', 'flatpack' ),
                    'radial' => esc_html__( 'Radial', 'flatpack' ),
                ],
                'condition'    => [
                    'level_color_type'    => 'gradient'
                ],
            ]
        );

        $this->add_control(
            'g_angle',
            [
                'label'      => esc_html__( 'Angle', 'flatpack' ),
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
                    '{{WRAPPER}} .fp-skill-level' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}deg, {{g_f_color.VALUE}} {{g_f_location.SIZE}}{{g_f_location.UNIT}}, {{g_s_color.VALUE}} {{g_s_location.SIZE}}{{g_s_location.UNIT}})',
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
                'label'   => esc_html__( 'Position', 'flatpack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'center center'  => esc_html__( 'Center Center', 'flatpack' ),
                    'center left' => esc_html__( 'Center Left', 'flatpack' ),
                    'center right' => esc_html__( 'Center Right', 'flatpack' ),
                    'top center' => esc_html__( 'Top Center', 'flatpack' ),
                    'top left' => esc_html__( 'Top Left', 'flatpack' ),
                    'top right' => esc_html__( 'Top Right', 'flatpack' ),
                    'bottom center' => esc_html__( 'Bottom Center', 'flatpack' ),
                    'bottom left' => esc_html__( 'Bottom Left', 'flatpack' ),
                    'bottom right' => esc_html__( 'Bottom Right', 'flatpack' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .fp-skill-level' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{g_f_color.VALUE}} {{g_f_location.SIZE}}{{g_f_location.UNIT}}, {{g_s_color.VALUE}} {{g_s_location.SIZE}}{{g_s_location.UNIT}})',
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
                'label'     => esc_html__( 'Base Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .fp-skill' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'height',
            [
                'label'      => esc_html__( 'Height', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 250,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}.text-outside .fp-skill' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.text-inside .fp-skill'  => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'spacing',
            [
                'label'      => esc_html__( 'Spacing Between', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fp-skill-items' => 'grid-row-gap: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'bar_border',
                'label'    => esc_html__( 'Border', 'flatpack' ),
                'selector' => '{{WRAPPER}} .fp-skill-items > div',
            ]
        );

        $this->add_responsive_control(
            'bar_inside_spacing',
            [
                'label'      => esc_html__( 'Inside Spacing', 'flatpack' ),
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
                    '{{WRAPPER}} .fp-skill-items > div' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-skill-items > div, {{WRAPPER}} .fp-skill, {{WRAPPER}} .fp-skill-level' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .fp-skill-items > div',
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
                'label' => esc_html__( 'Text', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label'     => esc_html__( 'Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-skill-info' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'info_typography',
                'selector' => '{{WRAPPER}} .fp-skill-info',
            ]
        );

        $this->add_responsive_control(
            'label_spacing',
            [
                'label'      => esc_html__( 'Label Spacing', 'flatpack' ),
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
                    '{{WRAPPER}}.text-outside .fp-skill-info' => 'top: -{{SIZE}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .fp-skill-info',
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
                'label' => esc_html__( 'Percentage', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'percent_typography',
                'selector' => '{{WRAPPER}} .fp-skill-level-text'
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'percent_bg',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => [ 'image' ],
                'selector' => '{{WRAPPER}}.text-outside .fp-skill-level-text',
                'condition'    => [
                    'view'    => 'outside'
                ],
            ]
        );

        $this->add_control(
            'percent_color',
            [
                'label'     => esc_html__( 'Text Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-skill-level-text ' => 'color: {{VALUE}}',
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
        echo '<div class="fp-skill-items">';
        foreach ( $settings['skills'] as $index => $skill ) :
            $name_key = $this->get_repeater_setting_key( 'name', 'bars', $index );
            $this->add_inline_editing_attributes( $name_key, 'none' );
            ?>
            <div class="fp-skill--wrap elementor-repeater-item-<?php echo $skill['_id']; ?>">
                <div class="fp-skill">
                    <div class="fp-skill-level" data-level="<?php echo esc_attr( $skill['level']['size'] ); ?>">
                        <div class="fp-skill-info"><span <?php echo $this->get_render_attribute_string( $name_key ); ?>><?php echo esc_html( $skill['name'] ); ?></span><span class="fp-skill-level-text"></span></div>
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
        <div class="fp-skill-items">
        <#
        if (_.isArray(settings.skills)) {
            _.each(settings.skills, function(skill, index) {
            var nameKey = view.getRepeaterSettingKey( 'name', 'skills', index);
            view.addInlineEditingAttributes( nameKey, 'none' );
            #>
            <div class="elementor-repeater-item-{{skill._id}} fp-skill--wrap">
                <div class="fp-skill">
                    <div class="fp-skill-level" data-level="{{skill.level.size}}">
                        <div class="fp-skill-info"><span {{{view.getRenderAttributeString( nameKey )}}}>{{skill.name}}</span><span class="fp-skill-level-text"></span></div>
                    </div>
                </div>
            </div>
            <# });
        } #>
        </div>
        <?php
    }

}