<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'BB_PLUGIN_WOO' ) ) {
	/**
	 * BB_PLUGIN_WOO Class
	 *
	 * @since	1.0
	 */
	class BB_PLUGIN_WOO {


		/**
		 * Constructor
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			$this->init();
		}

		public function init() {

			if(is_admin()) {
				add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
			}
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );

        }

		public function adminEnqueueScripts() {
		
		}

		public function enqueueScripts() {
		
        }
    }
	
	new BB_PLUGIN_WOO();
}

