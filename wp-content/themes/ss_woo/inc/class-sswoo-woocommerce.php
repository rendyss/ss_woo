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
			$this->_archive_customizer();
			$this->_single_customizer();
		}

		private function _single_customizer() {
			//remove flash
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		}

		private function _archive_customizer() {
			//remove breadcrumb in archive page
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

			//remove description
			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
			remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );

			//add our own description
			add_action( 'woocommerce_archive_description', array( $this, '_custom_archive_desc_callback' ), 10 );
			add_action( 'woocommerce_archive_description', array(
				$this,
				'_custom_product_archive_desc_callback'
			), 10 );

			//add header wrapper
			add_action( 'woocommerce_before_main_content', array( $this, '_before_archive_header_callback' ), 50 );

			//add header closer
			add_action( 'woocommerce_archive_description', array( $this, '_after_archive_header_callback' ), 30 );

			//add content wrapper
			add_action( 'woocommerce_archive_description', array( $this, '_before_content_callback' ), 40 );

			//add sidebar wrapper
			add_action( 'woocommerce_archive_description', array( $this, '_before_sidebar_callback' ), 45 );

			//add sidebar
			add_action( 'woocommerce_archive_description', array( $this, '_sidebar_callback' ), 50 );

			//close sidebar wrapper
			add_action( 'woocommerce_archive_description', array( $this, '_after_sidebar_callback' ), 55 );

			//before loop item wrapper
			add_action( 'woocommerce_archive_description', array( $this, '_before_archive_loop_item_callback' ), 60 );

			//add notices
			add_action( 'woocommerce_archive_description', 'woocommerce_output_all_notices', 65 );

			//after loop item wrapper
			add_action( 'woocommerce_after_main_content', array( $this, '_after_archive_loop_item_callback' ), 5 );

			//add content closer
			add_action( 'woocommerce_after_main_content', array( $this, '_after_content_callback' ), 6 );

			//remove resoult count
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

			//add wrapper before ordering
			add_action( 'woocommerce_before_shop_loop', array( $this, '_before_catalog_ordering_callback' ), 25 );

			//add wrapper before result count
			add_action( 'woocommerce_before_shop_loop', array( $this, '_before_result_count_callback' ), 30 );

			//add result count
			add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 35 );

			//add closer after result count
			add_action( 'woocommerce_before_shop_loop', array( $this, '_after_result_count_callback' ), 40 );

			//add closer after catalog
			add_action( 'woocommerce_before_shop_loop', array( $this, '_after_catalog_ordering_callback' ), 45 );

			//remove notices
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );

			//add row before item loop
			add_action( 'woocommerce_before_shop_loop', array( $this, '_before_item_loop_archive_callback' ), 50 );

			//close row after item loop
			add_action( 'woocommerce_after_shop_loop', array( $this, '_after_item_loop_archive_callback' ), 5 );
		}

		function _after_item_loop_archive_callback() {
			echo "</div>";
		}

		function _before_item_loop_archive_callback() {
			echo "<div class=\"row\">";
		}

		function _after_result_count_callback() {
			echo "</span>";
		}

		function _before_result_count_callback() {
			echo "<span class=\"s-text8 p-t-5 p-b-5\">";
		}

		function _after_catalog_ordering_callback() {
			echo "</div>";
		}

		function _before_catalog_ordering_callback() {
			echo "<div class=\"flex-sb-m flex-w p-b-35\">";
		}

		function _after_archive_loop_item_callback() {
			echo "</div>";
		}

		function _before_archive_loop_item_callback() {
			echo "<div class=\"col-sm-6 col-md-8 col-lg-9 p-b-50\">";
		}

		function _after_content_callback() {
			echo "</div></div></section>";
		}

		function _before_content_callback() {
			echo "<section class=\"bgwhite p-t-55 p-b-65\">";
			echo "<div class=\"container\">";
			echo "<div class=\"row\">";
		}

		function _before_sidebar_callback() {
			echo "<div class=\"col-sm-6 col-md-4 col-lg-3 p-b-50\">";
		}

		function _sidebar_callback() {
			global $ssWootemp;
			$prod_cats = get_categories( array(
				'taxonomy' => 'product_cat'
			) );
			echo $ssWootemp->render( 'woo-archive-sidebar', array( 'prod_cats' => $prod_cats ) );
		}

		function _after_sidebar_callback() {
			echo "</div>";
		}

		function _after_archive_header_callback() {
			echo "</section>";
		}

		function _before_archive_header_callback() {
			$term = get_queried_object();

			if ( property_exists( $term, 'term_id' ) ) {
				$thumb_url    = get_template_directory_uri() . '/assets/images/def-banner.jpg';
				$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
				if ( $thumbnail_id ) {
					$thumb_url = wp_get_attachment_image_url( $thumbnail_id, 'large' );
				}
				echo "<section class=\"bg-title-page p-t-50 p-b-40 flex-col-c-m woocommerce-products-header\" style=\"background: url($thumb_url) center no-repeat; background-size: cover;\">";
			}
		}

		function _custom_archive_desc_callback() {
			if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
				$term = get_queried_object();

				if ( $term && ! empty( $term->description ) ) {
					echo '<p class="m-text13 t-center">' . $term->description . '</p>'; // WPCS: XSS ok.
				}
			}
		}

		function _custom_product_archive_desc_callback() {
			// Don't display the description on search results page.
			if ( is_search() ) {
				return;
			}

			if ( is_post_type_archive( 'product' ) && in_array( absint( get_query_var( 'paged' ) ), array(
					0,
					1
				), true ) ) {
				$shop_page = get_post( wc_get_page_id( 'shop' ) );
				if ( $shop_page ) {
					$description = wc_format_content( $shop_page->post_content );
					if ( $description ) {
						echo '<p class="m-text13 t-center">' . $description . '</p>'; // WPCS: XSS ok.
					}
				}
			}
		}

		private function _loop_product_customizer() {

			//remove link open
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );

			//remove link close
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );

			//remove flash sale
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );

			//remove title
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

			//remove add to cart
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

			//remove rating
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

			//add .block2
			add_action( 'woocommerce_before_shop_loop_item', array( $this, '_before_loop_item_callback' ) );

			//add .block2-img.wrap-pic-w.of-hidden.pos-relative
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_before_thumbnail_add_to_cart_callback'
			), 5 );

			//thumbnail goes here

			//add .block2-overlay.trans-0-4
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_before_loop_add_to_cart_callback'
			), 15 );

			//add wishlist
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_custom_loop_add_to_wish_list_callback'
			), 20 );

			//add .block2-btn-addcart w-size1 trans-0-4
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_before_loop_add_to_cart_button'
			), 25 );

			//add add to cart
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 30 );

			//add closer .block2-btn-addcart w-size1 trans-0-4
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_after_loop_add_to_cart_button'
			), 35 );

			//closer .block2-overlay.trans-0-4
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_after_loop_add_to_cart_callback'
			), 40 );

			//add closer .block2-img.wrap-pic-w.of-hidden.pos-relative
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'_after_thumbnail_add_to_cart_callback'
			), 45 );

			//add .block2-txt p-t-20
			add_action( 'woocommerce_after_shop_loop_item_title', array( $this, '_before_loop_price_callback' ), 7 );

			//add title
			add_action( 'woocommerce_after_shop_loop_item_title', array( $this, '_custom_loop_title_callback' ), 8 );

			//price goes here

			//add closer .block2-txt p-t-20
			add_action( 'woocommerce_after_shop_loop_item_title', array( $this, '_after_loop_price_callback' ), 15 );

			//add closer .block2
			add_action( 'woocommerce_after_shop_loop_item', array( $this, '_after_loop_item_callback' ), 15 );

		}

		function _before_loop_add_to_cart_button() {
			echo "<div class=\"block2-btn-addcart w-size1 trans-0-4\">";
		}

		function _after_loop_add_to_cart_button() {
			echo "</div>";
		}

		function _custom_loop_add_to_wish_list_callback() {
			echo "<a href=\"#\" class=\"block2-btn-addwishlist hov-pointer trans-0-4\">
											<i class=\"icon-wishlist icon_heart_alt\" aria-hidden=\"true\"></i>
											<i class=\"icon-wishlist icon_heart dis-none\" aria-hidden=\"true\"></i>
										</a>";
		}

		function _after_loop_add_to_cart_callback() {
			echo "</div>";
		}

		function _before_loop_add_to_cart_callback() {
			echo "<div class=\"block2-overlay trans-0-4\">";
		}

		function _custom_loop_title_callback() {
			global $product;
			echo "<a href=\"" . $product->get_permalink() . "\" class=\"block2-name dis-block s-text3 p-b-5\">" . $product->get_title() . "</a>";
		}

		function _after_loop_price_callback() {
			echo "</div>";
		}

		function _before_loop_price_callback() {
			echo "<div class=\"block2-txt p-t-20\">";
		}

		function _after_thumbnail_add_to_cart_callback() {
			echo "</div>";
		}

		function _before_thumbnail_add_to_cart_callback() {
			global $product;
			$pclass = "block2-img wrap-pic-w of-hidden pos-relative";
			$pclass .= $product->is_on_sale() ? " block2-labelsale" : "";
			echo "<div class=\"$pclass\">";
		}

		function _after_loop_item_callback() {
			echo "</div>";
		}

		function _before_loop_item_callback() {
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