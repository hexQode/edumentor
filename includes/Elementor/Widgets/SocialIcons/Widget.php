<?php
/**
 * Social Icons
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\SocialIcons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

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
        return 'edumentor-social-icons';
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
        return esc_html__( 'Social Icons', 'edumentor' );
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
        return 'edumentor-icon eicon-social-icons';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'icons', 'social', 'social icons', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'edumentor-main', 'elementor-icons-fa-brands' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_layout();
        $this->social_icons_section();
        $this->icon_style();
        
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

        $this->add_control(
            'hover_effect',
            [
                'label'   => esc_html__( 'Effect', 'edumentor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1' => esc_html__( 'Style 1', 'edumentor' ),
                    'style-2' => esc_html__( 'Style 2', 'edumentor' ),
                    'style-3' => esc_html__( 'Style 3', 'edumentor' )
                ],
            ]
        );

        $this->add_responsive_control(
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
                    'right' => [
                        'title' => esc_html__( 'Right', 'edumentor' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle'  => false,
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right' => 'justify-content: flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-social-items' => '{{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'social_icon_spacing',
            [
                'label' => esc_html__( 'Space Between Icon', 'textdomain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-social-items' => 'gap: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-social-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Social Icons
     *
     * @return void
     */
    protected function social_icons_section() {

        $this->start_controls_section(
            'social_icons_section',
            [
                'label' => esc_html__( 'Social Links', 'edumentor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label'   => esc_html__( 'Icon', 'edumentor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fab fa-facebook-f',
                    'library' => 'brands',
                ],
                'recommended' => [
					'fa-brands' => [
						'facebook',
						'facebook-f',
						'facebook-square',
						'fa-x-twitter',
						'fa-x-twitter-square',
						'twitter',
						'twitter-square',
						'instagram',
						'pinterest',
						'pinterest-p',
						'pinterest-square',
						'linkedin',
						'linkedin-in',
						'dribbble',
						'dribbble-square',
						'youtube',
						'youtube-square',
						'whatsapp',
						'whatsapp-square',
						'tiktok',
						'reddit',
						'skype',
					]
				],
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
                   'icon[value]!'    => ''
                ],
            ]
        );

        $repeater->add_control(
            'custom_style',
            [
                'label'        => esc_html__( 'Custom Color', 'edumentor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'edumentor' ),
                'label_off'    => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'custom_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} a, {{WRAPPER}} .style-2 {{CURRENT_ITEM}} a .blob-hq-btn__inner',
                'condition'    => [
                   'custom_style'    => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'custom_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a' => 'color: {{VALUE}}'
                ],
                'condition'    => [
                   'custom_style'    => 'yes'
                ],
            ]
        );

        $repeater->add_control(
            'hover_styles_heading',
            [
                'label' => esc_html__( 'Hover Styles', 'textdomain' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'    => [
                   'custom_style'    => 'yes',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'custom_hover_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .style-1 {{CURRENT_ITEM}} a:before, {{WRAPPER}} .style-1 {{CURRENT_ITEM}} a:after, {{WRAPPER}} .style-2 {{CURRENT_ITEM}} a .blob-hq-btn__blob, {{WRAPPER}} .style-3 {{CURRENT_ITEM}} a:hover',
                'condition'    => [
                   'custom_style'    => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'custom_icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}}'
                ],
                'condition'    => [
                   'custom_style'    => 'yes'
                ],
            ]
        );
        
        $this->add_control(
            'social_links',
            [
                'label'       => esc_html__( 'Social Links', 'edumentor' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'icon'   => [
                            'value'   => 'fab fa-facebook-f',
                            'library' => 'fa-brands',
                        ],
                        'link' => [
                            'url'         => '#',
                            'is_external' => true,
                            'nofollow'    => true,
                        ]
                    ],
                    [
                        'icon'   => [
                            'value'   => 'fab fa-x-twitter',
                            'library' => 'fa-brands',
                        ],
                        'link' => [
                            'url'         => '#',
                            'is_external' => true,
                            'nofollow'    => true,
                        ]
                    ],
                    [
                        'icon'   => [
                            'value'   => 'fab fa-instagram',
                            'library' => 'fa-brands',
                        ],
                        'link' => [
                            'url'         => '#',
                            'is_external' => true,
                            'nofollow'    => true,
                        ]
                    ],
                    [
                        'icon'   => [
                            'value'   => 'fab fa-youtube',
                            'library' => 'fa-brands',
                        ],
                        'link' => [
                            'url'         => '#',
                            'is_external' => true,
                            'nofollow'    => true,
                        ]
                    ],
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) }}}',
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
        
        $this->add_responsive_control(
            'width',
            [
                'label'      => esc_html__( 'Width', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 200,
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-social-items a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label'      => esc_html__( 'Height', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 200,
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-social-items a' => 'height: {{SIZE}}{{UNIT}};',
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
                        'min'  => 10,
                        'max'  => 200,
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hq-social-items a' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hq-social-items a svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'icon_style_tabs' );
        
        $this->start_controls_tab(
            'icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'icon_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'esclude'  => ['image'],
                'selector' => '{{WRAPPER}} .hq-social-items.style-1 a,{{WRAPPER}} .hq-social-items.style-2 a .blob-hq-btn__inner, {{WRAPPER}} .hq-social-items.style-3 a',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-social-items a' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .hq-social-items a',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-social-items a',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-social-items a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'icon_hover_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'esclude'  => ['image'],
                'selector' => '{{WRAPPER}} .hq-social-items.style-1 a:before, {{WRAPPER}} .hq-social-items.style-1 a:after, {{WRAPPER}} .hq-social-items.style-2 a .blob-hq-btn__blob, {{WRAPPER}} .hq-social-items.style-3 a:hover',
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-social-items a:hover' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_hover_box_shadow',
                'selector' => '{{WRAPPER}} .hq-social-items a:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_hover_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-social-items a:hover',
            ]
        );

        $this->add_responsive_control(
            'icon_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-social-items a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_render_attribute( 'wrapper', 'class', 'hq-social-items' . ' ' . $settings['hover_effect'] );
        $social_links = $settings['social_links'];

        if( $social_links ) {
            echo '<ul '. $this->get_render_attribute_string('wrapper') .'>';
            foreach ( $social_links as $index => $item ) {
                if ( ! empty( $item['link']['url'] && $item['icon']['value'] ) ) {
                    $link_key = 'link_' . $index;
                    $this->add_link_attributes( $link_key, $item['link'] ); ?>
                    <li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
                        <a <?php $this->print_render_attribute_string( $link_key ); ?>>
                            <?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php if( 'style-2' === $settings['hover_effect'] ) : ?>
                            <span class="blob-hq-btn__inner">
                                <span class="blob-hq-btn__blobs">
                                    <span class="blob-hq-btn__blob"></span>
                                    <span class="blob-hq-btn__blob"></span>
                                    <span class="blob-hq-btn__blob"></span>
                                    <span class="blob-hq-btn__blob"></span>
                                </span>
                            </span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php
                }
            }
            echo '</ul>';
        }
       
    }

}