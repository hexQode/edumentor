<?php
/**
 * Marquee Text
 *
 * @package EduMentor
 */
namespace HexQode\EduMentor\Elementor\Widgets\MarqueeText;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Repeater;
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
        return 'edumentor-marquee-text';
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
        return esc_html__( 'Marquee Text', 'edumentor' );
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
        return 'edumentor-icon eicon-slider-push';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return ['marquee text', 'running text', 'text slide', 'edumentor'];
    }

    public function get_style_depends() {
        return [ 'edumentor-marquee-text', 'elementor-icons-fa-regular' ];
    }

    public function get_script_depends() {
        return [ 'edumentor-el-script' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->marquee_text_section();
        $this->marquee_text_options();
        $this->marquee_text_wrap();
        $this->marquee_text_typo();
        $this->marquee_text_icon();

    }

    /**
     * Marquee Text Section
     *
     * @return void
     */
    protected function marquee_text_section() {

        $this->start_controls_section(
            'marquee_text_section',
            [
                'label' => esc_html__( 'Marquee Text', 'edumentor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text', [
                'label'       => esc_html__( 'Text', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Marquee Text', 'edumentor' ),
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label'   => esc_html__( 'Icon', 'edumentor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'la la-snowflake',
                    'library' => 'elementor-icons-line-awesome-icons',
                ],
                'condition' => [
                    'text!' => ''
                ]
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
                    'text!'    => ''
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
                'description'  => esc_html__( 'You can customize this list from here.', 'edumentor' ),
                'condition'    => [
                    'text!'    => ''
                ]
            ]
        );

        $repeater->add_control(
            'text_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes',
                    'text!'    => ''
                ]
            ]
        );

        $repeater->add_control(
            'link_hover_color',
            [
                'label'     => esc_html__( 'Link Hover Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes',
                    'text!' => '',
                    'link[url]!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes',
                    'text!'    => '',
                    'icon[value]!' => ''
                ],
            ]
        );
        
        $this->add_control(
            'list_items',
            [
                'label'       => esc_html__( 'Items', 'edumentor' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'icon'   => [
                            'value'   => 'far fa-snowflake',
                            'library' => 'elementor-icons-fa-regular',
                        ],
                        'text' => esc_html__( 'let’s Make Something Amazing Together', 'edumentor' )
                    ],
                    [
                        'icon'   => [
                            'value'   => 'far fa-snowflake',
                            'library' => 'elementor-icons-fa-regular',
                        ],
                        'text' => esc_html__( 'Trusted by over 6.000 Ambitious Brands Across the US', 'edumentor' )
                    ],
                    [
                        'icon'   => [
                            'value'   => 'far fa-snowflake',
                            'library' => 'elementor-icons-fa-regular',
                        ],
                        'text' => esc_html__( 'Plus we’ve picked up plenty of awards and industry recognition', 'edumentor' )
                    ]
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) }}} {{{ text }}}'
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Marquee Text Options
     *
     * @return void
     */
    protected function marquee_text_options() {

        $this->start_controls_section(
            'marquee_text_options',
            [
                'label' => esc_html__( 'Options', 'edumentor' ),
            ]
        );

        $this->add_responsive_control(
            'spacebetween_item',
            [
                'label' => esc_html__( 'Space Between', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller-wrap' => '--edumentor-scroll-item-gap: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => esc_html__( 'Direction', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__( 'Left', 'edumentor' ),
                    'right' => esc_html__( 'Right', 'edumentor' )
                ]
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__( 'Pause on Hover', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edumentor' ),
                'label_off' => esc_html__( 'No', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__( 'Speed', 'edumentor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'slow',
                'options' => [
                    'slow' => esc_html__( 'Slow', 'edumentor' ),
                    'fast' => esc_html__( 'Fast', 'edumentor' ),
                    'custom'  => esc_html__( 'Custom', 'edumentor' )
                ],
            ]
        );

        $this->add_responsive_control(
            'custom_speed',
            [
                'label' => esc_html__( 'Custom Speed', 'edumentor' ),
                'description' => esc_html__( 'Speed will be calculated in seconds.', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.5,
                        'max' => 180,
                        'step' => 0.5
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller[data-speed="custom"]' => '--_hq-animation-duration: {{SIZE}}s;'
                ],
                'condition' => [
                    'speed' => 'custom'
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Marquee Text Wrap
     *
     * @return void
     */
    protected function marquee_text_wrap() {

        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => esc_html__( 'Wrapper', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_bg',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .hq-scroller',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_bd',
                'selector' => '{{WRAPPER}} .hq-scroller',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .hq-scroller',
            ]
        );

        $this->add_responsive_control(
            'wrapper_width',
            [
                'label' => esc_html__( 'width', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 150
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'wrapper_rotate',
            [
                'label' => esc_html__( 'Rotate', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller' => 'transform: rotate({{SIZE}}deg);'
                ]
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => esc_html__( 'Padding', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => esc_html__( 'Margin', 'edumentor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Marquee Text Typo
     *
     * @return void
     */
    protected function marquee_text_typo() {

        $this->start_controls_section(
            'text_style',
            [
                'label' => esc_html__( 'Text', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .hq-scroller__inner li',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller__inner li, {{WRAPPER}} .hq-scroller__inner li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_link_hover_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller__inner li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Marquee Text Icon
     *
     * @return void
     */
    protected function marquee_text_icon() {

        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'edumentor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                        'step' => 1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller__inner li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hq-scroller__inner li svg' => 'width: auto; height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-scroller__inner li i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .hq-scroller__inner li svg' => 'fill: {{VALUE}}'
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
        $items = $settings['list_items'];
        $speed = ! empty( $settings['speed'] ) ? $settings['speed'] : 'slow';
        $pause_on_hover = 'yes' === $settings['pause_on_hover'] ? ' is-hover-pause' : '';
        $direction = ! empty( $settings['direction'] ) ? $settings['direction'] : 'left';
        $this->add_render_attribute( 'wrapper', 'class', 'hq-scroller-wrap' );
        ?>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <?php if($items) : ?>
            <div class="hq-scroller<?php echo esc_attr( $pause_on_hover ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-direction="<?php echo esc_attr( $direction ); ?>">
                <ul class="hq-scroller__inner">
                    <?php
                    foreach( $items as $index => $item ) {
                        if( ! empty( $item['text'] ) ) {
                            if ( ! empty( $item['link']['url'] ) ) {
                                $link_key = 'link_' . $index;
                                $this->add_link_attributes( $link_key, $item['link'] );
                            }
                            echo '<li class="elementor-repeater-item-'. $item['_id'] .'">';
                                if( $item['link']['url'] ) {
                                    echo '<a '. $this->get_render_attribute_string( $link_key ) .'>'. esc_html( $item['text'] ) .'</a>';
                                }else{
                                    echo esc_html( $item['text'] );
                                }
                                Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php else:
                esc_html_e( 'No text found! Please add the text from the side panel.', 'edumentor' );
            endif; ?>
        </div>
        <?php
    }

}