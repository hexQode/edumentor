<?php
/**
 * Heading
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\Heading;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
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
        return 'edumentor-heading';
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
        return esc_html__( 'Heading', 'edumentor' );
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
        return 'edumentor-icon eicon-editor-h1';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'heading', 'title', 'text', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'hq-main', 'hq-keyframes' ];
    }

    public function get_script_depends() {
        return [ 'edumentor-el-script', 'wow', 'splitting' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->heading_section();
        $this->animation_section();
        $this->heading_style();
        
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
                'label'        => esc_html__( 'Heading Text', 'edumentor' ),
                'type'         => Controls_Manager::TEXTAREA,
                'rows'         => 5,
                'default'      => esc_html__( 'EduMentor {Heading} Text', 'edumentor' ),
                'placeholder'  => esc_html__( 'Text goes here...', 'edumentor' ),
                'description'  => esc_html__( 'Use this {Text} format to highlight the text.', 'edumentor' ),
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
            'link',
            [
                'label' => esc_html__( 'Link', 'edumentor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://example.com/', 'edumentor' ),
				'separator' => 'after',
				'dynamic' => [
					'active' => true,
                ],
                'condition' => [
                    'heading!' => ''
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
            'anim_type',
            [
                'label' => esc_html__( 'Type', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__( 'Normal', 'edumentor' ),
                    'splitting'  => esc_html__( 'Splitting Text', 'edumentor' )
                ],
                'condition' => [
                    'heading!' => '',
                    'heading_animation' => 'yes'
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
                    'heading_animation' => 'yes',
                    'anim_type' => 'normal'
                ]
            ]
        );

        $this->add_control(
            'splitting_anim_effect',
            [
                'label' => esc_html__( 'Effect', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'textFadeIn',
                'options' => [
                    'textFadeIn' => esc_html__( 'Fade In', 'edumentor' ),
                    'textFadeInTop' => esc_html__( 'Fade In Top', 'edumentor' ),
                    'textFadeInBottom'  => esc_html__( 'Fade In Bottom', 'edumentor' )
                ],
                'condition' => [
                    'heading!' => '',
                    'heading_animation' => 'yes',
                    'anim_type' => 'splitting'
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
                    'heading_animation' => 'yes',
                    'anim_type' => 'normal'
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
                    'heading_animation' => 'yes',
                    'anim_type' => 'normal'
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
                    'heading_animation' => 'yes',
                    'anim_type' => 'normal'
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
        $tag = $settings['tag'];
        $has_link = false;
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
			$has_link = true;
        }
        $this->add_render_attribute( 'heading', [ 'class' => [ 'hq-heading' ] ] );
        $this->add_inline_editing_attributes( 'heading', 'none' );

        if( 'yes' === $settings['heading_animation'] ) {
            if( 'normal' == $settings['anim_type'] ) {
                $this->add_render_attribute( 'heading', [ 
                    'class' => [ 'wow', 'hq-' . $settings['normal_anim_effect'] ],
                    'data-wow-offset' => $settings['anim_offset'],
                    'data-wow-delay' => $settings['anim_delay'] . 'ms',
                    'data-wow-duration' => $settings['anim_duration'] . 'ms'
                ] );
            }else{
                $this->add_render_attribute( 'heading', [ 
                    'class' => [ 'wow', 'hq-' . $settings['splitting_anim_effect'] ],
                    'data-splitting' => ''
                ] );
            }
        }
        if( 'yes' === $settings['show_background_text'] && '' != $settings['background_text'] ) {
            $this->add_render_attribute( 'heading', [ 'data-bg-text' => esc_attr( $settings['background_text'] ) ] );
        }
        ?>
        <<?php echo esc_attr( $tag ) . ' ' . $this->get_render_attribute_string( 'heading' ); ?>>
        <?php 
        if( $has_link ) {
            echo '<a '. $this->get_render_attribute_string( 'link' ) .'>'. Helper::kses_advance( Helper::get_highlighted_text( $settings['heading'] ) ) .'</a>';
        }else{
            echo Helper::kses_advance( Helper::get_highlighted_text( $settings['heading'] ) );
        }
        ?>
        </<?php echo esc_attr( $tag ); ?>>
        <?php

    }

}