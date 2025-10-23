<?php
/**
 * Button
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Elementor\Widgets\Button;

use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use HexQode\EduMentor\Traits\CommonControls;

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
        return 'edumentor-button';
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
        return esc_html__( 'Button', 'edumentor' );
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
        return 'edumentor-icon eicon-button';
    }

    public function get_categories() {
        return ['edumentor'];
    }

    public function get_keywords() {
        return [ 'button', 'edumentor' ];
    }

    public function get_style_depends() {
        return [ 'edumentor-button' ];
    }

    /**
     * Register controls
     */
    protected function register_controls() {

        $this->button_section();
        $this->button_style();
        $this->button_icon_style();
        
    }

    /**
     * Render Content
     *
     * @return void
     */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'wrapper','class','hq-el-btn-wrap' );
        $this->add_inline_editing_attributes( 'btn_text', 'none' );
        if( 'hq-el-btn-default' === $settings['button_effect'] ) {
            $effect_class = isset( $settings['btn_ouline']) && 'yes' === $settings['btn_ouline'] ? 'hq-el-btn-outline' : 'hq-el-btn-default';
            $this->add_render_attribute( 'link',[ 'class' => ['hq-el-btn', $effect_class ] ] );
        } else {
            $this->add_render_attribute( 'link',[ 'class' => ['hq-el-btn', $settings['button_effect'] ] ] );
        }
        $this->add_render_attribute( 'link','data-effect',$settings['button_effect'] );
        $this->add_link_attributes( 'link', $settings['btn_link'] );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
                <?php if ( ! empty( $settings['btn_icon']['value'] ) ) : ?>
                    <spn class="hq-el-btn-inner">
                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <span <?php echo $this->get_render_attribute_string( 'btn_text' ); ?>><?php echo esc_html( $settings['btn_text'] ); ?></span>
                    </spn>
                    <?php if( 'hq-el-effect-3' === $settings['button_effect'] ) {
                        echo '<span class="bg"></span>';
                    } ?>
                <?php else : ?>
                    <span <?php echo $this->get_render_attribute_string( 'btn_text' ); ?>><?php echo esc_html( $settings['btn_text'] ); ?></span>
                    <?php if( 'hq-el-effect-3' === $settings['button_effect'] ) {
                        echo '<span class="bg"></span>';
                    } ?>
                <?php endif; ?>
            </a>
        </div>
        <?php
    }

}