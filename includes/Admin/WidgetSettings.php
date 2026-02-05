<?php
/**
 * Widget Settings Admin Class
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Admin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WidgetSettings {

    private $option_key = 'edumentor_enabled_widgets';

    /**
     * Init hooks
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_menu' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    /**
     * Add submenu under your main EduMentor menu
     */
    public function add_menu() {
        add_submenu_page(
            'themes.php',                       // parent slug
            __( 'Widgets', 'edumentor' ),      // page title
            __( 'Widgets', 'edumentor' ),      // menu title
            'manage_options',                  // capability
            'edumentor-widgets',               // menu slug
            [ $this, 'render_page' ]           // callback
        );
    }

    /**
     * Register option in WordPress
     */
    public function register_settings() {
        register_setting( 'edumentor_widget_settings', $this->option_key );
    }

    /**
     * Retrieve widgets list (from your main plugin class)
     */
    private function get_widgets() {
        if ( method_exists( '\HexQode\EduMentor\Classes\Widgets', 'get_widgets' ) ) {
            return \HexQode\EduMentor\Classes\Widgets::instance()->get_widgets();
        }

        // fallback if not accessible
        return [];
    }

    /**
     * Render settings page
     */
    public function render_page() {
        $widgets = $this->get_widgets();
        $enabled = get_option( $this->option_key, [] );

        if ( empty( $widgets ) ) {
            echo '<div class="notice notice-warning"><p>No widgets found.</p></div>';
            return;
        }

        // Group widgets
        $groups = [];
        foreach ( $widgets as $slug => $widget ) {
            $group = $widget['group'] ?? 'general';
            $groups[$group][$slug] = $widget;
        }

        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'EduMentor Widget Manager', 'edumentor' ); ?></h1>
            <p class="description">Enable or disable specific Elementor widgets for performance optimization and cleaner UI.</p>
            
            <form method="post" action="options.php">
                <?php settings_fields( 'edumentor_widget_settings' ); ?>

                <div class="edumentor-widget-groups" style="margin-top: 20px;">
                    <?php foreach ( $groups as $group => $items ) : ?>
                        <h2 style="margin-top:30px;"><?php echo esc_html( ucfirst( $group ) ); ?></h2>
                        <table class="widefat striped" style="max-width:800px;">
                            <tbody>
                                <?php foreach ( $items as $slug => $widget ) : 
                                    $checked = in_array( $slug, $enabled, true ) ? 'checked' : '';
                                    $disabled = '';
                                    $dep_note = '';

                                    // Dependency indicators
                                    if ( $widget['dep'] === 'cf7' && ! class_exists('WPCF7') ) {
                                        $disabled = 'disabled';
                                        $dep_note = ' (requires Contact Form 7)';
                                    }
                                    if ( $widget['dep'] === 'mc' && ! defined('MC4WP_VERSION') ) {
                                        $disabled = 'disabled';
                                        $dep_note = ' (requires Mailchimp for WP)';
                                    }
                                ?>
                                <tr>
                                    <td style="width:30px;">
                                        <input type="checkbox" name="<?php echo esc_attr( $this->option_key ); ?>[]" 
                                            value="<?php echo esc_attr( $slug ); ?>" 
                                            <?php echo $checked . ' ' . $disabled; ?>>
                                    </td>
                                    <td>
                                        <strong><?php echo esc_html( $widget['name'] ); ?></strong>
                                        <span style="color:#888;"><?php echo esc_html( $dep_note ); ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endforeach; ?>
                </div>

                <?php submit_button( __( 'Save Changes', 'edumentor' ) ); ?>
            </form>
        </div>
        <?php
    }
}