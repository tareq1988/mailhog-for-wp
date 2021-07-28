<?php
/**
 * Plugin Name: Mailhog for WordPress
 * Description: This plugin routes your emails to MailHog for development purpose.
 * Plugin URI: https://tareq.co
 * Author: Tareq Hasan
 * Author URI: https://tareq.co
 * Version: 1.0.1
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

/**
 * WP MailHog
 */
class WP_MailHog {

    function __construct() {
        $this->define_constants();
        $this->init_phpmailer();
    }

    /**
     * Define constants
     *
     * @return void
     */
    public function define_constants() {

        if ( ! defined( 'WP_MAILHOG_HOST') ) {
            define( 'WP_MAILHOG_HOST', '127.0.0.1' );
        }

        if ( ! defined( 'WP_MAILHOG_PORT') ) {
            define( 'WP_MAILHOG_PORT', 1025 );
        }
    }

    /**
     * Override the PHPMailer SMTP options
     *
     * @return void
     */
    public function init_phpmailer() {
        add_action( 'phpmailer_init', function( $phpmailer ) {
            $phpmailer->Host     = WP_MAILHOG_HOST;
            $phpmailer->Port     = WP_MAILHOG_PORT;
            $phpmailer->SMTPAuth = false;
            $phpmailer->isSMTP();
        } );
    }
}

new WP_MailHog();
