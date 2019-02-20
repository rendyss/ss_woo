<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/20/2019
 * Time: 8:58 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<li class="header-cart-item">
    <div class="header-cart-item-img">
        <img src="<?php echo $thumbnail_url; ?>" alt="IMG">
    </div>

    <div class="header-cart-item-txt">
        <a href="<?php echo $product_url; ?>" class="header-cart-item-name">
			<?php echo $product_title; ?>
        </a>
        <span class="header-cart-item-info"><?php echo $qty_number . " x " . $product_price; ?></span>
    </div>
</li>
