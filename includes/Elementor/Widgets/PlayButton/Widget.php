<?php
/**
 * Play Button
 *
 * @package EduMentor
 */
namespace HexQode\EduMentor\Elementor\Widgets\PlayButton;

use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Embed;
use Elementor\Widget_Base;

use HexQode\EduMentor\Traits\CommonTemplates;

defined( 'ABSPATH' ) || die();

class Widget extends Widget_Base {

    use CommonTemplates;

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'edumentor-play-button';
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
        return esc_html__( 'Play Button', 'edumentor' );
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
        return 'edumentor-icon eicon-play-o';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return ['play button', 'play', 'video', 'button', 'edumentor'];
    }

    public function get_style_depends() {
        return ['edumentor-video-elements'];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_video();
        $this->section_button_style();
        $this->play_button_style();
        $this->lightbox_style();

    }

    /**
     * Section Video
     *
     * @return void
     */
    protected function section_video() {

        $this->start_controls_section(
            'video_box',
            [
                'label' => esc_html__( 'Video', 'edumentor' ),
            ]
        );

        $this->add_control(
            'link_type',
            [
                'label'   => esc_html__( 'Link Type', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'lightbox',
                'options' => [
                    'lightbox'    => esc_html__( 'Lightbox', 'edumentor' ),
                    'custom_link' => esc_html__( 'Custom Link', 'edumentor' ),
                ],
            ]
        );

        $this->add_control(
            'custom_link',
            [
                'label'         => esc_html__( 'Custom Link', 'edumentor' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'edumentor' ),
                'show_external' => true,
                'default'       => [
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => true,
                ],
                'condition'     => [
                    'link_type' => 'custom_link',
                ],
            ]
        );

        $this->add_control(
            'video_type',
            [
                'label'     => esc_html__( 'Source', 'edumentor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'youtube',
                'options'   => [
                    'youtube'     => esc_html__( 'YouTube', 'edumentor' ),
                    'vimeo'       => esc_html__( 'Vimeo', 'edumentor' ),
                    'dailymotion' => esc_html__( 'Dailymotion', 'edumentor' ),
                ],
                'condition' => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'youtube_url',
            [
                'label'       => esc_html__( 'Link', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active'     => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'placeholder' => esc_html__( 'Enter your URL', 'edumentor' ) . ' (YouTube)',
                'default'     => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
                'label_block' => true,
                'condition'   => [
                    'link_type'  => 'lightbox',
                    'video_type' => 'youtube',
                ],
            ]
        );

        $this->add_control(
            'vimeo_url',
            [
                'label'       => esc_html__( 'Link', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active'     => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'placeholder' => esc_html__( 'Enter your URL', 'edumentor' ) . ' (Vimeo)',
                'default'     => 'https://vimeo.com/235215203',
                'label_block' => true,
                'condition'   => [
                    'link_type'  => 'lightbox',
                    'video_type' => 'vimeo',
                ],
            ]
        );

        $this->add_control(
            'dailymotion_url',
            [
                'label'       => esc_html__( 'Link', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active'     => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'placeholder' => esc_html__( 'Enter your URL', 'edumentor' ) . ' (Dailymotion)',
                'default'     => 'https://www.dailymotion.com/video/x6tqhqb',
                'label_block' => true,
                'condition'   => [
                    'link_type'  => 'lightbox',
                    'video_type' => 'dailymotion',
                ],
            ]
        );

        $this->add_control(
            'start',
            [
                'label'       => esc_html__( 'Start Time', 'edumentor' ),
                'type'        => Controls_Manager::NUMBER,
                'description' => esc_html__( 'Specify a start time (in seconds)', 'edumentor' ),
                'condition'   => [
                    'loop' => '',
                ],
            ]
        );

        $this->add_control(
            'end',
            [
                'label'       => esc_html__( 'End Time', 'edumentor' ),
                'type'        => Controls_Manager::NUMBER,
                'description' => esc_html__( 'Specify an end time (in seconds)', 'edumentor' ),
                'condition'   => [
                    'link_type'  => 'lightbox',
                    'loop'       => '',
                    'video_type' => ['youtube', 'hosted'],
                ],
            ]
        );

        $this->add_control(
            'video_options',
            [
                'label'     => esc_html__( 'Video Options', 'edumentor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'     => esc_html__( 'Autoplay', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'play_on_mobile',
            [
                'label'     => esc_html__( 'Play On Mobile', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'link_type' => 'lightbox',
                    'autoplay'  => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mute',
            [
                'label'     => esc_html__( 'Mute', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'     => esc_html__( 'Loop', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'link_type'   => 'lightbox',
                    'video_type!' => 'dailymotion',
                ],
            ]
        );

        $this->add_control(
            'aspect_ratio',
            [
                'label'              => esc_html__( 'Aspect Ratio', 'edumentor' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    '169' => '16:9',
                    '219' => '21:9',
                    '43'  => '4:3',
                    '32'  => '3:2',
                    '11'  => '1:1',
                    '916' => '9:16',
                ],
                'default'            => '169',
                'prefix_class'       => 'elementor-aspect-ratio-',
                'frontend_available' => true,
                'condition'          => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'controls',
            [
                'label'     => esc_html__( 'Player Controls', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'edumentor' ),
                'label_on'  => esc_html__( 'Show', 'edumentor' ),
                'default'   => 'yes',
                'condition' => [
                    'link_type'   => 'lightbox',
                    'video_type!' => 'vimeo',
                ],
            ]
        );

        $this->add_control(
            'showinfo',
            [
                'label'     => esc_html__( 'Video Info', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'edumentor' ),
                'label_on'  => esc_html__( 'Show', 'edumentor' ),
                'default'   => 'yes',
                'condition' => [
                    'link_type'  => 'lightbox',
                    'video_type' => ['dailymotion'],
                ],
            ]
        );

        $this->add_control(
            'modestbranding',
            [
                'label'     => esc_html__( 'Modest Branding', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'link_type'  => 'lightbox',
                    'video_type' => ['youtube'],
                    'controls'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'logo',
            [
                'label'     => esc_html__( 'Logo', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'edumentor' ),
                'label_on'  => esc_html__( 'Show', 'edumentor' ),
                'default'   => 'yes',
                'condition' => [
                    'link_type'  => 'lightbox',
                    'video_type' => ['dailymotion'],
                ],
            ]
        );

        // YouTube.
        $this->add_control(
            'yt_privacy',
            [
                'label'       => esc_html__( 'Privacy Mode', 'edumentor' ),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'When you turn on privacy mode, YouTube won\'t store information about visitors on your website unless they play the video.', 'edumentor' ),
                'condition'   => [
                    'link_type'  => 'lightbox',
                    'video_type' => 'youtube',
                ],
            ]
        );

        $this->add_control(
            'rel',
            [
                'label'     => esc_html__( 'Suggested Videos', 'edumentor' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''    => esc_html__( 'Current Video Channel', 'edumentor' ),
                    'yes' => esc_html__( 'Any Video', 'edumentor' ),
                ],
                'condition' => [
                    'link_type'  => 'lightbox',
                    'video_type' => 'youtube',
                ],
            ]
        );

        // Vimeo.
        $this->add_control(
            'vimeo_title',
            [
                'label'     => esc_html__( 'Intro Title', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'edumentor' ),
                'label_on'  => esc_html__( 'Show', 'edumentor' ),
                'default'   => 'yes',
                'condition' => [
                    'link_type'  => 'lightbox',
                    'video_type' => 'vimeo',
                ],
            ]
        );

        $this->add_control(
            'vimeo_portrait',
            [
                'label'     => esc_html__( 'Intro Portrait', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'edumentor' ),
                'label_on'  => esc_html__( 'Show', 'edumentor' ),
                'default'   => 'yes',
                'condition' => [
                    'link_type'  => 'lightbox',
                    'video_type' => 'vimeo',
                ],
            ]
        );

        $this->add_control(
            'vimeo_byline',
            [
                'label'     => esc_html__( 'Intro Byline', 'edumentor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'edumentor' ),
                'label_on'  => esc_html__( 'Show', 'edumentor' ),
                'default'   => 'yes',
                'condition' => [
                    'link_type'  => 'lightbox',
                    'video_type' => 'vimeo',
                ],
            ]
        );

        $this->add_control(
            'color',
            [
                'label'     => esc_html__( 'Controls Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'link_type'  => 'lightbox',
                    'video_type' => ['vimeo', 'dailymotion'],
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Section Button Style
     *
     * @return void
     */
    protected function section_button_style() {

        $this->start_controls_section(
            'video_box_play_icon',
            [
                'label' => esc_html__( 'Play Button', 'edumentor' ),
            ]
        );

        $this->add_control(
            'video_box_play_btn_style',
            [
                'label'   => esc_html__( 'Play Button', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style1' => esc_html__( 'Style 1', 'edumentor' ),
                    'style2' => esc_html__( 'Style 2', 'edumentor' ),
                ],
                'default' => 'style1',
            ]
        );

        $this->add_control(
            'play_icon',
            [
                'label' => esc_html__( 'Icon', 'edumentor' ),
                'type' => Controls_Manager::ICONS,
                'recommended' => [
					'fa-solid' => [
						'play',
						'play-circle',
                    ],
                    'fa-regular' => [
						'play-circle'
					]
				],
            ]
        );

        $this->add_control(
            'ripple_color',
            [
                'label' => esc_html__( 'Ripple Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'alpha' => false,
                'selectors' => [
                    '{{WRAPPER}} .hq-play-btn' => '--edumentor-play-btn-ripple-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-play-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label'                => esc_html__( 'Alignment', 'edumentor' ),
                'type'                 => Controls_Manager::CHOOSE,
                'options'              => [
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
                'default'              => 'center',
                'toggle'               => false,
                'selectors_dictionary' => [
                    'left'   => 'margin: 0;',
                    'center' => 'margin: 0 auto;',
                    'right'  => 'margin-left: auto',
                ],
                'selectors'            => [
                    '{{WRAPPER}} .hq-play-btn' => '{{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_box_play_btn_style1_width',
            [
                'label'      => esc_html__( 'Width / Height', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-vb-2' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hq-vb-2 .ripple, {{WRAPPER}} .hq-vb-2 .ripple:before, {{WRAPPER}} .hq-vb-2 .ripple:after' => 'width: calc({{SIZE}}{{UNIT}} - 2px); height: calc({{SIZE}}{{UNIT}} - 2px);',
                ],
                'condition'  => [
                    'video_box_play_btn_style' => 'style1',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_box_play_btn_style1_icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 80,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-vb-2 svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'video_box_play_btn_style' => 'style1',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_box_play_btn_style2_width',
            [
                'label'      => esc_html__( 'Width / Height', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-vb-3' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'video_box_play_btn_style' => 'style2',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_box_play_btn_style2_icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 15,
                        'max'  => 80,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-vb-3 svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'video_box_play_btn_style' => 'style2',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_box_play_btn_style2_icon_pos_x',
            [
                'label'     => esc_html__( 'Icon Position X', 'edumentor' ),
                'type'      => Controls_Manager::NUMBER,
                'step'      => 1,
                'default'   => 0,
                'selectors' => [
                    '{{WRAPPER}} .hq-vb-3 svg' => 'margin-left: {{VALUE}}px;',
                ],
                'condition' => [
                    'video_box_play_btn_style' => 'style2',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_box_play_btn_style2_icon_pos_y',
            [
                'label'     => esc_html__( 'Icon Position Y', 'edumentor' ),
                'type'      => Controls_Manager::NUMBER,
                'step'      => 1,
                'default'   => 0,
                'selectors' => [
                    '{{WRAPPER}} .hq-vb-3 svg' => 'margin-bottom: {{VALUE}}px;',
                ],
                'condition' => [
                    'video_box_play_btn_style' => 'style2',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Play Button Style
     *
     * @return void
     */
    protected function play_button_style() {

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Play Button', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tab_box_style' );

        $this->start_controls_tab(
            'tab_box_normal',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        // Start play button 1 style
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'pbtn_style_1_bg_color',
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'types'     => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector'  => '{{WRAPPER}} .hq-vb-2',
                'condition' => [
                    'video_box_play_btn_style' => 'style1',
                ],
            ]
        );

        $this->add_control(
            'pbtn_style_1_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-vb-2' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'video_box_play_btn_style' => 'style1',
                ],
            ]
        );
        // End play button 1 style

        // Start play button 2 style
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'pbtn_style_2_bg_color',
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'types'     => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector'  => '{{WRAPPER}} .hq-vb-3',
                'condition' => [
                    'video_box_play_btn_style' => 'style2',
                ],
            ]
        );

        $this->add_control(
            'pbtn_style_2_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-vb-3 svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'video_box_play_btn_style' => 'style2',
                ],
            ]
        );
        // End play button 2 style

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_box_hover',
            [
                'label' => esc_html__( 'Hover', 'edumentor' ),
            ]
        );

        // Start play button 1 hover style
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'pbtn_style_1_bg_hover_color',
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'types'     => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector'  => '{{WRAPPER}} .hq-vb-2:hover',
                'condition' => [
                    'video_box_play_btn_style' => 'style1',
                ],
            ]
        );

        $this->add_control(
            'pbtn_style_1_icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-vb-2:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'video_box_play_btn_style' => 'style1',
                ],
            ]
        );
        // End play button 1 hover style

        // Start play button 2 hover style
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'pbtn_style_2_bg_hover_color',
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'types'     => ['classic', 'gradient'],
                'exclude'   => ['image'],
                'selector'  => '{{WRAPPER}} .hq-vb-3:hover',
                'condition' => [
                    'video_box_play_btn_style' => 'style2',
                ],
            ]
        );

        $this->add_control(
            'pbtn_style_2_icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-vb-3:hover svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'video_box_play_btn_style' => 'style2',
                ],
            ]
        );
        // End play button 2 hover style

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
     * Lightbox Style
     *
     * @return void
     */
    protected function lightbox_style() {

        $this->start_controls_section(
            'section_lightbox_style',
            [
                'label'     => esc_html__( 'Lightbox', 'edumentor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'lightbox_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '#elementor-lightbox-{{ID}}' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'lightbox_ui_color',
            [
                'label'     => esc_html__( 'UI Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '#elementor-lightbox-{{ID}} .dialog-lightbox-close-button' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'lightbox_ui_color_hover',
            [
                'label'     => esc_html__( 'UI Hover Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '#elementor-lightbox-{{ID}} .dialog-lightbox-close-button:hover' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
                'condition' => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'lightbox_video_width',
            [
                'label'     => esc_html__( 'Content Width', 'edumentor' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'unit' => '%',
                ],
                'range'     => [
                    '%' => [
                        'min' => 30,
                    ],
                ],
                'selectors' => [
                    '(desktop+)#elementor-lightbox-{{ID}} .elementor-video-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_control(
            'lightbox_content_position',
            [
                'label'                => esc_html__( 'Content Position', 'edumentor' ),
                'type'                 => Controls_Manager::SELECT,
                'frontend_available'   => true,
                'options'              => [
                    ''    => esc_html__( 'Center', 'edumentor' ),
                    'top' => esc_html__( 'Top', 'edumentor' ),
                ],
                'selectors'            => [
                    '#elementor-lightbox-{{ID}} .elementor-video-container' => '{{VALUE}}; transform: translateX(-50%);',
                ],
                'selectors_dictionary' => [
                    'top' => 'top: 60px',
                ],
                'condition'            => [
                    'link_type' => 'lightbox',
                ],
            ]
        );

        $this->add_responsive_control(
            'lightbox_content_animation',
            [
                'label'              => esc_html__( 'Entrance Animation', 'edumentor' ),
                'type'               => Controls_Manager::ANIMATION,
                'frontend_available' => true,
                'condition'          => [
                    'link_type' => 'lightbox',
                ],
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

        $custtom_url = ! empty( $settings['custom_link']['url'] ) ? $settings['custom_link']['url'] : '';
		$play_btn_style = $settings['video_box_play_btn_style'];
		
		$target = ! empty( $settings['custom_link']['is_external'] ) ? ' target="_blank"' : '';
		$nofollow = ! empty( $settings['custom_link']['nofollow'] ) ? ' rel="nofollow"' : '';
        $play_icon = $settings['play_icon'];

		$this->add_render_attribute( 'wrapper', 'class', 'hq-video-box-wrap' );
		if( 'lightbox' === $settings['link_type'] ) {
			$video_url = $settings[ $settings['video_type'] . '_url' ];
			$lightbox_url = '';
			$embed_params = $this->get_embed_params();
			$embed_options = $this->get_embed_options();
			if ( 'hosted' === $settings['video_type'] ) {
				$lightbox_url = $video_url;
			} else {
				$lightbox_url = Embed::get_embed_url( $video_url, $embed_params, $embed_options );
			}
			$lightbox_options = [
				'type' => 'video',
				'videoType' => $settings['video_type'],
				'url' => $lightbox_url,
				'modalOptions' => [
					'id' => 'elementor-lightbox-' . $this->get_id(),
					'entranceAnimation' => $settings['lightbox_content_animation'],
					'entranceAnimation_tablet' => $settings['lightbox_content_animation_tablet'],
					'entranceAnimation_mobile' => $settings['lightbox_content_animation_mobile'],
					'videoAspectRatio' => $settings['aspect_ratio'],
				],
			];
			$this->add_render_attribute( 'video-link', [
				'data-elementor-open-lightbox' => 'yes',
				'class' => 'el-lightbox',
				'data-elementor-lightbox' => wp_json_encode( $lightbox_options ),
			] );
		}
        
        ?>
		<?php if( 'custom_link' === $settings['link_type'] ) : ?>
			<a href="<?php echo esc_url( $custtom_url ); ?>" <?php echo esc_attr( $target ) . ' ' . esc_attr( $nofollow ); ?>>
		<?php else : ?>
			<div <?php echo $this->get_render_attribute_string( 'video-link' ); ?>>
		<?php endif; ?>
			<?php if( 'style1' === $play_btn_style ) : ?>
				<div class="hq-vb-2 hq-play-btn">
                    <?php if( ! empty( $play_icon['value'] ) ) : ?>
                        <?php Icons_Manager::render_icon( $play_icon, [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else: ?>
                        <svg aria-hidden="true" fill="currentColor" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
					<?php endif; ?>
                    <div class="ripple"></div>
				</div>
			<?php elseif( 'style2' === $play_btn_style ) : ?>
				<div class="hq-vb-3 hq-play-btn">
                    <?php if( ! empty( $play_icon['value'] ) ) : ?>
                        <?php Icons_Manager::render_icon( $play_icon, [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else: ?>
					<svg enable-background="new 0 0 41.999 41.999" version="1.1" width="12" viewBox="0 0 41.999 41.999" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
						<path d="M36.068,20.176l-29-20C6.761-0.035,6.363-0.057,6.035,0.114C5.706,0.287,5.5,0.627,5.5,0.999v40  c0,0.372,0.206,0.713,0.535,0.886c0.146,0.076,0.306,0.114,0.465,0.114c0.199,0,0.397-0.06,0.568-0.177l29-20  c0.271-0.187,0.432-0.494,0.432-0.823S36.338,20.363,36.068,20.176z M7.5,39.095V2.904l26.239,18.096L7.5,39.095z"/>
					</svg>
                    <?php endif; ?>
				</div>
			<?php endif; ?>
		<?php if( 'custom_link' === $settings['link_type'] ) : ?>
			</a>
		<?php else: ?>
			</div>
		<?php endif; ?>
        <?php

    }

    

}