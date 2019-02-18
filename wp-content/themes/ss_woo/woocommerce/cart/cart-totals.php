<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
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
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <h5 class="m-text20 p-b-24"><?php _e( 'Cart totals', 'woocommerce' ); ?></h5>

    <!--    <table cellspacing="0" class="shop_table shop_table_responsive">-->

    <!--    <tr class="cart-subtotal">-->
    <!--        <th>--><?php //_e( 'Subtotal', 'woocommerce' ); ?><!--</th>-->
    <!--        <td data-title="--><?php //esc_attr_e( 'Subtotal', 'woocommerce' ); ?><!--">-->
	<?php //wc_cart_totals_subtotal_html(); ?><!--</td>-->
    <!--    </tr>-->

    <!--    Subtotal-->
    <div class="flex-w flex-sb-m p-b-12">
        <span class="s-text18 w-size19 w-full-sm">
            <?php _e( 'Subtotal', 'woocommerce' ); ?>
        </span>

        <span class="m-text21 w-size20 w-full-sm">
            <?php wc_cart_totals_subtotal_html(); ?>
        </span>
    </div>

	<?php if ( WC()->cart->get_coupons() ) : ?>
        <div class="bo10 p-t-12">
			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="flex-w flex-sb-m p-b-12 coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <span class="s-text18 w-size19 w-full-sm">
                        <?php wc_cart_totals_coupon_label( $coupon ); ?>
                    </span>
                    <span class="m-text21 w-size20 w-full-sm">
                        <?php wc_cart_totals_coupon_html( $coupon ); ?>
                    </span>
                </div>
                <!--        <tr class="cart-discount coupon---><?php //echo esc_attr( sanitize_title( $code ) ); ?><!--">-->
                <!--            <th>--><?php //wc_cart_totals_coupon_label( $coupon ); ?><!--</th>-->
                <!--            <td data-title="--><?php //echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?><!--">--><?php //wc_cart_totals_coupon_html( $coupon ); ?><!--</td>-->
                <!--        </tr>-->
			<?php endforeach; ?>
        </div>
	<?php endif; ?>

	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

		<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

		<?php wc_cart_totals_shipping_html(); ?>

		<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

	<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

        <div class="flex-w flex-sb-m p-b-12 shipping">
            <span class="s-text18 w-size19 w-full-sm">
                <?php _e( 'Shipping', 'woocommerce' ); ?>
            </span>
            <span class="m-text21 w-size20 w-full-sm">
                <?php woocommerce_shipping_calculator(); ?>
            </span>
        </div>

	<?php endif; ?>

	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <div class="flex-w flex-sb-m p-b-12 fee">
            <span class="s-text18 w-size19 w-full-sm">
                <?php echo esc_html( $fee->name ); ?>
            </span>
            <span class="m-text21 w-size20 w-full-sm">
                <?php wc_cart_totals_fee_html( $fee ); ?>
            </span>
        </div>
	<?php endforeach; ?>

	<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
		$taxable_address = WC()->customer->get_taxable_address();
		$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
			? sprintf( ' <small>' . __( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
			: '';

		if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) :
			if ( WC()->cart->get_tax_totals() ): ?>
                <div class="bo10 p-t-12">
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                        <div class="flex-w flex-sb-m p-b-12 fee tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
                        <span class="s-text18 w-size19 w-full-sm">
                            <?php echo esc_html( $tax->label ) . $estimated_text; ?>
                        </span>
                            <span class="m-text21 w-size20 w-full-sm">
                            <?php echo wp_kses_post( $tax->formatted_amount ); ?>
                        </span>
                        </div>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>
		<?php else : ?>
            <div class="bo10 p-t-12 flex-w flex-sb-m p-b-12 fee tax-total">
                <span class="s-text18 w-size19 w-full-sm">
                    <?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?>
                </span>
                <span class="m-text21 w-size20 w-full-sm">
                    <?php wc_cart_totals_taxes_total_html(); ?>
                </span>
            </div>
		<?php endif; ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

    <div class="flex-w flex-sb-m p-t-12 p-b-30 order-total">
        <span class="s-text18 w-size19 w-full-sm">
            <?php _e( 'Total', 'woocommerce' ); ?>
        </span>
        <span class="m-text21 w-size20 w-full-sm">
            <?php wc_cart_totals_order_total_html(); ?>
        </span>
    </div>

	<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    <!--    </table>-->

    <div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
    </div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
