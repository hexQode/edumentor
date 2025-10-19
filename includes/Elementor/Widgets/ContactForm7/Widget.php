<?php
/**
 * Contact Form 7
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\ContactForm7;

use HexQode\EduMentor\Classes\Helper;
use HexQode\EduMentor\Elementor\Controls\Foreground;
use HexQode\EduMentor\Traits\CommonControls;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

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
        return 'edumentor-contact-form-7';
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
        return esc_html__( 'Contact Form 7', 'edumentor' );
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
        return 'edumentor-icon eicon-form-horizontal';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'contact form', 'form', 'contact form 7', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'hq-main', 'hq-contact-form', 'hq-keyframes', 'elementor-icons-fa-solid' ];
    }

    public function get_script_depends() {
        return [ 'edumentor-el-script', 'wow', 'splitting' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_general();
        $this->section_sub_heading();
        $this->section_heading();
        $this->section_description();
        $this->select_form_section();
        $this->column_controls_section();
        $this->wrapper_style();
        $this->sub_heading_style();
        $this->heading_style();
        $this->description_style();
        $this->form_label_style();
        $this->form_text_style();
        $this->form_select_box_style();
        $this->form_checkbox_radio_style();
        $this->form_submit_style();
        
    }

    /**
     * Select Form
     *
     * @return void
     */
    protected function select_form_section() {

        $this->start_controls_section(
			'select_form_section',
			[
				'label' => esc_html__( 'Form', 'edumentor' )
			]
        );

        $this->add_control(
            'contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => Helper::el_get_contact_forms()
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Columns Control
     *
     * @return void
     */
    protected function column_controls_section() {

        $this->start_controls_section(
			'column_controls_section',
			[
				'label' => esc_html__( 'Column Controls', 'edumentor' )
			]
        );

        $this->add_control(
            'column_layout',
            [
                'label'   => esc_html__( 'Column Layout', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'  => esc_html__( 'Default', 'edumentor' ),
                    'layout-1'  => esc_html__( '2 2 1 Column', 'edumentor' ),
                    'layout-2' => esc_html__( '2 1 Column', 'edumentor' ),
                    'layout-3' => esc_html__( '2 1 2 Column', 'edumentor' ),
                    'layout-4' => esc_html__( '1 2 1 Column', 'edumentor' ),
                    'layout-5' => esc_html__( '1 2 2 Column', 'edumentor' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'col_spacing',
            [
                'label'      => esc_html__( 'Space Between', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form' => 'margin: 0 calc(-{{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .wpcf7-form p:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7-form p' => 'padding: 0 calc({{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * General Control
     *
     * @return void
     */
    protected function section_general() {

        $this->start_controls_section(
			'section_heading_general',
			[
				'label' => esc_html__( 'General', 'edumentor' )
			]
        );

        $this->add_responsive_control(
            'dl_section_text_align',
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
                'toggle' => false,
                'prefix_class' => 'dl-align-',
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'section_margin',
            [
                'label'      => esc_html__( 'Section Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'allowed_dimensions' => 'vertical',
                'selectors'  => [
                    '{{WRAPPER}} .hq-heading-wrap' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Sub Heading Control
     *
     * @return void
     */
    protected function section_sub_heading() {

        $this->start_controls_section(
			'section_sub_heading',
			[
				'label' => esc_html__( 'Sub Heading', 'edumentor' )
			]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' => esc_html__( 'Heading', 'edumentor' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__( 'Text goes here...', 'edumentor' ),
                'rows'        => 4,
				'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_control(
            'sub_heading_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'edumentor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'h4',
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
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_position',
            [
                'label' => esc_html__( 'Display', 'edumentor' ),
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
                'default' => 'inline',
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading' => '{{VALUE}}',
                ],
                'condition' => [
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_control(
            'sub_heading_animation',
            [
                'label' => esc_html__( 'Animation', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edumentor' ),
                'label_off' => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'sub_heading!' => ''
                ]
            ]
        );

        $this->add_control(
            'sh_anim_type',
            [
                'label' => esc_html__( 'Type', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__( 'Normal', 'edumentor' ),
                    'splitting'  => esc_html__( 'Splitting Text', 'edumentor' )
                ],
                'condition' => [
                    'sub_heading!' => '',
                    'sub_heading_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'sh_normal_anim_effect',
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
                    'sub_heading!' => '',
                    'sub_heading_animation' => 'yes',
                    'sh_anim_type' => 'normal'
                ]
            ]
        );

        $this->add_control(
            'sh_splitting_anim_effect',
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
                    'sub_heading!' => '',
                    'sub_heading_animation' => 'yes',
                    'sh_anim_type' => 'splitting'
                ]
            ]
        );

        $this->add_control(
            'sh_anim_offset',
            [
                'label' => esc_html__( 'Offset', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 200,
                'condition' => [
                    'sub_heading!' => '',
                    'sub_heading_animation' => 'yes',
                    'sh_anim_type' => 'normal'
                ]
            ]
        );

        $this->add_control(
            'sh_anim_delay',
            [
                'label' => esc_html__( 'Delay', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 400,
                'condition' => [
                    'sub_heading!' => '',
                    'sub_heading_animation' => 'yes',
                    'sh_anim_type' => 'normal'
                ]
            ]
        );

        $this->add_control(
            'sh_anim_duration',
            [
                'label' => esc_html__( 'Duration', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 700,
                'condition' => [
                    'sub_heading!' => '',
                    'sub_heading_animation' => 'yes',
                    'sh_anim_type' => 'normal'
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Heading Control
     *
     * @return void
     */
    protected function section_heading() {

        // Heading
		$this->start_controls_section(
			'section_heading',
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
     * Description Control
     *
     * @return void
     */
    protected function section_description() {

        $this->start_controls_section(
			'section_desc',
			[
				'label' => esc_html__( 'Description', 'edumentor' )
			]
        );

        $this->add_control(
            'desc',
            [
                'label'       => esc_html__( 'Description', 'edumentor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 5,
                'default'     => '',
                'placeholder' => esc_html__( 'Description...', 'edumentor' ),
            ]
        );

        $this->add_control(
            'desc_animation',
            [
                'label' => esc_html__( 'Animation', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edumentor' ),
                'label_off' => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'desc!' => ''
                ]
            ]
        );

        $this->add_control(
            'desc_anim_type',
            [
                'label' => esc_html__( 'Type', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__( 'Normal', 'edumentor' ),
                    'splitting'  => esc_html__( 'Splitting Text', 'edumentor' )
                ],
                'condition' => [
                    'desc!' => '',
                    'desc_animation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'desc_normal_anim_effect',
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
                    'desc!' => '',
                    'desc_animation' => 'yes',
                    'desc_anim_type' => 'normal'
                ]
            ]
        );

        $this->add_control(
            'desc_splitting_anim_effect',
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
                    'desc!' => '',
                    'desc_animation' => 'yes',
                    'desc_anim_type' => 'splitting'
                ]
            ]
        );

        $this->add_control(
            'desc_anim_offset',
            [
                'label' => esc_html__( 'Offset', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 200,
                'condition' => [
                    'desc!' => '',
                    'desc_animation' => 'yes',
                    'desc_anim_type' => 'normal'
                ]
            ]
        );

        $this->add_control(
            'desc_anim_delay',
            [
                'label' => esc_html__( 'Delay', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 400,
                'condition' => [
                    'desc!' => '',
                    'desc_animation' => 'yes',
                    'desc_anim_type' => 'normal'
                ]
            ]
        );

        $this->add_control(
            'desc_anim_duration',
            [
                'label' => esc_html__( 'Duration', 'edumentor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 700,
                'condition' => [
                    'desc!' => '',
                    'desc_animation' => 'yes',
                    'desc_anim_type' => 'normal'
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Wrapper Style
     *
     * @return void
     */
    protected function wrapper_style() {

        $this->start_controls_section(
            'wrapper_style_section',
            [
                'label' => esc_html__( 'Wrapper', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'wrapper_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .el-cf7-form-wrap',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .el-cf7-form-wrap',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .el-cf7-form-wrap',
            ]
        );

        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .el-cf7-form-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .el-cf7-form-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .el-cf7-form-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wrapper_overlay',
            [
                'label'        => esc_html__( 'Overlay', 'edumentor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'edumentor' ),
                'label_off'    => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'ov_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .el-cf7-form-wrap .overlay',
                'condition'    => [
                   'wrapper_overlay' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ov_opacity',
            [
                'label'      => esc_html__( 'Opacity', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0.5,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .el-cf7-form-wrap .overlay' => 'opacity: {{SIZE}};',
                ],
                'condition'    => [
                    'wrapper_overlay' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Sub Heading Style Control
     *
     * @return void
     */
    protected function sub_heading_style() {

        $this->start_controls_section(
			'section_sub_heading_text',
			[
                'label' => esc_html__( 'Sub Heading', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'sub_heading!' => ''
				],
			]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_text_typography',
                'selector' => '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading',
                'condition' => [
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_group_control(
            Foreground::get_type(),
            [
                'name'     => 'sub_heading_color_type',
                'label'    => esc_html__( 'Text Color Type', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading span',
            ]
        );

        $this->add_responsive_control(
            'sub_heading_text_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_text_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sub_heading_text_border',
                'selector' => '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading',
                'condition' => [
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_control(
            'sub_heading_text_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'sub_heading_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading',
                'condition' => [
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sub_heading_text_background',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading',
                'condition' => [
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_control(
            'sub_heading_text_blend_mode',
            [
                'label' => esc_html__( 'Blend Mode', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'separator' => 'inherit',
                'options' => [
                    'inherit' => esc_html__( 'Normal', 'edumentor' ),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-sub-heading' => 'mix-blend-mode: {{VALUE}}',
                ],
                'condition' => [
					'sub_heading!' => ''
				],
            ]
        );

        $this->add_control(
            'subheading_custom_border',
            [
                'label'        => esc_html__( 'Custom Border', 'edumentor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'edumentor' ),
                'label_off'    => esc_html__( 'no', 'edumentor' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'sub_heading!'    => ''
                ],
            ]
        );

        $this->add_control(
            'sub_heading_bd_direction',
            [
                'label'   => esc_html__( 'Border Direction', 'edumentor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'edumentor' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle'  => false,
                'condition' => [
                    'sub_heading!'    => '',
                    'subheading_custom_border'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_bd_spacing',
            [
                'label'      => esc_html__( 'Spacing Between Text', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 5
                ],
                'render_type' => 'ui',
                'condition' => [
                    'sub_heading!'    => '',
                    'subheading_custom_border'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_bd_length',
            [
                'label'      => esc_html__( 'Border Length', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 20
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-sub-heading > span.custom-border:before' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hq-sub-heading > span.custom-border.left' => 'padding-left: calc({{SIZE}}{{UNIT}} + {{sub_heading_bd_spacing.SIZE}}px);',
                    '{{WRAPPER}} .hq-sub-heading > span.custom-border.right' => 'padding-right: calc({{SIZE}}{{UNIT}} + {{sub_heading_bd_spacing.SIZE}}px);',
                ],
                'condition' => [
                    'sub_heading!'    => '',
                    'subheading_custom_border'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_bd_height',
            [
                'label'      => esc_html__( 'Border Height', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 3
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-sub-heading > span.custom-border:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'sub_heading!'    => '',
                    'subheading_custom_border'    => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'subheading_border_color',
                'label'    => esc_html__( 'Border Color', 'edumentor' ),
                'show_label'    => true,
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hq-sub-heading > span.custom-border:before',
                'condition' => [
                    'sub_heading!'    => '',
                    'subheading_custom_border'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_h_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-sub-heading > span.custom-border:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'sub_heading!'    => '',
                    'subheading_custom_border'    => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_h_border_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'allowed_dimensions' => [ 'top', 'right' ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-sub-heading > span.custom-border:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'sub_heading!'    => '',
                    'subheading_custom_border'    => 'yes'
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
			'section_desc_text',
			[
                'label' => esc_html__( 'Description', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'    => [
                   'desc!'    => ''
                ],
			]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_text_typography',
                'selector' => '{{WRAPPER}} .hq-heading-wrap .hq-desc',
                'condition'    => [
                    'desc!'    => ''
                ],
            ]
        );

        $this->add_control(
            'desc_text_color',
            [
                'label'     => esc_html__( 'Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-desc' => 'color: {{VALUE}}',
                ],
                'condition'    => [
                    'desc!'    => ''
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_text_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'desc!'    => ''
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_text_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'desc!'    => ''
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'desc_text_border',
                'selector' => '{{WRAPPER}} .hq-heading-wrap .hq-desc',
                'condition'    => [
                    'desc!'    => ''
                ],
            ]
        );

        $this->add_control(
            'desc_text_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'    => [
                    'desc!'    => ''
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'desc_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-heading-wrap .hq-desc',
                'condition'    => [
                    'desc!'    => ''
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'desc_text_background',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .hq-heading-wrap .hq-desc',
                'condition'    => [
                    'desc!'    => ''
                ],
            ]
        );

        $this->add_control(
            'desc_text_blend_mode',
            [
                'label' => esc_html__( 'Blend Mode', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'separator' => 'inherit',
                'options' => [
                    'inherit' => esc_html__( 'Normal', 'edumentor' ),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-heading-wrap .hq-desc' => 'mix-blend-mode: {{VALUE}}',
                ],
                'condition'    => [
                    'desc!'    => ''
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Form Label Style
     *
     * @return void
     */
    protected function form_label_style() {

        $this->start_controls_section(
            'form_label_style_section',
            [
                'label' => esc_html__( 'Form Label', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_label_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-form p > label, {{WRAPPER}} .wpcf7-not-valid-tip',
            ]
        );

        $this->add_control(
            'form_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p > label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_required_text_color',
            [
                'label'     => esc_html__( 'Required Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-not-valid-tip' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'required_txt_margin',
            [
                'label'      => esc_html__( 'Required Text Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-not-valid-tip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Form Input Style
     *
     * @return void
     */
    protected function form_text_style() {

        $this->start_controls_section(
            'form_text_style_section',
            [
                'label' => esc_html__( 'Form Fields', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_input_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text,{{WRAPPER}} .wpcf7-form p .wpcf7-quiz,{{WRAPPER}} .wpcf7-form p .wpcf7-textarea',
            ]
        );

        $this->add_responsive_control(
            'input_field_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_field_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea, {{WRAPPER}} .wpcf7-form p .wpcf7-form-control:not(.wpcf7-submit)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'textarea_field_height',
            [
                'label' => esc_html__( 'Textarea Height', 'textdomain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 140
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'input_style_tabs' );

        $this->start_controls_tab(
            'input_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_control(
            'input_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-quiz' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_txt_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_txt_placeholder_color',
            [
                'label'     => esc_html__( 'Placeholder Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .wpcf7-form-control::placeholder, {{WRAPPER}} .wpcf7-form .wpcf7-form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'input_txt_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'input_txt_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea',
            ]
        );

        $this->add_responsive_control(
            'input_txt_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'input_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edumentor' ),
            ]
        );

        $this->add_control(
            'input_bg_h_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-text:focus' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-quiz:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:focus' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'input_txt_h_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-text:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'input_txt_h_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form p .wpcf7-text:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-text:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:focus',
            ]
        );

        $this->add_responsive_control(
            'input_txt_h_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form p .wpcf7-text:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-text:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-quiz:focus, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-form p .wpcf7-textarea:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
     * Form Select Box Style
     *
     * @return void
     */
    protected function form_select_box_style() {

        $this->start_controls_section(
            'form_select_box_style_section',
            [
                'label' => esc_html__( 'Form Select Field', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'select_box_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .ui-selectmenu-text',
            ]
        );

        $this->add_control(
            'form_select_box_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ui-selectmenu-button.ui-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'form_select_txt_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ui-selectmenu-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'select_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .ui-selectmenu-button.ui-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'select_box_shadow',
                'selector' => '{{WRAPPER}} .ui-selectmenu-button.ui-button',
            ]
        );

        $this->add_responsive_control(
            'select_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ui-selectmenu-button.ui-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_select_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ui-selectmenu-button.ui-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_select_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ui-selectmenu-button.ui-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Checkbox/Radio Field
     *
     * @return void
     */
    protected function form_checkbox_radio_style() {

        $this->start_controls_section(
            'form_cb_radio_style_section',
            [
                'label' => esc_html__( 'Form Checkbox/Radio Field', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'cb_radio_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-list-item-label',
            ]
        );

        $this->add_control(
            'cb_radio_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-list-item-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'cb_radio_space_between_item',
            [
                'label'      => esc_html__( 'Space Between Item', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form-control.wpcf7-radio' => 'column-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7-form-control.wpcf7-checkbox' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cb_radio_space_between_box_text',
            [
                'label'      => esc_html__( 'Space Between Box & Text', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-list-item > label' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'radio_cb_bd_color',
            [
                'label'     => esc_html__( 'Border Color Normal', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-checkbox input' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-radio input' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'radio_cb_bd_hover_color',
            [
                'label'     => esc_html__( 'Border Color Hover', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-checkbox input:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-radio input:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'radio_cb_bd_active_color',
            [
                'label'     => esc_html__( 'Active Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-checkbox input:checked' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-checkbox input:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-radio input:checked' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-radio input:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'checkbox_icon_color',
            [
                'label'     => esc_html__( 'Checkbox Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .el-cf7-form-wrap .wpcf7-checkbox input:before' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Form Submit Style
     *
     * @return void
     */
    protected function form_submit_style() {

        $this->start_controls_section(
            'form_submit_style_section',
            [
                'label' => esc_html__( 'Form Button', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btn_alignment',
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
                'default' => 'left',
                'toggle'  => false,
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right' => 'justify-content: flex-end'
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form>p:last-of-type' => '{{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_btn_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'btn_style_tabs' );

        $this->start_controls_tab(
            'btn_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'btn_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'    => ['image'],
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'btn_h_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'    => ['image'],
                'selector' => '{{WRAPPER}} .wpcf7-submit:hover',
            ]
        );

        $this->add_control(
            'btn_h_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_h_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .wpcf7-submit:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_h_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-submit:hover',
            ]
        );

        $this->add_responsive_control(
            'btn_h_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-submit:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $preview_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
        $this->add_render_attribute( 'wrapper', [ 'class' => [ 'el-cf7-form-wrap', $settings['column_layout'] ] ] );
        $this->add_inline_editing_attributes( 'heading', 'none' );
        $this->add_inline_editing_attributes( 'sub_heading', 'none' );
        $this->add_inline_editing_attributes( 'desc', 'none' );
        // Heading
        if( 'yes' === $settings['heading_animation'] ) {
            if( 'normal' == $settings['anim_type'] ) {
                $this->add_render_attribute( 'heading_anim_handler', [ 
                    'class' => [ 'wow', 'hq-heading', 'hq-' . $settings['normal_anim_effect'] ],
                    'data-wow-offset' => $settings['anim_offset'],
                    'data-wow-delay' => $settings['anim_delay'] . 'ms',
                    'data-wow-duration' => $settings['anim_duration'] . 'ms'
                ] );
            }else{
                $this->add_render_attribute( 'heading_anim_handler', [ 
                    'class' => [ 'wow', 'hq-heading', 'hq-' . $settings['splitting_anim_effect'] ],
                    'data-splitting' => ''
                ] );
            }
        }else{
            $this->add_render_attribute( 'heading_anim_handler', [ 'class' => 'hq-heading' ] );
        }

        if( 'yes' === $settings['show_background_text'] ) {
            $this->add_render_attribute( 'heading_anim_handler', [ 'data-bg-text' => esc_attr( $settings['background_text'] ) ] );
        }

        // Sub Heading
        if( 'yes' === $settings['sub_heading_animation'] ){
            if( 'normal' == $settings['sh_anim_type'] ) {
                $this->add_render_attribute( 'sub_heading_anim_handler', [ 
                    'class' => [ 'wow', 'hq-sub-heading', 'hq-' . $settings['sh_normal_anim_effect'] ],
                    'data-wow-offset' => $settings['sh_anim_offset'],
                    'data-wow-delay' => $settings['sh_anim_delay'] . 'ms',
                    'data-wow-duration' => $settings['sh_anim_duration'] . 'ms'
                ] );
            }else{
                $this->add_render_attribute( 'sub_heading_anim_handler', [ 
                    'class' => [ 'wow', 'hq-sub-heading', 'hq-' . $settings['sh_splitting_anim_effect'] ],
                    'data-splitting' => ''
                ] );
            }
        }else{
            $this->add_render_attribute( 'sub_heading_anim_handler', [ 'class' => 'hq-sub-heading' ] );
        }

        if( 'yes' === $settings['subheading_custom_border'] ) {
            $this->add_render_attribute( 'sub_heading', [ 'class' => [ 'custom-border', $settings['sub_heading_bd_direction'] ] ] );
        }

        // Description
        if( 'yes' === $settings['desc_animation'] ){
            if( 'normal' == $settings['desc_anim_type'] ) {
                $this->add_render_attribute( 'desc', [ 
                    'class' => [ 'wow', 'hq-desc', 'hq-' . $settings['desc_normal_anim_effect'] ],
                    'data-wow-offset' => $settings['desc_anim_offset'],
                    'data-wow-delay' => $settings['desc_anim_delay'] . 'ms',
                    'data-wow-duration' => $settings['desc_anim_duration'] . 'ms'
                ] );
            }else{
                $this->add_render_attribute( 'desc', [ 
                    'class' => [ 'wow', 'hq-desc', 'hq-' . $settings['desc_splitting_anim_effect'] ],
                    'data-splitting' => ''
                ] );
            }
        }else{
            $this->add_render_attribute( 'desc', [ 'class' => 'hq-desc' ] );
        }
        
        echo '<div '. $this->get_render_attribute_string( 'wrapper' ) .'>';
        if( 'yes' === $settings['wrapper_overlay'] ) {
            echo '<div class="overlay"></div>';
        } ?>
        <div class="hq-heading-wrap">
            <?php if( ! empty( $settings[ 'sub_heading' ] ) ) : ?>
                <<?php echo esc_attr( $settings['sub_heading_tag'] ); ?> <?php echo $this->get_render_attribute_string( 'sub_heading_anim_handler' ); ?>>
                <span <?php echo $this->get_render_attribute_string( 'sub_heading' ); ?>><?php echo Helper::kses_basic( $settings[ 'sub_heading' ] ); ?></span>
            </<?php echo esc_attr( $settings['sub_heading_tag'] ); ?>>
            <?php endif;?>
            <?php if( ! empty( $settings[ 'heading' ] ) ) : ?>
            <<?php echo esc_attr( $settings['tag'] ); ?> <?php echo $this->get_render_attribute_string( 'heading_anim_handler' ); ?>>
                <?php if( $preview_mode ) : ?>
                    <span <?php echo $this->get_render_attribute_string( 'heading' ); ?>><?php echo Helper::kses_advance( Helper::get_highlighted_text( $settings[ 'heading' ] ) ); ?></span>
                <?php else: ?>
                    <?php echo Helper::kses_advance( Helper::get_highlighted_text( $settings[ 'heading' ] ) ); ?>
                <?php endif; ?>
            </<?php echo esc_attr( $settings['tag'] ); ?>>
            <?php endif; ?>
            <?php if( ! empty( $settings['desc'] ) ) : ?>
                <p <?php echo $this->get_render_attribute_string( 'desc' ); ?>><?php echo Helper::kses_basic( $settings[ 'desc' ] ); ?></p>
            <?php endif; ?>
        </div>
        <?php
            echo do_shortcode( $this->get_shortcode() );
        echo '</div>';
    }

    /**
     * Get Contact Form 7 Shortcode
     */
    private function get_shortcode() {
        $settings = $this->get_settings();

        if ( ! $settings['contact_form'] ) {
            return '<div class="alert alert-warning" role="alert">' . __( 'Please select a Contact Form From Setting!', 'edumentor' ) . '</div>';
        }

        $attributes = [
            'id' => $settings['contact_form'],
        ];

        $this->add_render_attribute( 'shortcode', $attributes );

        $shortcode   = [];
        $shortcode[] = sprintf( '[contact-form-7 %s]', $this->get_render_attribute_string( 'shortcode' ) );

        return implode( "", $shortcode );
    }

}