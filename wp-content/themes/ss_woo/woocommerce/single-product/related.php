<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

    <section class="related products">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center"><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h3>
        </div>
        <div class="wrap-slick2">
            <div class="slick2">
				<?php woocommerce_product_loop_start(); ?>

				<?php foreach ( $related_products as $related_product ) : ?>

                    <div class="item-slick2 p-l-15 p-r-15">
						<?php $post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' ); ?>

                    </div>

				<?php endforeach; ?>

				<?php woocommerce_product_loop_end(); ?>
            </div>
        </div>
    </section>

<?php endif;

wp_reset_postdata();
