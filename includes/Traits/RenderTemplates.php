<?php
/**
 * Render Templates
 *
 * @package EduMentor
 */
namespace HexQode\EduMentor\Traits;

use Elementor\Embed;
use Elementor\Icons_Manager;
use HexQode\EduMentor\Classes\Helper;

defined( 'ABSPATH' ) || die();

trait RenderTemplates{

    /**
     * Animated Text Template
     *
     * @return void
     */
    protected function get_animated_text_template( $prefix = 'hq_' ){
        $settings = $this->get_settings_for_display();
        $h_tag = $settings[$prefix . 'animated_tag'];
        $h_has_link = false;
        $animation_type = $settings[$prefix . 'animation_type'];
        $this->add_render_attribute( $prefix . 'animated_text_heading', 'class',
            [
                'hq-animated-text-wrap',
                'cd-headline',
                $animation_type,
            ]
        );

        if ( $animation_type && 'letters type' !== $animation_type && 'letters type' !== $animation_type && 'clip' !== $animation_type ) {
            $this->add_render_attribute( $prefix . 'animated_text_heading', 'data-animation-delay', $settings[$prefix . 'animation_delay'] );
        }
        
        $this->add_render_attribute( $prefix . 'before_text', [ 'class' => [ 'hq-before-text' ] ] );
        $this->add_render_attribute( $prefix . 'after_text', [ 'class' => [ 'hq-after-text' ] ] );
        $this->add_inline_editing_attributes( $prefix . 'before_text', 'none' );
        $this->add_inline_editing_attributes( $prefix . 'after_text', 'none' );
        $animated_text = $settings[$prefix . 'animated_text'];
        if( 'yes' === $settings[$prefix . 'animated_animation'] ) {
            $this->add_render_attribute( $prefix . 'animated_text_heading', [ 
                'class' => [ 'wow', 'hq-' . $settings[$prefix . 'at_anim_effect'] ],
                'data-wow-offset' => $settings[$prefix . 'at_anim_offset'],
                'data-wow-delay' => $settings[$prefix . 'at_anim_delay'] . 'ms',
                'data-wow-duration' => $settings[$prefix . 'at_anim_duration'] . 'ms'
            ] );
        }
        if( ! empty( $settings[$prefix . 'before_text'] || $settings[$prefix . 'before_text'] ) ) : ?>
            <<?php echo esc_attr( $h_tag ) . ' ' . $this->get_render_attribute_string( $prefix . 'animated_text_heading' ); ?>>
            <?php 
            if( $h_has_link ) {
                echo '<a '. $this->get_render_attribute_string( $prefix . 'h_link' ) .'>';
            }
                if( ! empty( $settings[$prefix . 'before_text'] ) ) {
                    echo '<span '. $this->get_render_attribute_string( $prefix . 'before_text' ) .'>'. Helper::kses_advance( Helper::get_highlighted_text( $settings[$prefix . 'before_text'] ) ) .'</span>';
                }
                if( $animated_text ) {
                    echo ' <span class="hq-animated-text cd-words-wrapper">';
                    foreach ( $animated_text as $text_key => $text_item ) {
                        echo '<b class="elementor-repeater-item-'. esc_attr($text_item['_id'] . ( $text_key === 0 ? ' is-visible' : '' ) ) .'">'. esc_html( $text_item['text'] ) .'</b>';
                    }
                    echo '</span>';
                }
                if( ! empty( $settings[$prefix . 'after_text'] ) ) {
                    echo '<span '. $this->get_render_attribute_string( $prefix . 'after_text' ) .'>'. Helper::kses_advance( Helper::get_highlighted_text( $settings[$prefix . 'after_text'] ) ) .'</span>';
                }
            if( $h_has_link ) {
                echo '</a>';
            }
            ?>
            </<?php echo esc_attr( $h_tag ); ?>>
        <?php endif;
    }

