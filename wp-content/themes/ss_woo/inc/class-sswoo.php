<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/18/2019
 * Time: 9:13 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Class_SSWoo' ) ) {
	class Class_SSWoo {
		static function init() {
			static $instance = null;
			if ( $instance === null ) {
				$instance = new self();
			}

			return $instance;
		}

		private function __construct() {
			$this->_load_assets();
			$this->_load_template();
			$this->_load_hooks();
			$this->_load_customizer();
			$this->_load_navwalker();
		}

		private function _load_assets() {
			require_once get_template_directory() . '/inc/class-sswoo-assets.php';
			Class_SSWoo_Assets::init();
		}

		private function _load_template() {
			require_once get_template_directory() . '/inc/class-sswoo-template.php';
		}

		private function _load_hooks() {
			require_once get_template_directory() . '/inc/class-sswoo-hooks.php';
			Class_SSWoo_Hooks::init();
		}

		private function _load_customizer() {
			require_once get_template_directory() . '/inc/kirki/kirki.php';
			require_once get_template_directory() . '/inc/class-sswoo-customizer.php';
			Class_SSWoo_Customizer::init();
			add_filter( 'kirki/config', array( $this, '_customizer_callback' ) );
		}

		private function _load_navwalker() {
			require_once get_template_directory() . '/inc/class-sswoo-navwalker.php';
		}

		function _customizer_callback() {
			return array( 'url_path' => get_template_directory_uri() . '/inc/kirki/' );
		}
	}
}