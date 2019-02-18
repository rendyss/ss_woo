<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/18/2019
 * Time: 1:50 PM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Class_SSWoo_Woocommerce' ) ) {
	class Class_SSWoo_Woocommerce {
		static function init() {
			static $instance = null;
			if ( $instance === null ) {
				$instance = new self();
			}

			return $instance;
		}

		private function __construct() {
			$this->_single_product_add_to_cart_customizer();
			$this->_single_product_meta_customizer();
			$this->_single_product_notice_customizer();
		}

		private function _single_product_notice_customizer() {
//			add_action( 'woocommerce_before_single_product', array(
//				$this,
//				'_single_product_before_notice_callback'
//			), 5 );
//			add_action( 'woocommerce_before_single_product', array(
//				$this,
//				'_single_product_after_notice_callback'
//			), 15 );
		}

//		function _single_product_before_notice_callback() {
//			echo "<div class=\"p-t-35 p-b-35\">";
//		}
//
//		function _single_product_after_notice_callback() {
//			echo "</div>";
//		}

		private function _single_product_meta_customizer() {
			add_action( 'woocommerce_product_meta_start', array( $this, '_product_meta_start_callback' ) );
			add_action( 'woocommerce_product_meta_end', array( $this, '_product_meta_end_callback' ) );
		}

		function _product_meta_end_callback() {
			echo "</div>";
		}

		function _product_meta_start_callback() {
			echo "<div class=\"p-b-45\">";
		}

		private function _single_product_add_to_cart_customizer() {
			add_action( 'woocommerce_before_add_to_cart_form', array( $this, '_before_add_to_cart_form_callback' ) );
			add_action( 'woocommerce_after_add_to_cart_form', array( $this, '_after_add_to_cart_form_callback' ) );
			add_action( 'woocommerce_before_add_to_cart_button', array(
				$this,
				'_before_add_to_cart_button_callback'
			) );
			add_action( 'woocommerce_after_add_to_cart_button', array( $this, '_after_add_to_cart_button_callback' ) );
			add_action( 'woocommerce_after_add_to_cart_quantity', array(
				$this,
				'_after_add_to_cart_quantity_callback'
			) );

			add_action( 'woocommerce_before_add_to_cart_quantity', array(
				$this,
				'_before_add_to_cart_quantity_callback'
			) );

		}

		function _before_add_to_cart_quantity_callback() {
			echo "<div class=\"flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10\">";
			echo "<button class=\"btn-num-product-down color1 flex-c-m size7 bg8 eff2\"><i class=\"fs-12 fa fa-minus\" aria-hidden=\"true\"></i></button>";
		}

		function _after_add_to_cart_quantity_callback() {
			echo "<button class=\"btn-num-product-up color1 flex-c-m size7 bg8 eff2\"><i class=\"fs-12 fa fa-plus\" aria-hidden=\"true\"></i></button>";
			echo "</div>";
			echo "<div class=\"btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10\">";
		}

		function _before_add_to_cart_button_callback() {
			echo "<div class=\"flex-r-m flex-w p-t-10\">";
			echo "<div class=\"w-size16 flex-m flex-w\">";
		}

		function _after_add_to_cart_button_callback() {
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}

		function _before_add_to_cart_form_callback() {
			echo "<div class=\"p-t-33 p-b-60\">";
		}

		function _after_add_to_cart_form_callback() {
			echo "</div>";
		}
	}
}