<?php
/**
 * Plugin Name: EduMentor – LMS Addon for Elementor
 * Description: EduMentor is an LMS addon for Elementor that helps you design and customize online courses, lessons, and learning pages with ease. Fully compatible with LearnPress and TutorLMS.
 * Plugin URI: https://hexqode.com/edumentor
 * Author: Hexqode
 * Author URI: https://hexqode.com
 * Version: 1.0.0
 * Requires Plugins: elementor
 * Elementor tested up to: 3.16.5
 * License: GPL2 or later
 * Text Domain: edumentor
 * Domain Path: /languages
 * @package EduMentor
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class EduMentor {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.0';

    /**
     * Class construcotr
     */
    private function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'activate'] );

        add_action( 'plugins_loaded', [$this, 'init_plugin'] );

        add_action( 'elementor/init', [$this, 'elementor_init'] );
    }

    /**
     * Initializes a singleton instance
     *
     * @return \EduMentor
     */
    static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'EDUMENTOR_VERSION', self::version );
        define( 'EDUMENTOR_FILE', __FILE__ );
        define( 'EDUMENTOR_PATH', __DIR__ );
        define( 'EDUMENTOR_URL', plugins_url( '', EDUMENTOR_FILE ) );
        define( 'EDUMENTOR_ASSETS', EDUMENTOR_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        load_plugin_textdomain( 'edumentor', false, basename( dirname( __FILE__ ) ) . '/languages' );

        if ( is_admin() ) {
            new \HexQode\EduMentor\Classes\Elementor();
            new \HexQode\EduMentor\Admin\WidgetSettings();
        } else {
            new \HexQode\EduMentor\Classes\Assets();
        }

    }

    /**
     * Elementor Initialize
     *
     * @return void
     */
    public function elementor_init() {

        $assets = new \HexQode\EduMentor\Classes\Assets();
        $assets->el_scripts();
        new \HexQode\EduMentor\Classes\Widgets();
        new \HexQode\EduMentor\Classes\Controls();
        $wpml_manager = new \HexQode\EduMentor\Classes\WpmlManager();
        $wpml_manager->init();

    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new \HexQode\EduMentor\Classes\Installer();
        $installer->run();
    }
}

/**
 * Initializes the main plugin
 *
 * @return \EduMentor
 */
function edumentor_init() {
    return EduMentor::init();
}

// kick-off the plugin
edumentor_init();