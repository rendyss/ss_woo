<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/19/2019
 * Time: 2:58 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $ssWootemp;

get_header();

while ( have_posts() ) : the_post();

	echo $ssWootemp->render( 'cover', array(
		'cover_url'   => get_post_thumbnail_id() ? wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' ) : get_template_directory_uri() . '/assets/images/def-banner.jpg',
		'cover_title' => get_the_title(),
		'cover_desc'  => ''
	) );
	the_content();

endwhile;

get_footer();