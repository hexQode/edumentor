<?php
/**
 * Working Hours
 *
 * @package FlatPack
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
        return 'flatpack-working-hours';
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
        return esc_html__( 'Working Hours', 'flatpack' );
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
        return 'fq-icon eicon-clock-o';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'business hours', 'working hours', 'office hours', 'opening hours', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'fp-main' ];
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
                'label' => esc_html__( 'Business Hours', 'flatpack' ),
            ]
        );

            $repeater = new Repeater();

            $repeater->add_control(
                'business_day',
                [
                    'label'   => esc_html__( 'Day', 'flatpack' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Saturday', 'flatpack' ),
                ]
            );

            $repeater->add_control(
                'business_time',
                [
                    'label'   => esc_html__( 'Time', 'flatpack' ),
                    'type'    => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( '9:00 AM - 6:00 PM', 'flatpack' ),
                ]
            );

            $repeater->add_control(
                'highlight_this_day',
                [
                    'label'        => esc_html__( 'Hight Light this day', 'flatpack' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );

            $repeater->add_control(
                'single_business_day_color',
                [
                    'label'     => esc_html__( 'Day Color', 'flatpack' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#fa2d2d',
                    'selectors' => [
                        '{{WRAPPER}} .fp-single-hrs{{CURRENT_ITEM}}.fp-single-hrs.closed-day span.day' => 'color: {{VALUE}}',
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
                    'label'     => esc_html__( 'Time Color', 'flatpack' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#fa2d2d',
                    'selectors' => [
                        '{{WRAPPER}} .fp-single-hrs{{CURRENT_ITEM}}.fp-single-hrs.closed-day span.time' => 'color: {{VALUE}}',
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
                    'label'     => esc_html__( 'Background Color', 'flatpack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fp-single-hrs{{CURRENT_ITEM}}.fp-single-hrs.closed-day' => 'background-color: {{VALUE}}',
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
                            'business_day' => esc_html__( 'Saturday', 'flatpack' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','flatpack' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Sunday', 'flatpack' ),
                            'business_time' => esc_html__( 'Close','flatpack' ),
                            'highlight_this_day' => esc_html__( 'yes','flatpack' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Monday', 'flatpack' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','flatpack' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Tues Day', 'flatpack' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','flatpack' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Wednesday', 'flatpack' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','flatpack' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Thursday', 'flatpack' ),
                            'business_time' => esc_html__( '9:00 AM to 6:00 PM','flatpack' ),
                        ],

                        [
                            'business_day' => esc_html__( 'Friday', 'flatpack' ),
                            'business_time' => esc_html__( '9:00 AM to 6:30 PM','flatpack' ),
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
                'label' => esc_html__( 'Item Area', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'business_item_area_background',
                    'label' => esc_html__( 'Background', 'flatpack' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .fp-business-hours .business-hrs-inner',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'business_item_area_box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'flatpack' ),
                    'selector' => '{{WRAPPER}} .fp-business-hours .business-hrs-inner',
                ]
            );

            $this->add_responsive_control(
                'business_item_area_margin',
                [
                    'label' => esc_html__( 'Margin', 'flatpack' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .fp-business-hours .business-hrs-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'business_item_area_padding',
                [
                    'label' => esc_html__( 'Padding', 'flatpack' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .fp-business-hours .business-hrs-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'after',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'business_item_area_border',
                    'label' => esc_html__( 'Border', 'flatpack' ),
                    'selector' => '{{WRAPPER}} .fp-business-hours .business-hrs-inner',
                ]
            );

            $this->add_responsive_control(
                'business_item_area_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'flatpack' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .fp-business-hours .business-hrs-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                'label' => esc_html__( 'Item', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'business_item_margin',
                [
                    'label' => esc_html__( 'Margin', 'flatpack' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .fp-business-hours .fp-single-hrs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'business_item_padding',
                [
                    'label' => esc_html__( 'Padding', 'flatpack' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .fp-business-hours .fp-single-hrs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'after',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'business_item_border',
                    'label' => esc_html__( 'Border', 'flatpack' ),
                    'selector' => '{{WRAPPER}} .fp-business-hours .fp-single-hrs',
                ]
            );

            $this->add_responsive_control(
                'business_item_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'flatpack' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .fp-business-hours .fp-single-hrs' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                'label' => esc_html__( 'Day', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'business_day_color',
                [
                    'label'     => esc_html__( 'color', 'flatpack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fp-business-hours .fp-single-hrs span.day' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'business_day_typography',
                    'selector' => '{{WRAPPER}} .fp-business-hours .fp-single-hrs span.day',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'business_day_background',
                    'label' => esc_html__( 'Background', 'flatpack' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .fp-business-hours .fp-single-hrs span.day',
                ]
            );
            
        $this->end_controls_section();

    }

    // Time Style
    protected function section_time_style() {

        $this->start_controls_section(
            'business_time_style_section',
            [
                'label' => esc_html__( 'Time', 'flatpack' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'business_time_color',
                [
                    'label'     => esc_html__( 'color', 'flatpack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .fp-business-hours .fp-single-hrs span.time' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'business_time_typography',
                    'selector' => '{{WRAPPER}} .fp-business-hours .fp-single-hrs span.time',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'business_time_background',
                    'label' => esc_html__( 'Background', 'flatpack' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .fp-business-hours .fp-single-hrs span.time',
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

        $this->add_render_attribute( 'fp_business_hours', 'class', 'fp-business-hours' ); ?>

        <div <?php echo $this->get_render_attribute_string( 'fp_business_hours' ); ?>>
            <div class="business-hrs-inner">
                <?php
                if($settings['business_openday_list'] > 0) :
                    foreach ( $settings['business_openday_list'] as  $index => $item ):
                        $business_day = $this->get_repeater_setting_key('business_day', 'business_openday_list', $index );
                        $business_time = $this->get_repeater_setting_key('business_time', 'business_openday_list', $index );
                        $this->add_inline_editing_attributes( $business_day, 'none');
                        $this->add_inline_editing_attributes( $business_time, 'none'); ?>
                        
                    <div class="fp-single-hrs elementor-repeater-item-<?php echo $item['_id']; ?> <?php if( $item['highlight_this_day'] == 'yes' ){ echo esc_attr( 'closed-day' ); }?>">
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
        <# view.addRenderAttribute( 'fp_business_hours', 'class', 'fp-business-hours' ); #>
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
                <div class="fp-single-hrs elementor-repeater-item-{{{item._id}}} {{{closeStatus}}}">
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