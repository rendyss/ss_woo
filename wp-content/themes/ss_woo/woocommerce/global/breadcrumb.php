<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
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
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {
	$delimiter = "<i class=\"fa fa-angle-right m-l-8 m-r-9\" aria-hidden=\"true\"></i>";

//	echo $wrap_before;
	echo "<div class=\"bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm\">";

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '" class="s-text16">' . esc_html( $crumb[0] ) . $delimiter . '</a>';
		} else {
			echo "<span class=\"s-text17\">" . esc_html( $crumb[0] ) . "</span>";
		}

		echo $after;

//		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
//			echo $delimiter;
//		}
	}

//	echo $wrap_after;
	echo "</div>";
}
