<?php
/**
 * Working Hours
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\WorkingHours;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
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
        return 'edumentor-working-hours';
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
        return esc_html__( 'Working Hours', 'edumentor' );
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
        return 'edumentor-icon eicon-clock-o';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'business hours', 'working hours', 'office hours', 'opening hours', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'hq-main' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_business_hours();
        $this->section_item_area_style();
        $this->section_item_style();
        $this->section_day_style();
        $this->section_time_style();
        
    }

    // Business Hours
    protected function section_business_hours() {

        $this->start_controls_section(
            'businesshours_content',
            [
                'label' => esc_html__( 'Business Hours', 'edumentor' ),
            ]
        );

            $repeater = new Repeater();

            $repeater->add_control(
                'business_day',
                [
                    'label'   => esc_html__( 'Day', 'edumentor' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Saturday', 'edumentor' ),
                ]
            );

            $repeater->add_control(
                'business_time',
                [
                    'label'   => esc_html__( 'Time', 'edumentor' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( '9:00 AM - 6:00 PM', 'edumentor' ),
                ]
            );

            $repeater->add_control(
                'highlight_this_day',
                [
                    'label'        => esc_html__( 'Hight Light this day', 'edumentor' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );

            $repeater->add_control(
                'single_business_day_color',
                [
                    'label'     => esc_html__( 'Day Color', 'edumentor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#fa2d2d',
                    'selectors' => [
                        '{{WRAPPER}} .hq-single-hrs{{CURRENT_ITEM}}.hq-single-hrs.closed-day span.day' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'highlight_this_day' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );

            $repeater->add_control(
                'single_business_time_color',
                [
                    'label'     => esc_html__( 'Time Color', 'edumentor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#fa2d2d',
                    'selectors' => [
                        '{{WRAPPER}} .hq-single-hrs{{CURRENT_ITEM}}.hq-single-hrs.closed-day span.time' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'highlight_this_day' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );

            $repeater->add_control(
                'single_business_background_color',
                [
                    'label'     => esc_html__( 'Background Color', 'edumentor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hq-single-hrs{{CURRENT_ITEM}}.hq-single-hrs.closed-day' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'highlight_this_day' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'business_openday_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'business_day' => esc_html__( 'Saturday', 'edumentor' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','edumentor' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Sunday', 'edumentor' ),
                            'business_time' => esc_html__( 'Close','edumentor' ),
                            'highlight_this_day' => esc_html__( 'yes','edumentor' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Monday', 'edumentor' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','edumentor' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Tues Day', 'edumentor' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','edumentor' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Wednesday', 'edumentor' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','edumentor' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Thursday', 'edumentor' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','edumentor' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Friday', 'edumentor' ),
                            'business_time' => esc_html__( '9:00 AM to 6:30 PM','edumentor' ),
                        ]
                    ],
                    'title_field' => '{{{ business_day }}}',
                ]
            );
            
        $this->end_controls_section();

    }

    // Item Area Style
    protected function section_item_area_style() {

        $this->start_controls_section(
            'business_item_area_style_section',
            [
                'label' => esc_html__( 'Item Area', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'business_item_area_background',
                    'label' => esc_html__( 'Background', 'edumentor' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .hq-business-hours .business-hrs-inner',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'business_item_area_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'edumentor' ),
                    'selector' => '{{WRAPPER}} .hq-business-hours .business-hrs-inner',
                ]
            );

            $this->add_responsive_control(
                'business_item_area_margin',
                [
                    'label' => esc_html__( 'Margin', 'edumentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .hq-business-hours .business-hrs-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'business_item_area_padding',
                [
                    'label' => esc_html__( 'Padding', 'edumentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .hq-business-hours .business-hrs-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'after',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'business_item_area_border',
                    'label' => esc_html__( 'Border', 'edumentor' ),
                    'selector' => '{{WRAPPER}} .hq-business-hours .business-hrs-inner',
                ]
            );

            $this->add_responsive_control(
                'business_item_area_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'edumentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .hq-business-hours .business-hrs-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    // Item Style
    protected function section_item_style() {

        $this->start_controls_section(
            'business_item_style_section',
            [
                'label' => esc_html__( 'Item', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'business_item_margin',
                [
                    'label' => esc_html__( 'Margin', 'edumentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .hq-business-hours .hq-single-hrs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'business_item_padding',
                [
                    'label' => esc_html__( 'Padding', 'edumentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .hq-business-hours .hq-single-hrs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'after',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'business_item_border',
                    'label' => esc_html__( 'Border', 'edumentor' ),
                    'selector' => '{{WRAPPER}} .hq-business-hours .hq-single-hrs',
                ]
            );

            $this->add_responsive_control(
                'business_item_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'edumentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .hq-business-hours .hq-single-hrs' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            
        $this->end_controls_section();

    }

    // Day Style
    protected function section_day_style() {

        $this->start_controls_section(
            'business_day_style_section',
            [
                'label' => esc_html__( 'Day', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'business_day_color',
                [
                    'label'     => esc_html__( 'color', 'edumentor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hq-business-hours .hq-single-hrs span.day' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'business_day_typography',
                    'selector' => '{{WRAPPER}} .hq-business-hours .hq-single-hrs span.day',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'business_day_background',
                    'label' => esc_html__( 'Background', 'edumentor' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .hq-business-hours .hq-single-hrs span.day',
                ]
            );
            
        $this->end_controls_section();

    }

    // Time Style
    protected function section_time_style() {

        $this->start_controls_section(
            'business_time_style_section',
            [
                'label' => esc_html__( 'Time', 'edumentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'business_time_color',
                [
                    'label'     => esc_html__( 'color', 'edumentor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hq-business-hours .hq-single-hrs span.time' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'business_time_typography',
                    'selector' => '{{WRAPPER}} .hq-business-hours .hq-single-hrs span.time',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'business_time_background',
                    'label' => esc_html__( 'Background', 'edumentor' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .hq-business-hours .hq-single-hrs span.time',
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

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'fp_business_hours', 'class', 'hq-business-hours' ); ?>

        <div <?php echo $this->get_render_attribute_string( 'fp_business_hours' ); ?>>
            <div class="business-hrs-inner">
                <?php
                if($settings['business_openday_list'] > 0) :
                    foreach ( $settings['business_openday_list'] as  $index => $item ):
                        $business_day = $this->get_repeater_setting_key('business_day', 'business_openday_list', $index );
                        $business_time = $this->get_repeater_setting_key('business_time', 'business_openday_list', $index );
                        $this->add_inline_editing_attributes( $business_day, 'none');
                        $this->add_inline_editing_attributes( $business_time, 'none'); ?>
                        
                    <div class="hq-single-hrs elementor-repeater-item-<?php echo $item['_id']; ?> <?php if( $item['highlight_this_day'] == 'yes' ){ echo esc_attr( 'closed-day' ); }?>">
                        <?php
                            if( !empty( $item['business_day'] ) ){
                                echo '<span class="day"><span '. $this->get_render_attribute_string($business_day) .'>'.esc_html( $item['business_day'] ).'</span></span>';
                            }
                            if( !empty( $item['business_time'] ) ){
                                echo '<span class="time"><span '. $this->get_render_attribute_string($business_time) .'>'.esc_html( $item['business_time'] ).'</span>';
                            }
                        ?>
                    </div>
                <?php endforeach;
                endif;
                ?>
            </div>
        </div>

        <?php
       
    }

    /**
	 * Render output in the editor.
	 */
    protected function content_template() {
        ?>
        <# view.addRenderAttribute( 'fp_business_hours', 'class', 'hq-business-hours' ); #>
        <div {{{ view.getRenderAttributeString( 'fp_business_hours' ) }}}>
            <div class="business-hrs-inner">
            <#
            if(settings.business_openday_list.length){
                _.each(settings.business_openday_list, function(item, index){ 
                var business_day = view.getRepeaterSettingKey('business_day', 'business_openday_list', index);	
                var business_time = view.getRepeaterSettingKey('business_time', 'business_openday_list', index);
                view.addInlineEditingAttributes(business_day, 'none');	
                view.addInlineEditingAttributes(business_time, 'none');
                if(item.highlight_this_day === 'yes'){
                    var closeStatus = 'closed-day';
                }else{
                    var closeStatus = '';
                }
            #>
                <div class="hq-single-hrs elementor-repeater-item-{{{item._id}}} {{{closeStatus}}}">
                    <# if('' != item.business_day){ #>
                    <span class="day">
                        <span {{{ view.getRenderAttributeString(business_day) }}}>{{{item.business_day}}}</span>
                    </span>
                    <# } #>
                    <# if('' != item.business_time){ #>
                    <span class="time">
                            <span {{{ view.getRenderAttributeString(business_time) }}}>{{{item.business_time}}}</span>
                    </span>
                    <# } #>
                </div>
            <# });
            } #>
            </div>
        </div>
        <?php
    }
    

}