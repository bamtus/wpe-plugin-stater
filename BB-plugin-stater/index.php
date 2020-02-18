<?php
/*
Plugin Name: The plugin name
Description: The description.
Author: bbElite.net
Version: 1.0
Author URI: http://bbelite.net/
Text Domain: bbelite
Domain Path: /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


defined( 'BB_PLUGIN_VERSION' ) or define('BB_PLUGIN_VERSION', '1.0') ;
defined( 'BB_PLUGIN_URL' ) or define('BB_PLUGIN_URL', plugins_url( '/', __FILE__ )) ;
defined( 'BB_PLUGIN_PATH' ) or define('BB_PLUGIN_PATH', basename( dirname( __FILE__ ))) ;
defined( 'BB_PLUGIN_TEXTDOMAIN' ) or define('BB_PLUGIN_TEXTDOMAIN', plugins_url( '/', __FILE__ )) ;
defined( 'BB_PLUGIN_POSTTYPE' ) or define('BB_PLUGIN_POSTTYPE','bb-core') ;
defined( 'BB_META_POST' ) or define('BB_META_POST','bb_meta_') ;
defined( 'BB_PLUGIN_PAGESLUG' ) or define('BB_PLUGIN_PAGESLUG','bb_meta_') ;
if ( ! class_exists( 'BB_PLUGIN_CLASS' ) ) {
	/**
	 * BB_PLUGIN_CLASS Class
	 *
	 * @since	1.0
	 */
	class BB_PLUGIN_CLASS {
		
		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			// Load core
			if(!class_exists('BestBug_Core_Class')) {
				include_once 'bestbugcore/index.php';
			}
			BestBug_Core_Class::support('options');
			BestBug_Core_Class::support('meta_box');
			if(is_admin()) {
				include_once 'includes/admin/index.php';
			}
			BestBug_Core_Class::support('posttypes');
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
			BestBug_Core_Class::adminEnqueueScripts();
			
			// wp_enqueue_script( 'demo', BB_PLUGIN_URL . '/assets/admin/js/demo.js', array( 'jquery' ), BB_PLUGIN_VERSION, true );
			// wp_enqueue_style( 'demo', BB_PLUGIN_URL . '/assets/admin/css/demo.css', array(), BB_PLUGIN_VERSION  );
		}

		public function enqueueScripts() {
			BestBug_Core_Class::enqueueScripts();
			
			// wp_enqueue_style( 'bbfb', BB_PLUGIN_URL . '/assets/css/bbfb.css', array(), BB_PLUGIN_VERSION );
			// wp_enqueue_script( 'bbfb-builder', BB_PLUGIN_URL . '/assets/js/script.js', array( 'jquery' ), BB_PLUGIN_VERSION, true );

		}
		
		public function loadTextDomain() {
			load_plugin_textdomain( BB_PLUGIN_TEXTDOMAIN, false, BB_PLUGIN_PATH . '/languages/' );
		}
		
	}
	new BB_PLUGIN_CLASS();
}
