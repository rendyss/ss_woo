<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/18/2019
 * Time: 10:00 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Class_SSWoo_Hooks' ) ) {
	class Class_SSWoo_Hooks {
		static function init() {
			static $instance = null;
			if ( $instance === null ) {
				$instance = new self();
			}

			return $instance;
		}

		private function __construct() {
			$this->_add_head_doc();
			$this->_add_theme_support();
			$this->_register_menu_nav();
		}

		private function _add_head_doc() {
			add_action( 'wp_head', array( $this, '_head_doc_callback' ) );
		}

		private function _add_theme_support() {
			add_theme_support( 'title-tag' );
			add_theme_support( 'woocommerce' );
		}

		function _head_doc_callback() {
			echo "<meta charset=\"utf-8\">";
			echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";
		}

		private function _register_menu_nav() {
			register_nav_menus( array(
				'main_menu'   => 'Main Menu',
				'footer_menu' => 'Footer Menu',
			) );
		}
	}
}