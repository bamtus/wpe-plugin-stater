<?php
/*
Plugin Name: The plugin name
Description: The description.
Author: WPElite.net
Version: 1.0
Author URI: http://wpelite.net/
Text Domain: wpelite
Domain Path: /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


defined( 'WPE_PLUGIN_VERSION' ) or define('WPE_PLUGIN_VERSION', '1.0') ;

defined( 'WPE_PLUGIN_URL' ) or define('WPE_PLUGIN_URL', plugins_url( '/', __FILE__ )) ;

defined( 'WPE_PLUGIN_PATH' ) or define('WPE_PLUGIN_PATH', basename( dirname( __FILE__ ))) ;
defined( 'WPE_PLUGIN_TEXTDOMAIN' ) or define('WPE_PLUGIN_TEXTDOMAIN', plugins_url( '/', __FILE__ )) ;


if ( ! class_exists( 'WPE_PLUGIN_CLASS' ) ) {
	/**
	 * WPE_PLUGIN_CLASS Class
	 *
	 * @since	1.0
	 */
	class WPE_PLUGIN_CLASS {
		
		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			// Load core
			if(!class_exists('WPE_CORE_CLASS')) {
				include_once 'wpe-core/index.php';
			}
			WPE_CORE_CLASS::support('options');
			
			if(is_admin()) {
				include_once 'includes/admin/index.php';
			}
			WPE_CORE_CLASS::support('posttypes');
			include_once 'includes/index.php';
			
            add_action( 'init', array( $this, 'init' ) );
		}

		public function init() {
			// Load enqueueScripts
			if(is_admin()) {
				add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
			}
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );
        }

		public function adminEnqueueScripts() {
			WPE_CORE_CLASS::adminEnqueueScripts();
			
			// wp_enqueue_script( 'demo', WPE_PLUGIN_URL . '/assets/admin/js/demo.js', array( 'jquery' ), WPE_PLUGIN_VERSION, true );
			// wp_enqueue_style( 'demo', WPE_PLUGIN_URL . '/assets/admin/css/demo.css', array(), WPE_PLUGIN_VERSION  );
		}

		public function enqueueScripts() {
			WPE_CORE_CLASS::enqueueScripts();
			
			// wp_enqueue_style( 'bbfb', WPE_PLUGIN_URL . '/assets/css/bbfb.css', array(), WPE_PLUGIN_VERSION );
			// wp_enqueue_script( 'bbfb-builder', WPE_PLUGIN_URL . '/assets/js/script.js', array( 'jquery' ), WPE_PLUGIN_VERSION, true );

		}
		
		public function loadTextDomain() {
			load_plugin_textdomain( WPE_PLUGIN_TEXTDOMAIN, false, WPE_PLUGIN_PATH . '/languages/' );
		}
		
	}
	new WPE_PLUGIN_CLASS();
}
