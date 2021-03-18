<?php
/**
 * Zenospace Wordpress Vue admin class
 * 
 * @author		Zenospace
 * @version		1.1.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists('ZenopressAdmin') )
{
	final class ZenopressAdmin
	{

		private static 	$_instance	= null;
    private static $_id = 'zenopress';
    private static $_type = 'admin';
    private static $_style_id = null;
    private static $_script_id = null;

		public 			$_session	= null;

		public static function instance()
		{
			if ( ! empty( self::$_instance ) ) {
				return self::$_instance;
			}	
			return self::$_instance = new self();
		} // end: public static function instance()

		public function __construct() 
		{
			$this->define_constants();
			$this->register_hooks();
		} // end: public function __construct()

		private function define_constants()
		{
			//
      self::$_script_id = implode('-', [ self::$_id, 'vue', self::$_type, 'script']);
      self::$_style_id = implode('-', [ self::$_id, 'vue', self::$_type, 'style']);
		} // end: private function define_constants()

		private function register_hooks() 
		{
			add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'load_scripts' ] );
		} // end: private function register_hooks() 

		public function add_admin_menu() 
		{
			add_menu_page(
				'Shoebill Health - Admin Dashboard',
				'Shoebill',
				'manage_options',
				'zenopress',
				[ $this, 'load_zenopress_page' ],
				'dashicons-smiley',
				4
			);
		} // end: public function add_admin_menu() 

		public function load_zenopress_page() 
		{
			$template_file = ZENOPRESS_TEMPLATE . 'zenopress-admin.php';

			wp_enqueue_style( self::$_style_id );
			wp_enqueue_script( self::$_script_id );

			require_once $template_file;
		} // end: public function load_zenopress_page() 

		public function load_scripts() 
		{
			$vueDirectory = join(
				DIRECTORY_SEPARATOR,
        [
          rtrim( ZENOPRESS_URI, '/' ),
          'vue',
          'dist',
          'admin'
        ] 
			);

			wp_register_style( 
        self::$_style_id,
        $vueDirectory . '/css/zenopress-admin.css' 
      );
			wp_register_script( 
        self::$_script_id, 
				$vueDirectory . '/js/zenopress-admin.js',
				[],
				'1.0.0',
				true
			);
		} // end: public function load_scripts() 
	} // end: final class ZenopressAdmin

	if ( ! function_exists( 'ZenopressAdmin' ) ) 
	{
		function ZenopressAdmin()
		{
			return ZenopressAdmin::instance();
		}
	} // end: if ( ! function_exists( 'ZenopressAdmin' ) ) 

	ZenopressAdmin();

} // end: if ( ! class_exists('ZenopressAdmin') )

//new ZenopressAdmin();

$GLOBALS['ZenopressAdmin'] = ZenopressAdmin();
