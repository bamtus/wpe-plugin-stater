<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// include "helper.class.php";
include "posttypes.class.php";
include "options.class.php";
// include "filter.class.php";
// include "shortcodes/index.php";
// include "widgets/index.php";

if(class_exists('WooCommerce')) {
	include "woo.class.php";
}
