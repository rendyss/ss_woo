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
			$this->_single_product_tabs_customizer();
			$this->_single_product_related_customizer();
			$this->_loop_product_customizer();
		}

		private function _loop_product_customizer() {

			//remove link open
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );

			//remove link close
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );

			//remove add to cart
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

			//add .item-slick2 .block2
			add_action( 'woocommerce_before_shop_loop_item', array( $this, '_before_loop_item_callback' ) );

			//add .block2-img
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_before_loop_item_title_callback'
			), 5 );

			//add .block2-overlay.trans-0-4
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_before_add_to_cart_overlay_callback'
			), 15 );

			//add /.block2-overlay /.block2-img
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_after_add_to_cart_overlay_callback'
			), 25 );

			add_action( 'woocommerce_after_shop_loop_item', array( $this, '_after_loop_item_callback' ), 15 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );

			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 );
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_before_loop_item_title_and_price_callback'
			), 30 );
			add_action( 'woocommerce_after_shop_loop_item_title', array(
				$this,
				'_after_loop_item_title_callback'
			), 15 );
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
			add_action( 'woocommerce_shop_loop_item_title', array( $this, '_loop_item_title_callback' ) );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating' );
			add_action( 'woocommerce_after_shop_loop_item_title', array(
				$this,
				'_after_loop_item_title_and_price_callback'
			), 5 );
		}

		function _before_add_to_cart_overlay_callback() {
			echo "<div class=\"block2-overlay trans-0-4\">
									<a href=\"#\" class=\"block2-btn-addwishlist hov-pointer trans-0-4\">
										<i class=\"icon-wishlist icon_heart_alt\" aria-hidden=\"true\"></i>
										<i class=\"icon-wishlist icon_heart dis-none\" aria-hidden=\"true\"></i>
									</a>

									<div class=\"loop_add_to_cart block2-btn-addcart w-size1 trans-0-4\">";
		}

		function _after_add_to_cart_overlay_callback() {
			echo "</div></div></div>";
		}

		function _loop_item_title_callback() {
			global $product;
			echo "<a href=\"" . $product->get_permalink() . "\" class=\"block2-name dis-block s-text3 p-b-5\" tabindex=\"0\">" . $product->get_title() . "</a>";
		}

		function _after_loop_item_title_callback() {
			echo "</div>";
		}

		function _before_loop_item_title_and_price_callback() {
			echo "<div class=\"block2-txt p-t-20\">";
		}

		function _after_loop_item_title_and_price_callback() {
			echo "</div>";
		}

		function _before_loop_item_title_callback() {
			global $product;
			$prod_class = "block2-img wrap-pic-w of-hidden pos-relative";
			$prod_class .= $product->is_on_sale() ? " block2-labelsale" : "";
			echo "<div class=\"$prod_class\">";
		}

		function _after_loop_item_callback() {
			echo "</div>";
//			echo "</div>";
		}

		function _before_loop_item_callback() {
			echo "<div class=\"item-slick2 p-l-15 p-r-15\">";
			echo "<div class=\"block2\">";
		}

		private function _single_product_related_customizer() {
			add_action( 'woocommerce_after_single_product_summary', array( $this, '_before_related_callback' ), 5 );
			add_action( 'woocommerce_after_single_product_summary', array( $this, '_after_related_callback' ), 25 );
		}

		function _before_related_callback() {
			echo "<div class=\"bgwhite p-t-45 p-b-138\">";
			echo "<div class=\"container\">";
		}

		function _after_related_callback() {
			echo "</div>";
			echo "</div>";
		}

		private function _single_product_tabs_customizer() {

			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 55 );
		}

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