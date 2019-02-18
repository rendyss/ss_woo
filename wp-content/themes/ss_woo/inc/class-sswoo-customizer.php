<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2/18/2019
 * Time: 10:42 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Class_SSWoo_Customizer' ) ) {
	class Class_SSWoo_Customizer {
		static function init() {
			static $instance = null;
			if ( $instance === null ) {
				$instance = new self();
			}

			return $instance;
		}

		private function __construct() {
			$this->_register_section();
			$this->_register_field();
		}

		private function _register_section() {
			add_action( 'customize_register', array( $this, '_section_callback' ) );
		}

		function _section_callback( $wp_customize ) {
			$wp_customize->add_panel( 'front_page', array(
				'title' => __( 'Front Page' ),
			) );

			$wp_customize->add_section( 'header', array(
				'title' => __( 'Header' ),
				'panel' => 'front_page',
			) );
		}

		private function _register_field() {
			add_filter( 'kirki/fields', array( $this, '_field_callback' ) );
		}

		function _field_callback() {
			$fields[] = array(
				'type'        => 'image',
				'settings'    => '_logo',
				'label'       => __( 'Logo' ),
				'description' => __( 'Recommended to use 120 x 27px image' ),
				'section'     => 'title_tagline',
				'default'     => '',
				'choices'     => array(
					'save_as' => 'id',
				),
			);

			return $fields;
		}
	}
}