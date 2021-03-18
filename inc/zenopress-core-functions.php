<?php
/**
 * Zenospace Wordpress Vue functions
 * 
 * @author		Zenospace, zenithlaw
 * @package		ZWP-Vue/Function
 * @version		1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists('write_log') ) {
	function write_log( $log ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}
