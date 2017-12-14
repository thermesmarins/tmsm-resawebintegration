<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/nicomollet
 * @since             1.0.0
 * @package           Tmsm_Woocommerce_Customadmin
 *
 * @wordpress-plugin
 * Plugin Name:       TMSM Resaweb Integration
 * Plugin URI:        https://github.com/thermesmarins/tmsm-resawebintegration
 * Description:       Resaweb Shortcodes for prices
 * Version:           1.0.1
 * Author:            Nicolas Mollet
 * Author URI:        https://github.com/nicomollet
 * Requires PHP:      5.6
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tmsm-woocommerce-customadmin
 * Domain Path:       /languages
 * Github Plugin URI: https://github.com/thermesmarins/tmsm-resawebintegration
 * Github Branch:     master
 */



/*
 * Example:
 * [resaweb_load package_id="1"]
 * [resaweb_load hotel_id="GHT" package_id="1"]
 * [resaweb_price hotel_id="GHT" package_id="1" nights="6" lang="fr"]
 */


function tmsm_resawebintegration_price( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'hotel_id'   => '',
		'package_id' => '',
		'nights'     => '',
	), $atts );

	$price = '<span class="resaweb-price" data-hotelid="' . esc_attr( $atts['hotel_id'] ) . '" data-packageid="' . esc_attr( $atts['package_id'] ). '" data-nights="' . esc_attr( $atts['nights'] ) . '">?</span>';

	return $price;
}

add_shortcode( 'resaweb_price', 'tmsm_resawebintegration_price' );

function tmsm_resawebintegration_load( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'hotel_id'   => '',
		'trip_id'    => '',
		'package_id' => '',
		'nights' => '',
		'lang'       => '',
	), $atts );

	$load = '<span class="resaweb-load" data-hotelid="' . esc_attr( $atts['hotel_id'] ) . '" data-packageid="' . esc_attr( $atts['package_id'] ) . '" data-nights="' . esc_attr( $atts['nights'] ) . '" data-tripid="' . esc_attr( $atts['trip_id'] ) . '" data-lang="' . esc_attr( $atts['lang'] ) . '"></span>';

	return $load;
}

add_shortcode( 'resaweb_load', 'tmsm_resawebintegration_load' );

function tmsm_resawebintegration_accommodation3blocks( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'hotel_id'   => '',
		'trip_id'    => '',
		'package_id' => '',
		'nights' => '',
		'lang'       => '',
	), $atts );

	$accommodation3blocks = '<div class="resaweb-accommodation3blocks" data-hotelid="' . esc_attr( $atts['hotel_id'] ) . ' data-lang="' . esc_attr( $atts['lang'] ) . '"></div>';

	return $accommodation3blocks;
}

add_shortcode( 'resaweb_accommodation3blocks', 'tmsm_resawebintegration_accommodation3blocks' );


function tmsm_resawebintegration_enqueue_scripts() {
	wp_enqueue_script( 'tmsm_resawebintegration_js', plugin_dir_url( __FILE__ ) . 'js/tmsm-resawebintegration.js', array( 'jquery' ), '1.0.1', true );
}

add_action( 'wp_enqueue_scripts', 'tmsm_resawebintegration_enqueue_scripts' );