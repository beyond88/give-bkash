<?php
/**
 * Plugin Name:         Give - Bkash
 * Plugin URI:          https://github.com/beyond88/give-bkash
 * Description:         A payment method for Give
 * Version:             1.0.0
 * Requires at least:   4.9
 * Requires PHP:        7.0
 * Author:              Mohiuddin Abdul Kader
 * Author URI:          https://github.com/beyond88
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:         give-bkash
 * Domain Path:         /languages
 * @package 			Bkash
 */

if	( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Give_Bkash {

    /**
    * Plugin version
    *
    * @var string
    */
    const version = '1.0.0';

    /**
     * Class constructor
     */
    private function __construct() {

        //REMOVE THIS AFTER DEV
        error_reporting(E_ALL ^ E_DEPRECATED);

        $this->define_constants();

        if (!function_exists('is_plugin_active')) {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        if ( is_plugin_active( 'give/give.php' ) ) {
            register_activation_hook( GIVE_BKASH_FILE, [ $this, 'activate' ] );
            add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );

        } else {
            add_action( 'admin_notices', [ $this, 'givewp_plugin_required' ] );
        }
    }

    public function givewp_plugin_required()
    {
        ?>
        <script>
            (function($) {
                'use strict';
                $(document).on("click", '.notice-dismiss', function(){
                    $(this).parent().fadeOut();
                });
            })(jQuery);
        </script>
        <div id="message" class="error notice is-dismissible">
            <p><?php echo __('GiveWP plugin is required for Give-Bkash!', 'give-bkash'); ?></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php echo __('Dismiss this notice.', 'give-bkash'); ?></span>
            </button>
        </div>
        <?php
    }

    /**
     * Initializes a singleton instance
     *
     * @return \Give_BKASH
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
            $instance->setup();
        }

        return $instance;
    }

    /**
     * Setup Fee Recovery.
     *
     * @since  1.3.0
     * @access private
     */
    private function setup() {
        add_action('before_give_init', [ $this, 'register_service_providers' ] );
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'GIVE_BKASH_VERSION', self::version );
        define( 'GIVE_BKASH_FILE', __FILE__ );
        define( 'GIVE_BKASH_PATH', __DIR__ );
        // define( 'GIVE_BKASH_TEMPLATES', GIVE_BKASH_PATH . '/includes/Templates/' );
        define( 'GIVE_BKASH_URL', plugins_url( '', GIVE_BKASH_FILE ) );
        define( 'GIVE_BKASH_ASSETS', GIVE_BKASH_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        // new Give_Bkash\Assets();

        // if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        //     new Give_Bkash\Ajax();
        // }

        // //if ( is_admin() ) {
        // new Give_Bkash\Admin();
        // //} else {
        // new Give_Bkash\Frontend();
        // //}

        // new Give_Bkash\API();
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        // $installer = new Give_Bkash\Installer();
        // $installer->run();
    }

    /**
     * Registers the Service Providers with GiveWP core
     *
     * @since 1.9.0
     */
    public function register_service_providers()
    {
        // foreach ($this->service_providers as $service_provider) {
        //     give()->registerServiceProvider($service_provider);
        // }
    }

}
