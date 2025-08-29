<?php
/**
 * Elementor class
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace DynamicLayers\FlatPack\Classes;

defined( 'ABSPATH' ) || die();

class Elementor {

    const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

    const MINIMUM_PHP_VERSION = '7.4';

    /**
     * Class constructor
     */
    function __construct() {

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_missing_elementor'] );
            return;
        }

        // Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
        }
        
        // Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
        }

        add_action( 'elementor/elements/categories_registered', [ $this, 'categories_register' ] );

    }

    /**
     * Admin notice for missing Elementor
     */
    public function admin_notice_missing_elementor() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $notice = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Elementor installation link */
            '%1$s '. esc_html__( 'requires', 'flatpack' ) .' %2$s '. esc_html__( 'to be installed and activated to function properly.', 'flatpack' ) .' %3$s',
            '<strong>FlatPack Addons for Elementor</strong>',
            '<strong>Elementor</strong>',
            '<a href="' . esc_url( admin_url( 'plugin-install.php?s=Elementor&tab=search&type=term' ) ) . '">' . esc_html__( 'Please click on this link to install Elementor', 'flatpack' ) . '</a>'
        );
    
        printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
    }

    /**
     * Admin notice for minimum Elementor version
     */
    public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'flatpack' ),
			'<strong>FlatPack Addons for Elementor</strong>',
			'<strong>Elementor</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }
    
    /**
     * Admin notice for minimum PHP version
     */
    public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'flatpack' ),
			'<strong>FlatPack Addons for Elementor</strong>',
			'<strong>PHP</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Register Category
     *
     * @param [type] $elements_manager
     * @return void
     */
    public function categories_register( $elements_manager ){

        $elements_manager->add_category(
            'flatpack',
            [
                'title' => esc_html__( 'FlatPack', 'flatpack' ),
                'icon' => 'eicon-parallax',
            ]
        );

    }

}