    /**
     * Heading Template
     *
     * @return void
     */
    protected function get_heading_template( $prefix = 'hq_', $is_border = false ){
        $settings = $this->get_settings_for_display();
        $h_tag = $settings[$prefix . 'h_tag'];
        $h_has_link = false;
        if( $is_border ) {
            $border = $settings[ $prefix . 'is_border' ] === 'yes' ? 'is-border' : '';
        }else{
            $border = '';
        }
        $borter_status = $settings[ $prefix . 'is_border' ] === 'yes' ? true : false;
        $this->add_render_attribute( $prefix . 'heading', [ 'class' => [ 'hq-heading', $border ] ] );

        if( 'yes' === $settings[$prefix . 'heading_animation'] ) {
            $this->add_render_attribute( $prefix . 'heading', [ 
                'class' => [ 'hq-text-anim' ],
                'data-effect' => $settings[$prefix . 'h_normal_anim_effect'],
                'data-split' => $settings[$prefix . 'h_split_type'],
                'data-delay' => $settings[$prefix . 'h_anim_delay'],
                'data-duration' => $settings[$prefix . 'h_anim_duration'],
                'data-ease' => $settings[$prefix . 'h_ease_effect']
            ] );
        }
        if( ! empty( $settings[$prefix . 'heading'] ) ) : ?>
            <<?php echo esc_attr( $h_tag ) . ' ' . $this->get_render_attribute_string( $prefix . 'heading' ); ?>>
            <?php
                if( $h_has_link ) {
                    echo '<a '. $this->get_render_attribute_string( $prefix . 'h_link' ) .'>'. Helper::kses_advance( Helper::get_heading_highlighted_text( $settings[$prefix . 'heading'], $borter_status ) ) .'</a>';
                }else{
                    echo Helper::kses_advance( Helper::get_heading_highlighted_text( $settings[$prefix . 'heading'], $borter_status ) );
                }
                ?>
            </<?php echo esc_attr( $h_tag ); ?>>
        <?php endif;
    }

    /**
     * Sub Heading Template
     *
     * @return void
     */
    protected function get_sub_heading_template( $prefix = 'hq_' ){
        $settings = $this->get_settings_for_display();
        $sh_tag = $settings[$prefix . 'sh_tag'];
        $is__border = 'yes' === $settings[$prefix . 'sh_border'] ? 'is-border' : '';
        $this->add_render_attribute( $prefix . 'sub_heading', [ 'class' => [ 'hq-sub-heading', $is__border ] ] );
        $this->add_inline_editing_attributes( $prefix . 'sub_heading', 'none' );
        if( 'yes' === $settings[$prefix.'sub_heading_animation'] ) {
            if( 'yes' != $settings[$prefix . 'sh_border'] ) {
                $this->add_render_attribute( $prefix . 'sub_heading', [ 
                    'class' => [ 'hq-text-anim' ],
                    'data-effect' => $settings[$prefix . 'sh_normal_anim_effect'],
                    'data-split' => $settings[$prefix . 'sh_split_type'],
                    'data-duration' => $settings[$prefix . 'sh_anim_duration'],
                    'data-delay' => $settings[$prefix . 'sh_anim_delay'],
                    'data-ease' => $settings[$prefix . 'sh_ease_effect']
                ] );
            }else{
                $is_border = 'yes' === $settings[$prefix . 'sh_border'] ? 'hq-border-anim' : '';
                $this->add_render_attribute( $prefix . 'sub_heading', [ 'class' => [ $is_border ] ] );
            }
        }
        if( ! empty( $settings[$prefix . 'sub_heading'] ) ) : ?>
            <<?php echo esc_attr( $sh_tag ) . ' ' . $this->get_render_attribute_string( $prefix . 'sub_heading' ); ?>>
                <?php 
                    if( 'yes' == $settings[$prefix . 'sh_border'] ) {
                        echo '<span class="sh-underline"><img class="wheat" src="'. EDUMENTOR_URL .'/assets/img/wheat.svg" alt="'. esc_attr__( 'Wheat', 'agrox-core' ) .'"></span>';
                    }
                    echo Helper::kses_advance( Helper::get_highlighted_text( $settings[$prefix . 'sub_heading'] ) );
                ?>
            </<?php echo esc_attr( $sh_tag ); ?>>
        <?php endif;
    }

    /**
     * Description Template
     *
     * @return void
     */
    protected function get_description_template( $prefix = 'hq_' ){
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( $prefix . 'desc', [ 'class' => [ 'hq-desc' ] ] );
        $this->add_inline_editing_attributes( $prefix . 'desc', 'none' );
        if( 'yes' === $settings[$prefix . 'desc_animation'] ) {
            $this->add_render_attribute( $prefix . 'desc', [ 
                'class' => [ 'hq-text-anim' ],
                'data-effect' => $settings[$prefix . 'desc_normal_anim_effect'],
                'data-split' => $settings[$prefix . 'desc_split_type'],
                'data-delay' => $settings[$prefix . 'desc_anim_delay'],
                'data-duration' => $settings[$prefix . 'desc_anim_duration'],
                'data-ease' => $settings[$prefix . 'desc_ease_effect']
            ] );
        }
        if( ! empty( $settings[$prefix . 'desc'] ) ) : ?>
            <p <?php echo $this->get_render_attribute_string( $prefix . 'desc' ); ?>><?php echo Helper::kses_advance( $settings[$prefix . 'desc'] ); ?></p>
        <?php endif;
    }

