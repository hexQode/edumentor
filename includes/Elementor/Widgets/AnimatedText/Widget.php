<?php
/**
 * Animated Text
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\AnimatedText;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
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
        return 'edumentor-animated-text';
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
        return esc_html__( 'Animated Text', 'edumentor' );
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
        return 'edumentor-icon eicon-animated-headline';
    }

    protected function get_html_wrapper_class() {
        return parent::get_html_wrapper_class() . ' edumentor-wow';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'heading', 'title', 'text','animated', 'text animation', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'edumentor-main', 'edumentor-keyframes', 'edumentor-animated-text' ];
    }

    public function get_script_depends() {
        return [ 'edumentor-el-script', 'wow', 'edumentor-animated-text' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->heading_section();
        $this->text_animation_section();
        $this->animation_section();
        $this->heading_style();
        $this->animated_text_style();
        
    }

    /**
     * Layout Section
     *
     * @return void
     */
    protected function heading_section() {

        $this->start_controls_section(
			'heading_section',
			[
				'label' => esc_html__( 'Heading', 'edumentor' )
			]
        );

        $this->add_control(
            'heading',
            [
                'label'        => esc_html__( 'Text Before', 'edumentor' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 5,
                'default'      => esc_html__( 'EduMentor Text is', 'edumentor' ),
                'placeholder'  => esc_html__( 'Text goes here...', 'edumentor' ),
                'description'  => esc_html__( 'Use this {Text} format to highlight the text.', 'edumentor' ),
            ]
        );

        $this->add_control(
            'heading_after',
            [
                'label'        => esc_html__( 'Text After', 'edumentor' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 5,
                'default'      => esc_html__( '', 'edumentor' ),
                'placeholder'  => esc_html__( 'Text goes here...', 'edumentor' ),
                'description'  => esc_html__( 'Use this {Text} format to highlight the text.', 'edumentor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text', [
                'label'   => esc_html__( 'Text', 'edumentor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Awesome', 'edumentor' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'text_customize',
            [
                'label'          => esc_html__( 'Want To Customize Text?', 'edumentor' ),
                'type'           => Controls_Manager::SWITCHER,
                'label_on'       => esc_html__( 'Yes', 'edumentor' ),
                'label_off'      => esc_html__( 'No', 'edumentor' ),
                'return_value'   => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'text_typography',
                'label'          => esc_html__( 'Typography', 'edumentor' ),
                'exclude'        => [
                    'font_size',
                    'line_height',
                ],
                'selector'       => '{{WRAPPER}} .hq-heading .dl-animated-text > {{CURRENT_ITEM}}, {{WRAPPER}} .hq-heading .dl-animated-text > {{CURRENT_ITEM}} i, {{WRAPPER}} .hq-heading .dl-animated-text > {{CURRENT_ITEM}} em',
                'condition'      => [
                    'text_customize' => 'yes',
                ],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'text_color',
            [
                'label'          => esc_html__( 'Color', 'edumentor' ),
                'type'           => Controls_Manager::COLOR,
                'selectors'      => [
                    '{{WRAPPER}} .hq-heading .dl-animated-text > {{CURRENT_ITEM}} '     => 'color: {{VALUE}}; -webkit-background-clip: initial; -webkit-text-fill-color:initial; background: none;',
                    '{{WRAPPER}} .hq-heading .dl-animated-text > {{CURRENT_ITEM}} i'    => 'color: {{VALUE}}; -webkit-background-clip: initial; -webkit-text-fill-color:initial; background: none;',
                    '{{WRAPPER}} .hq-heading .dl-animated-text > {{CURRENT_ITEM}} i em' => 'color: {{VALUE}}; -webkit-background-clip: initial; -webkit-text-fill-color:initial; background: none;',
                ],
                'condition'      => [
                    'text_customize' => 'yes',
                ],
                'style_transfer' => true,
            ]
        );

        $repeater->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'           => 'text_shadow',
                'label'          => esc_html__( 'Text Shadow', 'edumentor' ),
                'selector'       => '{{WRAPPER}} .dl-animated-text > {{CURRENT_ITEM}}',
                'condition'      => [
                    'text_customize' => 'yes',
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'animated_text',
            [
                'label'       => esc_html__( 'Animated Text', 'edumentor' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'text' => esc_html__( 'Awesome', 'edumentor' ),
                    ],
                    [
                        'text' => esc_html__( 'Cool', 'edumentor' ),
                    ],
                    [
                        'text' => esc_html__( 'Nice', 'edumentor' ),
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
			'show_background_text',
			[
				'label' => esc_html__( 'Background Text', 'edumentor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'edumentor' ),
				'label_off' => esc_html__( 'Hide', 'edumentor' ),
				'return_value' => 'yes',
				'default' => 'no',
                'style_transfer' => true,
                'condition' => [
                    'heading!' => ''
                ]
			]
		);

		$this->add_control(
			'background_text',
			[
				'label' => esc_html__( 'Text', 'edumentor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Background', 'edumentor' ),
				'placeholder' => esc_html__( 'Background Text', 'edumentor' ),
				'condition' => [
                    'heading!' => '',
					'show_background_text' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

        $this->add_control(
            'tag',
            [
                'label' => esc_html__( 'HTML Tag', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'h2',
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'edumentor' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'edumentor' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'edumentor' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'edumentor' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'edumentor' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'edumentor' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'toggle' => false,
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_align',
            [
                'label' => esc_html__( 'Alignment', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'edumentor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'edumentor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'left',
                'prefix_class' => 'align-',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}.hq-layout-inline' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .hq-heading' => 'text-align: {{VALUE}}'

                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_layout',
            [
                'label' => esc_html__( 'Layout', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inline' => [
                        'title' => esc_html__( 'Inline', 'edumentor' ),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'edumentor' ),
                        'icon' => 'eicon-menu-bar',
                    ]
                ],
                'toggle' => false,
                'selectors_dictionary' => [
                    'inline' => 'display: inline-block',
                    'block' => 'display: block',
                ],
                'default' => 'block',
                'prefix_class' => 'hq-layout-',
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => '{{VALUE}}'
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Text Animation Section
     *
     * @return void
     */
    protected function text_animation_section() {

        // Animation Settings
        $this->start_controls_section(
            'section_animation_settings',
            [
                'label'      => esc_html__( 'Text Animation Settings', 'edumentor' ),
                'tab'        => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label'          => esc_html__( 'Animation Type', 'edumentor' ),
                'type'           => Controls_Manager::SELECT,
                'default'        => 'letters type',
                'options'        => [
                    'rotate-1'         => esc_html__( 'Rotate 1', 'edumentor' ),
                    'letters rotate-2' => esc_html__( 'Rotate 2', 'edumentor' ),
                    'letters rotate-3' => esc_html__( 'Rotate 3', 'edumentor' ),
                    'letters type'     => esc_html__( 'Type', 'edumentor' ),
                    'slide'            => esc_html__( 'Slide', 'edumentor' ),
                    'clip'             => esc_html__( 'Clip', 'edumentor' ),
                    'zoom'             => esc_html__( 'Zoom', 'edumentor' ),
                    'letters scale'    => esc_html__( 'Scale', 'edumentor' ),
                    'push'             => esc_html__( 'Push', 'edumentor' ),
                    'loading-bar'      => esc_html__( 'Loading Bar', 'edumentor' ),
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'animation_delay',
            [
                'label'              => esc_html__( 'Animation Delay', 'edumentor' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 1000,
                'step'               => 100,
                'max'                => 30000,
                'default'            => 2500,
                'description'        => esc_html__( 'Animation Delay in milliseconds. Min 1000 and Max 30000.', 'edumentor' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'clip_anim_duration',
            [
                'label'              => esc_html__( 'Reveal Duration', 'edumentor' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 10000,
                'default'            => 600,
                'description'        => esc_html__( 'Reveal Duration in milliseconds. Min 100 and Max 10000.', 'edumentor' ),
                'frontend_available' => true,
                'condition'    => [
                   'animation_type'    => 'clip',
                ],
            ]
        );

        $this->add_control(
            'clip_anim_delay',
            [
                'label'              => esc_html__( 'Reveal Animation Delay', 'edumentor' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 10000,
                'default'            => 1500,
                'description'        => esc_html__( 'Reveal Animation Delay in milliseconds. Min 100 and Max 10000.', 'edumentor' ),
                'frontend_available' => true,
                'condition'    => [
                   'animation_type'    => 'clip',
                ],
            ]
        );

        $this->add_control(
            'type_letter_delay',
            [
                'label'              => esc_html__( 'Type Letter Delay', 'edumentor' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 5000,
                'default'            => 150,
                'description'        => esc_html__( 'Type Letter Delay in milliseconds. Min 100 and Max 10000.', 'edumentor' ),
                'frontend_available' => true,
                'condition'    => [
                    'animation_type'    => 'letters type',
                ],
            ]
        );

        $this->add_control(
            'selection_duration',
            [
                'label'              => esc_html__( 'Selection Duration', 'edumentor' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 5000,
                'default'            => 500,
                'description'        => esc_html__( 'Selection Duration in milliseconds. Min 100 and Max 10000.', 'edumentor' ),
                'frontend_available' => true,
                'condition'    => [
                    'animation_type'    => 'letters type',
                ],
            ]
        );

        $this->add_control(
            'type_anim_delay',
            [
                'label'              => esc_html__( 'Type Animation Delay', 'edumentor' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 5000,
                'default'            => 1300,
                'description'        => esc_html__( 'Type Animation Delay in milliseconds. Min 100 and Max 10000.', 'edumentor' ),
                'frontend_available' => true,
                'condition'    => [
                    'animation_type'    => 'letters type',
                ],
            ]
        );

        $this->add_control(
            'bar_anim_delay',
            [
                'label'              => esc_html__( 'Bar Animation Delay', 'edumentor' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 10000,
                'default'            => 3800,
                'description'        => esc_html__( 'Bar Animation Delay in milliseconds. Min 100 and Max 10000.', 'edumentor' ),
                'frontend_available' => true,
                'condition'    => [
                    'animation_type'    => 'loading-bar',
                ],
            ]
        );

        $this->add_control(
            'bar_waiting',
            [
                'label'              => esc_html__( 'Bar Waiting Time', 'edumentor' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 10000,
                'default'            => 800,
                'description'        => esc_html__( 'Bar Waiting Time in milliseconds. Min 100 and Max 10000.', 'edumentor' ),
                'frontend_available' => true,
                'condition'    => [
                    'animation_type'    => 'loading-bar',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Animation Section
     *
     * @return void
     */
    protected function animation_section() {

        $this->start_controls_section(
			'animation_section',
			[
				'label' => esc_html__( 'Scrolling Animation', 'edumentor' ),
                'condition' => [
                    'heading!' => ''
                ]
			]
        );

        $this->add_control(
            'heading_animation',
            [
                'label' => esc_html__( 'Animation', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edumentor' ),
                'label_off' => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            'normal_anim_effect',
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
                    'heading!' => '',
                    'heading_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'anim_offset',
            [
                'label' => esc_html__( 'Offset', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 200,
                'condition' => [
                    'heading!' => '',
                    'heading_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'anim_delay',
            [
                'label' => esc_html__( 'Delay', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 400,
                'condition' => [
                    'heading!' => '',
                    'heading_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'anim_duration',
            [
                'label' => esc_html__( 'Duration', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 700,
                'condition' => [
                    'heading!' => '',
                    'heading_animation' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Heading style
     *
     * @return void
     */
    protected function heading_style() {

        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->start_controls_tabs( 'heading_tabs' );
                
        $this->start_controls_tab(
            'normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'heading_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => 'heading_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'heading_box_shadow',
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'heading_border',
                'selector' => '{{WRAPPER}} .hq-heading',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            'heading_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'highlighted_tab',
            [
                'label' => esc_html__( 'Highlighted Text', 'edumentor' ),
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hl_bg',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .hq-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => 'hl_text_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'hl_box_shadow',
                'selector' => '{{WRAPPER}} .hq-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hl_border',
                'selector' => '{{WRAPPER}} .hq-heading mark',
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_control(
            'hl_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading mark' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'hl_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading mark' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'hl_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading mark' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

		$this->add_control(
            'heading_bg_text',
            [
                'label' => esc_html__( 'Background Text', 'textdomain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'background_note',
            [
                'label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__( 'Background Text is Hidden on Content Tab', 'edumentor' ),
				'separator' => 'before',
                'condition' => [
                    'heading!' => '',
                    'show_background_text!' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'background_text_typography',
                'selector' => '{{WRAPPER}} .hq-heading:before',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Foreground::get_type(),
            [
                'name' => 'background_text_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-heading:before',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => ''
                ]
            ]
        );

        $this->add_control(
            'background_offset_toggle',
            [
                'label' => esc_html__( 'Offset', 'edumentor' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'None', 'edumentor' ),
                'label_on' => esc_html__( 'Custom', 'edumentor' ),
                'return_value' => 'yes',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => ''
                ]
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'background_horizontal_position',
            [
                'label' => esc_html__( 'Horizontal Position', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => '',
                    'background_offset_toggle' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading:before' => 'left: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'background_vertical_position',
            [
                'label' => esc_html__( 'Vertical Position', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => '',
                    'background_offset_toggle' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'background_text_rotation',
            [
                'label'        => esc_html__( 'Text Rotaion', 'edumentor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'edumentor' ),
                'label_off'    => esc_html__( 'Off', 'edumentor' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => ''
                ],
            ]
        );

        $this->add_responsive_control(
            'bg_text_rotation_val',
            [
                'label'      => esc_html__( 'Rotate The Text', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 1,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-heading:before' => 'transform: rotate({{SIZE}}deg);',
                ],
                'condition' => [
                    'heading!' => '',
                    'show_background_text' => 'yes',
                    'background_text!' => '',
                    'background_text_rotation' => 'yes'
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Animated Text Style
     *
     * @return void
     */
    protected function animated_text_style() {

        $this->start_controls_section(
            'section_custom_border',
            [
                'label' => esc_html__( 'Animated Text', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'animated_text_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'exclude'  => [
                    'font_size',
                    'line_height',
                ],
                'selector' => '{{WRAPPER}} .dl-animated-text b,{{WRAPPER}} .dl-animated-text i,{{WRAPPER}} .dl-animated-text em',
            ]
        );

        $this->add_control(
            'animated_text_color',
            [
                'label'     => esc_html__( 'Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl-animated-text b,{{WRAPPER}} .dl-animated-text i,{{WRAPPER}} .dl-animated-text em' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'animated_text_shadow',
                'label'    => esc_html__( 'Text Shadow', 'edumentor' ),
                'selector' => '{{WRAPPER}} .dl-animated-text b',
            ]
        );

        $this->add_control(
            'loading_bar_color',
            [
                'label'     => esc_html__( 'Loading Bar Color', 'adv-heading-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-heading.loading-bar .dl-animated-text::after' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'animation_type' => 'loading-bar',
                ],
            ]
        );

        $this->add_control(
            'cursor_color',
            [
                'label'      => esc_html__( 'Cursor Color', 'adv-heading-elementor' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .hq-heading.clip .dl-animated-text::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hq-heading.type .dl-animated-text::after' => 'background-color: {{VALUE}}',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'animation_type',
                            'operator' => '==',
                            'value'    => [
                                'clip',
                            ],
                        ],
                        [
                            'name'     => 'animation_type',
                            'operator' => '==',
                            'value'    => [
                                'letters type',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'select_text_color',
            [
                'label'     => esc_html__( 'Select Text Color', 'adv-heading-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-heading.type .dl-animated-text.selected' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'animation_type' => 'letters type',
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
        $tag = $settings['tag'];
        $animation_type = $settings['animation_type'];
        $data = [
			'anim_type' => $animation_type,
			'delay' => ! empty( $settings['animation_delay'] ) ? $settings['animation_delay'] : 2500,
			'clip_duration' => ! empty( $settings['clip_anim_duration'] ) ? $settings['clip_anim_duration'] : 600,
			'clip_delay' => ! empty( $settings['clip_anim_delay'] ) ? $settings['clip_anim_delay'] : 1500,
			'type_letter_delay' => ! empty( $settings['type_letter_delay'] ) ? $settings['type_letter_delay'] : 150,
			'selection_duration' => ! empty( $settings['selection_duration'] ) ? $settings['selection_duration'] : 500,
			'type_anim_delay' => ! empty( $settings['type_anim_delay'] ) ? $settings['type_anim_delay'] : 1300,
			'bar_anim_delay' => ! empty( $settings['bar_anim_delay'] ) ? $settings['bar_anim_delay'] : 3800,
			'bar_waiting' => ! empty( $settings['bar_waiting'] ) ? $settings['bar_waiting'] : 800,
		];

        $this->add_render_attribute( 'heading', [ 
            'class' => [ 'hq-heading', 'cd-headline', $animation_type ],
            'data-settings' => wp_json_encode( $data )
        ]);

        if( 'yes' === $settings['heading_animation'] ) {
            $this->add_render_attribute( 'heading', [ 
                'class' => [ 'wow', 'hq-' . $settings['normal_anim_effect'] ],
                'data-wow-offset' => $settings['anim_offset'],
                'data-wow-delay' => $settings['anim_delay'] . 'ms',
                'data-wow-duration' => $settings['anim_duration'] . 'ms'
            ] );
        }

        if( 'yes' === $settings['show_background_text'] && '' != $settings['background_text'] ) {
            $this->add_render_attribute( 'heading', [ 'data-bg-text' => esc_attr( $settings['background_text'] ) ] );
        }
        ?>
        <<?php echo esc_attr( $tag ) . ' ' . $this->get_render_attribute_string( 'heading' ); ?>>
        <?php 
            echo Helper::kses_advance( Helper::get_highlighted_text( $settings['heading'] ) );
            if ( $settings['animated_text'] && is_array( $settings['animated_text'] ) ) {
                $animated_animation_text = '';
    
                foreach ( $settings['animated_text'] as $key => $item ) {
                    $animated_animation_text .= sprintf(
                        '<b class="elementor-repeater-item-%s">%s</b>',
                        esc_attr( $item['_id'] . ( $key === 0 ? ' is-visible' : '' ) ),
                        esc_html( $item['text'] )
                    );
                }
    
                printf(
                    ' <span class="dl-animated-text cd-words-wrapper">%s</span>',
                    $animated_animation_text
                );
            }

            if( ! empty( $settings['heading_after'] ) ) {
                echo ' ' . Helper::kses_advance( Helper::get_highlighted_text( $settings['heading_after'] ) );
            }
        ?>
        </<?php echo esc_attr( $tag ); ?>>
        <?php

    }

}