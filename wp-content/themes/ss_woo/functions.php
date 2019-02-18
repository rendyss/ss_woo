<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/18/2019
 * Time: 8:43 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_template_directory() . '/inc/class-sswoo.php';
Class_SSWoo::init();

global $ssWootemp;
$ssWootemp = new Class_SSWoo_Template( get_template_directory() . '/templates' );