<?php
/**
 * Installer class
 *
 * @package FlatPack
 * @version 1.0.0
 */
namespace DynamicLayers\FlatPack\Classes;

class Installer {

    /**
     * Run the installer
     *
     * @return void
     */
    public function run() {
        $this->add_version();
    }

    /**
     * Add time and version on DB
     */
    public function add_version() {
        $installed = get_option( 'flatpack_installed' );

        if ( ! $installed ) {
            update_option( 'flatpack_installed', time() );
        }

        update_option( 'flatpack_version', FLATPACK_VERSION );
    }
}
