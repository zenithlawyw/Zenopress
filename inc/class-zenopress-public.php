<?php
/**
 * Zenospace Wordpress Vue public class
 * 
 * @author		Zenospace
 * @version		1.1.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists('ZenopressPublic') )
{
	final class ZenopressPublic
	{

		private static 	$_instance	= null;
    private static $_id = 'zenopress';
    private static $_type = 'client';
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
			add_action( 'wp_enqueue_scripts', [ $this, 'load_scripts' ] );
			add_shortcode(
        self::$_id . '_vuehome',
        [
          $this,
          'load_shortcode_content'
        ]
      );
		} // end: private function register_hooks() 

		public function load_shortcode_content() {
			$template_file = ZENOPRESS_TEMPLATE . 'zenopress-public.php';

			wp_enqueue_style( self::$_style_id );
			wp_enqueue_script( self::$_script_id );

			return file_get_contents( $template_file );
		}

		public function load_scripts() 
		{
			$vueDirectory = implode(
				DIRECTORY_SEPARATOR,
        [
          rtrim( ZENOPRESS_URI, '/' ),
          'vue',
          'dist',
          'public'
        ] 
			);
			wp_register_style(
        self::$_style_id,
        $vueDirectory . '/css/zenopress-public.css'
      );
			wp_register_script( 
        self::$_script_id, 
				$vueDirectory . '/js/zenopress-public.js',
				[],
				'1.0.0',
				true
			);
		} // end: public function load_scripts() 
	} // end: final class ZenopressPublic

	if ( ! function_exists( 'ZenopressPublic' ) ) 
	{
		function ZenopressPublic()
		{
			return ZenopressPublic::instance();
		}
	} // end: if ( ! function_exists( 'ZenopressPublic' ) ) 

	ZenopressPublic();

} // end: if ( ! class_exists('ZenopressPublic') )

//new ZenopressPublic();

$GLOBALS['ZenopressPublic'] = ZenopressPublic();
