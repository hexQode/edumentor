<?php
/**
 * Helper class
 *
 * @package EduMentor
 */
namespace HexQode\EduMentor\Classes;

defined( 'ABSPATH' ) || die();

class CardStyle {

    /**
     * Style 1
     */
    static function style_1($settings = [], $post_id = '') {
        $heading_tag = ! empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h3'; ?>
        <article <?php body_class(['hq-card', 'style-1']); ?>>
            <div class="hq-card-inner">
                <a href="<?php the_permalink(); ?>" class="hq-card-thumb">
                    <?php if( has_post_thumbnail() ) : ?>
                        <?php echo get_the_post_thumbnail( $post_id, $settings['img_size'] ); ?>
                    <?php else: ?>
                        <img src="<?php echo esc_url( Helper::get_placeholder() ); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                </a>
                <div class="hq-card-content">
                    <?php 
                    if( 'yes' === $settings['category'] ) {
                        Helper::get_terms( 'category', 1, true, 'hq-card-category', false );
                    } ?>
                    <<?php echo esc_attr( $heading_tag ); ?> class="hq-card-title">
                        <a href="<?php the_permalink(); ?>" class="hq-link-hover"><?php Helper::limit_latter( get_the_title(), $settings['title_length'], $settings['title_suffix'] ); ?></a>
                    </<?php echo esc_attr( $heading_tag ); ?>>
                    <?php if( 'yes' === $settings['meta_info'] ){ Helper::get_post_meta($settings, $settings['meta_icon']); } ?>
                </div>
            </div>
        </article>
        <?php
    }

    /**
     * Style 2
     */
    static function style_2($settings = [], $post_id = '') {
        $heading_tag = ! empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h3'; ?>
        <article <?php body_class(['hq-card', 'style-2']); ?>>
            <div class="hq-card-inner">
                <div class="hq-card-thumb">
                    <a href="<?php the_permalink(); ?>" class="ov-link" title="<?php the_title(); ?>"></a>
                    <?php if( has_post_thumbnail() ) : ?>
                        <?php echo get_the_post_thumbnail( $post_id, $settings['img_size'] ); ?>
                    <?php else: ?>
                        <img src="<?php echo esc_url( Helper::get_placeholder() ); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    <?php 
                    if( 'yes' === $settings['category'] ) {
                        Helper::get_terms( 'category', 1, true, 'hq-card-category', false );
                    } ?>
                </div>
                <div class="hq-card-content">
                    <<?php echo esc_attr( $heading_tag ); ?> class="hq-card-title">
                        <a href="<?php the_permalink(); ?>" class="hq-link-hover"><?php Helper::limit_latter( get_the_title(), $settings['title_length'], $settings['title_suffix'] ); ?></a>
                    </<?php echo esc_attr( $heading_tag ); ?>>
                    <?php if( 'yes' === $settings['meta_info'] ){ Helper::get_post_meta($settings, $settings['meta_icon']); } ?>
                </div>
            </div>
        </article>
        <?php
    }

    /**
     * Style 3
     */
    static function style_3($settings = [], $post_id = '') {
        $heading_tag = ! empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h3'; ?>
        <article <?php body_class(['hq-card', 'style-3']); ?>>
            <div class="hq-card-inner">
                <div class="hq-card-thumb">
                    <a href="<?php the_permalink(); ?>" class="ov-link" title="<?php the_title(); ?>"></a>
                    <?php if( has_post_thumbnail() ) : ?>
                        <?php echo get_the_post_thumbnail( $post_id, $settings['img_size'] ); ?>
                    <?php else: ?>
                        <img src="<?php echo esc_url( Helper::get_placeholder() ); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    <?php 
                    if( 'yes' === $settings['category'] ) {
                        Helper::get_terms( 'category', 1, true, 'hq-card-category', false );
                    } ?>
                </div>
                <div class="hq-card-content">
                    <<?php echo esc_attr( $heading_tag ); ?> class="hq-card-title">
                        <a href="<?php the_permalink(); ?>" class="hq-link-hover"><?php Helper::limit_latter( get_the_title(), $settings['title_length'], $settings['title_suffix'] ); ?></a>
                    </<?php echo esc_attr( $heading_tag ); ?>>
                    <?php if( 'yes' === $settings['meta_info'] ){ Helper::get_post_meta($settings, $settings['meta_icon']); } ?>
                </div>
            </div>
        </article>
        <?php
    }

