<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/18/2019
 * Time: 9:43 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $ssWootemp;

get_header();

echo $ssWootemp->render( 'front-slider' );

get_footer();
