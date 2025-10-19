<?php
/**
 * Helper class
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Classes;

use Elementor\Utils;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Helper {
    
    /**
     * Get elementor instance
     *
     * @return \Elementor\Plugin
     */
    static function elementor_instance() {
        return \Elementor\Plugin::instance();
    }

    /**
     * Check elementor version
     *
     * @param string $version
     * @param string $operator
     * @return bool
     */
    static function is_elementor_version( $operator = '<', $version = '2.6.0' ) {
        return defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator );
    }

    /**
     * Get a list of all the allowed html tags.
     *
     * @param string $level Allowed levels are basic and intermediate
     * @return array
     */
    static function get_allowed_html_tags( $level = 'basic' ) {
        $allowed_html = [
            'b'      => [],
            'i'      => [],
            'u'      => [],
            's'      => [],
            'br'     => [],
            'em'     => [],
            'del'    => [],
            'ins'    => [],
            'sub'    => [],
            'sup'    => [],
            'code'   => [],
            'mark'   => [],
            'small'  => [],
            'strike' => [],
            'abbr'   => [
                'title' => [],
            ],
            'span'   => [
                'class' => [],
            ],
            'strong' => [],
        ];

        if ( $level === 'intermediate' ) {
            $tags = [
                'a'       => [
                    'href'  => [],
                    'title' => [],
                    'class' => [],
                    'id'    => [],
                ],
                'i'       => [
                    'class' => [],
                ],
                'q'       => [
                    'cite' => [],
                ],
                'img'     => [
                    'src'    => [],
                    'alt'    => [],
                    'height' => [],
                    'width'  => [],
                ],
                'svg'     => [
                    'class'           => true,
                    'aria-hidden'     => true,
                    'aria-labelledby' => true,
                    'role'            => true,
                    'xmlns'           => true,
                    'width'           => true,
                    'height'          => true,
                    'viewbox'         => true,
                ],
                'g'       => ['fill' => true],
                'title'   => ['title' => true],
                'path'    => [
                    'd'    => true,
                    'fill' => true,
                ],
                'dfn'     => [
                    'title' => [],
                ],
                'time'    => [
                    'datetime' => [],
                ],
                'cite'    => [
                    'title' => [],
                ],
                'acronym' => [
                    'title' => [],
                ],
                'hr'      => [],
                'mark'   => [
                    'class' => [],
                ]
            ];

            $allowed_html = array_merge( $allowed_html, $tags );
        }

        return $allowed_html;
    }

    /**
     * Strip all the tags except allowed html tags
     *
     * The name is based on inline editing toolbar name
     *
     * @param string $string
     * @return string
     */
    static function kses_basic( $string = '' ) {
        return wp_kses( $string, self::get_allowed_html_tags( 'basic' ) );
    }

    /**
     * Strip all the tags except allowed html tags
     *
     * The name is based on inline editing toolbar name
     *
     * @param string $string
     * @return string
     */
    static function kses_advance( $string = '' ) {
        return wp_kses( $string, self::get_allowed_html_tags( 'intermediate' ) );
    }

    /**
     * Limit Letter
     *
     * @param [type] $string
     * @param [type] $limit_length
     * @param string $suffix
     * @return void
     */
    static function limit_latter( $string, $limit_length, $suffix = '...' ) {
        if ( strlen( $string ) > $limit_length ) {
            echo strip_shortcodes( substr( $string, 0, $limit_length ) . $suffix );
        } else {
            echo strip_shortcodes( esc_html( $string ) );
        }
    }

    /**
     * Get Version form filemtime
     *
     * @param string $filename
     * @param string $extention
     * @return void
     */
    static function get_version( $filename = '', $extention = 'css' ) {
        $min = ( WP_DEBUG === true ) ? '' : '.min';
        if( ! empty( $filename ) ) {
            return filemtime( EDUMENTOR_PATH . '/assets/'. $extention .'/'. $filename . $min . '.'. $extention .'' );
        }else{
            return EDUMENTOR_VERSION;
        }
    }

    /**
     * Get elementor instance
     *
     * @return \Elementor\Plugin
     */
    static function elementor() {
        return \Elementor\Plugin::instance();
    }

    /**
     * Is Elemenotr Editor mode
     *
     * @param string $id
     * @return boolean
     */
    static function is_el_edit_mode( $id = '' ){
        $page_id = ! empty( $id ) ? $id : get_the_ID();
        return \Elementor\Plugin::$instance->editor->is_edit_mode($page_id);
    }

    /**
     * Get the list of all section templates
     *
     * @return array
     */
    static function get_section_templates() {
        $items = self::elementor()->templates_manager->get_source( 'local' )->get_items( ['type' => 'section'] );

        if ( ! empty( $items ) ) {
            $items = wp_list_pluck( $items, 'title', 'template_id' );
            return $items;
        } else {
            return [];
        }
    }

    /**
     * Get Terms
     *
     * @param string $taxonomy
     * @param integer $count
     * @param boolean $link
     * @param string $class
     * @param boolean $div
     * @return void
     */
    static function get_terms( $taxonomy="category", $count=1, $link=true, $class="hq-cat-item", $div=true ) {
		$dl_terms = get_the_terms( get_the_id(), $taxonomy );
		$dl_max_cat = $count;
		if( $dl_terms ) {
            if( $div === true ) {
                echo '<div class="hq-cat-items">';
            }
			foreach ( $dl_terms as $dl_term ) {
				$dl_cat = get_category( $dl_term );
				if( $link ) {
					printf( 
                        '<a href="%1$s" class="'. $class .'">%2$s</a>',
                        esc_url( get_category_link( $dl_cat->term_id ) ),
                        esc_html( $dl_cat->name )
                    );
				}else{
					printf( '<span>%1$s</span>', esc_html( $dl_cat->name ) );
				}
				
				$dl_max_cat--;

				if ( 0 == $dl_max_cat ) {
					break;
				}
			}
            if( $div === true ) {
                echo '</div>';
            }
		}
	}

    /**
     * Return Terms
     *
     * @param string $terms
     * @return array
     */
    static function el_get_terms( $terms = 'category' ) {
        $post_categories = get_terms( $terms );

        $post_options = [];
        if ( ! empty( $post_categories ) ) {
            foreach ( $post_categories as $post_cat ) {
                if ( ! empty( $post_cat->slug ) ) {
                    $post_options[$post_cat->slug] = $post_cat->name;
                }
            }
        }

        return $post_options;
    }

    /**
     * Return Tags
     *
     * @return array
     */
    static function el_get_tags() {
        $tag_args = array(
            'taxonomy' => 'post_tag',
            'orderby' => 'name',
            'hide_empty' => false
        );
        $tags  = get_tags($tag_args);

        $post_options = [];
        if ( ! empty( $tags ) ) {
            foreach ( $tags as $tag ) {
                if ( ! empty( $tag->term_id ) ) {
                    $post_options[$tag->term_id] = $tag->name;
                }
            }
        }

        return $post_options;
    }

    /**
     * Get image sizes
     *
     * @return array
     */
    static function get_image_sizes() {
        $sizes = get_intermediate_image_sizes();
        $items = array();
        $items['full'] = 'full';
        foreach ( $sizes as $size ) {
            $items[$size] = $size;
        }

        return $items;
    }

    /**
     * Get post date link
     *
     * @return void
     */
    static function get_post_date_link() {
        $year  = get_the_time( 'Y' );
        $month = get_the_time( 'm' );
        $day   = get_the_time( 'd' );
        return get_day_link( $year, $month, $day );
    }

    /**
     * Get posted by
     *
     * @return void
     */
    static function get_posted_by( $avatar = false, $by = '' ) {
		$author_id = get_the_author_meta( 'ID' );
		if ( empty( $author_id ) && ! empty( $GLOBALS['post']->post_author ) ) {
			$author_id = $GLOBALS['post']->post_author;
		}
		if ( $author_id > 0 ) {
			$author_link   = get_author_posts_url( $author_id );
			$author_name   = get_the_author_meta( 'display_name', $author_id );
			
			if( $avatar === true ) {
				$author_avatar = get_avatar( get_the_author_meta( 'user_email', $author_id ), 60 );
				echo '<a href="'. esc_url( $author_link ) .'" class="author is-avatar">'. self::kses_advance( $author_avatar ) . esc_html( $author_name ) .'</a>';
			}else{
                $by_text = '<span class="by">'. $by .'</span> ';
				echo '<a href="'. esc_url( $author_link ) .'" class="author">'. self::kses_advance( $by_text ) . esc_html( $author_name ) .'</a>';
			}
		}
	}

    /**
     * Get Featured Image
     *
     * @param string $size
     * @return void
     */
    static function get_featured_image_url( $size = 'full', $post_id = '' ) {
        if( ! empty( $post_id ) ) {
            $postid = $post_id;
        }else{
            global $wp_query;
            $postid = $wp_query->post->ID;
        }
        $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), $size );
        $image_url = ! empty( $image_array[0] ) ? $image_array[0] : '';
        return $image_url;
    }

    /**
     * Get Featured image with placeholder image
     *
     * @param string $size
     * @param [type] $post_id
     * @param string $place_img_url // URL of placeholder image
     * @return void
     */
    static function get_featured_img_with_placeholder_img( $size = 'full', $post_id = '', $place_img_url = '' ) {
        $postid = ! empty( $post_id ) ? $post_id : get_the_ID();
        $img_url = self::get_featured_image_url($size, $postid);
        if( ! empty( $img_url ) ) {
            return $img_url;
        }else{
            return $place_img_url;
        }
    }

    /**
     * Get Image URL by ID
     *
     * @param [type] $id
     * @param string $size
     * @return void
     */
    static function get_image_url_by_id( $id , $size = 'thumbnail' ) {
        if( empty( $id ) ) { return ''; }
        $img = wp_get_attachment_image_url( $id, $size );
        if( ! empty($img) ) {
            return $img;
        }else{
            return '';
        }
    }

    /**
     * Get image alt text by attachement ID
     *
     * @param [type] $image_id
     * @return void
     */
    static function get_image_alt_text( $image_id ) {
        $img_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        if( ! empty( get_the_title( $img_alt ) ) ) {
            return get_the_title($img_alt);
        }else{
            return 'Image';
        }
    }

    /**
     * @uses WP_Query
     * @uses get_queried_object()
     * @see get_the_ID()
     * @return int
     */
    static function get_the_post_id() {
        if ( in_the_loop() ) {
            $post_id = get_the_ID();
        } else {
            global $wp_query;
            $post_id = $wp_query->get_queried_object_id();
        }
        return $post_id;
    }

    /**
     * Highlighted text
     *
     * @param [type] $text
     * @return string
     */
    static function get_highlighted_text( $text ) {
        $text = $text ?? '';
		return str_replace( array( '{', '}' ), array( '<mark>', '</mark>' ), $text );
        
	}

    /**
     * Get elementor placeholder image
     *
     * @return string
     */
    static function get_placeholder() {
        return Utils::get_placeholder_image_src();
    }

    /**
     * Get post reading time
     */
    static function get_post_reading_time( $string = 'short' ) {

        $content = get_post_field( 'post_content', get_the_ID() );

        $minute_text = 'full' == $string ? esc_html__( ' minutes', 'edumentor' ) : esc_html__( ' min.', 'edumentor' );
        $second_text = 'full' == $string ? esc_html__( ' seconds', 'edumentor' ) : esc_html__( ' sec.', 'edumentor' );

        // Predefined words-per-minute rate.
        $words_per_minute = 225;
        $words_per_second = $words_per_minute / 60;
    
        // Count the words in the content.
        $word_count = str_word_count( strip_tags( $content ) );
    
        // How many seconds (total)?
        $seconds_total = floor( $word_count / $words_per_second );
        $minutes_total = ceil( $word_count / $words_per_minute );
        
        // String to store our output.
        $string_output = '';
    
        // Double-check we're using an integer.
        $seconds = (int) $seconds_total;
    
        if ( $seconds < 59 ) {
    
            $string_output .= $seconds . $second_text;
    
        } else {
            $string_output .= $minutes_total . $minute_text;
        }
    
        return $string_output;
    }

    /**
     * Post Meta
     */
    static function get_post_meta($settings = [], $icon = 'yes', $date_format = 'M j, Y' ) {
        if( 'yes' === $settings['author'] || 'yes' === $settings['date'] || 'yes' === $settings['comments'] || 'yes' === $settings['reading_time'] ) {
            echo '<ul class="hq-meta">';
            if( 'yes' === $settings['author'] ) {
                $author_icon  = 'yes' === $icon ? ' <i class="far fa-user"></i> ': '';
                echo '<li class="author"><a href="'. esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) .'">'. $author_icon . esc_html( get_the_author_meta('nickname') ) .'</a></li>';
            }
            if( 'yes' === $settings['date'] ) {
                $date_icon  = 'yes' === $icon ? ' <i class="far fa-calendar-alt"></i> ': '';
                $post_date = 'publish' === $settings['date_type'] ? get_the_date($date_format) : get_the_modified_date($date_format);
                echo '<li class="date"><a href="'. esc_url( self::get_post_date_link() ) .'">'. $date_icon . esc_html( $post_date ) .'</a></li>';
            }
            if( 'yes' === $settings['comments'] ) {
                if( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
                    $comments_icon  = 'yes' === $icon ? ' <i class="far fa-comments"></i> ': '';
                    echo '<li class="comments"><a href="'. esc_url( get_comments_link( get_the_ID() ) ) .'">'. $comments_icon .'';
                    comments_number( 
                        esc_html__( 'No Comments', 'edumentor' ), 
                        esc_html__( '1 Comment', 'edumentor' ), 
                        esc_html__( '% Comments', 'edumentor' ) 
                    );
                    echo '</a></li>';
                }
            }
            if( 'yes' === $settings['reading_time'] && '5' != $settings['card_style'] ) {
                $reading_icon  = 'yes' === $icon ? ' <i class="far fa-clock"></i> ': '';
                echo '<li class="reading-time" title="'. esc_html__( 'Take ', 'edumentor' ) . self::get_post_reading_time() . esc_html__( ' to read.', 'edumentor' ) .'">'. $reading_icon . esc_html( self::get_post_reading_time() ) .'</li>';
            }
            echo '</ul>';
        }
    }

    /**
     * Get carousel control layout
     */
    static function get_carousel_control_layout($settings = []){
        $nav_mobile = 'yes' === $settings['nav_hide_mobile'] ? ' nav-none' : '';
        $dots_mobile = 'yes' === $settings['dots_hide_mobile'] ? ' dots-none' : '';
        ?>
        <?php if( 'dots' === $settings['navigation'] || 'both' === $settings['navigation'] ) : ?>
            <div class="hq-carousel-dots<?php echo esc_attr( $dots_mobile ); ?> dot-style-<?php echo $settings['dots_style']; ?>"></div>
        <?php endif; ?>
        <?php if( 'arrow' === $settings['navigation'] || 'both' === $settings['navigation'] ) : ?>
            <div class="hq-carousel-nav <?php echo esc_attr( 'nav-' . $settings['nav_style'] ) . esc_attr( $nav_mobile ); ?>"></div>
            <?php if ( ! empty( $settings['arrow_prev_icon']['value'] ) ) : ?>
                <button type="button" class="slick-prev nav-hidden"><?php Icons_Manager::render_icon( $settings['arrow_prev_icon'], ['aria-hidden' => 'true'] ); ?></button>
            <?php endif; ?>
            <?php if ( ! empty( $settings['arrow_next_icon']['value'] ) ) : ?>
                <button type="button" class="slick-next nav-hidden"><?php Icons_Manager::render_icon( $settings['arrow_next_icon'], ['aria-hidden' => 'true'] ); ?></button>
            <?php endif; ?>
        <?php endif;
    }

    /**
     * Get Contact Forms
     */
    static function el_get_contact_forms( $limit = -1 ) {
        $items = [];
        $args = array(
            'post_type' => 'wpcf7_contact_form', 
            'posts_per_page' => $limit 
        );
        if( $data = get_posts( $args ) ) {
            foreach( $data as $key ){
                $items[$key->ID] = $key->post_title;
            }
        }else{
            $items['0'] = esc_html__( 'No Contact Form found', 'edumentor' );
        }
        return $items;
    }

    /**
     * Animation Effect List
     *
     * @return void
     */
    static function get_animation_effects() {
        return [
            'hq-fadeIn'       => esc_html( 'Fade In', 'softgen-core' ),
            'hq-fadeInLeft'   => esc_html( 'Fade In Left', 'softgen-core' ),
            'hq-fadeInRight'  => esc_html( 'Fade In Right', 'softgen-core' ),
            'hq-fadeInTop'    => esc_html( 'Fade In Top', 'softgen-core' ),
            'hq-fadeInBottom' => esc_html( 'Fade In Bottom', 'softgen-core' )
        ];
    }

}