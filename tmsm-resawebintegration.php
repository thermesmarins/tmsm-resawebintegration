<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://github.com/nicomollet
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       TMSM Resaweb Integration
 * Plugin URI:        https://github.com/thermesmarins/tmsm-resawebintegration
 * Description:       Resaweb Shortcodes for prices
 * Version:           1.0.8
 * Author:            Nicolas Mollet
 * Author URI:        https://github.com/nicomollet
 * Requires PHP:      5.6
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tmsm-resawebintegration
 * Domain Path:       /languages
 * Github Plugin URI: https://github.com/thermesmarins/tmsm-resawebintegration
 * Github Branch:     master
 */

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TMSM_RESAWEBINTEGRATION_VERSION', '1.0.8' );

/**
 * Shortcode for [resaweb-price]
 *
 * @param      $atts
 * @param null $content
 *
 * @return string
 */
function tmsm_resawebintegration_price( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'hotel_id'   => '',
		'package_id' => '',
		'nights'     => '',
		'instead'     => 0,
		'from'     => 0,
		'fallback'     => 0,
	), $atts );

	$price = '<span class="resaweb-price" data-hotelid="' . esc_attr( $atts['hotel_id'] ) . '" data-packageid="' . esc_attr( $atts['package_id'] ). '" data-nights="' . esc_attr( $atts['nights'] ) . '" data-fallback="' . esc_attr( $atts['fallback'] ) . '">';

	if($atts['fallback']){
		$price .= '<span class="fallback">'.esc_attr__( 'Check availability', 'tmsm-resawebintegration' ).'</span>&nbsp;';
	}

	if($atts['from']){
		$price .= '<span class="from" style="display:none">'._x('From', 'price', 'tmsm-resawebintegration').'</span>&nbsp;';
	}
	$price .= '<span class="pricevalue" style="display:none">?</span>';
	if($atts['instead']){
		$price .= '<span class="instead" style="display:none">&nbsp;'.__('instead of','tmsm-resawebintegration').'&nbsp;<span class="insteadvalue">?</span></span>';
	}
	$price .= '</span>';

	return $price;
}
add_shortcode( 'resaweb_price', 'tmsm_resawebintegration_price' );

/**
 * Shortcode for [resaweb-load]
 *
 * @param      $atts
 * @param null $content
 *
 * @return string
 */
function tmsm_resawebintegration_load( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'hotel_id'   => '',
		'trip_id'    => '',
		'package_id' => '',
		'nights' => '',
	), $atts );

	$load = '<span class="resaweb-load" data-hotelid="' . esc_attr( $atts['hotel_id'] ) . '" data-packageid="' . esc_attr( $atts['package_id'] ) . '" data-nights="' . esc_attr( $atts['nights'] ) . '" data-tripid="' . esc_attr( $atts['trip_id'] ) . '"></span>';

	return $load;
}
add_shortcode( 'resaweb_load', 'tmsm_resawebintegration_load' );

/**
 * Shortcode [resaweb-accommodation3blocks]
 *
 * @param array $atts
 * @param null $content
 *
 * @return string
 */
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

/**
 * Enqueue Javascript
 */
function tmsm_resawebintegration_enqueue_scripts() {
	wp_enqueue_script( 'tmsm_resawebintegration', plugin_dir_url( __FILE__ ) . 'js/tmsm-resawebintegration.js', array( 'jquery' ), TMSM_RESAWEBINTEGRATION_VERSION, true );

	// Params
	$params = [
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'locale'   => function_exists('pll_current_language') ? pll_current_language() : substr(get_locale(),0, 2),
		'i18n'     => [
			'fromprice'          => _x( 'From', 'price', 'tmsm-resawebintegration' ),
			'fallback'          => esc_attr__( 'Check availability', 'tmsm-resawebintegration' ),
		],
		'options'  => [
			'currency' => 'EUR',
		],
	];

	wp_localize_script( 'tmsm_resawebintegration', 'tmsm_resawebintegration_params', $params);
}
add_action( 'wp_enqueue_scripts', 'tmsm_resawebintegration_enqueue_scripts' );

/**
 * Load plugin textdomain.
 *
 * @since 1.0.3
 */
function tmsm_resawebintegration_load_textdomain() {
	load_plugin_textdomain( 'tmsm-resawebintegration', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'tmsm_resawebintegration_load_textdomain' );
