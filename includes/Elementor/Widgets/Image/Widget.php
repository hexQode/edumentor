<?php
/**
 * Image
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace DynamicLayers\FlatPack\Elementor\Widgets\Image;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;
use Elementor\Plugin;
use DynamicLayers\FlatPack\Classes\Helper;

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
        return 'flatpack-image';
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
        return esc_html__( 'Image', 'flatpack' );
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
        return 'fq-icon eicon-image';
    }

    public function get_categories() {
        return ['flatpack'];
    }

    public function get_keywords() {
        return [ 'image', 'parallax', 'img', 'flatpack' ];
    }

    public function get_style_depends() {
        return [ 'fp-image', 'fp-keyframes' ];
    }

    public function get_script_depends() {
        return [ 'flatpack-el-script', 'fp-parallax-scroll' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->section_image();
        $this->section_image_animation();
        $this->image_style();
        $this->image_caption_style();
        
    }

    /**
	 * Section Image
	 *
	 * @return void
	 */
    protected function section_image() {

        $this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'flatpack' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'flatpack' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'align',
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
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
                'toggle' => false
			]
		);

		$this->add_control(
			'caption_source',
			[
				'label' => esc_html__( 'Caption', 'flatpack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'flatpack' ),
					'attachment' => esc_html__( 'Attachment Caption', 'flatpack' ),
					'custom' => esc_html__( 'Custom Caption', 'flatpack' ),
				],
				'default' => 'none',
			]
		);

		$this->add_control(
			'caption',
			[
				'label' => esc_html__( 'Custom Caption', 'flatpack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Enter your image caption', 'flatpack' ),
				'condition' => [
					'caption_source' => 'custom',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => esc_html__( 'Link', 'flatpack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'flatpack' ),
					'file' => esc_html__( 'Media File', 'flatpack' ),
					'custom' => esc_html__( 'Custom URL', 'flatpack' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'flatpack' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'flatpack' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'show_label' => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => esc_html__( 'Lightbox', 'flatpack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'flatpack' ),
					'yes' => esc_html__( 'Yes', 'flatpack' ),
					'no' => esc_html__( 'No', 'flatpack' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->add_control(
            'image_blend_mode',
            [
                'label' => esc_html__( 'Blend Mode', 'flatpack' ),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'default' => 'inherit',
                'options' => [
                    'inherit' => esc_html__( 'Normal', 'flatpack' ),
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
                    '{{WRAPPER}} .el-image img' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', 'flatpack' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

    }

    /**
     * Section Image Animation
     *
     * @return void
     */
    protected function section_image_animation() {
        
        $this->start_controls_section(
			'section_image_animation',
			[
				'label' => esc_html__( 'Image Animation', 'flatpack' ),
			]
		);

        $this->add_control(
            'anim_control',
            [
                'label' => esc_html__( 'Animation', 'textdomain' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'textdomain' ),
                    'infinite'  => esc_html__( 'Infinite', 'textdomain' ),
                    'parallax' => esc_html__( 'Parallax', 'textdomain' )
                ]
            ]
        );

		$this->add_control(
			'anim_direction',
			[
				'label'   => esc_html__( 'Animation Direction', 'flatpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'updown',
				'options' => [
					'updown'  => esc_html__( 'Up Down', 'flatpack' ),
					'leftright' => esc_html__( 'Left Right', 'flatpack' ),
				],
				'condition'    => [
					'anim_control' => 'infinite'
				],
			]
		);

		$this->add_control(
			'img_anim_duration',
			[
				'label'      => esc_html__( 'Duration', 'flatpack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['ms'],
				'range'      => [
					'ms' => [
						'min'  => 300,
						'max'  => 5000,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'ms',
					'size' => 1500,
				],
				'selectors'  => [
					'{{WRAPPER}} .fp-img-anim' => 'animation-duration: {{SIZE}}{{UNIT}}; -webkit-animation-duration: {{SIZE}}{{UNIT}};',
				],
				'condition'    => [
					'anim_control' => 'infinite'
				],
			]
		);

		$this->end_controls_section();

    }

    /**
     * Image Style
     *
     * @return void
     */
    protected function image_style() {
        
        $this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'flatpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'flatpack' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'max-width',
			[
				'label' => esc_html__( 'Max Width', 'flatpack' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el-image' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'flatpack' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el-image' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'object-fit',
			[
				'label'   => esc_html__( 'Object Fit', 'flatpack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'fill'  => esc_html__( 'Fill', 'flatpack' ),
					'contain' => esc_html__( 'Contain', 'flatpack' ),
					'cover' => esc_html__( 'Cover', 'flatpack' ),
					'scale-down' => esc_html__( 'Scale Down', 'flatpack' ),
					'none' => esc_html__( 'None', 'flatpack' ),
				],
				'selectors' => [
					'{{WRAPPER}} .el-image img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'object-position',
			[
				'label'     => esc_html__( 'Object Position', 'flatpack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => [
					'top'    => esc_html__( 'Top', 'flatpack' ),
					'bottom' => esc_html__( 'Bottom', 'flatpack' ),
					'left'   => esc_html__( 'Left', 'flatpack' ),
					'right'  => esc_html__( 'Right', 'flatpack' ),
					'center' => esc_html__( 'Center', 'flatpack' ),
				],
				'selectors' => [
					'{{WRAPPER}} .el-image img' => 'object-position: {{VALUE}};',
				],
                'condition' => [
                    'object-fit!' => 'none'
                ]
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'flatpack' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => esc_html__( 'Opacity', 'flatpack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .elementor-image img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'flatpack' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'flatpack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .elementor-image:hover img',
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'flatpack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'flatpack' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elementor-image img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'flatpack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .elementor-image img',
			]
		);

		$this->end_controls_section();

    }

    /**
     * Image Caption Style
     *
     * @return void
     */
    protected function image_caption_style() {
        
        $this->start_controls_section(
			'section_style_caption',
			[
				'label' => esc_html__( 'Caption', 'flatpack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_source!' => 'none',
				],
			]
		);

		$this->add_control(
			'caption_align',
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
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'flatpack' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'flatpack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'caption_background_color',
			[
				'label' => esc_html__( 'Background Color', 'flatpack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .widget-image-caption'
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'caption_text_shadow',
				'selector' => '{{WRAPPER}} .widget-image-caption',
			]
		);

		$this->add_responsive_control(
			'caption_space',
			[
				'label' => esc_html__( 'Spacing', 'flatpack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

    }

    /**
	 * Check if the current widget has caption
	 *
	 * @access private
	 * @since 2.3.0
	 *
	 * @param array $settings
	 *
	 * @return boolean
	 */
	private function has_caption( $settings ) {
		return ( ! empty( $settings['caption_source'] ) && 'none' !== $settings['caption_source'] );
	}

	/**
	 * Get the caption for current widget.
	 *
	 * @access private
	 * @since 2.3.0
	 * @param $settings
	 *
	 * @return string
	 */
	private function get_caption( $settings ) {
		$caption = '';
		if ( ! empty( $settings['caption_source'] ) ) {
			switch ( $settings['caption_source'] ) {
				case 'attachment':
					$caption = wp_get_attachment_caption( $settings['image']['id'] );
					break;
				case 'custom':
					$caption = ! Utils::is_empty( $settings['caption'] ) ? $settings['caption'] : '';
			}
		}
		return $caption;
	}

    /**
     * Render Content
     *
     * @return void
     */
    protected function render() {

		$settings = $this->get_settings_for_display();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		}

		$has_caption = $this->has_caption( $settings );

		if( 'infinite' === $settings['anim_control'] ) {
			$anim_cls = 'fp-img-anim';
			$anim_direction = 'fp-img-anim-' . $settings['anim_direction'];
		}else{
			$anim_cls = '';
			$anim_direction = '';
		}

		$this->add_render_attribute(
			'wrapper',
			[
				'class' => [ 'elementor-image', 'el-image', $anim_cls, $anim_direction ],
                'data-anim' => $settings['anim_control']
			]
		);

		if ( ! empty( $settings['shape'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-image-shape-' . $settings['shape'] );
		}

		$link = $this->get_link_url( $settings );

		if ( $link ) {
			$this->add_link_attributes( 'link', $link );

			if ( Plugin::$instance->editor->is_edit_mode() ) {
				$this->add_render_attribute( 'link', [
					'class' => 'elementor-clickable',
				] );
			}

			if ( 'custom' !== $settings['link_to'] ) {
				$this->add_lightbox_data_attributes( 'link', $settings['image']['id'], $settings['open_lightbox'] );
			}
		} ?>
		<div id="fp-img-<?php echo $this->get_id(); ?>" <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( $has_caption ) : ?>
				<figure class="wp-caption">
			<?php endif; ?>
			<?php if ( $link ) : ?>
					<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
			<?php endif; ?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
			<?php if ( $link ) : ?>
					</a>
			<?php endif; ?>
			<?php if ( $has_caption ) : ?>
					<figcaption class="widget-image-caption wp-caption-text"><?php echo $this->get_caption( $settings ); ?></figcaption>
			<?php endif; ?>
			<?php if ( $has_caption ) : ?>
				</figure>
			<?php endif; ?>
		</div>
		<?php

    }

    /**
     * Get Link URL
     *
     * @param [type] $settings
     * @return array
     */
    private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return [
			'url' => $settings['image']['url'],
		];
	}

}