    /**
     * Style 4
     */
    static function style_4($settings = [], $post_id = '') {
        $heading_tag = ! empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h3'; ?>
        <article <?php body_class(['hq-card', 'style-4']); ?>>
            <div class="hq-card-inner">
                <div class="hq-card-thumb">
                    <?php if( has_post_thumbnail() ) : ?>
                        <?php echo get_the_post_thumbnail( $post_id, $settings['img_size'] ); ?>
                    <?php else: ?>
                        <img src="<?php echo esc_url( Helper::get_placeholder() ); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    <div class="hq-overlay">
                        <div class="hq-overlay-inner">
                            <a href="<?php the_permalink(); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32"><path d="M 19.71875 5.28125 L 18.28125 6.71875 L 24.5625 13 L 11 13 C 7.144531 13 4 16.144531 4 20 C 4 23.855469 7.144531 27 11 27 L 11 25 C 8.226563 25 6 22.773438 6 20 C 6 17.226563 8.226563 15 11 15 L 24.5625 15 L 18.28125 21.28125 L 19.71875 22.71875 L 27.71875 14.71875 L 28.40625 14 L 27.71875 13.28125 Z"/></svg>
                            </a>
                            <?php
                                if( 'yes' === $settings['date'] ) {
                                    $date_format = 'M j, Y';
                                    $post_date = 'publish' === $settings['date_type'] ? get_the_date($date_format) : get_the_modified_date($date_format);
                                    echo '<div class="date">'. esc_html( $post_date ) .'</div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="hq-card-content">
                    <?php if( 'yes' === $settings['category'] || 'yes' === $settings['reading_time'] ) : ?>
                    <div class="card-header">
                        <?php
                            if( 'yes' === $settings['category'] ) {
                                Helper::get_terms( 'category', 1, true, 'hq-card-category', false );
                            }
                            if( 'yes' === $settings['reading_time'] ) {
                                echo '<div class="reading-time" title="'. esc_html__( 'Take ', 'edumentor' ) . Helper::get_post_reading_time('full') . esc_html__( ' to read.', 'edumentor' ) .'"><i class="far fa-clock"></i> '. esc_html( Helper::get_post_reading_time() ) .'</div>';
                            } 
                        ?>
                    </div>
                    <?php endif; ?>
                    <<?php echo esc_attr( $heading_tag ); ?> class="hq-card-title">
                        <a href="<?php the_permalink(); ?>" class="hq-link-hover"><?php Helper::limit_latter( get_the_title(), $settings['title_length'], $settings['title_suffix'] ); ?></a>
                    </<?php echo esc_attr( $heading_tag ); ?>>
                    <?php if( 'yes' === $settings['author'] || 'yes' === $settings['show_readmore'] ) : ?>
                    <div class="card-footer">
                        <?php
                        if( 'yes' === $settings['author'] ) {
                            $avatar = 'yes' === $settings['author_avatar'] ? true : false;
                            Helper::get_posted_by( $avatar, $settings['posted_by'] );
                        }
                        if( 'yes' === $settings['show_readmore'] ) {
                            echo '<a href="'. esc_url( get_the_permalink() ) .'" class="read-more"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32"><path d="M 18.71875 6.78125 L 17.28125 8.21875 L 24.0625 15 L 4 15 L 4 17 L 24.0625 17 L 17.28125 23.78125 L 18.71875 25.21875 L 27.21875 16.71875 L 27.90625 16 L 27.21875 15.28125 Z"/></svg></a>';
                        }
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>
        <?php
    }

    /**
     * Style 5
     */
    static function style_5($settings = [], $post_id = '') {
        $heading_tag = ! empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h3'; ?>
        <article <?php body_class(['hq-card', 'style-5']); ?>>
            <div class="hq-card-inner">
                <div class="hq-card-thumb">
                    <a href="<?php the_permalink(); ?>" class="ov-link" title="<?php the_title(); ?>"></a>
                    <?php if( has_post_thumbnail() ) : ?>
                        <?php echo get_the_post_thumbnail( $post_id, $settings['img_size'] ); ?>
                    <?php else: ?>
                        <img src="<?php echo esc_url( Helper::get_placeholder() ); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    <?php 
                    if( 'yes' === $settings['category'] ) {
                        Helper::get_terms( 'category', 1, true, 'hq-card-category', false );
                    } ?>
                </div>
                <div class="hq-card-content">
                    <?php if( 'yes' === $settings['meta_info'] ){ Helper::get_post_meta($settings, $settings['meta_icon']); } ?>
                    <<?php echo esc_attr( $heading_tag ); ?> class="hq-card-title">
                        <a href="<?php the_permalink(); ?>" class="hq-link-hover"><?php Helper::limit_latter( get_the_title(), $settings['title_length'], $settings['title_suffix'] ); ?></a>
                    </<?php echo esc_attr( $heading_tag ); ?>>
                    <?php if( 'yes' === $settings['show_readmore'] || 'yes' === $settings['reading_time'] ) : ?>
                    <div class="card-footer">
                        <?php if( 'yes' === $settings['show_readmore'] ) : ?>
                        <a href="#" class="read-more"><?php echo esc_html( $settings['readmore_text'] ); ?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32"><path d="M 18.71875 6.78125 L 17.28125 8.21875 L 24.0625 15 L 4 15 L 4 17 L 24.0625 17 L 17.28125 23.78125 L 18.71875 25.21875 L 27.21875 16.71875 L 27.90625 16 L 27.21875 15.28125 Z"/></svg></a>
                        <?php 
                        endif;
                        if( 'yes' === $settings['reading_time'] ) {
                            echo '<div class="reading-time" title="'. esc_html__( 'Take ') . Helper::get_post_reading_time('full') . esc_html__( ' to read.', 'edumentor' ) .'"><i class="far fa-clock"></i> '. esc_html( Helper::get_post_reading_time() ) .'</div>';
                        } 
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>
        <?php
    }
}