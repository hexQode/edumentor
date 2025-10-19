<?php
/**
 * List Pricing
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\ListPricing;

use HexQode\EduMentor\Classes\Helper;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

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
        return 'edumentor-list-pricing';
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
        return esc_html__( 'List Pricing', 'edumentor' );
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
        return 'edumentor-icon eicon-bullet-list';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'pricing', 'list pricing', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'hq-main' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->general_section();
        $this->pricing_list_section();
        $this->heading_style();
        $this->price_style();
        $this->border_style();
        $this->desc_style();
        
    }

    /**
     * General Section
     *
     * @return void
     */
    protected function general_section() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'edumentor' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'list_background',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .hq-pricing-list li',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_border',
                'label'    => esc_html__( 'Border', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-pricing-list li',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .hq-pricing-list li',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-pricing-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-pricing-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bottom_spacing',
            [
                'label'     => esc_html__( 'Bottom Spacing', 'edumentor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hq-pricing-list li:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Pricing List Section
     *
     * @return void
     */
    protected function pricing_list_section() {

        $this->start_controls_section(
            'pricing_list_section',
            [
                'label' => esc_html__( 'Pricing List', 'edumentor' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'heading', [
                'label'       => esc_html__( 'Heading', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'price', [
                'label'       => esc_html__( 'Price', 'edumentor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desc', [
                'label'       => esc_html__( 'Description', 'edumentor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'customize',
            [
                'label' => esc_html__( 'Want to customize?', 'edumentor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'edumentor' ),
                'label_off' => esc_html__( 'no', 'edumentor' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'pricing_bg',
                'label'    => esc_html__( 'Background', 'edumentor' ),
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'condition' => [
                    'customize' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Heading Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pricing-header h4' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pricing-header .hq-price' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Description Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Border Color', 'edumentor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pricing-header .pricing-border' => 'border-bottom-color: {{VALUE}}',
                ],
                'condition' => [
                    'customize' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pricing_list',
            [
                'label'       => esc_html__( 'Pricing List', 'edumentor' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'heading' => esc_html__( 'Hair Cut', 'edumentor' ),
                        'price'   => esc_html__( '$29.00', 'edumentor' ),
                        'desc'    => esc_html__( 'Barber is a person whose occupation is mainly to cut dress groom style and shave men.', 'edumentor' ),
                    ],
                    [
                        'heading' => esc_html__( 'Hair Styling', 'edumentor' ),
                        'price'   => esc_html__( '$39.00', 'edumentor' ),
                        'desc'    => esc_html__( 'Barber is a person whose occupation is mainly to cut dress groom style and shave men.', 'edumentor' ),
                    ],
                    [
                        'heading' => esc_html__( 'Hair Triming', 'edumentor' ),
                        'price'   => esc_html__( '$49.00', 'edumentor' ),
                        'desc'    => esc_html__( 'Barber is a person whose occupation is mainly to cut dress groom style and shave men.', 'edumentor' ),
                    ],
                ],
                'title_field' => '{{{ heading }}}',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Heading Style
     *
     * @return void
     */
    protected function heading_style() {

        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .pricing-header h4',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-header h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-header h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-header h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Price Style
     *
     * @return void
     */
    protected function price_style() {

        $this->start_controls_section(
            'price_style',
            [
                'label' => esc_html__( 'Price', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'price_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .pricing-header .hq-price',
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-header .hq-price' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-header .hq-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-header .hq-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Border Style
     *
     * @return void
     */
    protected function border_style() {

        $this->start_controls_section(
            'border_style',
            [
                'label' => esc_html__( 'Border', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'bd_width',
            [
                'label'      => esc_html__( 'Border Width', 'edumentor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 10,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-header .pricing-border' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bd_style',
            [
                'label'     => esc_html__( 'Border Style', 'edumentor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dashed',
                'options'   => [
                    'dotted' => esc_html__( 'Dotted', 'edumentor' ),
                    'dashed' => esc_html__( 'Dashed', 'edumentor' ),
                    'solid'  => esc_html__( 'Solid', 'edumentor' ),
                    'double' => esc_html__( 'Double', 'edumentor' ),
                    'none'   => esc_html__( 'None', 'edumentor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-header .pricing-border' => 'border-bottom-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bd_color',
            [
                'label'     => esc_html__( 'Border Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-header .pricing-border' => 'border-bottom-color: {{VALUE}}',
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
    protected function desc_style() {

        $this->start_controls_section(
            'desc_style',
            [
                'label' => esc_html__( 'Description', 'edumentor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'label'    => esc_html__( 'Typography', 'edumentor' ),
                'selector' => '{{WRAPPER}} .hq-pricing-list li p',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Text Color', 'edumentor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hq-pricing-list li p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label'      => esc_html__( 'Padding', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-pricing-list li p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label'      => esc_html__( 'Margin', 'edumentor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .hq-pricing-list li p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->add_render_attribute( 'wrapper', 'class', 'hq-pricing-list' );
        
        if( $settings['pricing_list'] > 0 ) :
            ?>
            <ul <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
                <?php foreach ( $settings['pricing_list'] as  $index => $item ) : 
                    $repeater_setting_key_heading = $this->get_repeater_setting_key( 'heading', 'pricing_list', $index );
                    $this->add_inline_editing_attributes( $repeater_setting_key_heading );
                    $repeater_setting_key_price = $this->get_repeater_setting_key( 'price', 'pricing_list', $index );
                    $this->add_render_attribute( $repeater_setting_key_price, 'class', 'hq-price' );
                    $this->add_inline_editing_attributes( $repeater_setting_key_price );
                    $repeater_setting_key_desc = $this->get_repeater_setting_key( 'desc', 'pricing_list', $index );
                    $this->add_inline_editing_attributes( $repeater_setting_key_desc ); 
                ?>
                <li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
                <?php if( ! empty( $item['heading'] || $item['price'] ) ) : ?>
                    <div class="pricing-header">
                        <?php if( $item['heading'] ) : ?>
                        <h4 <?php $this->print_render_attribute_string( $repeater_setting_key_heading ); ?>><?php echo esc_html( $item['heading']  ); ?></h4>
                        <?php endif; ?>
                        <span class="pricing-border"></span>
                        <?php if( $item['price'] ) : ?>
                        <span <?php $this->print_render_attribute_string( $repeater_setting_key_price ); ?>><?php echo esc_html( $item['price'] ); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if( $item['desc'] ) : ?>
                    <p <?php $this->print_render_attribute_string( $repeater_setting_key_desc ); ?>><?php echo Helper::kses_basic( $item['desc'] ); ?></p>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php
            endif;

    }

}