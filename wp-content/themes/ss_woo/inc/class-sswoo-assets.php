<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/18/2019
 * Time: 9:16 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Class_SSWoo_Assets' ) ) {
	class Class_SSWoo_Assets {
		static function init() {
			static $instance = null;
			if ( $instance === null ) {
				$instance = new self();
			}

			return $instance;
		}

		private function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'global_assets_callback' ) );
		}

		function global_assets_callback() {

			//load bootstrap's assets
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css' );

			//load font's assets
			wp_enqueue_style( 'font_awesome', get_template_directory_uri() . '/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css' );
			wp_enqueue_style( 'themify', get_template_directory_uri() . '/assets/fonts/themify/themify-icons.css' );
			wp_enqueue_style( 'linearicons', get_template_directory_uri() . '/assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css' );
			wp_enqueue_style( 'elegant_font', get_template_directory_uri() . '/assets/fonts/elegant-font/html-css/style.css' );

			//load other dependencies
			wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/vendor/animate/animate.css' );
			wp_enqueue_style( 'hamburger', get_template_directory_uri() . '/assets/vendor/css-hamburgers/hamburgers.min.css' );
			wp_enqueue_style( 'animsition', get_template_directory_uri() . '/assets/vendor/animsition/css/animsition.min.css' );
			wp_enqueue_style( 'select-2', get_template_directory_uri() . '/assets/vendor/select2/select2.min.css' );
			wp_enqueue_style( 'daterange-picker', get_template_directory_uri() . '/assets/vendor/daterangepicker/daterangepicker.css' );
			wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/vendor/slick/slick.css' );
			wp_enqueue_style( 'lightbox-2', get_template_directory_uri() . '/assets/vendor/lightbox2/css/lightbox.min.css' );

			//load main css
			wp_enqueue_style( 'util', get_template_directory_uri() . '/assets/css/util.min.css' );
			wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.min.css' );
			wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css' );

			//load dependencies
			wp_enqueue_script( 'animsition', get_template_directory_uri() . '/assets/vendor/animsition/js/animsition.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/vendor/bootstrap/js/popper.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'select-2', get_template_directory_uri() . '/assets/vendor/select2/select2.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/vendor/slick/slick.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'slick-custom', get_template_directory_uri() . '/assets/js/slick-custom.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'countdown-time', get_template_directory_uri() . '/assets/vendor/countdowntime/countdowntime.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'lightbox-2', get_template_directory_uri() . '/assets/vendor/lightbox2/js/lightbox.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'sweetalert', get_template_directory_uri() . '/assets/vendor/sweetalert/sweetalert.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'parallax100', get_template_directory_uri() . '/assets/vendor/parallax100/parallax100.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), false, true );
			wp_localize_script( 'custom', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		}
	}
}