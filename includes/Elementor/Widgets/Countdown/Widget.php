<?php
/**
 * Countdown
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace DynamicLayers\FlatPack\Elementor\Widgets\Countdown;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Control_Media;

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
        return 'flatpack-countdown';
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
        return esc_html__( 'Countdown', 'flatpack' );
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
        return 'fq-icon eicon-countdown';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'countdown', 'coming soon', 'timer', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'fp-countdown' ];
    }

    public function get_script_depends() {
        return [ 'fp-countdown', 'flatpack-el-script' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_time();
        $this->section_countdown_settings();
        $this->section_end_action();
        $this->common_style();
        $this->days_style();
        $this->hours_style();
        $this->minutes_style();
        $this->seconds_style();
        
    }

    /**
	 * Section Time
	 *
	 * @return void
	 */
    protected function section_time() {

        $this->start_controls_section(
            '_section_time',
            [
                'label' => esc_html__( 'Set Time', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'due_date',
            [
                'label'       => esc_html__( 'Time', 'flatpack' ),
                'type'        => Controls_Manager::DATE_TIME,
                'default'     => date( "Y-m-d", strtotime( "+ 1 day" ) ),
                'description' => esc_html__( 'Set the due date and time', 'flatpack' ),
            ]
        );

        $this->end_controls_section();

    }

	/**
	 * Section Coundown Settings
	 *
	 * @return void
	 */
    protected function section_countdown_settings() {

        $this->start_controls_section(
            '_section_countdown_settings',
            [
                'label' => esc_html__( 'Settings', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'label_position',
            [
                'label'          => esc_html__( 'Label Position', 'flatpack' ),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'right'  => [
                        'title' => esc_html__( 'Right', 'flatpack' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'flatpack' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle'         => false,
                'default'        => 'bottom',
                'prefix_class'   => 'fp-countdown-label-',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_space',
            [
                'label'          => esc_html__( 'Label Space', 'flatpack' ),
                'type'           => Controls_Manager::POPOVER_TOGGLE,
                'condition'      => [
                    'label_position' => 'right',
                ],
                'style_transfer' => true,
            ]
        );

        $this->start_popover();

        $this->add_control(
            'label_space_top',
            [
                'label'          => esc_html__( 'Label Space Top', 'flatpack' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}}.fp-countdown-label-right .fp-countdown-item .fp-countdown-label' => 'top: {{SIZE || 0}}{{UNIT}};',
                ],
                'condition'      => [
                    'label_position' => 'right',
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_space_left',
            [
                'label'          => esc_html__( 'Label Space Left', 'flatpack' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}}.fp-countdown-label-right .fp-countdown-item .fp-countdown-label' => 'left: {{SIZE || 0}}{{UNIT}};',
                ],
                'condition'      => [
                    'label_position' => 'right',
                ],
                'style_transfer' => true,
            ]
        );

        $this->end_popover(); //End Prover

        $this->add_control(
            'show_label_days',
            [
                'label'          => esc_html__( 'Show Label Days?', 'flatpack' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'yes',
                'default'        => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_days',
            [
                'label'       => esc_html__( 'Label Days', 'flatpack' ),
                'description' => esc_html__( 'Set the label for days.', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Days', 'flatpack' ),
                'default'     => 'Days',
                'condition'   => [
                    'show_label_days' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_label_hours',
            [
                'label'          => esc_html__( 'Show Label Hours?', 'flatpack' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'yes',
                'default'        => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_hours',
            [
                'label'       => esc_html__( 'Label Hours', 'flatpack' ),
                'description' => esc_html__( 'Set the label for hours.', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Hours', 'flatpack' ),
                'default'     => 'Hours',
                'condition'   => [
                    'show_label_hours' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_label_minutes',
            [
                'label'          => esc_html__( 'Show Label Minutes?', 'flatpack' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'yes',
                'default'        => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_minutes',
            [
                'label'       => esc_html__( 'Label Minutes', 'flatpack' ),
                'description' => esc_html__( 'Set the label for minutes.', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Minutes', 'flatpack' ),
                'default'     => 'Minutes',
                'condition'   => [
                    'show_label_minutes' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_label_seconds',
            [
                'label'          => esc_html__( 'Show Label Seconds?', 'flatpack' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'yes',
                'default'        => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_seconds',
            [
                'label'       => esc_html__( 'Label Seconds', 'flatpack' ),
                'description' => esc_html__( 'Set the label for seconds.', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Seconds', 'flatpack' ),
                'default'     => 'Seconds',
                'condition'   => [
                    'show_label_seconds' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Alignment', 'flatpack' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'toggle'    => false,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'show_separator',
            [
                'label'          => esc_html__( 'Show Separator?', 'flatpack' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'on',
                'default'        => '',
                'separator'      => 'before',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'separator',
            [
                'label'     => esc_html__( 'Separator', 'flatpack' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => ':',
                'condition' => [
                    'show_separator' => 'on',
                ],
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label'          => esc_html__( 'Separator Color', 'flatpack' ),
                'type'           => Controls_Manager::COLOR,
                'selectors'      => [
                    '{{WRAPPER}} .fp-countdown-item.fp-countdown-separator-on .fp-countdown-separator' => 'color: {{VALUE}}',
                ],
                'condition'      => [
                    'show_separator' => 'on',
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_responsive_control(
            'separator_font',
            [
                'label'          => esc_html__( 'Separator Font Size', 'flatpack' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'selectors'      => [
                    '{{WRAPPER}} .fp-countdown-item.fp-countdown-separator-on .fp-countdown-separator' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition'      => [
                    'show_separator' => 'on',
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'separator_position',
            [
                'label'          => esc_html__( 'Separator Position', 'flatpack' ),
                'type'           => Controls_Manager::POPOVER_TOGGLE,
                'condition'      => [
                    'show_separator' => 'on',
                ],
                'style_transfer' => true,
            ]
        );

        $this->start_popover();

        $this->add_control(
            'separator_position_top',
            [
                'label'          => esc_html__( 'Position Top', 'flatpack' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fp-countdown-item.fp-countdown-separator-on .fp-countdown-separator' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition'      => [
                    'show_separator' => 'on',
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'separator_position_right',
            [
                'label'          => esc_html__( 'Position Right', 'flatpack' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .fp-countdown-item.fp-countdown-separator-on .fp-countdown-separator' => 'right: {{SIZE || -16}}{{UNIT}};',
                ],
                'condition'      => [
                    'show_separator' => 'on',
                ],
                'style_transfer' => true,
            ]
        );

        $this->end_popover();

        $this->end_controls_section();
    }

	/**
	 * Section End Action
	 *
	 * @return void
	 */
    protected function section_end_action() {

        $this->start_controls_section(
            '_section_end_action',
            [
                'label' => esc_html__( 'Countdown End Action', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'end_action_type',
            [
                'label'       => esc_html__( 'End Action Type', 'flatpack' ),
                'label_block' => false,
                'type'        => Controls_Manager::SELECT,
                'description' => esc_html__( 'Choose which action you want to at the end of countdown.', 'flatpack' ),
                'options'     => [
                    'none'    => esc_html__( 'None', 'flatpack' ),
                    'message' => esc_html__( 'Message', 'flatpack' ),
                    'url'     => esc_html__( 'Redirection Link', 'flatpack' ),
                    'img'     => esc_html__( 'Image', 'flatpack' ),
                ],
                'default'     => 'none',
            ]
        );

        $this->add_control(
            'end_message',
            [
                'label'       => esc_html__( 'Countdown End Message', 'flatpack' ),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => esc_html__( 'Countdown End!', 'flatpack' ),
                'placeholder' => esc_html__( 'Type your message here', 'flatpack' ),
                'condition'   => [
                    'end_action_type' => 'message',
                ],
            ]
        );

        $this->add_control(
            'end_redirect_link',
            [
                'label'       => esc_html__( 'Redirection Link', 'flatpack' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://flatpack.com', 'flatpack' ),
                'condition'   => [
                    'end_action_type' => 'url',
                ],
            ]
        );

        $this->add_control(
            'end_image',
            [
                'label'     => esc_html__( 'Image', 'flatpack' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'end_action_type' => 'img',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'end_image_size',
                'default'   => 'large',
                'separator' => 'none',
                'condition' => [
                    'end_action_type' => 'img',
                ],
            ]
        );

        $this->end_controls_section();

    }

	/**
	 * Common Style
	 *
	 * @return void
	 */
    protected function common_style() {

        $this->start_controls_section(
            '_section_common_style',
            [
                'label' => esc_html__( 'Common Style', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_width',
            [
                'label'      => esc_html__( 'Box Width', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 300,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fp-countdown-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_height',
            [
                'label'      => esc_html__( 'Box Height', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 300,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .fp-countdown-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'common_box_bg',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fp-countdown-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'box_border',
                'label'     => esc_html__( 'Box Border', 'flatpack' ),
                'selector'  => '{{WRAPPER}} .fp-countdown-item',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_box_shadow',
                'label'    => esc_html__( 'Box Shadow', 'flatpack' ),
                'selector' => '{{WRAPPER}} .fp-countdown-item',
            ]
        );

        $this->add_control(
            'common_box_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'common_box_time_typography',
                'label'    => esc_html__( 'Time Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-time',
            ]
        );

        $this->add_control(
            'common_box_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'common_box_label_typography',
                'label'    => esc_html__( 'Label Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-label',
            ]
        );

        $this->add_responsive_control(
            'common_box_spacing',
            [
                'label'      => esc_html__( 'Spacing Between Box', 'flatpack' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-countdown-item' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Box Padding', 'flatpack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .fp-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	/**
	 * Days Style
	 *
	 * @return void
	 */
    protected function days_style() {

        $this->start_controls_section(
            '_section_days_style',
            [
                'label' => esc_html__( 'Days', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'days_bg',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fp-countdown-item.fp-countdown-item-days',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'days_border',
                'label'     => esc_html__( 'Box Border', 'flatpack' ),
                'selector'  => '{{WRAPPER}} .fp-countdown-item.fp-countdown-item-days',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'days_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-item-days .fp-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'days_time_typography',
                'label'    => esc_html__( 'Time Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-item-days .fp-countdown-time',
            ]
        );

        $this->add_control(
            'days_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-item-days .fp-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'days_label_typography',
                'label'    => esc_html__( 'Label Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-item-days .fp-countdown-label',
            ]
        );

        $this->end_controls_section();

    }

	/**
	 * Hours Style
	 *
	 * @return void
	 */
    protected function hours_style() {

        $this->start_controls_section(
            '_section_hours_style',
            [
                'label' => esc_html__( 'Hours', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'hours_bg',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fp-countdown-item.fp-countdown-item-hours',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'hours_border',
                'label'     => esc_html__( 'Box Border', 'flatpack' ),
                'selector'  => '{{WRAPPER}} .fp-countdown-item.fp-countdown-item-hours',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hours_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-item-hours .fp-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hours_time_typography',
                'label'    => esc_html__( 'Time Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-item-hours .fp-countdown-time',
            ]
        );

        $this->add_control(
            'hours_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-item-hours .fp-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hours_label_typography',
                'label'    => esc_html__( 'Label Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-item-hours .fp-countdown-label',
            ]
        );

        $this->end_controls_section();

    }

	/**
	 * Minutes Style
	 *
	 * @return void
	 */
    protected function minutes_style() {

        $this->start_controls_section(
            '_section_minutes_style',
            [
                'label' => esc_html__( 'Minutes', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'minutes_bg',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fp-countdown-item.fp-countdown-item-minutes',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'minutes_border',
                'label'     => esc_html__( 'Box Border', 'flatpack' ),
                'selector'  => '{{WRAPPER}} .fp-countdown-item.fp-countdown-item-minutes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'minutes_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-item-minutes .fp-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'minutes_time_typography',
                'label'    => esc_html__( 'Time Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-item-minutes .fp-countdown-time',
            ]
        );

        $this->add_control(
            'minutes_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-item-minutes .fp-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'minutes_label_typography',
                'label'    => esc_html__( 'Label Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-item-minutes .fp-countdown-label',
            ]
        );

        $this->end_controls_section();

    }

	/**
	 * Seconds Style
	 *
	 * @return void
	 */
    protected function seconds_style() {

        $this->start_controls_section(
            '_section_seconds_style',
            [
                'label' => esc_html__( 'Seconds', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'seconds_bg',
                'label'    => esc_html__( 'Background', 'flatpack' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .fp-countdown-item.fp-countdown-item-seconds',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'seconds_border',
                'label'     => esc_html__( 'Box Border', 'flatpack' ),
                'selector'  => '{{WRAPPER}} .fp-countdown-item.fp-countdown-item-seconds',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'seconds_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-item-seconds .fp-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'seconds_time_typography',
                'label'    => esc_html__( 'Time Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-item-seconds .fp-countdown-time',
            ]
        );

        $this->add_control(
            'seconds_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'flatpack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-countdown-item-seconds .fp-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'seconds_label_typography',
                'label'    => esc_html__( 'Label Typography', 'flatpack' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .fp-countdown-item-seconds .fp-countdown-label',
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
		$due_date = date("M d Y G:i:s", strtotime($settings['due_date']));
		$this->add_render_attribute('fp-countdown', 'class', 'fp-countdown');
		$this->add_render_attribute('fp-countdown', 'data-date', esc_attr($due_date));
		$this->add_render_attribute('fp-countdown', 'data-end-action', esc_attr($settings['end_action_type']));
		if ('url' === $settings['end_action_type'] && $settings['end_redirect_link']) {
			$this->add_render_attribute('fp-countdown', 'data-redirect-link', esc_url($settings['end_redirect_link']));
		}
		$this->add_render_attribute('days', 'class', 'fp-countdown-item fp-countdown-item-days');
		$this->add_render_attribute('hours', 'class', 'fp-countdown-item fp-countdown-item-hours');
		$this->add_render_attribute('minutes', 'class', 'fp-countdown-item fp-countdown-item-minutes');
		$this->add_render_attribute('seconds', 'class', 'fp-countdown-item fp-countdown-item-seconds');
		if ('on' == $settings['show_separator']) {
			$this->add_render_attribute('days', 'class', 'fp-countdown-separator-on');
			$this->add_render_attribute('hours', 'class', 'fp-countdown-separator-on');
			$this->add_render_attribute('minutes', 'class', 'fp-countdown-separator-on');
			$this->add_render_attribute('seconds', 'class', 'fp-countdown-separator-on');
		}
		?>
		<?php if ( ! empty( $due_date ) ) : ?>
			<div class="fp-countdown-wrap">
				<div <?php $this->print_render_attribute_string('fp-countdown'); ?>>
					<div <?php $this->print_render_attribute_string('days'); ?>>
						<span data-days class="fp-countdown-time fp-countdown-days">0</span>
						<?php if ('yes' == $settings['show_label_days'] && !empty($settings['label_days'])): ?>
							<span
								class="fp-countdown-label fp-countdown-label-days"><?php echo esc_html($settings['label_days']); ?></span>
						<?php endif; ?>
						<?php if ('on' == $settings['show_separator'] && !empty($settings['separator'])): ?>
							<span class="fp-countdown-separator"><?php echo esc_attr($settings['separator']); ?></span>
						<?php endif; ?>
					</div>
					<div <?php $this->print_render_attribute_string('hours'); ?>>
						<span class="fp-countdown-time fp-countdown-hours" data-hours>0</span>
						<?php if ('yes' == $settings['show_label_hours'] && !empty($settings['label_hours'])): ?>
							<span
								class="fp-countdown-label fp-countdown-label-hours"><?php echo esc_html($settings['label_hours']); ?></span>
						<?php endif; ?>
						<?php if ('on' == $settings['show_separator'] && !empty($settings['separator'])): ?>
							<span class="fp-countdown-separator"><?php echo esc_attr($settings['separator']); ?></span>
						<?php endif; ?>
					</div>
					<div <?php $this->print_render_attribute_string('minutes'); ?>>
						<span class="fp-countdown-time fp-countdown-minutes" data-minutes>0</span>
						<?php if ('yes' == $settings['show_label_minutes'] && !empty($settings['label_minutes'])): ?>
							<span
								class="fp-countdown-label fp-countdown-label-minutes"><?php echo esc_html($settings['label_minutes']); ?></span>
						<?php endif; ?>
						<?php if ('on' == $settings['show_separator'] && !empty($settings['separator'])): ?>
							<span class="fp-countdown-separator"><?php echo esc_attr($settings['separator']); ?></span>
						<?php endif; ?>
					</div>
					<div <?php $this->print_render_attribute_string('seconds'); ?>>
						<span class="fp-countdown-time fp-countdown-seconds" data-seconds>0</span>
						<?php if ('yes' == $settings['show_label_seconds'] && !empty($settings['label_seconds'])): ?>
							<span
								class="fp-countdown-label fp-countdown-label-seconds"><?php echo esc_html($settings['label_seconds']); ?></span>
						<?php endif; ?>
					</div>
					<!--End action markup-->
					<?php if ('none' != $settings['end_action_type'] && !empty($settings['end_action_type'])): ?>
						<div class="fp-countdown-end-action">
							<?php if ('message' == $settings['end_action_type'] && $settings['end_message']) :
								echo '<div class="fp-countdown-end-message">' . wpautop(wp_kses_post($settings['end_message'])) . '</div>';
							endif; ?>
							<?php if ('img' == $settings['end_action_type'] && ($settings['end_image']['url'] || $settings['end_image']['id'])) :
								$this->add_render_attribute('image', 'src', $settings['end_image']['url']);
								$this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['end_image']));
								$this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['end_image']));
								?>
								<figure class="fp-countdown-end-action-image">
									<?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'end_image_size', 'end_image'); ?>
								</figure>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif;
       
    }

    

}