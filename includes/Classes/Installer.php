<?php
/**
 * Installer class
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Classes;

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
        $installed = get_option( 'edumentor_installed' );

        if ( ! $installed ) {
            update_option( 'edumentor_installed', time() );
        }

        update_option( 'edumentor_version', EDUMENTOR_VERSION );
    }
}
