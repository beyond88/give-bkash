<?php
namespace GiveBkash;
use GiveBkash\Helpers;

/**
 * Installer class
 */
class Installer {

    /**
     * Run the installer
     *
	 * @since 1.0.0
	 * @access public
	 * @param none
	 * @return void
     */
    public function run() {
        $this->add_version();
    }

    /**
     * Add time and version on DB
	 *
	 * @since 1.0.0
	 * @access public
	 * @param none
	 * @return void
     */
    public function add_version() {
        $installed = get_option( 'give_bkash_installed' );

        if ( ! $installed ) {
            update_option( 'give_bkash_installed', time() );
        }

        update_option( 'give_bkash_version', GIVE_BKASH_VERSION );
    }

}
