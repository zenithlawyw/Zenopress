<?php
/**
 * Plugin Name: Zenopress - Admin Dashboard in WordPress
 * Plugin URI: http://www.zenospace.com/
 * Description: A dashboard for managing Shoebill Health apppointment system settings and data
 * Author: Zenospace
 * Version: 1.0.0
 * Author URI: http://zenospace.com/
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ZENOPRESS' ) ) 
{
	final class ZENOPRESS
	{

		private static 	$_instance 	= null;
		public 			    $_session 	= null;

		public static function instance()
		{
			if ( ! empty( self::$_instance ) ) {
				return self::$_instance;
			}

			return self::$_instance = new self();
		}

		public function __construct()
		{
			$this->define_constants();
			$this->includes();
			$this->register_hooks();
		} // end: function __construct()

		public function define_constants()
		{
			$this->_define( 'ZENOPRESS_PATH',			plugin_dir_path( __FILE__ ) );
			$this->_define( 'ZENOPRESS_URI',			plugin_dir_url( __FILE__ ) );
			$this->_define( 'ZENOPRESS_INC',			ZENOPRESS_PATH . 'inc/' );
			$this->_define( 'ZENOPRESS_INC_URI', 		ZENOPRESS_URI . 'inc/' );
			$this->_define( 'ZENOPRESS_ASSETS_URI', 	ZENOPRESS_URI . 'assets/' );
			$this->_define( 'ZENOPRESS_LIB_URI', 		ZENOPRESS_INC_URI . 'libraries/' );
			$this->_define( 'ZENOPRESS_TEMPLATE',		ZENOPRESS_PATH . 'templates/' );
			$this->_define( 'ZENOPRESS_VER', 			'1.0.0' );
			$this->_define( 'ZENOPRESS_MAIN_FILE', 	__FILE__ );
		} // end: function define_constants()

		public function includes()
		{
			$this->_include( ZENOPRESS_INC . 'zenopress-core-functions.php' );

			if ( is_admin() ) {
				$this->_include( ZENOPRESS_INC . 'admin/class-zenopress-admin.php' );
			} else {
				$this->_include( ZENOPRESS_INC . 'class-zenopress-public.php' );
			}
		} // end: function includes()

		public function register_hooks()
		{
			add_action( 'plugins_loaded', [ $this, '_loaded' ] );
		} // end: function register_hooks()

		public function text_domain()
		{
			$text_domain	= 'zenopress';
			$locale			= apply_filter( 'plugins_locale', get_locale(), $text_domain );
			$mo_file		= $text_domain . '-' . $locale . '.mo';
			$mo_global		= WP_LANG_DIR . '/plugins/' . $mo_file;
			if ( file_exists( $mo_global ) ) {
				load_textdomain( $text_domain, $mo_global );
			} else {
				load_textdomain( $text_domain, ZENOPRESS_PATH . '/languages/' . $mo_file );
			}
		}

		public function _loaded() 
		{
			do_action( 'zenopress_init', $this );
		} // end: function _loaded()

		public function _define( $name = '', $value = '' )
		{
			if ( $name && ! defined( $name ) ) {
				define( $name, $value );
			}
		} // end: function _define()

		public function _include( $file = null )
		{
			if ( is_array( $file ) ) {
				foreach ( $file as $key => $f ) {
					if ( file_exists( ZENOPRESS_PATH . $f ) ) {
						require_once ZENOPRESS_PATH . $f;
					}
				}
			} else {
				if ( file_exists( ZENOPRESS_PATH . $file ) ) {
					require_once ZENOPRESS_PATH . $file;
				} elseif ( file_exists( $file ) ) {
					require_once $file;
				}
			}
		} // end: function _include()
	} // end: final class ZENOPRESS

	if ( ! function_exists( 'ZENOPRESS' ) ) 
	{
		function ZENOPRESS()
		{
			return ZENOPRESS::instance();
		}
	} // end: if ( ! function_exists( 'ZENOPRESS' ) ) 

	ZENOPRESS();

} // end: if ( ! class_exists( 'ZENOPRESS' ) ) 

$GLOBALS['ZENOPRESS'] = ZENOPRESS();
