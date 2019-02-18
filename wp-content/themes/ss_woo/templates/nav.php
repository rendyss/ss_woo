<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/18/2019
 * Time: 11:15 AM
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( has_nav_menu( 'main_menu' ) ) :
	wp_nav_menu( array(
			'theme_location' => $is_top ? 'main_menu' : 'footer_menu',
			'menu_class'     => $is_top ? 'main_menu' : '',
			'depth'          => 1,
			'container'      => '',
			'walker'         => new Class_SSWoo_Navwalker()
		)
	);
endif;