    /**
     * List Items Layout
     *
     * @return void
     */
    protected function get_list_items_template( $prefix = 'hq_' ) {
        $settings = $this->get_settings_for_display();
        $list_items = $settings[$prefix . 'list_content'];
        $this->add_render_attribute( $prefix . 'list_wrapper', [ 'class' => [ 'check-list' ] ] );
        if( 'yes' === $settings[$prefix . 'list_animation'] ) {
            $this->add_render_attribute( $prefix . 'list_wrapper', [ 
                'class' => [ 'wow', 'hq-' . $settings[$prefix . 'list_anim_effect'] ],
                'data-wow-offset' => $settings[$prefix . 'list_anim_offset'],
                'data-wow-delay' => $settings[$prefix . 'list_anim_delay'] . 'ms',
                'data-wow-duration' => $settings[$prefix . 'list_anim_duration'] . 'ms'
            ] );
        }

        if( $list_items ) : ?>
            <ul <?php $this->print_render_attribute_string( $prefix . 'list_wrapper' ); ?>>
                <?php foreach( $list_items as $list_item ) : 
                    if( ! empty( $list_item['text'] ) ) : ?>
                    <li class="elementor-repeater-item-<?php echo $list_item['_id']; ?>"><?php if( ! empty( $list_item['icon']['value'] ) ){ echo '<i class="'. esc_attr( $list_item['icon']['value'] ) .'"></i>'; }  echo esc_html( $list_item['text'] ); ?></li>
                <?php endif;
                    endforeach; ?>
            </ul>
        <?php endif;

    }

