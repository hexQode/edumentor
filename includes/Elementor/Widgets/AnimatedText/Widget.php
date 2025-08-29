<?php
/**
 * Animated Text
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\AnimatedText;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use HexQode\EduMentor\Classes\Helper;
use HexQode\EduMentor\Traits\CommonControls;

defined( 'ABSPATH' ) || die();

class Widget extends Widget_Base {

    use CommonControls;

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'flatpack-animated-text';
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
        return esc_html__( 'Animated Text', 'flatpack' );
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
        return 'fq-icon eicon-animated-headline';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'heading', 'title', 'text','animated', 'text animation', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'fp-main', 'fp-keyframes', 'fp-animated-text' ];
    }

    public function get_script_depends() {
        return [ 'flatpack-el-script', 'wow', 'fp-animated-text' ];
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
				'label' => esc_html__( 'Heading', 'flatpack' )
			]
        );

        $this->add_control(
            'heading',
            [
                'label'        => esc_html__( 'Text Before', 'flatpack' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 5,
                'default'      => esc_html__( 'FlatPack Text is', 'flatpack' ),
                'placeholder'  => esc_html__( 'Text goes here...', 'flatpack' ),
                'description'  => esc_html__( 'Use this {Text} format to highlight the text.', 'flatpack' ),
            ]
        );

        $this->add_control(
            'heading_after',
            [
                'label'        => esc_html__( 'Text After', 'flatpack' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 5,
                'default'      => esc_html__( '', 'flatpack' ),
                'placeholder'  => esc_html__( 'Text goes here...', 'flatpack' ),
                'description'  => esc_html__( 'Use this {Text} format to highlight the text.', 'flatpack' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text', [
                'label'   => esc_html__( 'Text', 'flatpack' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Awesome', 'flatpack' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'text_customize',
            [
                'label'          => esc_html__( 'Want To Customize Text?', 'flatpack' ),
                'type'           => Controls_Manager::SWITCHER,
                'label_on'       => esc_html__( 'Yes', 'flatpack' ),
                'label_off'      => esc_html__( 'No', 'flatpack' ),
                'return_value'   => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'text_typography',
                'label'          => esc_html__( 'Typography', 'flatpack' ),
                'exclude'        => [
                    'font_size',
                    'line_height',
                ],
                'selector'       => '{{WRAPPER}} .fp-heading .dl-animated-text > {{CURRENT_ITEM}}, {{WRAPPER}} .fp-heading .dl-animated-text > {{CURRENT_ITEM}} i, {{WRAPPER}} .fp-heading .dl-animated-text > {{CURRENT_ITEM}} em',
                'condition'      => [
                    'text_customize' => 'yes',
                ],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'text_color',
            [
                'label'          => esc_html__( 'Color', 'flatpack' ),
                'type'           => Controls_Manager::COLOR,
                'selectors'      => [
                    '{{WRAPPER}} .fp-heading .dl-animated-text > {{CURRENT_ITEM}} '     => 'color: {{VALUE}}; -webkit-background-clip: initial; -webkit-text-fill-color:initial; background: none;',
                    '{{WRAPPER}} .fp-heading .dl-animated-text > {{CURRENT_ITEM}} i'    => 'color: {{VALUE}}; -webkit-background-clip: initial; -webkit-text-fill-color:initial; background: none;',
                    '{{WRAPPER}} .fp-heading .dl-animated-text > {{CURRENT_ITEM}} i em' => 'color: {{VALUE}}; -webkit-background-clip: initial; -webkit-text-fill-color:initial; background: none;',
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
                'label'          => esc_html__( 'Text Shadow', 'flatpack' ),
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
                'label'       => esc_html__( 'Animated Text', 'flatpack' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'text' => esc_html__( 'Awesome', 'flatpack' ),
                    ],
                    [
                        'text' => esc_html__( 'Cool', 'flatpack' ),
                    ],
                    [
                        'text' => esc_html__( 'Nice', 'flatpack' ),
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
			'show_background_text',
			[
				'label' => esc_html__( 'Background Text', 'flatpack' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'flatpack' ),
				'label_off' => esc_html__( 'Hide', 'flatpack' ),
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
				'label' => esc_html__( 'Text', 'flatpack' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Background', 'flatpack' ),
				'placeholder' => esc_html__( 'Background Text', 'flatpack' ),
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
                'label' => esc_html__( 'HTML Tag', 'flatpack' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'h2',
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'flatpack' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'flatpack' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'flatpack' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'flatpack' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'flatpack' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'flatpack' ),
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
                'label' => esc_html__( 'Alignment', 'flatpack' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'flatpack' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'flatpack' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'flatpack' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'left',
                'prefix_class' => 'align-',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}.fp-layout-inline' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .fp-heading' => 'text-align: {{VALUE}}'

                ],
                'condition' => [
                    'heading!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_layout',
            [
                'label' => esc_html__( 'Layout', 'flatpack' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inline' => [
                        'title' => esc_html__( 'Inline', 'flatpack' ),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'flatpack' ),
                        'icon' => 'eicon-menu-bar',
                    ]
                ],
                'toggle' => false,
                'selectors_dictionary' => [
                    'inline' => 'display: inline-block',
                    'block' => 'display: block',
                ],
                'default' => 'block',
                'prefix_class' => 'fp-layout-',
                'selectors' => [
                    '{{WRAPPER}} .fp-heading' => '{{VALUE}}'
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
                'label'      => esc_html__( 'Text Animation Settings', 'flatpack' ),
                'tab'        => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label'          => esc_html__( 'Animation Type', 'flatpack' ),
                'type'           => Controls_Manager::SELECT,
                'default'        => 'letters type',
                'options'        => [
                    'rotate-1'         => esc_html__( 'Rotate 1', 'flatpack' ),
                    'letters rotate-2' => esc_html__( 'Rotate 2', 'flatpack' ),
                    'letters rotate-3' => esc_html__( 'Rotate 3', 'flatpack' ),
                    'letters type'     => esc_html__( 'Type', 'flatpack' ),
                    'slide'            => esc_html__( 'Slide', 'flatpack' ),
                    'clip'             => esc_html__( 'Clip', 'flatpack' ),
                    'zoom'             => esc_html__( 'Zoom', 'flatpack' ),
                    'letters scale'    => esc_html__( 'Scale', 'flatpack' ),
                    'push'             => esc_html__( 'Push', 'flatpack' ),
                    'loading-bar'      => esc_html__( 'Loading Bar', 'flatpack' ),
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'animation_delay',
            [
                'label'              => esc_html__( 'Animation Delay', 'flatpack' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 1000,
                'step'               => 100,
                'max'                => 30000,
                'default'            => 2500,
                'description'        => esc_html__( 'Animation Delay in milliseconds. Min 1000 and Max 30000.', 'flatpack' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'clip_anim_duration',
            [
                'label'              => esc_html__( 'Reveal Duration', 'flatpack' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 10000,
                'default'            => 600,
                'description'        => esc_html__( 'Reveal Duration in milliseconds. Min 100 and Max 10000.', 'flatpack' ),
                'frontend_available' => true,
                'condition'    => [
                   'animation_type'    => 'clip',
                ],
            ]
        );

        $this->add_control(
            'clip_anim_delay',
            [
                'label'              => esc_html__( 'Reveal Animation Delay', 'flatpack' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 10000,
                'default'            => 1500,
                'description'        => esc_html__( 'Reveal Animation Delay in milliseconds. Min 100 and Max 10000.', 'flatpack' ),
                'frontend_available' => true,
                'condition'    => [
                   'animation_type'    => 'clip',
                ],
            ]
        );

        $this->add_control(
            'type_letter_delay',
            [
                'label'              => esc_html__( 'Type Letter Delay', 'flatpack' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 5000,
                'default'            => 150,
                'description'        => esc_html__( 'Type Letter Delay in milliseconds. Min 100 and Max 10000.', 'flatpack' ),
                'frontend_available' => true,
                'condition'    => [
                    'animation_type'    => 'letters type',
                ],
            ]
        );

        $this->add_control(
            'selection_duration',
            [
                'label'              => esc_html__( 'Selection Duration', 'flatpack' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 5000,
                'default'            => 500,
                'description'        => esc_html__( 'Selection Duration in milliseconds. Min 100 and Max 10000.', 'flatpack' ),
                'frontend_available' => true,
                'condition'    => [
                    'animation_type'    => 'letters type',
                ],
            ]
        );

        $this->add_control(
            'type_anim_delay',
            [
                'label'              => esc_html__( 'Type Animation Delay', 'flatpack' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 5000,
                'default'            => 1300,
                'description'        => esc_html__( 'Type Animation Delay in milliseconds. Min 100 and Max 10000.', 'flatpack' ),
                'frontend_available' => true,
                'condition'    => [
                    'animation_type'    => 'letters type',
                ],
            ]
        );

        $this->add_control(
            'bar_anim_delay',
            [
                'label'              => esc_html__( 'Bar Animation Delay', 'flatpack' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 10000,
                'default'            => 3800,
                'description'        => esc_html__( 'Bar Animation Delay in milliseconds. Min 100 and Max 10000.', 'flatpack' ),
                'frontend_available' => true,
                'condition'    => [
                    'animation_type'    => 'loading-bar',
                ],
            ]
        );

        $this->add_control(
            'bar_waiting',
            [
                'label'              => esc_html__( 'Bar Waiting Time', 'flatpack' ),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 100,
                'step'               => 100,
                'max'                => 10000,
                'default'            => 800,
                'description'        => esc_html__( 'Bar Waiting Time in milliseconds. Min 100 and Max 10000.', 'flatpack' ),
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
				'label' => esc_html__( 'Scrolling Animation', 'flatpack' ),
                'condition' => [
                    'heading!' => ''
                ]
			]
        );

        $this->add_control(
            'heading_animation',
            [
                'label' => esc_html__( 'Animation', 'flatpack' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'flatpack' ),
                'label_off' => esc_html__( 'No', 'flatpack' ),
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
                'label' => esc_html__( 'Effect', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fadeIn',
                'options' => [
                    'fadeIn' => esc_html__( 'Fade In', 'flatpack' ),
                    'fadeInLeft' => esc_html__( 'Fade In Left', 'flatpack' ),
                    'fadeInRight'  => esc_html__( 'Fade In Right', 'flatpack' ),
                    'fadeInTop' => esc_html__( 'Fade In Top', 'flatpack' ),
                    'fadeInBottom' => esc_html__( 'Fade In Bottom', 'flatpack' )
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
                'label' => esc_html__( 'Offset', 'flatpack' ),
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
                'label' => esc_html__( 'Delay', 'flatpack' ),
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
                'label' => esc_html__( 'Duration', 'flatpack' ),
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
     * Animated Text Style
     *
     * @return void
     */
    protected function animated_text_style() {

        $this->start_controls_section(
            'section_custom_border',
            [
                'label' => esc_html__( 'Animated Text', 'flatpack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'animated_text_typography',
                'label'    => esc_html__( 'Typography', 'flatpack' ),
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
                'label'     => esc_html__( 'Color', 'flatpack' ),
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
                'label'    => esc_html__( 'Text Shadow', 'flatpack' ),
                'selector' => '{{WRAPPER}} .dl-animated-text b',
            ]
        );

        $this->add_control(
            'loading_bar_color',
            [
                'label'     => esc_html__( 'Loading Bar Color', 'adv-heading-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fp-heading.loading-bar .dl-animated-text::after' => 'background: {{VALUE}}',
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
                    '{{WRAPPER}} .fp-heading.clip .dl-animated-text::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .fp-heading.type .dl-animated-text::after' => 'background-color: {{VALUE}}',
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
                    '{{WRAPPER}} .fp-heading.type .dl-animated-text.selected' => 'background-color: {{VALUE}}',
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
            'class' => [ 'fp-heading', 'cd-headline', $animation_type ],
            'data-settings' => wp_json_encode( $data )
        ]);

        if( 'yes' === $settings['heading_animation'] ) {
            $this->add_render_attribute( 'heading', [ 
                'class' => [ 'wow', 'fp-' . $settings['normal_anim_effect'] ],
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