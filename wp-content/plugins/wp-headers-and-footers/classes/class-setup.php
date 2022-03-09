<?php

/**
 * WordPress Header and Footer Setup
 *
 * @package wp-headers-and-footers
 */

if ( ! class_exists( 'WPHeaderAndFooter_Setting' ) ) :
	/**
	 * The WPHeaderAndFooter Settings class
	 */
	class WPHeaderAndFooter_Setting {

		/**
		 * Settings sections array
		 *
		 * @var array $settings_api The settings API array.
		 */
		private $settings_api;

		/**
		 * The constructor of WPHeaderAndFooter Settings class
		 */
		public function __construct() {

			include_once WPHEADERANDFOOTER_DIR_PATH . 'classes/class-settings-api.php';
			$this->settings_api = new WPHeaderAndFooter_Settings_API();

			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_menu', array( $this, 'register_options_page' ) );
		}

		/**
		 * Admin initialize function.
		 */
		public function admin_init() {

			// Set the settings.
			$this->settings_api->set_sections( $this->get_settings_sections() );
			$this->settings_api->set_fields( $this->get_settings_fields() );

			// Initialize settings.
			$this->settings_api->admin_init();
		}

		/**
		 * Register the plugin settings panel
		 *
		 * @since 1.1.0
		 */
		public function register_options_page() {

			add_submenu_page( 'options-general.php', __( 'WP Headers and Footers', 'wp-headers-and-footers' ), __( 'WP Headers and Footers', 'wp-headers-and-footers' ), 'manage_options', 'wp-headers-and-footers', array( $this, 'wp_header_and_footer_callback' ) );
		}

		/**
		 * The settings section.
		 *
		 * @since 1.1.0
		 */
		public function get_settings_sections() {
			$sections = array(
				array(
					'id'    => 'wpheaderandfooter_basics',
					'title' => __( 'Settings', 'wp-headers-and-footers' ),
					'desc'  => __( 'WP Headers and Footers.', 'wp-headers-and-footers' ),
				),
			);
			return $sections;
		}

		/**
		 * Returns all the settings fields
		 *
		 * @since 1.0.0
		 * @version 1.2.3
		 *
		 * @return array settings fields
		 */
		public function get_settings_fields() {
			$settings_fields = array(
				'wpheaderandfooter_basics' => array(
					array(
						'name'  => 'wp_header_textarea',
						'label' => __( 'Scripts in Header', 'wp-headers-and-footers' ),
						/* Translators: The header textarea description */
						'desc'  => sprintf( __( 'These scripts will be printed in the %1$s section.', 'wp-headers-and-footers' ), '&#60head&#62' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'wp_body_textarea',
						'label' => __( 'Scripts in Body', 'wp-headers-and-footers' ),
						/* Translators: The body textarea description */
						'desc'  => sprintf( __( 'These scripts will be printed below the %1$s tag.', 'wp-headers-and-footers' ), '&#60body&#62' ),
						'type'  => 'textarea',
					),
					array(
						'name'  => 'wp_footer_textarea',
						'label' => __( 'Scripts in Footer', 'wp-headers-and-footers' ),
						/* Translators: The footer textarea description */
						'desc'  => sprintf( __( 'These scripts will be printed below the %1$s tag.', 'wp-headers-and-footers' ), '&#60footer&#62' ),
						'type'  => 'textarea',
					),
				),
			);

			return $settings_fields;
		}

		/**
		 * The header and footer settings section and forms callback
		 *
		 * @since 1.1.0
		 */
		public function wp_header_and_footer_callback() {
			echo '<div class="wrap wp-headers-and-footers">';

			$this->settings_api->show_navigation();
			$this->settings_api->show_forms();

			echo '</div>';
		}

		/**
		 * Get all the pages
		 *
		 * @return array page names with key value pairs
		 */
		public function get_pages() {
			$pages         = get_pages();
			$pages_options = array();
			if ( $pages ) {
				foreach ( $pages as $page ) {
					$pages_options[ $page->ID ] = $page->post_title;
				}
			}

			return $pages_options;
		}

	}
endif;
