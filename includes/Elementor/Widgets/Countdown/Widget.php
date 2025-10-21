<?php
/**
 * Countdown
 *
 * @package EduMentor
 */
namespace HexQode\EduMentor\Elementor\Widgets\Countdown;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Widget_Base;

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
        return 'edumentor-countdown';
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
        return esc_html__( 'Countdown', 'edumentor' );
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
        return 'edumentor-icon eicon-countdown';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'countdown', 'timer', 'coming soon', 'petfun' ];
    }

    public function get_script_depends() {
        return [ 'edumentor-countdown', 'edumentor-el-script' ];
    }

    public function get_style_depends() {
        return ['edumentor-countdown'];
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
                'label' => esc_html__( 'Set Time', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'due_date',
            [
                'label'       => esc_html__( 'Time', 'edumentor' ),
                'type'        => Controls_Manager::DATE_TIME,
                'default'     => date( "Y-m-d H:i:s", strtotime( "+10 days" ) ),
                'description' => esc_html__( 'Set the target date and time for the countdown. Defaults to 10 days from today.', 'edumentor' ),
            ]
        );

        $this->add_control(
            'demo_countdown',
            [
                'label' => esc_html__( 'Demo Countdown (60 Days)', 'textdomain' ),
                'description' => __( 'Enable this to start the countdown from today and run for 60 days automatically. Ideal for demos or templates where the timer should never expire.', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'textdomain' ),
                'label_off' => esc_html__( 'No', 'textdomain' ),
                'return_value' => 'yes',
                'default' => 'no'
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
                'label' => esc_html__( 'Settings', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'label_position',
            [
                'label'          => esc_html__( 'Label Position', 'edumentor' ),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'right'  => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'edumentor' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle'         => false,
                'default'        => 'bottom',
                'prefix_class'   => 'hq-countdown-label-',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_space',
            [
                'label'          => esc_html__( 'Label Space', 'edumentor' ),
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
                'label'          => esc_html__( 'Label Space Top', 'edumentor' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}}.hq-countdown-label-right .hq-countdown-item .hq-countdown-label' => 'top: {{SIZE || 0}}{{UNIT}};',
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
                'label'          => esc_html__( 'Label Space Left', 'edumentor' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}}.hq-countdown-label-right .hq-countdown-item .hq-countdown-label' => 'left: {{SIZE || 0}}{{UNIT}};',
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
                'label'          => esc_html__( 'Show Label Days?', 'edumentor' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'yes',
                'default'        => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_days',
            [
                'label'       => esc_html__( 'Label Days', 'edumentor' ),
                'description' => esc_html__( 'Set the label for days.', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Days', 'edumentor' ),
                'default'     => 'Days',
                'condition'   => [
                    'show_label_days' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_label_hours',
            [
                'label'          => esc_html__( 'Show Label Hours?', 'edumentor' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'yes',
                'default'        => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_hours',
            [
                'label'       => esc_html__( 'Label Hours', 'edumentor' ),
                'description' => esc_html__( 'Set the label for hours.', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Hours', 'edumentor' ),
                'default'     => 'Hours',
                'condition'   => [
                    'show_label_hours' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_label_minutes',
            [
                'label'          => esc_html__( 'Show Label Minutes?', 'edumentor' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'yes',
                'default'        => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_minutes',
            [
                'label'       => esc_html__( 'Label Minutes', 'edumentor' ),
                'description' => esc_html__( 'Set the label for minutes.', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Minutes', 'edumentor' ),
                'default'     => 'Minutes',
                'condition'   => [
                    'show_label_minutes' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_label_seconds',
            [
                'label'          => esc_html__( 'Show Label Seconds?', 'edumentor' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'yes',
                'default'        => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'label_seconds',
            [
                'label'       => esc_html__( 'Label Seconds', 'edumentor' ),
                'description' => esc_html__( 'Set the label for seconds.', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Seconds', 'edumentor' ),
                'default'     => 'Seconds',
                'condition'   => [
                    'show_label_seconds' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Alignment', 'edumentor' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'edumentor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'edumentor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'toggle'    => false,
                'default' => 'left',
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right' => 'justify-content: flex-end'
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown' => '{{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'show_separator',
            [
                'label'          => esc_html__( 'Show Separator?', 'edumentor' ),
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
                'label'     => esc_html__( 'Separator', 'edumentor' ),
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
                'label'          => esc_html__( 'Separator Color', 'edumentor' ),
                'type'           => Controls_Manager::COLOR,
                'selectors'      => [
                    '{{WRAPPER}} .hq-countdown-item.hq-countdown-separator-on .hq-countdown-separator' => 'color: {{VALUE}}',
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
                'label'          => esc_html__( 'Separator Font Size', 'edumentor' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'selectors'      => [
                    '{{WRAPPER}} .hq-countdown-item.hq-countdown-separator-on .hq-countdown-separator' => 'font-size: {{SIZE}}{{UNIT}};',
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
                'label'          => esc_html__( 'Separator Position', 'edumentor' ),
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
                'label'          => esc_html__( 'Position Top', 'edumentor' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .hq-countdown-item.hq-countdown-separator-on .hq-countdown-separator' => 'top: {{SIZE}}{{UNIT}};',
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
                'label'          => esc_html__( 'Position Right', 'edumentor' ),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .hq-countdown-item.hq-countdown-separator-on .hq-countdown-separator' => 'right: {{SIZE || -16}}{{UNIT}};',
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
                'label' => esc_html__( 'Countdown End Action', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'end_action_type',
            [
                'label'       => esc_html__( 'End Action Type', 'edumentor' ),
                'label_block' => false,
                'type'        => Controls_Manager::SELECT,
                'description' => esc_html__( 'Choose which action you want to at the end of countdown.', 'edumentor' ),
                'options'     => [
                    'none'    => esc_html__( 'None', 'edumentor' ),
                    'message' => esc_html__( 'Message', 'edumentor' ),
                    'url'     => esc_html__( 'Redirection Link', 'edumentor' ),
                    'img'     => esc_html__( 'Image', 'edumentor' ),
                ],
                'default'     => 'none',
            ]
        );

        $this->add_control(
            'end_message',
            [
                'label'       => esc_html__( 'Countdown End Message', 'edumentor' ),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => esc_html__( 'Countdown End!', 'edumentor' ),
                'placeholder' => esc_html__( 'Type your message here', 'edumentor' ),
                'condition'   => [
                    'end_action_type' => 'message',
                ],
            ]
        );

        $this->add_control(
            'end_redirect_link',
            [
                'label'       => esc_html__( 'Redirection Link', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://dynamiclayers.net/', 'edumentor' ),
                'condition'   => [
                    'end_action_type' => 'url',
                ],
            ]
        );

        $this->add_control(
            'end_image',
            [
                'label'     => esc_html__( 'Image', 'edumentor' ),
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
                'label' => esc_html__( 'Common Style', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_width',
            [
                'label'      => esc_html__( 'Box Width', 'edumentor' ),
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
                    '{{WRAPPER}} .hq-countdown-item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_height',
            [
                'label'      => esc_html__( 'Box Height', 'edumentor' ),
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
                    '{{WRAPPER}} .hq-countdown-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'common_box_bg',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-countdown-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'box_border',
                'label'     => esc_html__( 'Box Border', 'edumentor' ),
                'selector'  => '{{WRAPPER}} .hq-countdown-item',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_box_shadow',
                'label'    => esc_html__( 'Box Shadow', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-countdown-item',
            ]
        );

        $this->add_control(
            'common_box_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'common_box_time_typography',
                'label'    => esc_html__( 'Time Typography', 'edumentor' ),
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-time',
            ]
        );

        $this->add_control(
            'common_box_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'common_box_label_typography',
                'label'    => esc_html__( 'Label Typography', 'edumentor' ),
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-label',
            ]
        );

        $this->add_responsive_control(
            'common_box_spacing',
            [
                'label'      => esc_html__( 'Spacing Between Box', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-countdown' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Box Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label' => esc_html__( 'Days', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'days_bg',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-countdown-item.hq-countdown-item-days',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'days_border',
                'label'     => esc_html__( 'Box Border', 'edumentor' ),
                'selector'  => '{{WRAPPER}} .hq-countdown-item.hq-countdown-item-days',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'days_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-item-days .hq-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'days_time_typography',
                'label'    => esc_html__( 'Time Typography', 'edumentor' ),
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-item-days .hq-countdown-time',
            ]
        );

        $this->add_control(
            'days_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-item-days .hq-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'days_label_typography',
                'label'    => esc_html__( 'Label Typography', 'edumentor' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-item-days .hq-countdown-label',
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
                'label' => esc_html__( 'Hours', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'hours_bg',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-countdown-item.hq-countdown-item-hours',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'hours_border',
                'label'     => esc_html__( 'Box Border', 'edumentor' ),
                'selector'  => '{{WRAPPER}} .hq-countdown-item.hq-countdown-item-hours',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hours_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-item-hours .hq-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hours_time_typography',
                'label'    => esc_html__( 'Time Typography', 'edumentor' ),
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-item-hours .hq-countdown-time',
            ]
        );

        $this->add_control(
            'hours_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-item-hours .hq-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hours_label_typography',
                'label'    => esc_html__( 'Label Typography', 'edumentor' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-item-hours .hq-countdown-label',
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
                'label' => esc_html__( 'Minutes', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'minutes_bg',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-countdown-item.hq-countdown-item-minutes',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'minutes_border',
                'label'     => esc_html__( 'Box Border', 'edumentor' ),
                'selector'  => '{{WRAPPER}} .hq-countdown-item.hq-countdown-item-minutes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'minutes_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-item-minutes .hq-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'minutes_time_typography',
                'label'    => esc_html__( 'Time Typography', 'edumentor' ),
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-item-minutes .hq-countdown-time',
            ]
        );

        $this->add_control(
            'minutes_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-item-minutes .hq-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'minutes_label_typography',
                'label'    => esc_html__( 'Label Typography', 'edumentor' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-item-minutes .hq-countdown-label',
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
                'label' => esc_html__( 'Seconds', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'seconds_bg',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-countdown-item.hq-countdown-item-seconds',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'seconds_border',
                'label'     => esc_html__( 'Box Border', 'edumentor' ),
                'selector'  => '{{WRAPPER}} .hq-countdown-item.hq-countdown-item-seconds',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'seconds_time_color',
            [
                'label'     => esc_html__( 'Time Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-item-seconds .hq-countdown-time' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'seconds_time_typography',
                'label'    => esc_html__( 'Time Typography', 'edumentor' ),
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-item-seconds .hq-countdown-time',
            ]
        );

        $this->add_control(
            'seconds_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-countdown-item-seconds .hq-countdown-label' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'seconds_label_typography',
                'label'    => esc_html__( 'Label Typography', 'edumentor' ),
                'exclude'  => [
                    'line_height',
                ],
                'default'  => [
                    'font_size' => [''],
                ],
                'selector' => '{{WRAPPER}} .hq-countdown-item-seconds .hq-countdown-label',
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
		// Normal due date from widget settings
        $due_date = !empty( $settings['due_date'] ) ? date( "M d Y G:i:s", strtotime( $settings['due_date'] ) ) : null;

        // Check if demo mode is enabled
        if ( isset( $settings['demo_countdown'] ) && $settings['demo_countdown'] === 'yes' ) {
            $due_date = date( "M d Y G:i:s", strtotime( '+60 days' ) );
        }

		$this->add_render_attribute('hq-countdown', 'class', 'hq-countdown');
		$this->add_render_attribute('hq-countdown', 'data-date', esc_attr($due_date));
		$this->add_render_attribute('hq-countdown', 'data-end-action', esc_attr($settings['end_action_type']));
		if ('url' === $settings['end_action_type'] && $settings['end_redirect_link']) {
			$this->add_render_attribute('hq-countdown', 'data-redirect-link', esc_url($settings['end_redirect_link']));
		}
		$this->add_render_attribute('days', 'class', 'hq-countdown-item hq-countdown-item-days');
		$this->add_render_attribute('hours', 'class', 'hq-countdown-item hq-countdown-item-hours');
		$this->add_render_attribute('minutes', 'class', 'hq-countdown-item hq-countdown-item-minutes');
		$this->add_render_attribute('seconds', 'class', 'hq-countdown-item hq-countdown-item-seconds');
		if ('on' == $settings['show_separator']) {
			$this->add_render_attribute('days', 'class', 'hq-countdown-separator-on');
			$this->add_render_attribute('hours', 'class', 'hq-countdown-separator-on');
			$this->add_render_attribute('minutes', 'class', 'hq-countdown-separator-on');
			$this->add_render_attribute('seconds', 'class', 'hq-countdown-separator-on');
		}
		?>
		<?php if ( ! empty( $due_date ) ) : ?>
			<div class="hq-countdown-wrap">
				<div <?php $this->print_render_attribute_string('hq-countdown'); ?>>
					<div <?php $this->print_render_attribute_string('days'); ?>>
						<span data-days class="hq-countdown-time hq-countdown-days">0</span>
						<?php if ('yes' == $settings['show_label_days'] && !empty($settings['label_days'])): ?>
							<span
								class="hq-countdown-label hq-countdown-label-days"><?php echo esc_html($settings['label_days']); ?></span>
						<?php endif; ?>
						<?php if ('on' == $settings['show_separator'] && !empty($settings['separator'])): ?>
							<span class="hq-countdown-separator"><?php echo esc_attr($settings['separator']); ?></span>
						<?php endif; ?>
					</div>
					<div <?php $this->print_render_attribute_string('hours'); ?>>
						<span class="hq-countdown-time hq-countdown-hours" data-hours>0</span>
						<?php if ('yes' == $settings['show_label_hours'] && !empty($settings['label_hours'])): ?>
							<span
								class="hq-countdown-label hq-countdown-label-hours"><?php echo esc_html($settings['label_hours']); ?></span>
						<?php endif; ?>
						<?php if ('on' == $settings['show_separator'] && !empty($settings['separator'])): ?>
							<span class="hq-countdown-separator"><?php echo esc_attr($settings['separator']); ?></span>
						<?php endif; ?>
					</div>
					<div <?php $this->print_render_attribute_string('minutes'); ?>>
						<span class="hq-countdown-time hq-countdown-minutes" data-minutes>0</span>
						<?php if ('yes' == $settings['show_label_minutes'] && !empty($settings['label_minutes'])): ?>
							<span
								class="hq-countdown-label hq-countdown-label-minutes"><?php echo esc_html($settings['label_minutes']); ?></span>
						<?php endif; ?>
						<?php if ('on' == $settings['show_separator'] && !empty($settings['separator'])): ?>
							<span class="hq-countdown-separator"><?php echo esc_attr($settings['separator']); ?></span>
						<?php endif; ?>
					</div>
					<div <?php $this->print_render_attribute_string('seconds'); ?>>
						<span class="hq-countdown-time hq-countdown-seconds" data-seconds>0</span>
						<?php if ('yes' == $settings['show_label_seconds'] && !empty($settings['label_seconds'])): ?>
							<span
								class="hq-countdown-label hq-countdown-label-seconds"><?php echo esc_html($settings['label_seconds']); ?></span>
						<?php endif; ?>
					</div>
					<!--End action markup-->
					<?php if ('none' != $settings['end_action_type'] && !empty($settings['end_action_type'])): ?>
						<div class="hq-countdown-end-action">
							<?php if ('message' == $settings['end_action_type'] && $settings['end_message']) :
								echo '<div class="hq-countdown-end-message">' . wpautop(wp_kses_post($settings['end_message'])) . '</div>';
							endif; ?>
							<?php if ('img' == $settings['end_action_type'] && ($settings['end_image']['url'] || $settings['end_image']['id'])) :
								$this->add_render_attribute('image', 'src', $settings['end_image']['url']);
								$this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['end_image']));
								$this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['end_image']));
								?>
								<figure class="hq-countdown-end-action-image">
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