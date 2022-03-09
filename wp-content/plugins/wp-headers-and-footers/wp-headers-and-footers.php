<?php
/**
 * Plugin Name: WP Headers And Footers
 * Plugin URI: https://www.WPBrigade.com/wordpress/plugins/wp-headers-and-footers/
 * Description: Allows you to insert code or text in the header or footer of your WordPress site.
 * Version: 1.3.2
 * Author: WPBrigade
 * Author URI: https://wpbrigade.com/?utm_source=plugin-meta&utm_medium=author-uri-link
 * License: GPLv3
 * Text Domain: wp-headers-and-footers
 * Domain Path: /languages
 *
 * @package wp-headers-and-footers
 * @category Core
 * @author WPBrigade
 */

if ( ! class_exists( 'WPHeaderAndFooter' ) ) :

	/**
	 * The class WPHeaderAndFooter
	 */
	final class WPHeaderAndFooter {

		/**
		 * The single instance of the class.
		 *
		 * @var string $version
		 */
		public $version = '1.3.2';

		/**
		 * The single instance of the class.
		 *
		 * @var object $instance
		 */
		protected static $instance = null;

		/**
		 * WPHeaderAndFooter Class constructor
		 */
		public function __construct() {

			$this->define_constants();
			$this->includes();
			$this->hooks();
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @version 1.3.1
		 */
		public function includes() {

			include_once WPHEADERANDFOOTER_DIR_PATH . 'classes/class-setup.php';
			include_once WPHEADERANDFOOTER_DIR_PATH . 'classes/plugin-meta.php';

			// set the logger settings option if was not set before.
			if ( ! get_option( 'wpheaderandfooter_basics_logger' ) ) {

				$setting = get_option( 'wpheaderandfooter_basics' );

				$logger_value = array();

				$logger_value['is_using_wp_header_textarea'] = isset( $setting['wp_header_textarea'] ) && ! empty( trim( $setting['wp_header_textarea'] ) ) ? true : false;
				$logger_value['is_using_wp_body_textarea']   = isset( $setting['wp_body_textarea'] ) && ! empty( trim( $setting['wp_body_textarea'] ) ) ? true : false;
				$logger_value['is_using_wp_footer_textarea'] = isset( $setting['wp_footer_textarea'] ) && ! empty( trim( $setting['wp_footer_textarea'] ) ) ? true : false;

				update_option( 'wpheaderandfooter_basics_logger', $logger_value );
			}

			// init logger.
			include_once WPHEADERANDFOOTER_DIR_PATH . 'lib/wpb-sdk/init.php';

			new WPHeaderAndFooter_SDK\Logger(
				array(
					'name'     => 'WP Headers And Footers',
					'slug'     => 'wp-headers-and-footers',
					'path'     => __FILE__,
					'version'  => $this->version,
					'license'  => '',
					'settings' => array(
						'wpheaderandfooter_basics_logger' => false,
					),
				)
			);

		}

		/**
		 * Hook into actions and filters
		 *
		 * @since  1.0.0
		 * @version 1.3.1
		 */
		private function hooks() {

			add_action( 'plugins_loaded', array( $this, 'textdomain' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			add_action( 'wp_print_scripts', array( $this, 'admin_scripts' ) );
			add_action( 'wp_head', array( $this, 'frontend_header' ) );

			if ( function_exists( 'wp_body_open' ) && version_compare( get_bloginfo( 'version' ), '5.2', '>=' ) ) {
				add_action( 'wp_body_open', array( $this, 'frontend_body' ) );
			}

			add_action( 'wp_footer', array( $this, 'frontend_footer' ) );
		}

		/**
		 * Define WP Header and Footer Constants
		 */
		private function define_constants() {

			$this->define( 'WPHEADERANDFOOTER_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'WPHEADERANDFOOTER_DIR_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'WPHEADERANDFOOTER_DIR_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'WPHEADERANDFOOTER_ROOT_PATH', dirname( __FILE__ ) . '/' );
			$this->define( 'WPHEADERANDFOOTER_VERSION', $this->version );
			$this->define( 'WPHEADERANDFOOTER_FEEDBACK_SERVER', 'https://wpbrigade.com/' );
		}

		/**
		 * Admin Scripts
		 *
		 * @param string $page The page slug.
		 * @version 1.3.1
		 */
		public function admin_scripts( $page ) {

			if ( 'settings_page_wp-headers-and-footers' === $page ) {

				wp_enqueue_style( 'wpheaderandfooter_stlye', plugins_url( 'asset/css/style.css', __FILE__ ), array(), WPHEADERANDFOOTER_VERSION );

				$editor_args = array( 'type' => 'text/html' );

				if ( ! current_user_can( 'unfiltered_html' ) || ! current_user_can( 'manage_options' ) ) {
					$editor_args['codemirror']['readOnly'] = true;
				}

				// Enqueue code editor and settings for manipulating HTML.
				$settings = wp_enqueue_code_editor( $editor_args );

				// Bail if user disabled CodeMirror.
				if ( false === $settings ) {
					return;
				}

				wp_enqueue_script( 'wpheaderandfooter_script', plugins_url( 'asset/js/script.js', __FILE__ ), array( 'jquery' ), WPHEADERANDFOOTER_VERSION, false );

			}
		}

		/**
		 * Define constant if not already set
		 *
		 * @param string      $name The name of the variable.
		 * @param string|bool $value The value of the variable.
		 */
		private function define( $name, $value ) {

			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Main Instance
		 *
		 * @since 1.0.0
		 * @static
		 * @see wpheaderandfooter_loader()
		 * @return Main instance
		 */
		public static function instance() {

			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}


		/**
		 * Load Languages
		 *
		 * @since 1.0.0
		 */
		public function textdomain() {

			$plugin_dir = dirname( plugin_basename( __FILE__ ) );
			load_plugin_textdomain( 'wp-headers-and-footers', false, $plugin_dir . '/languages/' );
		}

		/**
		 * Outputs script / style to the header
		 *
		 * @since 1.0.0
		 * @version 1.3.2
		 */
		public function frontend_header() {

			/**
			 * Filter to add or exclude scripts to and from the frontend header.
			 *
			 * @since 1.3.2
			 */
			if ( apply_filters( 'wp_hnf_header_script', true ) ) {
				$this->wp_hnf_output( 'wp_header_textarea' );
			}
		}

		/**
		 * Outputs script / style to the frontend below opening body
		 *
		 * @since 1.0.0
		 * @version 1.3.2
		 */
		public function frontend_body() {

			/**
			 * Filter to add or exclude scripts to and from the frontend body.
			 *
			 * @since 1.3.2
			 */
			if ( apply_filters( 'wp_hnf_body_script', true ) ) {
				$this->wp_hnf_output( 'wp_body_textarea' );
			}
		}

		/**
		 * Outputs script / style to the footer
		 *
		 * @since 1.0.0
		 * @version 1.3.2
		 */
		public function frontend_footer() {

			/**
			 * Filter to add or exclude scripts to and from the frontend footer.
			 *
			 * @since 1.3.2
			 */
			if ( apply_filters( 'wp_hnf_footer_script', true ) ) {
				$this->wp_hnf_output( 'wp_footer_textarea' );
			}
		}

		/**
		 * Outputs the given setting, if conditions are met
		 *
		 * @param string $script Setting Name.
		 *
		 * @version 1.3.1
		 * @return output
		 */
		public function wp_hnf_output( $script ) {

			// Ignore admin, feed, robots or track backs.
			if ( is_admin() || is_feed() || is_robots() || is_trackback() ) :
				return;
			endif;

			// Get meta.
			$wp_hnf_setting = get_option( 'wpheaderandfooter_basics' );
			$meta           = ! empty( $wp_hnf_setting[ $script ] ) ? $wp_hnf_setting[ $script ] : false;

			if ( '' === trim( $meta ) || ! $meta ) :
				return;
			endif;

			// Output.
			echo wp_unslash( $meta ) . PHP_EOL;  // @codingStandardsIgnoreLine.
		}
	}

endif;


/**
 * Returns the main instance of WP to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return WPHeaderAndFooter
 */
function wpheaderandfooter_loader() {
	return WPHeaderAndFooter::instance();
}

// Call the function.
wpheaderandfooter_loader();
new WPHeaderAndFooter_Setting();
