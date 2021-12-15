<?php

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_filter('woocommerce_product_add_to_cart_text', 'change_text');
function change_text($text) {
	$text = 'Acheter';

	return $text;
}

add_action('wp_enqueue_scripts', 'my_load_scripts');
function my_load_scripts($hook) {
 
	wp_enqueue_script(
		'nomade-main-js',
		get_stylesheet_directory_uri() . '/js/main.js',
		array('jquery', 'slick-js'),
		null,
		true 
	);

	wp_enqueue_script(
		'slick-js',
		get_stylesheet_directory_uri() . '/slick/slick.min.js',
		array('jquery'),
		null,
		true 
	);
	
	wp_enqueue_style(
		'slick-css',
		get_stylesheet_directory_uri() . '/slick/slick.css'
	);
	wp_enqueue_style(
		'slick-theme-css',
		get_stylesheet_directory_uri() . '/slick/slick-theme.css'
	);

}

// Add WooCommerce Supoprt and WooCommerce Gallery support
add_action( 'after_setup_theme', 'nomades_add_woocommerce_support' );
function nomades_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

// Remove meta on product price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Hide other delivery methods if free shipping is available
add_filter( 'woocommerce_package_rates', 'nomades_hide_shipping_when_free_is_available', 100 );
function nomades_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	
	return ! empty( $free ) ? $free : $rates;
}

// Remove additionnal info tab
add_filter( 'woocommerce_product_tabs', 'remove_product_tabs', 99 );
function remove_product_tabs( $tabs ) {
	unset( $tabs['additional_information'] ); 
	// unset( $tabs['reviews'] ); 
	return $tabs;
}

// Replace "Out of stock" label
add_filter('woocommerce_get_availability', 'nomades_availability_label');
function nomades_availability_label($availability) {
	$availability['availability'] = str_replace('Rupture de stock', 'Vendu', $availability['availability']);
	return $availability;
}

// Set a minimum order amount for checkout
add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
add_action( 'woocommerce_before_cart' , 'wc_minimum_order_amount' );
function wc_minimum_order_amount() {
    $minimum = 50;

    if ( WC()->cart->total < $minimum ) {

        wc_print_notice( 
            sprintf( 'Votre total est de %s — vous devez avoir un minimum de %s pour commander' , 
                wc_price( WC()->cart->total ), 
                wc_price( $minimum )
            ), 'error' 
        );

    }
}