    /**
     * Carousel Controlers
     *
     * @return void
     */
    protected function get_carousel_controlers(){
        $settings = $this->get_settings_for_display();
        $dots_mobile = 'yes' === $settings['dots_hide_mobile'] ? ' dots-none' : '';
        $nav_mobile = 'yes' === $settings['nav_hide_mobile'] ? ' nav-none' : '';
        if( 'dots' === $settings['navigation'] || 'both' === $settings['navigation'] ) {
            echo '<div class="hq-carousel-dots'. esc_attr( $dots_mobile ) .'"></div>';
        }

        if( 'arrow' === $settings['navigation'] || 'both' === $settings['navigation'] ){
            ?>
            <div class="hq-carousel-nav <?php echo esc_attr( 'nav-' . $settings['nav_style'] ) . esc_attr( $nav_mobile ); ?>"></div>
            <button type="button" class="slick-prev nav-hidden">
                <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1470.39 1397.53"><g><g><path fill="currentColor" d="M1219,1207c-37.29-6.83-74.2-14-111.74.82-64.62,25.48-100.89,100.61-157.24,141.78-46.3,33.83-103.49,55.17-159.16,45.73-77-13.06-127.19-77.87-182.18-129.56-36.17-34-74.76-56.73-124.64-42.28-35.87,10.39-66.92,33.56-99.59,52.31-107.26,61.55-281,75.43-356.49-47.49-27-44-35.06-100.46-21.47-150.89,16.89-62.66,56.78-111.47,84.9-168.21,33.38-67.34,26.26-134.82,4.41-205.48-35.74-115.54-84.11-244-21.67-359.87,77.23-143.33,257.06-34.19,344.38-160.48C440.8,151.09,456.44,114,480.35,83.08c150.3-194.54,397.2-.81,533.94,108.1,84.64,67.41,163.22,55.12,263,47.71,49.42-3.68,102.54.45,142.37,31.45,132.86,103.42-33.61,261.77-66.52,369.45-22.48,73.57,3.08,150.87,28.54,219.79,33.4,90.41,91,234.89,8.72,316.89-31.17,31.06-77.22,39.65-120.1,37.5C1253.08,1213.1,1236,1210.06,1219,1207Z"/></g></g></svg>
				<?php 
				if ( ! empty( $settings['arrow_prev_icon']['value'] ) ) {
					Icons_Manager::render_icon( $settings['arrow_prev_icon'], ['aria-hidden' => 'true'] );
				}else{
					echo '<svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m491.135 229.652c-66.025-27.155-137.442-45.34-230.769-58.77 6.617-21.763 11.96-45.242 17.254-69.309 3.333-15.097-2.99-30.243-16.127-38.478-13.136-8.284-29.508-7.451-41.713 2.108-25.145 19.704-50.095 39.409-75.044 59.163-42.105 33.282-85.632 67.74-129.207 101.169-5.539 4.264-9.019 10.735-9.46 17.695-.441 6.911 2.108 13.675 6.961 18.528 67.446 67.348 140.775 129.844 217.926 185.821 6.421 4.656 13.872 7.009 21.322 7.009 7.009 0 14.019-2.059 20.243-6.176 12.744-8.529 18.676-23.724 15.097-38.625l-22.351-93.621c47.889-9.166 93.523-17.352 137.687-25.292 27.498-4.951 54.996-9.901 83.181-15.097 10.833-2.01 18.577-10.391 19.705-21.42 1.127-10.882-4.657-20.588-14.705-24.705zm-350.662 103.228c-.49.637-1.225.931-1.912.931-.539 0-1.079-.147-1.52-.49l-70.976-55.977c-4.95-3.921-11.126-8.823-14.165-15.685-2.99-6.911-1.814-16.91 5.441-20.93 1.176-.637 2.696-.196 3.333.98.686 1.176.245 2.647-.931 3.333-4.706 2.598-5.49 9.705-3.333 14.656 2.5 5.735 7.941 9.999 12.695 13.774l70.976 55.977c1.029.833 1.225 2.402.392 3.431zm19.851 10.686c-.441.833-1.274 1.324-2.157 1.324-.392 0-.784-.098-1.176-.294l-4.559-2.402c-1.225-.588-1.666-2.108-1.029-3.284.588-1.225 2.059-1.666 3.284-1.029l4.608 2.402c1.176.587 1.666 2.106 1.029 3.283zm7.794-7.843c-.441.49-1.127.735-1.765.735-.588 0-1.225-.196-1.667-.686l-50.928-48.771c-.98-.98-1.029-2.5-.098-3.48.98-.98 2.5-1.029 3.48-.098l50.928 48.82c.981.931 1.03 2.5.05 3.48zm16.371-178.762-11.96 7.794c-.392.245-.882.392-1.324.392-.784 0-1.569-.392-2.059-1.127-.735-1.127-.441-2.647.735-3.382l11.911-7.793c1.127-.735 2.647-.392 3.382.735.737 1.126.442 2.646-.685 3.381zm33.772-44.409-101.954 69.456c-.441.294-.931.392-1.421.392-.784 0-1.519-.343-2.01-1.029-.735-1.127-.49-2.647.637-3.431l102.003-69.456c1.078-.735 2.598-.441 3.382.637.785 1.127.491 2.647-.637 3.431zm48.429 174.253c-.294 1.128-1.274 1.912-2.402 1.912-.196 0-.343-.049-.539-.098l-3.137-.735c-1.274-.294-2.108-1.618-1.814-2.941.343-1.323 1.618-2.157 2.941-1.814l3.137.735c1.323.294 2.108 1.618 1.814 2.941zm140.921-28.234-129.599 26.175c-.147 0-.343.049-.49.049-1.127 0-2.157-.833-2.402-2.01-.245-1.323.588-2.598 1.912-2.843l129.599-26.224c1.323-.245 2.598.637 2.892 1.961.245 1.324-.588 2.598-1.912 2.892z"/></g></g><g/></svg>';
				}
				?>
			</button>
			<button type="button" class="slick-next nav-hidden">
                <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1470.39 1397.53"><g><g><path fill="currentColor" d="M1219,1207c-37.29-6.83-74.2-14-111.74.82-64.62,25.48-100.89,100.61-157.24,141.78-46.3,33.83-103.49,55.17-159.16,45.73-77-13.06-127.19-77.87-182.18-129.56-36.17-34-74.76-56.73-124.64-42.28-35.87,10.39-66.92,33.56-99.59,52.31-107.26,61.55-281,75.43-356.49-47.49-27-44-35.06-100.46-21.47-150.89,16.89-62.66,56.78-111.47,84.9-168.21,33.38-67.34,26.26-134.82,4.41-205.48-35.74-115.54-84.11-244-21.67-359.87,77.23-143.33,257.06-34.19,344.38-160.48C440.8,151.09,456.44,114,480.35,83.08c150.3-194.54,397.2-.81,533.94,108.1,84.64,67.41,163.22,55.12,263,47.71,49.42-3.68,102.54.45,142.37,31.45,132.86,103.42-33.61,261.77-66.52,369.45-22.48,73.57,3.08,150.87,28.54,219.79,33.4,90.41,91,234.89,8.72,316.89-31.17,31.06-77.22,39.65-120.1,37.5C1253.08,1213.1,1236,1210.06,1219,1207Z"/></g></g></svg>
				<?php 
				if ( ! empty( $settings['arrow_next_icon']['value'] ) ) {
					Icons_Manager::render_icon( $settings['arrow_next_icon'], ['aria-hidden' => 'true'] );
				}else{
					echo '<svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m498.97 250.225c-67.446-67.3-140.775-129.844-217.926-185.821-12.45-9.019-28.773-9.313-41.566-.784-12.744 8.529-18.675 23.675-15.097 38.625l22.351 93.572c-47.791 9.166-93.327 17.352-137.442 25.293-27.596 4.951-55.143 9.901-83.426 15.146-10.833 2.01-18.577 10.391-19.705 21.371-1.127 10.881 4.657 20.587 14.705 24.753 66.025 27.106 137.442 45.291 230.769 58.721-6.617 21.812-11.96 45.242-17.254 69.309-3.333 15.146 2.99 30.243 16.077 38.527 6.029 3.774 12.744 5.637 19.41 5.637 7.892 0 15.734-2.598 22.351-7.794 25.145-19.705 50.144-39.458 75.142-59.212 42.056-33.282 85.583-67.691 129.109-101.072 5.539-4.264 9.019-10.735 9.46-17.695.443-6.91-2.106-13.674-6.958-18.576zm-264.002-18.136-129.599 26.175c-.147.049-.343.049-.49.049-1.127 0-2.157-.784-2.402-1.96-.245-1.324.588-2.647 1.912-2.892l129.599-26.175c1.324-.294 2.598.588 2.892 1.911.245 1.324-.588 2.647-1.912 2.892zm18.234-5.049c-.294 1.128-1.274 1.912-2.402 1.912-.196 0-.392 0-.588-.049l-3.088-.784c-1.324-.294-2.108-1.618-1.814-2.941.343-1.323 1.666-2.108 2.941-1.814l3.088.735c1.324.344 2.157 1.618 1.863 2.941zm98.474-58.623c.637-1.176 2.108-1.667 3.333-1.029l4.559 2.402c1.225.637 1.666 2.108 1.029 3.333-.441.833-1.274 1.324-2.157 1.324-.392 0-.784-.098-1.127-.294l-4.608-2.402c-1.176-.638-1.666-2.108-1.029-3.334zm-7.843 7.892c.98-.98 2.5-1.029 3.48-.098l50.928 48.82c.98.931 1.029 2.5.098 3.48-.49.49-1.127.735-1.814.735-.588 0-1.176-.245-1.667-.686l-50.928-48.82c-.979-.931-1.028-2.451-.097-3.431zm-16.322 178.762 11.96-7.793c1.127-.735 2.647-.441 3.382.686s.441 2.647-.735 3.431l-11.911 7.745c-.441.294-.882.441-1.323.441-.833 0-1.618-.392-2.059-1.128-.735-1.127-.441-2.647.686-3.382zm70.976-21.028-102.003 69.456c-.392.294-.882.441-1.372.441-.784 0-1.519-.392-2.01-1.079-.784-1.127-.49-2.647.637-3.382l101.954-69.456c1.127-.784 2.647-.49 3.431.637.735 1.128.49 2.648-.637 3.383zm56.172-62.79c-.392.196-.784.343-1.176.343-.882 0-1.716-.49-2.157-1.274-.686-1.176-.245-2.696.931-3.333 4.705-2.598 5.49-9.705 3.333-14.705-2.5-5.735-7.941-9.999-12.695-13.774l-70.976-55.977c-1.029-.833-1.225-2.353-.392-3.431.833-1.029 2.402-1.225 3.431-.392l70.975 55.977c4.951 3.922 11.127 8.774 14.117 15.636 3.04 6.961 1.814 16.911-5.391 20.93z"/></g></g><g/></svg>';
				}
				?>
			</button>
            <?php
        }
    }

}