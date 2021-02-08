<?php
/**
 * Plugin Name: disable techiepress dhl shipping
 * Plugin URI: httsp://github.com/yttechiepress/disable-techiepress-dhl-shipping
 * Author: Plugin Techiepress
 * Author URI: httsp://github.com/yttechiepress/disable-techiepress-dhl-shipping
 * Description: This plugin allows for DHL shipping method on Kampala state alone.
 * Version: 0.1.0
 * License: GPL2 or later
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: disable-techiepress-dhl-shipping
*/

// Basic security
defined( 'ABSPATH' ) or die( 'Unauthorized access' );

add_action( 'woocommerce_package_rates', 'techiepress_change_dhl', 100, 2 );

function techiepress_change_dhl( $rates, $package ) {

    $customer_data = WC()->session->get('customer');
    $billing_state = $customer_data['state'];

    if ( $billing_state == 'UG102' ) {
        unset( $rates['techipress_dhl_shipping'] );
    }

    return $rates;
}

add_filter( 'woocommerce_checkout_fields', 'techiepress_dhl_add_class' );

function techiepress_dhl_add_class( $fields ) {

    $fields['billing']['billing_state']['class'][] = 'update_totals_on_change';

    return $fields;
}