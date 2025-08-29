<?php
/**
 * Plugin Name: FlatPack Addons for Elementor
 * Description: FlatPack Addons for Elementor is a versatile collection of over 20 custom widgets for Elementor, designed and created by DynamicLayers. These widgets offer flexibility, easy styling, and a comprehensive range of options.
 * Plugin URI: https://dynamiclayers.net/flatpack
 * Author: DynamicLayers
 * Author URI: https://dynamiclayers.net
 * Version: 1.0.0
 * Elementor tested up to: 3.16.5
 * License: GPL2 or later
 * Text Domain: flatpack
 * Domain Path: /languages
 * @package FlatPack
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class FlatPack {

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
     * @return \FlatPack
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
        define( 'FLATPACK_VERSION', self::version );
        define( 'FLATPACK_FILE', __FILE__ );
        define( 'FLATPACK_PATH', __DIR__ );
        define( 'FLATPACK_URL', plugins_url( '', FLATPACK_FILE ) );
        define( 'FLATPACK_ASSETS', FLATPACK_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        load_plugin_textdomain( 'flatpack', false, basename( dirname( __FILE__ ) ) . '/languages' );
        

        if ( is_admin() ) {
            new \DynamicLayers\FlatPack\Classes\Elementor();
        } else {
            new \DynamicLayers\FlatPack\Classes\Assets();
        }

    }

    /**
     * Elementor Initialize
     *
     * @return void
     */
    public function elementor_init() {

        $assets = new \DynamicLayers\FlatPack\Classes\Assets();
        $assets->el_scripts();
        new \DynamicLayers\FlatPack\Classes\Widgets();
        new \DynamicLayers\FlatPack\Classes\Controls();
        $wpml_manager = new \DynamicLayers\FlatPack\Classes\WpmlManager();
        $wpml_manager->init();

    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new \DynamicLayers\FlatPack\Classes\Installer();
        $installer->run();
    }
}

/**
 * Initializes the main plugin
 *
 * @return \FlatPack
 */
function flatpack_init() {
    return FlatPack::init();
}

// kick-off the plugin
flatpack_init();

/**
 * List of Widgets
 * ===============
 * 1. Heading - done
 * 2. Animated Text - f - done
 * 3. Info Box - f
 * 4. Testimonials - f
 * 5. Testimonials Carousel - f
 * 6. Flip Box - f
 * 7. Sponsor - done
 * 8. Sponsor Carousel - f 
 * 9. Team - f - done
 * 10. Team Carousel
 * 11. Counter - done
 * 12. Countdown - done
 * 13. Button - done
 * 14. Dual Button
 * 15. Pricing List - done
 * 16. Before After
 * 17. Progress Bar - f
 * 18. Pie Chart
 * 19. Image Carousel - f
 * 20. Advanced Tabs
 * 21. Advanced Accordion
 * 22. Business Hours - f - done
 * 23. Charts
 * 24. FAQ - f
 * 25. Social Icons - f - done
 * 26. Social Sharing
 * 27. Image Hotspots
 * 28. Image Hover Effect
 * 29. Posts Grid - f
 * 30. Posts Carousel - f
 * 31. Contact Form 7 - done
 * 32. Video Box
 * 33. Play Button
 * 34. Call to Action - f
 * 35. Section Title - f
 * 36. MailChimp Form - f - done
 * 37. Pricing Table - f
 * 38. Timeline - f - done
 */

/**
{
    "liveSassCompile.settings.autoprefix": [
        "> 1%",
        "last 2 versions"
    ],
    "liveSassCompile.settings.generateMap": false,
    "liveSassCompile.settings.showOutputWindowOn": "None",
    "liveSassCompile.settings.forceBaseDirectory": "/wp-content/plugins/flatpack-addons-for-elementor/assets/scss",
    "liveSassCompile.settings.compileOnWatch": true,
    "liveSassCompile.settings.formats": [
        {
            "format": "compressed",
            "extensionName": ".min.css",
            "savePath": "/wp-content/plugins/flatpack-addons-for-elementor/assets/css"
        }
    ],
    "files.associations": {
        "*.min.css": "plaintext"
    },
    "[css]": {
        "editor.formatOnSave": true,
        "editor.defaultFormatter": "michelemelluso.code-beautifier"
    },
    "[scss]": {
        "editor.formatOnSave": true,
        "editor.defaultFormatter": "michelemelluso.code-beautifier"
    },
    "[plaintext]": {
        "editor.formatOnSave": false
    }
}
 */