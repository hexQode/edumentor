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
        return [ 'hq-main' ];
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
        $this->add_render_attribute( 'wrapper','class','hq-btn-wrap' );
        $this->add_inline_editing_attributes( 'btn_text', 'none' );
        $this->add_render_attribute( 'link','class','hq-btn' );
        $this->add_link_attributes( 'link', $settings['btn_link'] );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
                <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <span <?php echo $this->get_render_attribute_string( 'btn_text' ); ?>><?php echo esc_html( $settings['btn_text'] ); ?></span>
            </a>
        </div>
        <?php
    }

    /**
	 * Render counter widget output in the editor.
	 */
    protected function content_template() {
        ?>
        <#
        view.addRenderAttribute( 'wrapper', 'class', 'hq-btn-wrap' );
		view.addInlineEditingAttributes( 'btn_text', 'none' );
        var target = settings.btn_link.is_external ? ' target="_blank"' : '';
		var nofollow = settings.btn_link.nofollow ? ' rel="nofollow"' : '';
        var iconHTML = elementor.helpers.renderIcon( view, settings.btn_icon, { 'aria-hidden': true }, 'i' , 'object' );
        #>
        <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
            <a href="{{{ settings.btn_link.url }}}" {{{ target }}} {{{ nofollow }}}>
                {{{ iconHTML.value }}}
                <span {{{ view.getRenderAttributeString( 'btn_text' ) }}}>{{{ settings.btn_text }}}</span>
            </a>
        </div>
        <?php
    }

}